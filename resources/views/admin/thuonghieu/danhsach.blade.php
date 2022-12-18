@extends('admin.layout.index')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Quản lý thương hiệu</h6>
    </div>
    <div class="card-body">
    <a href="admin/thuonghieu/them" class="btn btn-secondary float-right mb-3">Thêm thương hiệu</a>
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
                        <th>Tên thương hiệu</th>
                        <th>Tên xuất xứ</th>
                        <th>Hình ảnh</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($thuonghieu as $th)
                    <tr>
                        <td>{{$th->th_id}}</td>
                        <td>{{$th->th_ten}}</td>
                        <td>{{$th->xuatxu->xx_ten}}</td>
                       
                        <td><img src="upload/thuonghieu/{{$th->th_hinhanh}}" width="25%" alt=""> </td>
                        <td  class="text-center">
                            @if($th->th_status==1)
                            <a href="admin/thuonghieu/inactive/{{$th->th_id}}"><i class="fa fa-circle active"></i></a>
                            @else
                            <a href="admin/thuonghieu/active/{{$th->th_id}}"><i class="fa fa-circle inactive"></i></a>
                            @endif
                        </td>
                        <td>{{date('d/m/Y H:i:s  ', strtotime($th->created_at))}}</td>
                        <td>{{date('d/m/Y H:i:s ', strtotime($th->updated_at))}}</td>
                        <td>
                            <a href="admin/thuonghieu/sua/{{$th->th_id}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <a data-th_id='{{$th->th_id}}' class="btn btn-danger btnDelete"><i class="fa fa-trash-alt"></i></a>
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
                title: 'Bạn chắn chắn muốn xóa thương hiệu?',
                text: "Một khi đã xóa, không thể phục hồi....",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy',
                confirmButtonText: 'Xác nhận'
            }).then((result) => {
                if (result.isConfirmed) {
                    var th_id = $(this).data('th_id');
                        var url = "admin/thuonghieu/xoa/" + th_id;
                        location.href = url;
                    Swal.fire(
                        'Đã xóa',
                        'Thương hiệu đã được xóa',
                        'success'
                    )
                }
            })
        });
      });
</script>
@endsection
@endsection