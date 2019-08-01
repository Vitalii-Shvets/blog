<hr>
<h4>Залиште коментар:</h4>
    <form method="POST" id="commentForm" action="{{route($route, $item->id)  }}">
                @csrf
                <div class="form-group">
                    <label for="author">Введіть ім'я:</label>
                    <input name="author"
                           id="author"
                           type="text"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="content">Введіть коментар:</label>
                    <textarea name="content"
                              id="content"
                              class="form-control"
                              rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Зберегти</button>
            </form>
            <br>
            <div id="msg-errors"></div><br>

            <div class="row" id="block-comment">
                @foreach($item->comments as $comment)
                    @include('blog.comments.one_comment', ['comment'=> $comment])
                @endforeach
            </div>
