<?php

namespace App\Providers;

use App\DTO\Banks\CredoBank;
use App\DTO\Banks\MonoBank;
use App\DTO\Banks\PrivateBank;
use App\DTO\DataActionsDTO\CredoBankDTO;
use App\DTO\DataActionsDTO\MonoBankActionDTO;
use App\DTO\DataActionsDTO\PrivateBankActionDTO;
use App\Http\Controllers\TestController;
use App\Jobs\ExchangerRateJob;
use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\Types\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('MonoBankDTO', function () {
            return ['MonoBank' => new MonoBankActionDTO()];
        });

        $this->app->bind('PrivateBankDTO', function () {
            return ['PrivateBank' => new PrivateBankActionDTO()];
        });

        $this->app->bind('CredoBankDTO', function () {
            return ['CredoBank' => new CredoBankDTO()];
        });

        $this->app->tag([MonoBank::class, PrivateBank::class, CredoBank::class], 'Banks');
        $this->app->tag(['MonoBankDTO', 'PrivateBankDTO', 'CredoBankDTO'], 'DTO');
        $this->app->bindMethod([ExchangerRateJob::class, 'handle'], function ($job, $app) {
            return $job->handle($app->tagged('Banks'), $this->tagsToArrayWithKeys('DTO'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function tagsToArrayWithKeys(string $tag): \Illuminate\Support\Collection
    {
        $tagsWithKeys = [];

        foreach (app()->tagged($tag) as $tags) {
            foreach ($tags as $key => $tag) {
                $tagsWithKeys[$key] = $tag;
            }
        }

        return collect($tagsWithKeys);
    }
}
