<?php

namespace App\Http\Controllers\Blog;

use App\Http\Requests\BlogPostCreateUpdateRequest;
use App\Models\BlogPost;
use App\Services\FileService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->middleware('category.reader',   ['only' => ['show', 'index','create','edit']]);
        $this->fileService = $fileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.posts.create_edit', ['post'=>new BlogPost()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(BlogPostCreateUpdateRequest $request)
    {
        $item = $this->fileService->upload_file($request->file('uploads-file'),$request->input());
        if ($item) {
            return redirect()->route('blog.categories.show',$item['category_id'])->with(['success' => 'Збережено']);
        }
        return back()->withErrors(['msg' => 'Помилка збереження'])
            ->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param BlogPost $post
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $post)
    {
        return view('blog.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogPost $post
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $post)
    {
        return view('blog.posts.create_edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogPostCreateUpdateRequest $request
     * @param BlogPost $post
     * @return void
     */
    public function update(BlogPostCreateUpdateRequest $request, BlogPost $post)
    {
        if ($post->update($request->input())) {
            return redirect()
                ->route('blog.categories.index')->with(['success' => 'Збережено']);
        }
        return back()
            ->withErrors(['msg' => "Помилка збереження"])
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogPost $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(BlogPost $post)
    {
        $category_id=$post['category_id'];
        $post->comments()->delete();
        $post->delete();
        return redirect()
            ->route('blog.categories.show',$category_id)->with(['success' => 'Видалено']);
    }

    public function download(BlogPost $post)
    {
        if(Storage::disk('public')->exists($post->file))
            return Storage::disk('public')->download($post->file);
        return Storage::disk('public');
    }
}
