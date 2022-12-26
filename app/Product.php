<?php

namespace App;

use App\Car;
use App\Brand;
use App\Color;
use App\Category;
use App\Application;
use App\ProductPicture;
use App\VariableProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'order', 'name', 'description', 'number_of_teeth', 'data_sheet', 'external_diameter', 'inside_diameter', 'thickness', 'code'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductPicture::class);
    }

}
