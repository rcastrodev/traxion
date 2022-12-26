<?php

namespace App;

use App\Post;
use App\Section;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['name', 'keywords'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
