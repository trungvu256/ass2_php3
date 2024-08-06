@extends('layoutadmin')
@section('title')
    Danh sách danh mục
@endsection
@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="">
    <a class="btn btn-secondary" href="{{route('categories.create')}}">Thêm sản phẩm</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listCate as $items)
            <tr>
                <td>{{$items->id}}</td>
                <td>{{$items->name}}</td>
                <td>{{$items->status}}</td>
                <td>
                    <a href="{{route('categories.edit',['id'=>$items->id])}}" class="btn btn-warning">Sửa</a>
                    <form action="{{route('categories.destroy',['id'=>$items->id])}}" method="POST">
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
    {{$listCate->links()}}
@endsection
