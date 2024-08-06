@extends('layoutlogin')
@section('title')
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
    <!-- <form action="{{route('postRegister')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name"
            placeholder="Nguyễn Văn A" value="{{old('name')}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email"
                   placeholder="abc@gmail.com" value="{{old('email')}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password"
                   value="{{old('password')}}">
        </div>
        <button type="submit" class="btn btn-success">Đăng ký</button>
    </form> -->
    <!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            The best offer <br />
            <span class="text-primary">for your business</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Eveniet, itaque accusantium odio, soluta, corrupti aliquam
            quibusdam tempora at cupiditate quis eum maiores libero
            veritatis? Dicta facilis sint aliquid ipsum atque?
          </p>
        </div>
        
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form action="{{route('postRegister')}}" method="POST"> 
              @csrf
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">
                  <div class="form-outline mb-4">
                    
                    <div data-mdb-input-init class="form-outline">
                    <label class="form-label" for="form3Example1"> Name</label>
                      <input type="text" id="form3Example1" class="form-control" name="name"
                      placeholder="" value="{{old('name')}}">
                    </div>
                  </div>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Email address</label>
                  <input type="email" id="form3Example3" class="form-control" name="email"
                  placeholder="abc@gmail.com" value="{{old('email')}}">
                  
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" id="form3Example4" class="form-control" name="password"
                  value="{{old('password')}}">
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-center mb-4">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                  <label class="form-check-label" for="form2Example33">
                    Subscribe to our newsletter
                  </label>
                </div>

                <!-- Submit button -->
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                 Register
                </button>

                <!-- Register buttons -->
                <div class="text-center">
                  <p>If you already have an account, click here to <a href="http://127.0.0.1:8000/login"> login</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
@endsection
