<?php

namespace Modules\News\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_id","title","content","featured_img","publish_status","comment_status","author_id"
    ];
    
    protected static function newFactory()
    {
        return \Modules\News\Database\factories\NewsFactory::new();
    }
}
