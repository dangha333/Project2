<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $table = 'products';
    public $primarykey = 'id';
    public $fillable = [
        'category_id',
        'name',
        'price',
        'description',
        'created_at',
        'updated_at',
    ];
}
