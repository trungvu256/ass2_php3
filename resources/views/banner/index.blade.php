@extends('layoutadmin2')
@section('title')
    Danh sách Banner
@endsection
@section('content')
<div class="pt-3">
  <a class="btn btn-secondary" href="{{route('banners.create')}}">Thêm Banner</a>
</div>
<div class="">
    <table class="table">
    <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Image</th>
                          <th scope="col">Status</th>
                          <th scope="col">Chức năng</th>
                        </tr>
                      </thead>
        <tbody>
        @foreach($listBanner as $items)
            <tr>
                <td>{{$items->id}}</td>
                <td>{{$items->name}}</td>
                <td>
                    @if(!isset($items->image))
                        Không có hình ảnh
                    @else
                        <img src="{{Storage::url($items->image)}}" style="width:500px" height="250px">
                    @endif
                </td>
                <td>{{$items->status}}</td>
                <td>
                    <a href="{{route('banners.edit',['id'=>$items->id])}}" class="btn btn-warning">Sửa</a>
                    <a href="{{route('banners.show',['id'=>$items->id])}}" class="btn btn-secondary">Chi tiêt</a>
                    <form action="{{route('banners.destroy',['id'=>$items->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                    </form>
                </td>
            </tr>
                    </table>
        @endforeach
        </tbody>
    </table>
    </div>
    {{$listBanner->links()}}
@endsection
