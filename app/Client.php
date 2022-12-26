<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    protected $fillable = ['name', 'password', 'email', 'status', 'discount_id'];

    static function getClient()
    {
        return self::find(session('user_id'));
    }

    public function priceLists()
    {
        return $this->belongsToMany(PriceList::class);
    }

}
