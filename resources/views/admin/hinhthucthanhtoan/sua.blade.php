@extends('admin.layout.index')
@section('content')
<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Sửa hình thức thanh toán</h6>
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
            <form method="post" action="admin/hinhthucthanhtoan/sua/{{$hinhthucthanhtoan->ht_id}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="thuonghieu_id" class="fontweight"> Tên hình thức thanh toán</label>
                    <input type="text" class="form-control" value="{{$hinhthucthanhtoan->ht_ten}}" name="ht_ten" placeholder="Nhập tên hình thức thanh toán">
                </div>
                <button type="submit" class="btn btn-primary" name="btnSave">Sửa</button>
                <a href="admin/hinhthucthanhtoan/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
            </form>
        </div>
    </div>
</div>

@endsection