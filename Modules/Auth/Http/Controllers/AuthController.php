<?php

namespace Modules\Auth\Http\Controllers;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Repositories\AuthRepository;
use Modules\Core\Http\Controllers\BaseController;

class AuthController extends BaseController
{
    protected $repository;

    public function __construct()
    {   
        $this->repository = new AuthRepository();
    }
    public function register(Request $request): JsonResponse
    {
        try{
            $data = $this->repository->validateData(
                request: $request,
                merge: $this->repository->getValidationRules(),
                callback: function($request){
                    $data["password"] = Hash::make($request->password);
                    return $data;
                }
            );

            $created = $this->repository->create($data,
                   callback: function($created){
                    $token = $created->createToken("API TOKEN")->plainTextToken;
                    $created->setAttribute("token", $token);
                   });
       
           }catch(Exception $exception){
                return $this->handleException($exception);
            }
            return $this->successResponse($created);
        
    }

    public function login(Request $request)
    {
        try{

            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                'message' => 'Invalid login details'
                           ], 401);
                }
    
                $user = $this->repository->queryFetch(["email" => $request->email]);
                $user->setAttribute("token", $user->createToken("API TOKEN")->plainTextToken);

            }catch(Exception $exception){
                return $this->handleException($exception);
            }

            return $this->successResponse($user);

    }

    public function logout(){
        try{
             Auth::user()->tokens()->delete();

            return [
                'message' => 'Tokens Revoked'
            ];
        }catch(Exception $exception){
            return $this->handleException($exception);
        }
    }
}
