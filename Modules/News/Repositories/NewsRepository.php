<?php

namespace Modules\News\Repositories;

use Illuminate\Http\JsonResponse;
use Modules\Core\Repositories\BaseRepository;
use Modules\News\Entities\News;

class NewsRepository extends BaseRepository{

    public function __construct()
    {
        $this->model = New News();
        $this->rules = [
            "category_id" =>"required",
            "title" => "required|unique:news|max:225",
            "content" => "required",
            "featured_img"=>"required|mimes:jpeg,jpg,png,gif|max:10000",   // 10 MB
            "publish_status" => "required",
            "comment_status" => "required",
            "author_id" => "required"
            ];
    }

    public function getValidationRules(): array
    {
        return $this->rules;
    }
}