<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Blog\BaseController;
use App\Models\BlogPost;
use App\PostAttachment;
use ZipArchive;
class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = BlogPost::all();

        return view('blog.posts.index',compact('items'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $post = BlogPost::find($id);
        $post = \DB::table('blog_posts')
        ->join('blog_categories','blog_posts.category_id','=','blog_categories.id')
        ->join('users','blog_posts.user_id','=','users.id')
        ->select('blog_posts.*','blog_categories.title AS category_name','users.name AS user_name')
        ->where('id', $id)
        ->get();

        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = BlogPost::find($id)->delete();

        return "Deleted !";
    }




    public function posts()
    {
        $items = BlogPost::select(['id','title','slug','category_id','user_id'])->with([
                'category' => function($query){
                $query->select(['id', 'title']);
                },
                'user:id,name',
            ])->get();

        return $items;

    }


    public function store(Request $request)
    {
        $data = $request->input();
        if(empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);
        }
        $item = BlogPost::create($data);

        return $item;
    }

    public function update(Request $request, $id)
    {
        $update = BlogPost::findOrFail($id);

        $update->update($request->all());

        return $update;
    }



    function uploads(Request $request)
    {
        // dd($request->file('file'));
        if($request->hasFile('file'))
        {            

            $image_code = '';
            $images = $request->file('file');
            // dd($images);
            $arr_files = count($images);

            for($i=0; $i<$arr_files; $i++) {

                $new_name = rand() . '.' . $images[$i]->getClientOriginalExtension();
                // var_dump($new_name);
                $images[$i]->move(public_path('files/'.$request->id), $new_name);
                $image_put = '/files/'.$request->id.'/'.$new_name;

                $attachment = new PostAttachment;

                $attachment->id_post = $request->id;
                $attachment->put_file = $image_put;
                $attachment->save();

            }

            // foreach($images as $image){
            // // dd($image);
            //     // $new_name = rand() . '.' . $image->getClientOriginalExtension();
            //     // // var_dump($new_name);
            //     // $image->move(public_path('files'), $new_name);
            //     // $image_code .= '/files/'.$new_name; 
            // }

            // $output = array(
            //     'success' => 'Images uploaded successfully',
            //     'image'   => $image_code
            // );

            // return response()->json($output);
            return redirect()->back()->with('msg', 'Images uploaded successfully');
        }else{
            return back()->with('msg', 'Place choose file');
        }
    }




    public function archive(Request $request)
    {
      $zip_file = 'invoices.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $path = public_path('files');
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file)
        {
            // We're skipping all subfolders
            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();

                // extracting filename with substr/strlen
                $relativePath = 'files/' . substr($filePath, strlen($path) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
        return response()->download($zip_file);        
    }






}
