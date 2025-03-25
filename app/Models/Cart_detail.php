<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_detail extends Model
{
    /** @use HasFactory<\Database\Factories\CartDetailFactory> */
    use HasFactory;
    protected $table = 'cart_details';
}
