<?php

namespace App\Models;

use App\Interfaces\CommentStorageInterface;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model implements CommentStorageInterface
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
    ];

    public function comments()
    {
        return $this->belongsToMany(Comment::class,'blog_category_comment','blog_category_id', 'comment_id');
    }

    public function posts()
    {
        return $this->hasMany(BlogPost::class,'category_id','id');
    }
}
