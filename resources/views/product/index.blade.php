@extends('layoutadmin')
@section('title')
    Danh sách sản phẩm
@endsection
@section('content')
<div class="d-flex "  ><a class=" btn btn-secondary " href="{{route('products.create')}}">Thêm sản phẩm</a></div>
   
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Category Name</th>
            <th>Describe</th>
            <th>Status</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listPro as $items)
            <tr>
                <td>{{$items->id}}</td>
                <td>{{$items->name}}</td>
                <td>{{$items->price}}</td>
                <td>{{$items->quantity}}</td>
                <td>
                    @if(!isset($items->image))
                        Không có hình ảnh
                    @else
                        <img src="{{Storage::url($items->image)}}" style="width:250px" height="250px">
                    @endif
                </td>
{{--                <td>{{$listCate[$items->category_id]}}</td>--}}
                <td>{{$items->loadAllCate->name}}</td>
                <td>{{$items->describe}}</td>
                <td>{{$items->status}}</td>
                <td>
                    <a href="{{route('products.edit',['id'=>$items->id])}}" class="btn btn-warning">Sửa</a>
                    <form action="{{route('products.destroy',['id'=>$items->id])}}" method="POST">
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
    {{$listPro->links()}}
@endsection
