@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Book create</div>
                <div class="card-body">
                    <form method="POST" action="{{route('book.store')}}">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="book_title" class="form-control" value="{{old('book_title')}}">
                            <small class="form-text text-muted">book title.</small>
                        </diV>
                        <div class="form-group">
                            <label>ISBN</label>
                            <input type="text" name="book_isbn" class="form-control" value="{{old('book_isbn')}}">
                            <small class="form-text text-muted">book isbn.</small>
                        </diV>
                        <div class="form-group">
                            <label>Pages</label>
                            <input type="text" name="book_pages" class="form-control" value="{{old('book_pages')}}">
                            <small class="form-text text-muted">book pages.</small>
                        </diV>
                        <div class="form-group">
                            <label>About</label>
                            <textarea type="text" name="book_about" class="form-control" id="summernote" value="{{old('book_about')}}"> </textarea>
                            <small class="form-text text-muted">book about.</small>
                        </diV>
                        <select name="author_id">
                            @foreach ($authors as $author)
                            <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                            @endforeach
                        </select>
                        @csrf
                        <button class="btn btn-primary" type="submit">ADD</button>
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