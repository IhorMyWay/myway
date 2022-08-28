<?php

namespace App\Providers;

use App\DTO\BanksDTO\CredoBankDTO;
use App\DTO\BanksDTO\MonoBankDTO;
use App\DTO\BanksDTO\PrivateBankDTO;
use App\Jobs\ExchangerRateJob;
use App\Services\BanksApiService\CredoBankApiService;
use App\Services\BanksApiService\MonoBankApiService;
use App\Services\BanksApiService\PrivateBankApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('MonoBankApiService', function () {
            return ['MonoBank' => new MonoBankApiService()];
        });

        $this->app->bind('PrivateBankApiService', function () {
            return ['PrivateBank' => new PrivateBankApiService()];
        });

        $this->app->bind('CredoBankApiService', function () {
            return ['CredoBank' => new CredoBankApiService()];
        });

        $this->app->tag([MonoBankDTO::class, PrivateBankDTO::class, CredoBankDTO::class], 'BanksDTO');
        $this->app->tag(['MonoBankApiService', 'PrivateBankApiService', 'CredoBankApiService'], 'ApiService');
        $this->app->bindMethod([ExchangerRateJob::class, 'handle'], function ($job, $app) {
            return $job->handle($app->tagged('BanksDTO'), $this->tagsToArrayWithKeys());
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
    private function tagsToArrayWithKeys(): \Illuminate\Support\Collection
    {
        $tagsWithKeys = [];

        foreach (app()->tagged('ApiService') as $tags) {
            foreach ($tags as $key => $tag) {
                $tagsWithKeys[$key] = $tag;
            }
        }

        return collect($tagsWithKeys);
    }
}
