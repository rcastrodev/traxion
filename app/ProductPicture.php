<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPicture extends Model
{
    protected $table = 'product_picture';
    protected $fillable = ['product_id', 'image'];
}
