<?php

namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Blog;
use Modules\Core\Repositories\BaseRepository;

class BlogRepository extends BaseRepository{

    public function __construct()
    {
        $this->model = new Blog();
    }
}