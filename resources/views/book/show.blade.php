@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Book information</div>
                <div class="card-body">
                    <table class="table-responsive-xl" >
                        <tr>
                            <th>Title</th>
                            <th>Isbn</th>
                            <th>Pages</th>
                            <th>About</th>
                            <th>Photo</th>
                            <th>Edit</th>
                            <th>Delete</th>         
                        </tr>
                        @foreach ($reservoir as $reservoir)
                        <tr>
                           <td>{{$book->title}}</td>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->pages}}</td>
                            <td>{!!$book->about!!}</td>
                             <td>   
                            <form action="{{route('book.uploadPhoto',$book)}}" method="post" enctype="multipart/form-data">
                            <input type="file" name="photo" id="">
                             @csrf
                            <button class="btn btn-success" type="submit">upload photo</button>
                            </form>
                             </td>
                            <td> <a class="btn btn-primary" href="{{route('book.edit',$book)}}">edit</a></td>
                            <td>
                                <form method="POST" action="{{route('book.destroy', $book)}}">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">DELETE</button>
                                </form>
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