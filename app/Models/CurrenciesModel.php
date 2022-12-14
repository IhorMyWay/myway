<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurrenciesModel extends Model
{
    use HasFactory;

    protected $guarded = false;

    public $timestamps = false;

    public function exchangeRates(): HasMany
    {
        return $this->hasMany(ExchangeRatesModel::class, 'currency_id', 'id');
    }
}
