@extends('layouts.app')

@section('content')
    <h1 class="my-4">Вітаємо Вас! Читайте та доповнюйте блог)
    </h1>
    <div class="container">
        @include('blog.includes.result_messages')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Категория</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $item )
                                <tr>
                                    <td>
                                        {{--Відображення номеру категорії для пагінації--}}
                                        {{$loop->iteration+$paginator->perPage()*($paginator->currentPage()-1)}}
                                    </td>
                                    <td>
                                        <a href="{{ route('blog.categories.show', $item->id) }}">
                                            {{ $item->name }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
