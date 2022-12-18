@extends('admin.layout.index')
@section('content')
<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Thêm hình thức thanh toán</h6>
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
            <form method="post" action="admin/hinhthucthanhtoan/them" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="thuonghieu_id" class="fontweight"> Tên hình thức thanh toán</label>
                    <input type="text" class="form-control" name="ht_ten" placeholder="Nhập tên hình thức thanh toán">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Trạng thái</label>
                    <br>
                    <label class="radio-inline">
                        <input name="ht_status" checked="" value="1" type="radio"> <i class="fa fa-circle active"></i>
                    </label>
                    <br>
                    <label class="radio-inline">
                        <input name="ht_status" value="0" type="radio"> <i class="fa fa-circle inactive"></i>
                    </label>
                </div>
                <button class="btn btn-primary" name="btnSave">Thêm</button>
                <a href="admin/hinhthucthanhtoan/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
            </form>
        </div>
    </div>
</div>

@endsection