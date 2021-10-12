@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Author information</div>
                <div class="card-body">
                    <table class="table-responsive-xl" >
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Photo</th>
                            <th>Edit</th>
                            <th>Delete</th>         
                        </tr>
                        @foreach ($authors as $author)
                        <tr>
                            <td>{{$author->name}}</td>
                            <td>{{$author->surname}}</td>
                             <td>   
                            <form action="{{route('author.uploadPhoto',$author)}}" method="post" enctype="multipart/form-data">
                            <input type="file" name="photo" id="">
                             @csrf
                            <button class="btn btn-success" type="submit">upload photo</button>
                            </form>
                             </td>
                            <td> <a class="btn btn-primary" href="{{route('author.edit',$author)}}">edit</a></td>
                            <td>
                                <form method="POST" action="{{route('author.destroy', $author)}}">
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