<!-- Blog Category -->
<div class="card mb-4">
    <div class="card-body">
        <h2 class="card-title">{{$item->name}}</h2>
        <p class="card-text"> {{str_limit($item->content,100,'...')}}</p>
        <a href="{{ route('blog.posts.show', $item->id) }}" class="btn btn-primary">Дивитися &rarr;</a>
    </div>
</div>
