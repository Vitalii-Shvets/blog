<?php
namespace App\Services;
use App\Interfaces\CommentStorageInterface;
use App\Models\Comment;
class CommentSaveService
{
     public function save(CommentStorageInterface $storage, $data){
        $comment=Comment::create($data);
        $storage->comments()->attach($comment->id);
        return $comment;
    }
}
