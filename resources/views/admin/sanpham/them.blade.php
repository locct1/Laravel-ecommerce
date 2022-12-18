@extends('admin.layout.index')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Thêm sản phẩm</h6>
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
            <form method="post" action="admin/sanpham/them" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="font-weight-bold">Tên thương hiệu</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="th_id">
                        @foreach($thuonghieu as $th)
                        <option value="{{$th->th_id}}">{{$th->th_ten}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Tên sản phẩm</label>
                    <input type="text" class="form-control" name="sp_ten" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Số lượng</label>
                    <input type="text" class="form-control" name="sp_soluong" placeholder="Nhập số lượng">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Giá</label>
                    <input type="text" id="gia" class="form-control" name="sp_gia" placeholder="Nhập giá">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Hình ảnh</label>
                    <div class="preview-img-container">
                        <img id="preview-img" src="admin_asset/img/noimg.png" width="200px">
                    </div>
                    <input type="file" class="form-control" id="hinhanh" name="sp_hinhanh">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Khuyến mãi</label>
                    <textarea type="text" class="form-control" id="sp_km" name="sp_km" placeholder="Nhập khuyến mãi"></textarea>
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Thông số kỹ thuật</label>
                    <textarea type="text" class="form-control" id="sp_tskt" name="sp_tskt" placeholder="Nhập bảng thông số kỹ thuật"></textarea>
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Mô tả chi tiết</label>
                    <textarea type="text" class="form-control" id="sp_chitiet" name="sp_chitiet" placeholder="Nhập mô tả chi tiết"></textarea>
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Trạng thái</label>
                    <br>
                    <label class="radio-inline">
                        <input name="sp_status" checked="" value="1" type="radio"> <i class="fa fa-circle active"></i>
                    </label>
                    <br>
                    <label class="radio-inline">
                        <input name="sp_status" value="0" type="radio"> <i class="fa fa-circle inactive"></i>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary" name="btnSave">Thêm</button>
                <a href="admin/sanpham/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
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
<script src="admin_asset/ckeditor/ckeditor.js"> </script>
<script src="admin_asset/ckfinder/ckfinder.js"> </script>
<script>
    var url = 'admin_asset';
    CKEDITOR.replace('sp_tskt', {
        extraPlugins: 'editorplaceholder',
        editorplaceholder: 'Nhập bảng thông tin kỹ thuật...',
        filebrowserBrowseUrl: url + '/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: url + '/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
    CKEDITOR.replace('sp_chitiet', {
        extraPlugins: 'editorplaceholder',
        editorplaceholder: 'Nhập mô tả chi tiết...',
        filebrowserBrowseUrl: url + '/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: url + '/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
    var url = 'admin_asset';
    CKEDITOR.replace('sp_km', {
        extraPlugins: 'editorplaceholder',
        editorplaceholder: 'Nhập khuyến mãi đặt biệt...',
        filebrowserBrowseUrl: url + '/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: url + '/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
</script>
<script>
    $('#gia').keyup(function(event) {
        $(this).val(function(index, value) {
            return '' + value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });
</script>
@endsection