<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *
 *
 */
class ProductService
{
    public function create(Request $request){
        $Product = Product::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'p_code' => generate_product_code(),
            'description' => $request->description,
            'price' => $request->price,
            'status'=> $request->status,
        ]);
        return $Product;
    }
}
