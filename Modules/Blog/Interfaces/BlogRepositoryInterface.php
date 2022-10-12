<?php

namespace modules\Blog\Interfaces;

interface BlogRepositoryInterface{

    public function getAllBlogs();
    public function getBlog($blogId);
    public function deleteBlog($blogId);
    public function createBlog(array $blogDetails);
    public function updateBlog($blogId, array $blogDetails);

}