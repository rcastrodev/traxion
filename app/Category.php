<?php

namespace App;

use App\Car;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['order', 'name', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    static function brandWithCars()
    {
        $brandsID = Car::distinct('category_id')->pluck('category_id')->toArray();
        return Category::whereIn('id', $brandsID)->get();
    }
}
