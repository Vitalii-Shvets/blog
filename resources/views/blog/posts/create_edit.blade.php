@extends('layouts.app')

@section('content')

    @include('blog.includes.result_messages')

    @if($post->exists)
        <hr>
        <h1 class="my-4">Редагування поста
        </h1>
        <form method="POST" action="{{ route('blog.posts.update', $post->id )}}" enctype="multipart/form-data">
            @method('PATCH')
            @else
                <h1 class="my-4">Створення поста
                </h1>
                <form method="POST" action="{{ route('blog.posts.store')}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Ім'я поста</label>
                        <input name="name"
                               id="name"
                               type="text"
                               class="form-control"
                               value="{{ old('name', $post->name) }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="content">Інформація</label>
                        <textarea name="content"
                                  id="content"
                                  class="form-control"
                                  rows="7">{{ old('content', $post->content) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Категория</label>
                        <select name="category_id"
                                id="category_id"
                                class="form-control"
                                placeholder="Виберіть категорію"
                                required>

                            @foreach($categoryList as $categoryOption)
                                <option value="{{ $categoryOption->id }}"
                                        @if($categoryOption->id == $post->category_id) selected @endif>
                                    {{$categoryOption->name}}
                                </option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        @if(isset($post->file)&&$post->file!==''&&$post->exists)
                            <p class="text-danger">Файл вже прикріплений до поста. Ви можете прикріпити замість існуючого свій</p>
                            @endif
                        <input type="file" name="uploads-file">
                    </div>
                    <button type="submit" class="btn btn-success">Зберегти</button>

                </form>
@endsection
