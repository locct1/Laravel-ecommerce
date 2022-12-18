@extends('admin.layout.index')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Thêm thương hiệu</h6>
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
            @if(session('loi'))
            <div class="alert alert-danger">
                {{session('loi')}}
            </div>
            @endif
            <form method="post" action="admin/thuonghieu/them" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="font-weight-bold">Tên xuất xứ</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="xx_id">
                        @foreach($xuatxu as $xx)
                        <option value="{{$xx->xx_id}}">{{$xx->xx_ten}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Tên thương hiệu</label>
                    <input type="text" class="form-control" name="th_ten" placeholder="Nhập tên thương hiệu">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Hình ảnh</label>
                    <div class="preview-img-container">
                        <img id="preview-img" src="admin_asset/img/noimg.png" width="200px">
                    </div>
                    <input type="file" class="form-control" id="hinhanh" name="th_hinhanh">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Trạng thái</label>
                    <br>
                    <label class="radio-inline">
                        <input name="th_status" checked="" value="1" type="radio"> <i class="fa fa-circle active"></i>
                    </label>
                    <br>
                    <label class="radio-inline">
                        <input name="th_status" value="0" type="radio"> <i class="fa fa-circle inactive"></i>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary" name="btnSave">Thêm</button>
                <a href="admin/thuonghieu/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    const reader = new FileReader();
    const fileInput = document.getElementById("hinhanh");
    const img = document.getElementById("preview-img");
    reader.onload = e => {
        img.src = e.target.result;
    }
    fileInput.addEventListener('change', e => {
        const f = e.target.files[0];
        reader.readAsDataURL(f);
    })
</script>
@endsection