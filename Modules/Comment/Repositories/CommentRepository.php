<?php

namespace Modules\Comment\Repositories;

use Modules\Comment\Entities\Comment;
use Modules\Core\Repositories\BaseRepository;

class CommentRepository extends BaseRepository{

    public function __construct()
    {
        $this->model = new Comment();
        $this->rules = [
            "news_id" => "required",
            "content" => "required|max:500",
            "name"  => "required",
            "email" => "required|email"
        ];
    }

    public function getValidationRules(): array
    {
        return $this->rules;
    }
}