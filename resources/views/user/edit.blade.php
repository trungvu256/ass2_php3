@extends('layoutadmin')
@section('title')
  Sửa User 
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
    <form action="{{route('users.update',['id'=>$idUser->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control"  placeholder="Tên danh mục" value="{{$idUser->name}}" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-select" aria-label="Danh mục sản phẩm" name="role">
                @foreach($listRole as $item)
                    <option value="{{$item->id}}"
                    @if($item->id == $idUser->role) selected @endif>
                    {{$item->name}}
                    </option>
                
                @endforeach
                </select>
                </div>

        <button type="submit" class="btn btn-success">Sửa</button>
        <a class="btn btn-light" href="{{route('users.index')}}">Quay lại trang chủ</a>
    </form>
@endsection


