<?php

namespace App;

use App\Product;
use App\Category;
use App\Document;
use Illuminate\Database\Eloquent\Model;

class DocumentSupply extends Model
{
    protected $fillable = ['document_id', 'category_id', 'product_id', 'price', 'amount'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
