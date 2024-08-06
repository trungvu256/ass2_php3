<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .content {
            display: flex;
            flex: 1;
        }
        .sidebar {
            min-width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 1rem;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 0.75rem 1rem;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            flex: 1;
            padding: 1rem;
        }
        .image-container {
            position: relative;
            width: 50%;
        }
        .image {
            width: 100%;
            height: auto;
            transition: transform 0.25s ease;
            cursor: zoom-in;
        }
        .image.zoomed {
            transform: scale(2);
            cursor: zoom-out;
        }
        .right-slide-box {
            position: fixed;
            top: 0;
            right: -300px; /* Initially hidden */
            width: 300px;
            height: 100%;
            background-color: #f8f9fa;
            box-shadow: -2px 0 5px rgba(0,0,0,0.5);
            transition: right 0.3s ease;
        }

        .right-slide-box.open {
            right: 0;
        }
        .nav-buttons a {
            margin: 5px;
            text-decoration: none; /* Remove underline */
            color: white;
        }
    </style>
</head>
<body>

  
        
    

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
      
    <div class="d-flex justify-content-center">
        <div class=" text-white "><h1>@yield('title')</h1></div>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">   
                    <div class="container mt-0">
        <button id="toggle-btn" class="btn btn-dark ">right box</button>
    </div>
                </li>
                <li class="nav-item">
                <form action="{{route('sigOut')}}" method="POST">
                @csrf
                <button class="btn btn-dark" type="submit">logout</button>
<!--        
        <button class="btn btn-secondary" type="submit">Đăng xuất</button> -->
    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="content">

        <div class="right-slide-box " id="right-slide-box">
        <button id="close-btn" class="btn btn-danger">Close</button>
        <div class="nav-buttons">
          <div class="btn btn-dark " > <a href="http://127.0.0.1:8000/users">Users</a></div>
          <div class="btn btn-dark " ><a href="http://127.0.0.1:8000/categories">Categories</a></div>
          <div class="btn btn-dark " ><a href="http://127.0.0.1:8000/products">Products</a></div>
          <div class="btn btn-dark " ><a href="http://127.0.0.1:8000/banners">Banner</a></div>
          <div class="btn btn-dark " ><a href="#">Reports</a></div>
          <div class="btn btn-dark " > <a href="#">Settings</a></div>
        </div>
        </div>
        <div class="main-content">
        <div class="content">
            @yield('content')
        </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggle-btn');
            const closeBtn = document.getElementById('close-btn');
            const rightSlideBox = document.getElementById('right-slide-box');

            toggleBtn.addEventListener('click', function () {
                rightSlideBox.classList.toggle('open');
            });

            closeBtn.addEventListener('click', function () {
                rightSlideBox.classList.remove('open');
            });
        });
    </script>
</body>
</html>
