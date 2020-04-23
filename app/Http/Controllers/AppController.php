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



    function uploads(Request $request)
    {
        // dd('upload');
        $image_code = '';
        $images = $request->file('file');
        // dd($images);
        foreach($images as $image)       {
        // dd($image);
            $new_name = rand() . '.' . $images->getClientOriginalExtension();
            // var_dump($new_name);
            $image->move(public_path('files'), $new_name);
            $image_code .= '/files/'.$new_name; 
        }

        $output = array(
            'success' => 'Images uploaded successfully',
            'image'   => $image_code
        );

        return response()->json($output);
    }


    function archive(Request $request)
    {
        $files = $request->file('file');
        $file_folder = "/files/".$request->id;
        $zip = new ZipArchive();
        $zip_time = time().".zip";

        if($zip->open($zip_name, ZIPARCHIVE::CREATE) !=TRUE){
            $error = "* Error to archive files";
        }
        foreach($files as $file){
            $zip->addFile($file_folder.$file);
        }
        $zip->close();

        if(file_exists($zip_name)){
            header('Content-type: application/zip');
            header('Content-Disposition: attachment; filename:"'.$zip_name.'"');

            $file_zip = readfile($zip_name);

            return $file_zip;
            unlink($zip_name);
        }
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
