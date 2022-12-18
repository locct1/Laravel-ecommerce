@extends('layout.index')
@section('title')
LKshop | Đăng nhập
@endsection
@section('content')
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Đăng nhập</h2>
                    <div class="breadcrumb__option">
                        <a href="trang-chu">Trang chủ</a>
                        <span>Đăng nhập</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col-6 offset-3">
            @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                {{$err}} <br>
                @endforeach
            </div>
            @endif
            @if(session('thongbao'))
            <div class="alert alert-danger">
                {{session('thongbao')}}
            </div>
            @endif
            <form action="dang-nhap" method="post">
                @csrf
                <div class="form-group"> 
                    <label for="exampleInputEmail1" class="font-weight-bold">Email:</label>
                    <input type="email" name="user_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="font-weight-bold">Mật khẩu:</label>
                    <input type="password" name="user_password" class="form-control" id="exampleInputPassword1" placeholder="Nhập mật khẩu">
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
            <div class="float-right">
                Bạn chưa có tài khoản? <a href="dang-ky" type="button" class="btn btn-primary"> Đăng ký tại đây</a>
            </div>
        </div>
    </div>
</div>
@endsection