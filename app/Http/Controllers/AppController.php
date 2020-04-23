<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {   
      
        $products = [ 
                ['product' => 'Desk', 'price' => 200],
                ['product' => 'Chair', 'price' => 100],
                ['product' => 'Bookcase', 'price' => 150],
                ['product' => 'Door', 'price' => 100], 
           ];
        $productName = $request->q;
       $collection = collect($products)->filter(function ($item) use ($productName) { 
            
            if(!empty($productName)){
                return false !== stristr($item['product'], $productName); 
            }
        });

       // dd($collection);

       return response()->json([
        'data' => array_values($collection->toArray())
       ]);
    }

}
