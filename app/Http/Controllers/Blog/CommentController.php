<?php

namespace App\Http\Controllers\Blog;

use App\Http\Requests\BlogCommentRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Services\CommentSaveService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * @var CommentSaveService
     */
    private $commentSaveService;

    public function __construct(CommentSaveService $commentSaveService)
    {
        $this->commentSaveService = $commentSaveService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogCommentRequest $request
     * @param BlogPost $post
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */

    public function storeCommentPost(BlogCommentRequest $request, BlogPost $post)
    {
        $comment = $this->commentSaveService->save($post, $request->input());
        return response()->json([
            'comment' => view('blog.comments.one_comment', compact('comment'))->render(),
        ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogCommentRequest $request
     * @param BlogCategory $category
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function storeCommentCategory(BlogCommentRequest $request, BlogCategory $category)
    {
        $comment = $this->commentSaveService->save($category, $request->input());
            return response()->json([
                'comment' => view('blog.comments.one_comment', compact('comment'))->render(),
            ]);


    }


}
