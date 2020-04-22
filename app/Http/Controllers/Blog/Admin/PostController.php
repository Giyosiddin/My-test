<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;
//use App\Http\Controllers\Blog\Admin\BaseController;

class PostController extends BaseController
{
    private $blogPostRepository;

    public function __construct()
    {
        parent::__construct();
        $this->blogPostRepository = app(BlogPostRepository::class);
    }

    public function index()
    {
        $paginator = $this->blogPostRepository->getPaginateAll();
//        dd($paginator);
        return view('blog.admin.posts.index', compact('paginator'));
    }

    public function create()
    {
        dd('create');
    }

    public function edit($id)
    {
        dd($id);
    }

}
