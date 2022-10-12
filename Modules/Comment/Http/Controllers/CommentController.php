<?php

namespace Modules\Comment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Comment\Repositories\CommentRepository;

class CommentController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new CommentRepository();
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

    public function update(Request $request, $id): JsonResponse
    {
        try{
            $data = $this->repository->validateData(
                request: $request,
                merge: $this->repository->getValidationRules()
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
