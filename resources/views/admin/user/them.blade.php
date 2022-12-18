@extends('admin.layout.index')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Thêm tài khoản</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
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
            <form method="post" action="admin/user/them" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Tên tài khoản</label>
                    <input type="text" class="form-control" name="user_name" placeholder="Nhập tên tài khoản">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Email</label>
                    <input type="text" class="form-control" name="user_email" placeholder="Nhập Email">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Số điện thoại</label>
                    <input type="text" class="form-control" name="user_dienthoai" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Địa chỉ</label>
                    <input type="text" class="form-control" name="user_diachi" placeholder="Nhập số điện chỉ">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Password</label>
                    <input type="password" class="form-control" name="user_password" placeholder="Nhập mật khẩu" />
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Nhập lại password</label>
                    <input type="password" class="form-control" name="user_passwordAgain" placeholder="Nhập mật khẩu" />
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Quyền người dùng</label>
                    <label class="radio-inline">
                        <input name="user_quyen" value="1" type="radio">Admin
                    </label>
                    <label class="radio-inline">
                        <input name="user_quyen" checked="" value="0" type="radio">Thường
                    </label>
                </div>
                <button class="btn btn-primary" name="btnSave">Thêm</button>
                <a href="admin/user/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
            </form>
        </div>
    </div>
</div>

@endsection