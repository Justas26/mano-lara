@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Book list</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <th>ISBN</th>
                            <th>Pages</th>
                            <th>About</th>
                            <th>Photo</th>
                            <th>Show</th>
                        </tr>
                        @foreach ($books as $book)
                        <tr>
                            <td>{{$book->title}}</td>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->pages}}</td>
                            <td>{!!$book->about!!}</td>
                             <td>
                            <img src="{{asset('bookPhoto/'.$book->photo_name)}}"alt="">
                            </td>
                            <td>
                            <a class="btn btn-primary" href="{{route('book.show',$book)}}">show</a>
                            </td>
                            <br>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection