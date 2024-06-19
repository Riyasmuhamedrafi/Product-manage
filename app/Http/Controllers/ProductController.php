<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\ProductsImport;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:add product')->only(['create', 'store']);
        $this->middleware('permission:edit product')->only(['edit', 'update']);
        $this->middleware('permission:delete product')->only(['destroy']);
        $this->middleware('permission:view product')->only(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => request('name'),
            'user_id' => Auth::id(),
            'p_code' => generate_product_code(),
            'description' => request('description'),
            'price' => request('price'),
            'status'=> request('status'),
        ]);
        if ($request->hasFile('images')) {
            $images = $request->images;
            foreach ($images as $key => $value) {
                $extension = $value->extension();
                $fileName = Str::random(6)."_".time()."_product.".$extension;
                $path = $value->storeAs('images/',$fileName);
                ProductImage::create([
                    'product_id'=>$product->id,
                    'image'=>$fileName
                ]);
            }
        }
        return ['status'=>200,'message'=>'Product Created Successfully','data'=>$product];
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update_product(Request $request)
     {
        $product = Product::find($request->product_id);
        $product->update([
            'name' => request('name'),
             'user_id' => Auth::id(),
             'description' => request('description'),
             'price' => request('price'),
             'status'=> request('status'),
        ]);
         if ($request->hasFile('images')) {
            $images = $product->images; // Assuming 'images' is the relationship method in Product model
            foreach ($images as $image) {
                $filePath = 'images/' . $image->image; // The image field stores the filename
                if (Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
            }

            // Delete image records from database
            $product->images()->delete();
            // again store
             $images = $request->images;
             foreach ($images as $key => $value) {
                 $extension = $value->extension();
                 $fileName = Str::random(6)."_".time()."_product.".$extension;
                 $path = $value->storeAs('images/',$fileName);
                 ProductImage::create([
                     'product_id'=>$product->id,
                     'image'=>$fileName
                 ]);
             }
         }
         return ['status'=>200,'message'=>'Product Updated Successfully','data'=>$product];
     }

    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (Auth::user()->hasRole('subadmin') && $product->user_id == 1) {
            abort(403);
        }
        // Retrieve and delete images from storage
        $images = $product->images; // Assuming 'images' is the relationship method in Product model
        foreach ($images as $image) {
            $filePath = 'images/' . $image->image; // The image field stores the filename
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        // Delete image records from database
        $product->images()->delete(); // Deletes associated records in product_images table

        // Delete product record from database
        $product->delete();
        return redirect()->route('product.index')->with('success','Deleted Successfully');
    }
    public function import(Request $request, ProductService $productService)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx,csv',
        ]);

        // Import the file using the ImportProducts class
        try {
            Excel::import(new ProductsImport($productService), $request->file('file'));

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Products imported successfully.');
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->with('error', 'There was an error importing the products: ' . $e->getMessage());
        }
    }
    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
    public function bulkdelete(Request $request)
    {
        $products = Product::whereIn('id',$request->ids)->get();
        foreach ($products as $key => $value) {
            $images = $value->images;
            foreach ($images as $image) {
                $filePath = 'images/' . $image->image; // The image field stores the filename
                if (Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
            }
            $value->images()->delete();
            $value->delete();
        }
        return ['status'=>200,'message'=>'Deleted Successfully'];

    }
    public function search(Request $request)
    {
        $created_at = $request->input('created_at');
            $status = $request->input('status', null); // Default to null if not provided

            // Initialize query
            $query = Product::query();

            // Add created_at condition if provided
            if (!empty($created_at)) {
                $query->whereDate('created_at', $created_at);
            }

            // Add status condition if provided
            if ($status !== null) {
                $query->where('status', $status);
            }

            // Get the filtered products
            $products = $query->get();

            return view('products.index', compact('products'));
    }
}
