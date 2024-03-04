<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Product;


class OrdersController extends Controller
{
    public function add($productId)
    {
        $product = Product::findOrFail($productId);
        return view('order.create', compact('product'));    
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'total_order' => 'required|string',
        ]);

        

        Orders::create([
            'address' => $request->address,
            'total_order' => $request->total_order,
            'status' => "0",
            'product_id' => $request->product_id,
            'user_id' => $request->user_id
        ]);

        return redirect('/')->with('success', 'Product created successfully.');
    }
    
    public function history()
    {
        $user = Auth::user();
        
        if ($user) {
            $userId = $user->id;
            $orders = Orders::with('product')->where('user_id', $userId)->get();
        
            return view('order.history', compact('orders'));
        } else {
            return redirect()->route('login')->with('error', 'Please login to view your order history.');
        }
    }

    public function status()
    {
            $orders = Orders::with('product')->get();   
            return view('order.history', compact('orders'));
    }
    
}
