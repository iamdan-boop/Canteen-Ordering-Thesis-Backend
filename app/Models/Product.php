<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public static int $PRODUCT_DRINK_TYPE = 1;
    public static int $PRODUCT_BEVERAGES_TYPE = 2;
    public static int $PRODUCT_SNACKS_TYPE = 3;

    protected $fillable = [
        'productName',
        'price',
        'type'
    ];
}
