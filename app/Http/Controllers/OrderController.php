<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Location;
use App\Models\OrderItems;
use Exception;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    public function index ()
    {
        $orders =Order::with('user');
        if($orders)
        foreach($orders as $order)
       {

         foreach($order->items as $order_items)

         {
            $product =Product::where('id', $order_items->product_id)->pluck('name');
            $order_items->product_name = $product[0];
         }
         return response()->json(array('order' => $orders),200);

        }  
       
        else
        return response()->json('There is no orders');
    }

    public function show($id)
    {
        $order = Order::find($id);
        return response()->json(array('order' => $order), 200);
    }

    public function store(Request $request)
    {
        try{
            $location = Location::where('user_id', Auth::id())->first();
        
            // $request->validate([
    
            //     'date_of_delivery'=>'required',
            //     'order_items'=>'required',
            //     'total_price'=>'required',

    
            // ]);
    
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->location_id=$location->id;
            $order->total_price = $request->total_price;
            $order->date_of_delivery =$request ->date_of_delivery;
            $order->save();
            foreach($request->order_items as $order_items)
    
            {
    
                $items = new OrderItems();
                $items->order_id=$order->id;
                $items ->price =$order_items ['price'];
                $items->product_id = $order_items ['product_id'];
                $items ->quantity = $order_items ['quantity'];
                $items->save();
                $product = Product::where('id',$order_items ['product_id'])->first();
                $product->amount-=$order_items['quantity'];
    
      
    
            }
            return response()->json('Order Is Added',201);

        }catch(Exception $e){
            return response()->json($e);
        }
       
      

    }

    public function get_order_items($id)

    {
        $order_items = OrderItems::where('order_id',$id)->get();
       
        if($order_items)
        {

            foreach($order_items as $order_item)

            {
                $product =Product::where('id', $order_item->product_id)->pluck('name');
                $order_item->product_name = $product[0];
    
            }
            
            return response()->json($order_items);

        }
        else
        return response()->json('no items found');


    }

    public function get_user_orders($id)

    {
        $orders = Order::with('item')->where('user_id', $id)->get();

        if($orders)
        {
            foreach($orders as $order)
            { 
                foreach( $order->item as $order_items)
                $product =Product::where('id', $order_items->product_id)->pluck('name');
                $order_items->product_name = $product[0];

            }
        }

    }

    public function change_order_status($id ,Request $request)

    {

        $order = Order::find($id);
        if($order)
        {
            $order->update(['status'=>$request->status]);

            return response()->json('Status changed successfully',201) ;
        
        }
        else

        return response()->json('order not found',404);

    }


}
