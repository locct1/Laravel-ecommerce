@extends('admin.layout.index')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Quản lý hình thức thanh toán</h6>
    </div>
    <div class="card-body">
    <a href="admin/hinhthucthanhtoan/them" class="btn btn-secondary float-right mb-3">Thêm hình thức thanh toán</a>
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
                        <th>Tên hình thức thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hinhthucthanhtoan as $ht)
                    <tr>
                        <td>{{$ht->ht_id}}</td>
                        <td>{{$ht->ht_ten}}</td>
                        <td  class="text-center">
                            @if($ht->ht_status==1)
                            <a href="admin/hinhthucthanhtoan/inactive/{{$ht->ht_id}}"><i class="fa fa-circle active"></i></a>
                            @else
                            <a href="admin/hinhthucthanhtoan/active/{{$ht->ht_id}}"><i class="fa fa-circle inactive"></i></a>
                            @endif
                        </td>
                        <td>
                            <a href="admin/hinhthucthanhtoan/sua/{{$ht->ht_id}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <a data-ht_id='{{$ht->ht_id}}' class="btn btn-danger btnDelete"><i class="fa fa-trash-alt"></i></a>
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
                title: 'Bạn chắn chắn muốn xóa hình thức thanh toán ?',
                text: "Một khi đã xóa, không thể phục hồi....",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy',
                confirmButtonText: 'Xác nhận'
            }).then((result) => {
                if (result.isConfirmed) {
                    var ht_id = $(this).data('ht_id');
                        var url = "admin/hinhthucthanhtoan/xoa/" + ht_id;
                        location.href = url;
                    Swal.fire(
                        'Đã xóa',
                        'Hình thức thanh toán đã được xóa',
                        'success'
                    )
                }
            })
        });
      });
</script>
@endsection
@endsection