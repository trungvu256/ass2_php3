@extends('layoutadmin')
@section('title')
    Danh sách user
@endsection
@section('content')

   
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>   
            <th>email</th>
            <th>role</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listUser as $items)
            <tr>
                <td>{{$items->id}}</td>
                <td>{{$items->name}}</td>
                <td>{{$items->email}}</td>
                <td>{{$items->loadAllRole->name}}</td>
                <td>
                    <a href="{{route('users.edit',['id'=>$items->id])}}" class="btn btn-warning">Sửa</a>
                    <form action="{{route('users.destroy',['id'=>$items->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$listUser->links()}}
@endsection
