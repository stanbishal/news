<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Repositories\BlogRepository;
use Modules\Core\Http\Controllers\BaseController;

class BlogController extends BaseController
{
    protected $repository;

    public function __construct(BlogRepository $repo)
    {
        $this->repository = $repo;
    }
    public function index(Request $request)
    {
        $blogs = $this->repository->fetchAll(request: $request);
        return $this->successResponse(payload:$blogs);
    }


    public function create()
    {
        return view('blog::create');
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        return view('blog::show');
    }

    
    public function edit($id)
    {
        return view('blog::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
