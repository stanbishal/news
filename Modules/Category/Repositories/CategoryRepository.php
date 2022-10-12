<?php 
namespace Modules\Category\Repositories;

use Modules\Category\Entities\Category;
use Modules\Core\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Category();
        $this->rules = [
            "name" =>"required|unique:categories|max:255",
            "image"=>"required|mimes:jpeg,jpg,png,gif|max:10000"   // 10 MB
            ];
    }

    public function getValidationRules(): array
    {
        return $this->rules;
    }

    
}