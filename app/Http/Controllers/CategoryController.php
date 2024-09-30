<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Models\Categories;
use Exception;

class CategoryController extends Controller
{
  
    public function index()
    {
        $categories =Categories::all();

        return response()->json(array('categories' => $categories),200);
    }

    public function show($id)
    {
        $category = Categories::find($id);

        if ($category)
        
        {
              return response()->json(array('category' => $category),200);
        }

        else

        return response()->json('category not found');
    }

    public function store(Request $request)
    {
        try{
            $validated = $request->validate([

                'name'=>'required|unique:category,name',
                //'image'=>'required',
            ]);

            $category= new Categories();
            $category->name=$request->name;
            $category->save();
            return response()->json('category is added',201);
        }catch(FileException $exc)
        {
            return response()->json($exc,500);
        }
       
    }

    public function update_category($id,Request $request)
    {

    try{
                $validated = $request->validate([

                    'name'=>'required|unique:category,name',
                    'image'=>'required',
                ]);
                $category=Categories::find($id);
                if($request->hasfile('image'))
                {
                    $path='assets/images/category' . $category->image;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }
                    $file=$request->file('image');
                    $ext=$file->getClientOriginalExtension();
                    $filename=time() . '.' . $ext;
                    try
                    {
                        $file->move('assets/uploads/category', $filename);
                    }catch(FileException $e)
                    {
                        dd($e);
                    }
                    $category->image=$filename;
        
                };
                $category->name=$request->name;
                $category->update();
                return response()->json('category is updated',201);
        }
    catch(FileException $exc)
       {
                return response()->json($exc,500);
       }  
        
    }

    public function delete_category($id)
    {
        $category =Categories::find($id);
        if($category)

        {
          $category->delete();
          return response()->json('category is deleted', 200);
        }
        else
        return response()->json('category is not found', 404);
          
    }
}
