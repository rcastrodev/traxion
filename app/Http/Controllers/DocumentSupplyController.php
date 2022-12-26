<?php

namespace App\Http\Controllers;

use App\Client;
use App\Product;
use App\Document;
use App\ShoppingCart;
use App\DocumentSupply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentSupplyController extends Controller
{
    private function productCreate(Document $document, Product $product, Request $request)
    {
        return [
            'document_id'   => $document->id, 
            'category_id'   => $product->category->id,
            'product_id'    => $product->id,
            'price'         => $product->price,
            'amount'        => $request->input('amount'),
        ];
    }

    private function productValidator($request)
    {
        Validator::make($request->all(), [
            'product_id'    => 'required',
            'amount'        => 'required',
        ], [
            'product_id.required' => 'Producto es requerido',
            'amount.required'     => 'Cantidad del producto es requerido',
        ])->validate();
    }

    public function registerOrUpdateDocumentSupply(Request $request)
    {
        $this->productValidator($request);
        $productId = intval($request->input('product_id'));
        $product = Product::find($productId);
        $document = Document::theyHaveDocumentInProcess();

        if ($document){
            $hasTheProduct = $document->documentSupplies()->where('product_id', $productId)->first();
            if ($hasTheProduct){
                $amount = $hasTheProduct->amount + intval($request->input('amount'));
                $document->documentSupplies()->where('product_id', $productId)->first()->update(['amount' => $amount]);
            }else{
                $document->documentSupplies()->create($this->productCreate($document, $product, $request));
            }
        }else{
            $document = Document::create([
                'client_id' => session('user_id'),
                'iva'       => ShoppingCart::getIva(),
                'discount'  => ShoppingCart::getDiscount(),
                'status'    => 'p'
            ]);

            DocumentSupply::create($this->productCreate($document, $product, $request));
        }

    }

    public function destroy($id)
    {
        $document = Document::theyHaveDocumentInProcess();
        $reload = false;
        if (! $document) return;

        if (count($document->documentSupplies) > 1){
            $item = DocumentSupply::find($id);
            $item->delete();
        }else{
            $document->delete();
            $reload = true;
        }
            

        return response()->json(['reloadd' => $reload],200);
    }


}
