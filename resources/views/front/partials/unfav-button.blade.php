<form method="post" action="{{ route('book-unfavorite', $book->id) }}" class="float-right">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-info" style="padding:8px;">
        <i class="fa fa-thumbs-down" aria-hidden="true"></i>
    </button>
</form>