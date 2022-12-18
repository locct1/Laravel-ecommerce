@extends('layout.index')
@section('title')
LKshop | Giỏ hàng
@endsection
@section('css')

@endsection
@section('content')
<style>
    .modal-dialog {
        max-width: 60%;
    }

    .nice-select.form-control.form-control-lg {
        width: 322px;
    }

    li.option.selected.focus {
        width: 322px;
    }
</style>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Giỏ hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="trang-chu">Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid mt-3">
    @if(count($errors)>0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
        {{$err}} <br>
        @endforeach
    </div>
    @endif
    @if((Session::get('giohangdata')==true))
    @php
    $i=0;
    $tongtien=0;
    @endphp
    <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
        <div id="thongbao">&nbsp;</div>
    </div>
    <table id="tblGioHang" class="table table-bordered" style="border:1px solid #343a40">
        <thead class="thead-dark">
            <tr>
                <th scope="col" width="1%">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col" width="10%">Hình ảnh</th>
                <th scope="col">Số lượng </th>
                <th scope="col">Giá </th>
                <th scope="col">Thành tiền</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach(Session::get('giohangdata') as $key => $sp)
            @php
            $i++;
            $tongtien=$sp['thanhtien']+$tongtien;
            @endphp
            <tr>
                <td>{{$i}}</td>
                <td>{{$sp['sp_ten']}}</td>
                <td> <img src="upload/sanpham/{{$sp['hinhdaidien']}}" alt="" width="50%"></td>
                <td>
                    <input min="0" type="number" class="form-control" id="soluong_{{ $sp['sp_ma'] }}" name="soluong" value="{{ $sp['soluong'] }}" />
                    <button class="btn btn-primary btn-sm btn-capnhat-soluong" data-sp-ma="{{ $sp['sp_ma'] }}">Cập nhật</button>
                </td>
                <td>{{ number_format($sp['gia'])}}<sup style="text-decoration:underline">đ</sup></td>
                <td>{{ number_format($sp['thanhtien'])}}<sup style="text-decoration:underline">đ</sup></td>
                <td>
                    <form action="">
                        @csrf
                        <a id="delete_{{ $i }}" data-sp-ma="<?= $sp['sp_ma'] ?>" class="btn btn-danger btn-delete-sanpham text-light">
                            <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                        </a>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="7" class="bg bg-dark text-light text-center font-weight-bold">Tổng tiền: {{ number_format($tongtien)}}<sup style="text-decoration:underline">đ</sup> </td>
            </tr>
        </tbody>
    </table>
    <a href="trang-chu" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Về trang chủ</a>
    <a class="btn btn-deleteall-sanpham btn-danger text-light"> <i class="fa fa-trash" aria-hidden="true"></i> Xóa tất cả</a>
    @if(Session::get('user_id'))
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-shopping-cart"></i> Đặt hàng</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg bg-primary">
                    <h5 class="modal-title text-light" id="exampleModalLabel">Xác nhận đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="dat-hang" method="post">
                    @csrf
                    <div class="modal-body">
                        <h4 class="font-weight-bold text-center">Thông tin người nhận hàng</h4>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label font-weight-bold">Họ và tên:</label>
                            <input type="text" class="form-control" name="nh_name" value="{{$user->user_name}}" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label font-weight-bold">Email:</label>
                            <input type="text" name="nh_email" value="{{$user->user_email}}" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label font-weight-bold">Số điện thoại:</label>
                            <input type="text" name="nh_phone" value="{{$user->user_dienthoai}}" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label font-weight-bold">Địa chỉ:</label>
                            <textarea class="form-control" name="nh_address" id="message-text">{{$user->user_diachi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="exampleFormControlSelect1">Hình thức thanh toán:</label><br>
                            <select class="form-control form-control-lg" name="httt" id="exampleFormControlSelect1">
                                @foreach($hinhthucthanhtoan as $ht)
                                <option value="{{$ht->ht_id}}">{{$ht->ht_ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label font-weight-bold">Ghi chú: </label>
                            <textarea class="form-control" placeholder="Ghi chú hoặc hẹn ngày giao" name="dh_notes" id="message-text"></textarea>
                        </div>
                        @if((Session::get('giohangdata')==true))
                        @php
                        $i=0;
                        $tongtien=0;
                        @endphp
                        <h4 class="mb-3 font-weight-bold text-center">Thông tin chi tiết đơn hàng</h4>
                        <table id="tblGioHang" class="table table-bordered" style="border:1px solid #343a40">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="1%">STT</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col" width="10%">Hình ảnh</th>
                                    <th scope="col">Số lượng </th>
                                    <th scope="col">Giá </th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Session::get('giohangdata') as $key => $sp)
                                @php
                                $i++;
                                $tongtien=$sp['thanhtien']+$tongtien;
                                @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$sp['sp_ten']}}</td>
                                    <td> <img src="upload/sanpham/{{$sp['hinhdaidien']}}" alt="" width="100%"></td>
                                    <td>
                                        {{$sp['soluong']}}

                                    </td>
                                    <td>{{ number_format($sp['gia'])}}<sup style="text-decoration:underline">đ</sup></td>
                                    <td>{{ number_format($sp['thanhtien'])}}<sup style="text-decoration:underline">đ</sup></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <input type="hidden" name="dh_tong" value="{{$tongtien}}">
                                    <td colspan="7" class="bg bg-dark text-light text-center font-weight-bold">Tổng tiền: {{ number_format($tongtien)}}<sup style="text-decoration:underline">đ</sup> </td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
    <a class="btn btn-primary dang-nhap-thanh-toan text-light"><i class="fa fa-shopping-cart"></i> Đặt hàng</a>
    @endif
    @else
    <tr>
        <td colspan="5">
            <h3>Hiện chưa có sản phẩm trong giỏ hàng</h3>
        </td>
    </tr>
    @endif
</div>
@endsection

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        function removeSanPhamVaoGioHang(id) {
            // Dữ liệu gởi
            var dulieugoi = {
                sp_ma: id,
                token: $('input[name="_token"]').val()
            };
            // AJAX đến API xóa sản phẩm khỏi Giỏ hàng trong Session
            $.ajax({
                url: 'giohang-xoasanpham',
                method: "POST",
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Xóa sản phẩm thành công',
                        showConfirmButton: false,
                        timer: 1500,
                    })
                    window.setTimeout(function() {
                        location.reload()
                    }, 1550)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#thongbao').html(htmlString);
                    // Hiện thông báo
                    $('.alert').removeClass('d-none').addClass('show');
                }
            });
        };

        function removeAllSanPhamVaoGioHang() {
            // AJAX đến API xóa sản phẩm khỏi Giỏ hàng trong Session
            $.ajax({
                url: 'giohang-xoatatca',
                method: "POST",
                success: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Xóa tất cả sản phẩm thành công',
                        showConfirmButton: false,
                        timer: 1500,
                    })
                    window.setTimeout(function() {
                        location.reload()
                    }, 1550)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#thongbao').html(htmlString);
                    // Hiện thông báo
                    $('.alert').removeClass('d-none').addClass('show');
                }
            });
        };
        // Đăng ký sự kiện cho các nút đang sử dụng class .btn-delete-sanpham
        $('.btn-deleteall-sanpham').click(function() {
            // debugger;
            removeAllSanPhamVaoGioHang();
        });

        function dangNhapThanhToan() {
            var htmlString = `<h4>Vui lòng đăng nhập để đặt hàng.<a class="btn btn-primary" href="dang-nhap">Đăng nhập tại đây.</a></h4>`;
            $('#thongbao').html(htmlString);
            $('.alert').removeClass('d-none').addClass('show');
        }
        $('.dang-nhap-thanh-toan').click(function() {
            // debugger;

            dangNhapThanhToan();
        });

        // Đăng ký sự kiện cho các nút đang sử dụng class .btn-delete-sanpham
        $('#tblGioHang').on('click', '.btn-delete-sanpham', function(event) {
            // debugger;
            event.preventDefault();
            var id = $(this).data('sp-ma');

            console.log(id);
            removeSanPhamVaoGioHang(id);
        });

        // Cập nhật số lượng trong Giỏ hảng
        function capnhatSanPhamTrongGioHang(id, soluong) {
            // Dữ liệu gởi
            var dulieugoi = {
                sp_ma: id,
                soluong: soluong,
                token: $('input[name="_token"]').val()
            };

            $.ajax({
                url: 'giohang-capnhatsanpham',
                method: "POST",
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    if (data.loisoluong) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thông báo',
                            text: 'Số lượng sản phẩm thêm vào vượt qua số lượng trong kho',
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cập nhật số lượng sản phẩm thành công',
                            showConfirmButton: false,
                            timer: 1500,
                        })
                        window.setTimeout(function() {
                            location.reload()
                        }, 1550)
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    var htmlString = `<h6>Không thể xử lý</h6>`;
                    $('#thongbao').html(htmlString);
                    // Hiện thông báo
                    $('.alert').removeClass('d-none').addClass('show');
                }
            });
        };
        $('#tblGioHang').on('click', '.btn-capnhat-soluong', function(event) {
            // debugger;
            event.preventDefault();
            var id = $(this).data('sp-ma');
            var soluongmoi = $('#soluong_' + id).val();
            capnhatSanPhamTrongGioHang(id, soluongmoi);
        });
    });
</script>
@endsection