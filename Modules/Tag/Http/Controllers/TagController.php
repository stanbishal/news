<?php

namespace Modules\Tag\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\tag\Repositories\TagRepository;
use Modules\Core\Http\Controllers\BaseController;

class TagController extends BaseController
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new TagRepository();
    }

    public function index(Request $request): JsonResponse
    {
        try{
            $tags = $this->repository->fetchAll(request:$request);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($tags);
    }

    public function store(Request $request): JsonResponse
    {
        try{
            $data = $this->repository->validateData(
                request: $request,
                merge: $this->repository->getValidationRules()
            );
            $created = $this->repository->create($data);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($created);
    }

    public function show($id): JsonResponse
    {
        try{
            $tag = $this->repository->fetch($id);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($tag);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try{
            $data = $this->repository->validateData(
                request: $request,
                merge: array_merge($this->repository->getValidationRules(),
                ["name"=>"required|unique:tags,name,".$id."|max:255"])
            );
            $tag = $this->repository->update($data,$id);

        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($tag);
    }

    public function destroy($id): JsonResponse
    {
        try{
            $tag = $this->repository->delete($id);
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
        return $this->successResponse($tag);
    }
}
