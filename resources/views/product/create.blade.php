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

    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="{{old('name')}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" class="form-control" name="price" placeholder="Giá sản phẩm" value="{{old('price')}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="text" class="form-control" name="quantity" placeholder="Số lượng sản phẩm" value="{{old('quantity')}}">
        </div>
        <div class="form-group">
            <label for="avatar">Avatar:</label>
            <input type="file" name="image" class="form-control">
            @error('image_products')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <select class="form-select" name="category_id" aria-label="Danh mục sản phẩm">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
                @foreach($listCate as $item)
                    <option value="{{$item->id}}"
                        @if($item->id == old('category_id')) selected
                        @endif>{{$item->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Describe</label>
            <input type="text" class="form-control" name="describe" placeholder="Mô tả sản phẩm" value="{{old('describe')}}">
        </div>
        <button type="submit" class="btn btn-success">Gửi</button>
        <a class="btn btn-light" href="{{route('products.index')}}">Quay lại trang chủ</a>
    </form>
@endsection
