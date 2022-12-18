@extends('admin.layout.index')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Quản lý tài khoản khách hàng</h6>
    </div>
    <div class="card-body">
    <a href="admin/user/them" class="btn btn-secondary float-right mb-3">Thêm tài khoản</a>
        <div class="table-responsive">
        @if(session('thongbao'))
                     <div class="alert alert-success">
                    {{session('thongbao')}}      
                    </div>
                    @endif
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên tài khoản</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Quyền</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $user)
                    <tr>
                        <td>{{$user->user_id}}</td>
                        <td>{{$user->user_name}}</td>
                        <td>{{$user->user_email}}</td>
                        <td>{{$user->user_diachi}}</td>
                        <td>{{$user->user_dienthoai}}</td>
                        <td>@if($user->user_quyen==1)
                            {{'Admin'}}
                            @else
                            {{'Thường'}}
                            @endif
                        </td>
                        <td>{{date('d/m/Y ', strtotime($user->created_at))}}</td>
                        <td>{{date('d/m/Y ', strtotime($user->updated_at))}}</td>
                        <td>
                            <a href="admin/user/sua/{{$user->user_id}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <a data-user_id='{{$user->user_id}}' class="btn btn-danger btnDelete"><i class="fa fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('script')
<script>
      $(document).ready(function() {
        $('.btnDelete').click(function() {
            Swal.fire({
                title: 'Bạn chắn chắn muốn xóa tài khoản?',
                text: "Một khi đã xóa, không thể phục hồi....",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy',
                confirmButtonText: 'Xác nhận'
            }).then((result) => {
                if (result.isConfirmed) {
                    var user_id = $(this).data('user_id');
                        var url = "admin/user/xoa/" + user_id;
                        location.href = url;
                    Swal.fire(
                        'Đã xóa',
                        'Tài khoản đã được xóa',
                        'success'
                    )
                }
            })
        });
      });
</script>
@endsection
@endsection