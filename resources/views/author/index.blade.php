@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Author list</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Photo</th>
                            <th>Show</th>
                        </tr>
                        @foreach ($authors as $author)
                        <tr>
                            <td>{{$author->name}}</td>
                            <td>{{$author->surname}}</td>
                           <td>
                            <img src="{{asset('authorPhoto/'.$author->photo_name)}}"alt="">
                            </td>
                            <td>
                            <a class="btn btn-primary" href="{{route('author.show',$author)}}">show</a>
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