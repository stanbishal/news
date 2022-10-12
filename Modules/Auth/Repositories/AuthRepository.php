<?php
namespace Modules\Auth\Repositories;

use App\Models\User;

use Modules\Core\Repositories\BaseRepository;

class AuthRepository extends BaseRepository{


    public function __construct()
    {   
        $this->model = new User();
        $this->rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ];
    }

    public function getValidationRules(){
        return $this->rules;
    }
}