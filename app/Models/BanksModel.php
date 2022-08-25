<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BanksModel extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function currencies(): HasMany
    {
        return $this->hasMany(CurrenciesModel::class, 'bank_id', 'id');
    }
}
