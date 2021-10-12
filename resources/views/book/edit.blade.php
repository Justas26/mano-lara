@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Knygų redagavimas</div>
                <div class="card-body">
                    <form method="POST" action="{{route('book.update',[$book])}}">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="book_title" class="form-control" value="{{$book->title}}">
                            <small class="form-text text-muted">book title.</small>
                        </div>
                        <div class="form-group">
                            <label>ISBN</label>
                            <input type="text" name="book_isbn" class="form-control" value="{{$book->isbn}}">
                            <small class="form-text text-muted">book isbn.</small>
                        </div>
                        <div class="form-group">
                            <label>Pages</label>
                            <input type="text" name="book_pages" class="form-control" value="{{$book->pages}}">
                            <small class="form-text text-muted">book pages.</small>
                        </div>
                        <div class="form-group">
                            <label>About</label>
                            <textarea type="text" name="book_about" class="form-control" value="{{$book->about}}" id="summernote"></textarea>
                            <small class="form-text text-muted">book about.</small>
                        </div>
                        <select name="author_id">
                            @foreach ($authors as $author)
                            <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif>
                                {{$author->name}} {{$author->surname}}
                            </option>
                            @endforeach
                        </select>
                        @csrf
                        <button class="btn btn-info" type="submit">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
@endsection