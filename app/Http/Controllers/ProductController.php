<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Exception;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products=Product::all()->paginate(10);
        if($products)
        {
            return response()->json(array('products' => $products),200);
        }
        else
        return response()->json('products not found',404);
    }
    public function show($id)
    {
        $product=Product::find($id);
        if($product)
        {
            return response()->json(array('product' => $product),200);
        }
        else
        return response()->json('product not found',404);
    }
    public function store(Request $request)
    {
     
        Validator::make($request->all(),[
            'name'=>'required',
            'price'=>'required|numeric',
            'category_id'=>'required|numeric',
            'brand_id'=>'required|numeric',
            'discount'=>'required|numeric',
            'amount'=>'required|numeric',
            'image'=>'required'
        ]);
        $product=new Product();
        $product->name=$request->name;
        $product->price=$request->price;
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->discount=$request->discount;
        $product->amount=$request->amount;
        if($request->hasfile('image'))
        {
            $path='assets/images/product/' . $product->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $filename=time() . '.' . $ext;
            try
            {
                $file->move('assets/uploads/product', $filename);
            }catch(FileException $e)
            {
                dd($e);
            }
            $product->image=$filename;

        }
        $product->save();
        return response()->json('Product Added',201);

    }
    public function update_product($id,Request $request)
    {
        Validator::make($request->all(),[
            'name'=>'required',
            'price'=>'required|numeric',
            'category_id'=>'required|numeric',
            'brand_id'=>'required|numeric',
            'discount'=>'required|numeric',
            'amount'=>'required|numeric',
            'image'=>'required'
        ]);  
    
        $product=Product::find($id);
        if ($product)
    {
        $product=new Product();
        $product->name=$request->name;
        $product->price=$request->price;
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->discount=$request->discount;
        $product->amount=$request->amount;
        if($request->hasfile('image'))
        {
            $path='assets/images/product/' . $product->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $filename=time() . '.' . $ext;
            try
            {
                $file->move('assets/uploads/product', $filename);
            }catch(FileException $e)
            {
                dd($e);
            }
            $product->image=$filename;

        }
        $product->save();
        return response()->json('Product updated',201);
    }
       else
       return response()->json('Product not found',404);
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
        if ($product)
        {
            $product->delete();
            return response()->json('Product deleted',201);
        }
        else
        return response()->json('Product not found',404);
    }
}
