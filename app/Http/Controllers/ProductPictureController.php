<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductPicture;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPictureController extends Controller
{
    public function destroy($id){
        $productPicture = ProductPicture::find($id);
        
        if(Storage::disk('public')->exists($productPicture->image))
            Storage::disk('public')->delete($productPicture->image);

        $productPicture->delete();
    }
}
