@extends('admin.layout.index')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Quản lý sản phẩm</h6>
    </div>
    <div class="card-body">
    <a href="admin/sanpham/them" class="btn btn-secondary float-right mb-3">Thêm sản phẩm</a>
        <div class="table-responsive">
                    @if(session('thongbao'))
                     <div class="alert alert-success">
                    {{session('thongbao')}}      
                    </div>
                    @endif
                    @if(session('thongbaoloi'))
                     <div class="alert alert-danger">
                    {{session('thongbaoloi')}}      
                    </div>
                    @endif
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Giá bán</th>
                        <th>Giá cũ</th>
                        <th>Thương hiệu</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sanpham as $sp)
                    <tr>
                        <td>{{$sp->sp_id}}</td>
                        <td>{{$sp->sp_ten}}</td>
                        <td><img src="upload/sanpham/{{$sp->sp_hinhanh}}" alt="" width="50%"></td>
                        <td>{{$sp->sp_soluong}}</td>
                      <td>{{ number_format($sp->sp_gia, 0, ".", ",").'đ'}}</td>
                        <td>
                            @if($sp->sp_giacu==-0)
                            {{'Không có'}}
                            @else
                            {{number_format($sp->sp_giacu, 0, ".", ",").'đ'}}
                            @endif
                        </td>
                        <td>{{$sp->thuonghieu->th_ten}}</td>
                        <td  class="text-center">
                            @if($sp->sp_status==1)
                            <a href="admin/sanpham/inactive/{{$sp->sp_id}}"><i class="fa fa-circle active"></i></a>
                            @else
                            <a href="admin/sanpham/active/{{$sp->sp_id}}"><i class="fa fa-circle inactive"></i></a>
                            @endif
                        </td>
                        <td>{{date('d/m/Y H:i:s  ', strtotime($sp->created_at))}}</td>
                        <td>{{date('d/m/Y H:i:s ', strtotime($sp->updated_at))}}</td>
                       
                        <td>
                            <a href="admin/sanpham/sua/{{$sp->sp_id}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <a data-sp_id='{{$sp->sp_id}}' class="btn btn-danger btnDelete"><i class="fa fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
      $(document).ready(function() {
        $('.btnDelete').click(function() {
            Swal.fire({
                title: 'Bạn chắn chắn muốn xóa sản phẩm?',
                text: "Một khi đã xóa, không thể phục hồi....",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy',
                confirmButtonText: 'Xác nhận'
            }).then((result) => {
                if (result.isConfirmed) {
                    var sp_id = $(this).data('sp_id');
                        var url = "admin/sanpham/xoa/" + sp_id;

                        // Điều hướng qua trang xóa với REQUEST GET, có tham số dh_ma=...
                        location.href = url;
                    Swal.fire(
                        'Đã xóa',
                        'Sản phẩm đã được xóa',
                        'success'
                    )
                }
            })
        });
      });
</script>
@endsection