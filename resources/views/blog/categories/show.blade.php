@extends('layouts.app')

@section('content')
    @include('blog.includes.result_messages')
    <h1 class="my-4">Читайте та добавляйте пости до категорії
    </h1>
    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">

        <a class="btn btn-secondary" href="{{ route('blog.categories.edit',$category->id)}}"
           role="button">Редагувати</a>
        <form method="POST" action="{{route('blog.categories.destroy',$category->id)}}">
            @method('DELETE')
            @csrf
        <button class="btn btn-secondary"
            type="submit">Видалити</button>
        </form>
    </div>

    <div class="card mb-4">
        <div class="card-body bg-success">
            <h2 class="card-title ">  {{$category->name}}</h2>
            <p class="card-text ">{{$category->description}}</p>
        </div>
    </div>

    @foreach($category->posts as $posts)
        @include('blog.posts.index',['item'=> $posts])
    @endforeach
    @include('blog.comments.comments', ['item'=> $category, 'route'=>'blog.comments.storeCommentCategory'])

@endsection
