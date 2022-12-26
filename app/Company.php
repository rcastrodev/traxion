<?php

namespace App;

use App\Data;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name'];

    public function data()
    {
        return $this->hasMany(Data::class);
    }
}
