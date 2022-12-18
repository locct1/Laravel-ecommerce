@extends('admin.layout.index')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Quản lý xuất xứ</h6>
    </div>
    <div class="card-body">
    <a href="admin/xuatxu/them" class="btn btn-secondary float-right mb-3">Thêm xuất xứ</a>
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
                        <th>Tên xuất xứ</th>
                        <th>Tên không dấu</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($xuatxu as $xx)
                    <tr>
                        <td>{{$xx->xx_id}}</td>
                        <td>{{$xx->xx_ten}}</td>
                        <td>{{$xx->xx_tenkhongdau}}</td>
                        <td>
                            <a href="admin/xuatxu/sua/{{$xx->xx_id}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <a data-xx_id='{{$xx->xx_id}}' class="btn btn-danger btnDelete"><i class="fa fa-trash-alt"></i></a>
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
                title: 'Bạn chắn chắn muốn xóa xuất xứ?',
                text: "Một khi đã xóa, không thể phục hồi....",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy',
                confirmButtonText: 'Xác nhận'
            }).then((result) => {
                if (result.isConfirmed) {
                    var xx_id = $(this).data('xx_id');
                        var url = "admin/xuatxu/xoa/" + xx_id;
                        location.href = url;
                    Swal.fire(
                        'Đã xóa',
                        'Xuất xứ đã được xóa',
                        'success'
                    )
                }
            })
        });
      });
</script>
@endsection
@endsection