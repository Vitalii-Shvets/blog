@extends('layouts.app')

@section('content')

    @include('blog.includes.result_messages')
    <hr>

    @if($category->exists)
        <h1 class="my-4">Редагування категорії
        </h1>
        <form method="POST" action="{{ route('blog.categories.update', $category->id )}}">
            @method('PATCH')
            @else
                <h1 class="my-4">Створення категорії
                </h1>
                <form method="POST" action="{{ route('blog.categories.store')}}">
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Ім'я категорії</label>
                        <input name="name"
                               id="name"
                               type="text"
                               class="form-control"
                               value="{{ old('name', $category->name) }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="description">Опис категорії</label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control"
                                  rows="7">{{ old('description', $category->description) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Зберегти</button>
                </form>
@endsection
