<?php

namespace App;

use App\Client;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    protected $fillable = ['category_id', 'name', 'type', 'archive'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}
