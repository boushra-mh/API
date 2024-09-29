<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([

            'street'=>'required',
            'building'=>'required',
            'area'=>'required',

        ]);
        Location::create([

            'street'=> $request->street,
            'building'=> $request->building,
            'area'=> $request->area,
            'user_id'=>Auth::user()->id,
        ]);

        return response()->json('Location Added',201);
    }

    public function update_location(Request $request,$id)
    {
        $request->validate([

            'street'=>'required',
            'building'=>'required',
            'area'=>'required',

        ]);

        $location = Location::find($id);
        if($location)
        {
         $location->street =$request->street;
        $location->building =$request->building;
        $location->area =$request->area;
        $location->save();
        return response()->json('location updated');
        }
        else
        return response()->json('location not found');
        

    }
    public function delete_location($id)
    {
        $location = Location::find($id);

        if($location)
        {
            $location->delete();
            return response()->json('location deleted',201);
        }
        else
        return response()->json('location not found', 404);   
    }
}
