<?php

namespace App\Models;

use App\Interfaces\CommentStorageInterface;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model implements CommentStorageInterface
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'content',
        'file',
        'category_id',
    ];

    public function comments()
    {
        return $this->belongsToMany(Comment::class,'blog_post_comment','blog_post_id', 'comment_id');
    }
}
