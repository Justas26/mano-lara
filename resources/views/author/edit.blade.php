@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Author edit</div>
                <div class="card-body">
                    <form method="POST" action="{{route('author.update',$author)}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="author_name" class="form-control" value="{{old('author_name',$author->name)}}">
                            <small class="form-text text-muted">Author name.</small>
                        </diV>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="author_surname" class="form-control" value="{{old('author_surname',$author->surname)}}">
                            <small class=" form-text text-muted">Author surname.</small>
                        </diV>
                        @csrf
                        <button class="btn btn-info" type="submit">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection