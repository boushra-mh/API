<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brands;
use Exception;

class BrandsController extends Controller
{
    public function index()
    {
        $brands =Brands::all();

        return response()->json(array('brands' => $brands),200);
    }

    public function show($id)
    {
        $brand = Brands::find($id);

        if ($brand)
        
        {
              return response()->json(array('brand' => $brand),200);
        }

        else

        return response()->json('brand not found');
    }

    public function store(Request $request)
    {
        try{
            $validated = $request->validate([

                'name'=>'required|unique:brands,name',
            ]);

            $brand= new Brands();
            $brand->name=$request->name;
            $brand->save();
            return response()->json('brand is added',201);
        }catch(Exception $exc)
        {
            return response()->json($exc,500);
        }
       
    }

    public function update_brand($id,Request $request)
    {

    try{
                $validated = $request->validate([

                    'name'=>'required|unique:brands,name',
                ]);
                $brand=Brands::where('id',$id)->update(['name'=>$request->name]);
                return response()->json('brand is updated',201);
        }
    catch(Exception $exc)
       {
                return response()->json($exc,500);
       }  
        
    }

    public function delete_brand    ($id)
    {
        $brand =Brands::find($id);
        if($brand)

        {
          $brand->delete();
          return response()->json('brand is deleted', 200);
        }
        else
        return response()->json('brand is not found', 404);
          
    }
}
