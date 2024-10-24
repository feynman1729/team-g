<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory;

    public function supply()
    {
        return $this->hasMany(Supply::class);
    }

    public function income_and_expenses()
    {
        return $this->hasMany(Income_and_Expense::class);
    }
}
