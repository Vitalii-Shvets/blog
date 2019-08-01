@extends('layouts.app')

@section('content')
    @include('blog.includes.result_messages')
    <h1 class="my-4">Читайте та добавляйте пости
    </h1>
    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
        <a class="btn btn-secondary" href="{{ route('blog.posts.edit',$post->id) }}"
           role="button">Редагувати</a>
        <form method="POST" action="{{route('blog.posts.destroy',$post->id)  }}">
            @method('DELETE')
            @csrf
            <button class="btn btn-secondary"
                    type="submit">Видалити</button>
        </form>
    </div>

    <div class="card mb-4">
        <div class="card-body bg-success">
            <h2 class="card-title ">  {{$post->name}}</h2>
            <p class="card-text ">{{$post->content}}</p>
        </div>
    </div>
    @if($post->file)
    <a href="{{ route('blog.posts.download',$post->id) }}" class="btn btn-outline-info">Скачати прикріплений файл </a>
    @endif
    @include('blog.comments.comments', ['item'=> $post, 'route'=>'blog.comments.storeCommentPost'])
@endsection
