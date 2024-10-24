<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income_and_Expense extends Model
{
    /** @use HasFactory<\Database\Factories\IncomeAndExpenseFactory> */
    use HasFactory;
    protected $fillable = [
        'delta',
        'date',
        'description',
        'store_id',

    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
