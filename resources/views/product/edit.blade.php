@extends('layoutadmin')
@section('title')
    Thêm mới sản phẩm
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
    <form action="{{route('products.update',['id'=>$idPro->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="{{$idPro->name}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" class="form-control" name="price" placeholder="Giá sản phẩm" value="{{$idPro->price}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="text" class="form-control" name="quantity" placeholder="Số lượng sản phẩm" value="{{$idPro->quantity}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
            @if(isset($idPro->image))
                <img src="{{Storage::url($idPro->image)}}" style="width: 100px" height="100px">
            @else
                Không có hình ảnh
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Danh mục sản phẩm</label>
            <select class="form-select" aria-label="Danh mục sản phẩm" name="category_id">
                @foreach($listCate as $item)
                    <option value="{{$item->id}}"
                    @if($item->id == $idPro->category_id) selected @endif>
                    {{$item->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Describe</label>
            <input type="text" class="form-control" name="describe" placeholder="Mô tả sản phẩm" value="{{$idPro->describe}}">
        </div>
        <button type="submit" class="btn btn-success">Sửa</button>
        <a class="btn btn-light" href="{{route('products.index')}}">Quay lại trang chủ</a>
    </form>
@endsection

