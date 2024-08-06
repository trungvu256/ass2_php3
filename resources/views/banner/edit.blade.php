@extends('layoutadmin')
@section('title')
    Sửa banner
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <form action="{{route('banners.update',['id'=>$idBanner->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="{{$idBanner->name}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
            @if(isset($idBanner->image))
                <img src="{{Storage::url($idBanner->image)}}" style="width: 500px" height="250px">
            @else
                Không có hình ảnh
            @endif
        </div>
        <button type="submit" class="btn btn-success">Sửa</button>
        <a class="btn btn-light" href="{{route('banners.index')}}">Quay lại trang chủ</a>
    </form>
@endsection

