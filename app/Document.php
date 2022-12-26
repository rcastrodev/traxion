<?php

namespace App;

use App\Client;
use App\ShoppingCart;
use App\DocumentSupply;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['client_id', 'iva', 'discount', 'delivery', 'comment', 'file', 'status'];

    public function documentSupplies()
    {
        return $this->hasMany(DocumentSupply::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    static function theyHaveDocumentInProcess()
    {
        $client = Client::getClient();

        if (! $client) 
            return null;

        return self::where('client_id', $client->id)->where('status', 'p')->first();
    }

    static function getDocument()
    {
        $client = Client::getClient();
        return self::where('client_id', $client->id)->where('status', 'p')->first();
    }

    static function getProducts($id = null)
    {
        if (isset($id)) {
            return self::findOrFail($id)->documentSupplies;
        } else {
            $client = Client::getClient();
            return self::where('client_id', $client->id)->where('status', 'p')->first()->documentSupplies;
        }
        

    }

    public function discount($subtotal, $id = null)
    {
        if (isset($id))
            $client = self::find($id)->client;
        else
            $client = Client::getClient();

        $discount = 0;

        if ($client->discount)
            if ($client->discount->percentage > 0) 
                $discount = $subtotal * ($client->discount->percentage / 100);
        
        return $discount;
    }

    public function subtotal($id = null)
    {
        $subtotal = [];
        foreach (self::getProducts($id) as $item) {
            $subtotal[] = $item->amount * $item->price; 
        }

        return array_sum($subtotal);
    }

    public function iva($id = null)
    {
        return ($this->subtotal($id) - $this->discount($this->subtotal($id), $id )) * ShoppingCart::getIva();
    }

    public function total($subTotal, $discount, $iva)
    {
        return  ($subTotal - $discount) + $iva;
    }
}
