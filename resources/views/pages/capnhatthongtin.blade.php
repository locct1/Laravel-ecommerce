@extends('layout.index')
@section('title')
LKshop | Cập nhật thông tin
@endsection
@section('content')
<style>
    .modal-log {
  width: 750px;
  margin: auto;
}
</style>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Cập nhật thông tin</h2>
                    <div class="breadcrumb__option">
                        <a href="trang-chu">Trang chủ</a>
                        <span>Cập nhật thông tin</span>
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
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
            @endif
            <form action="cap-nhat-thong-tin" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Họ và tên:</label>
                    <input type="text" name="user_name" class="form-control"  value="{{$user->user_name}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập họ và tên">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Email:</label>
                    <input type="email" name="user_email" readonly class="form-control"  value="{{$user->user_email}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Địa chỉ: </label>
                    <textarea type="text" name="user_diachi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập địa chỉ">{{$user->user_diachi}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Số điện thoại:</label>
                    <input type="text" name="user_dienthoai" class="form-control" id="exampleInputEmail1"  value="{{$user->user_dienthoai}}" aria-describedby="emailHelp" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                        <input type="checkbox" id="changePassword" name="changePassword">
                        <label class="font-weight-bold">Đổi mật khẩu:</label>
                        <input type="password" disabled="" class="form-control password" name="user_password" placeholder="Nhập mật khẩu" />
                    </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="font-weight-bold">Nhập lại mật khẩu:</label>
                    <input type="password" disabled="" name="user_passwordAgain" class="form-control password" id="changepassword"  placeholder="Nhập mật khẩu">
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#changePassword").change(function(){
            if($(this).is(":checked"))
            {
                $(".password").removeAttr('disabled');
            }
            else
            {
                $(".password").attr('disabled','');
            }
        });
    });
</script>
@endsection