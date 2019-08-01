<?php

namespace App\Http\Controllers\Blog;

use App\Http\Requests\BlogCategoryCreateUpdateRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BlogCategoryRepository;
use App\Models\BlogCategory;

class CategoryController extends Controller
{
    private $blogCategoryRepository;

    public function __construct(BlogCategoryRepository $blogCategoryRepository)
    {
        $this->blogCategoryRepository = $blogCategoryRepository;
        $this->middleware('category.reader',   ['only' => ['show', 'index','create','edit']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(25);
        return view('blog.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.categories.create_edit', ['category'=>new BlogCategory()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateUpdateRequest $request)
    {
        $item = BlogCategory::create($request->input());
        if ($item) {
            return redirect()->route('blog.categories.index')->with(['success' => 'Збережено']);
        }
        return back()->withErrors(['msg' => 'Помилка збереження'])
            ->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param BlogCategory $category
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $category)
    {
        return view('blog.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogCategory $category
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $category)
    {
        return view('blog.categories.create_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogCategoryCreateUpdateRequest $request
     * @param BlogCategory $category
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryCreateUpdateRequest $request, BlogCategory $category)
    {
        if ($category->update($request->input())) {
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
     * @param BlogCategory $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(BlogCategory $category)
    {
        $category->comments()->delete();
        $category->delete();
        return redirect()
            ->route('blog.categories.index')->with(['success' => 'Видалено']);
    }
}
