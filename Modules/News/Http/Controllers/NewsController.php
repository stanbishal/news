<?php

namespace Modules\News\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\News\Repositories\NewsRepository;
use Modules\Core\Http\Controllers\BaseController;

class NewsController extends BaseController
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new NewsRepository();
    }

    public function index(Request $request): JsonResponse
    {
        try{
            $news = $this->repository->fetchAll($request);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($news);
    }


    public function store(Request $request): JsonResponse
    {
        try{
            $data = $this->repository->validateData(
                request: $request,
                merge: $this->repository->getValidationRules(),
                callback: function($request){
                   $data["featured_img"] = $this->storeImage($request, "featured_img", "news");
                   return $data;
                });
            $news = $this->repository->create($data);

        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($news);
    }

    public function show($id): JsonResponse
    {
        try{
            $news = $this->repository->fetch($id);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($news);
    }


    public function update(Request $request, $id): JsonResponse
    {
        try{
            $data = $this->repository->validateData(
                request: $request,
                merge: array_merge($this->repository->getValidationRules(),
                    ["title"=>"required|unique:news,title,".$id."|max:255",
                    "featured_img"=>"mimes:jpeg,jpg,png,gif|max:10000"]
                ),
                callback: function($request) use ($id){
                    $data = [];
                    if($request->hasFile("featured_img")){
                        $news = $this->repository->fetch($id);
                        $data["featured_img"] = $this->storeImage($request,"featured_img","news",$news->featured_img);
                    }
                    return $data;
                }
            );
            $updated = $this->repository->update($data, $id);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($updated);
    }

    public function destroy($id): JsonResponse
    {
        try{
            $news = $this->repository->delete($id);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($news);
    }
}
