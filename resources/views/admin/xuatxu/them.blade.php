@extends('admin.layout.index')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Thêm xuất xứ</h6>
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
            <form method="post" action="admin/xuatxu/them" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="thuonghieu_id" class="fontweight"> Tên xuất xứ</label>
                    <input type="text" class="form-control" name="xx_ten" placeholder="Nhập tên xuất xứ">
                </div>
                <button class="btn btn-primary" name="btnSave">Thêm</button>
                <a href="admin/xuatxu/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
            </form>
        </div>
    </div>
</div>

@endsection