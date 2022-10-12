<?php

namespace Modules\Category\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Core\Http\Controllers\BaseController;

class CategoryController extends BaseController
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new CategoryRepository();
    }

    public function index(Request $request): JsonResponse
    {
        try{
            $categories = $this->repository->fetchAll(request:$request);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($categories);
    }

    public function store(Request $request)
    {
       
        try{
            $data = $this->repository->validateData(
                request: $request,
                merge: $this->repository->getValidationRules(),
                callback: function($request){
                    $data["image"]= $this->storeImage($request,"image","category");
                    return $data;
                }
            );
        
            $created = $this->repository->create($data);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse(
            payload:$created,
            message:"Category created successfully !"
        );
    }

    public function show($id): JsonResponse
    {
        try{
            $category = $this->repository->fetch($id);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($category);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try{
            $data = $this->repository->validateData(
                request: $request,
                merge: array_merge($this->repository->getValidationRules(),
                    ["name"=>"required|unique:categories,name,".$id."|max:255",
                     "image"=>"mimes:jpeg,jpg,png,gif|max:10000"
                ]),
                callback:function($request) use ($id){
                    $data = [];
                    if ($request->hasFile('image')){
                        $category = $this->repository->fetch($id);
                        $data["image"]= $this->storeImage($request,"image","category", $category->image);
                    }
                    return $data;
                }
            );
            $category = $this->repository->update($data, $id);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($category);
    }

    public function destroy($id): JsonResponse
    {
        try{
            $category = $this->repository->delete($id);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse(payload:$category,message:"Category deleted sucessfully !");
    }
}
