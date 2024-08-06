@extends('layoutadmin')
@section('title')
    Thêm mới danh mục
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
    <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Tên danh mục" value="{{old('name')}}">
        </div>
        <button type="submit" class="btn btn-success">Gửi</button>
        <a class="btn btn-light" href="{{route('categories.index')}}">Quay lại trang chủ</a>
    </form>
@endsection
