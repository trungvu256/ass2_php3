@extends('layoutadmin')
@section('title')
Banner
@endsection
@section('content')
<h1>{{ $image->name }}</h1>
<div class="d-flex justify-content-center align-items-center" style="height: 100vh; width: 100vh  " >
    <div class="image">
    <img src="{{Storage::url($image->image)}}" style="width:500px" height="250px"  class="image" id="zoomable-image">
    </div>
</div>
<a class="btn btn-light" href="{{route('banners.index')}}">Quay lại trang chủ</a>

    <script>
        document.getElementById('zoomable-image_products').addEventListener('click', function () {
            this.classList.toggle('zoomed');
        });
    </script>
@endsection
