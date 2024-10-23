<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'id', 'store_id', 'location'];

    public function products()
    {
        return $this->hasMany(Product::class)
    }
}