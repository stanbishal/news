<?php 
namespace Modules\Tag\Repositories;

use Modules\Tag\Entities\Tag;
use Modules\Core\Repositories\BaseRepository;

class TagRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Tag();
        $this->rules = [
            "name" =>"required|unique:tags|max:255"
            ];
    }

    public function getValidationRules(): array
    {
        return $this->rules;
    }
}