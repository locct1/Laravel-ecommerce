@extends('admin.layout.index')
@section('content')
<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Sửa thông tin tài khoản</h6>
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
            <form method="post" action="admin/user/sua/{{$user->user_id}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Tên tài khoản</label>
                    <input type="text" class="form-control" value="{{$user->user_name}}" name="user_name" placeholder="Nhập tên tài khoản">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Email</label>
                    <input type="text" readonly class="form-control" value="{{$user->user_email}}" name="user_email" placeholder="Nhập Email">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Số điện thoại</label>
                    <input type="text" class="form-control" value="{{$user->user_dienthoai}}" name="user_dienthoai" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Địa chỉ</label>
                    <input type="text" class="form-control" value="{{$user->user_diachi}}" name="user_diachi" placeholder="Nhập số điện chỉ">
                </div>
                <div class="form-group">
                    <input type="checkbox" id="changePassword" name="changePassword">
                    <label>Đổi mật khẩu</label>
                    <input type="password" disabled="" class="form-control password" name="user_password" placeholder="Nhập mật khẩu" />
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Nhập lại password</label>
                    <input type="password" disabled="" class="form-control password" name="user_passwordAgain" placeholder="Nhập mật khẩu" />
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Quyền người dùng</label>
                    <label class="radio-inline">
                        <input name="user_quyen" @if($user->user_quyen==1)
                        {{'checked'}}
                        @endif
                        value="1" type="radio"> Admin
                    </label>
                    <label class="radio-inline">
                        <input name="user_quyen" @if($user->user_quyen==0)
                        {{'checked'}}
                        @endif
                        value="0" type="radio"> Thường
                    </label>
                </div>
                <button class="btn btn-primary" name="btnSave">Sửa</button>
                <a href="admin/user/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        $("#changePassword").change(function() {
            if ($(this).is(":checked")) {
                $(".password").removeAttr('disabled');
            } else {
                $(".password").attr('disabled', '');
            }
        });
    });
</script>
@endsection