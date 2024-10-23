<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'id', 'store_id', 'location'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
