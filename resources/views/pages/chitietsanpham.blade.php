@extends('layout.index')
@section('title')
LKshop | Chi tiết sản phẩm
@endsection
@section('css')
<style>
    .con {
        position: relative;

    }

    .con p {
        display: none;
    }

    .con h3 {
        display: none;
    }

    .contentchitiet {
        text-align: center;
        position: absolute;
        width: 95.5%;
        height: 129px;
        background: linear-gradient(to bottom, rgb(255 255 255 / 0%), rgba(255 255 255/62.5), rgba(255 255 255/1));
        border-radius: 5px;
        margin-top: -76px;
    }

    #loadMore {
        padding: 10px 73px;
        text-align: center;
        background-color: #33739E;
        color: #fff;
        border-width: 0 1px 1px 0;
        border-style: solid;
        border-color: #fff;
        border-radius: 100px;
        box-shadow: 0 1px 1px #ccc;
        transition: all 600ms ease-in-out;
        -webkit-transition: all 600ms ease-in-out;
        -moz-transition: all 600ms ease-in-out;
        -o-transition: all 600ms ease-in-out;
    }

    #loadMore:hover {
        background-color: #fff;
        color: #33739E;
    }

    .spad {
        padding-top: 23px;
    }
</style>
@endsection
@section('content')
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Sản phẩm</h2>
                    <div class="breadcrumb__option">
                        <a href="trang-chu">Trang chủ</a>
                        <a href="thuong-hieu/{{$sanpham->thuonghieu->th_id}}">{{$sanpham->thuonghieu->th_ten}}</a>
                        <span>{{$sanpham->sp_ten}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-details spad">
    <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
        <div id="thongbao">&nbsp;</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form name="frmsanphamchitiet" id="frmsanphamchitiet" method="post" action="">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <input type="hidden" name="sp_ma" id="sp_ma" value="{{$sanpham->sp_id}}" />
                            <input type="hidden" name="sp_ten" id="sp_ten" value="{{$sanpham->sp_ten}}" />
                            <input type="hidden" name="sp_gia" id="sp_gia" value="{{$sanpham->sp_gia}}" />
                            <input type="hidden" name="hinhdaidien" id="hinhdaidien" value="{{$sanpham->sp_hinhanh}}" />
                            <img class="product__details__pic__item--large" src="upload/sanpham/{{$sanpham->sp_hinhanh}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$sanpham->sp_ten}}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(989 reviews)</span>
                        </div>
                        <div class="product__details__price">Giá:
                            <?php if ($sanpham->sp_giacu != 0) { ?>
                                <?php echo number_format($sanpham->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                <span style="text-decoration: line-through; color:#6c757d; font-weight:300;">
                                    <?php echo number_format($sanpham->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                </span>
                            <?php } else { ?>
                                <?php echo number_format($sanpham->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                            <?php } ?>
                        </div>
                        <div class="mtn">
                            <p style="font-weight:bold;">Nhận khuyến mãi đặt biệt</p>
                            <hr>
                            <div class="khuyenmai">
                                <?php echo $sanpham->sp_km ?>
                            </div>
                            <br>
                        </div>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="soluong" id="soluong" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="primary-btn" id="btnThemVaoGioHang">Thêm vào giỏ hàng</a>
                        <ul>
                            <li><b>Thương hiệu</b> <span>{{$sanpham->thuonghieu->th_ten}}</span></li>
                            <li><b>Xuất xứ thương hiệu:</b> <span>{{$sanpham->thuonghieu->xuatxu->xx_ten}}</span></li>
                            <li><b>Số lượng</b> <span>{{$sanpham->sp_soluong}}</span></li>
                            <li><b>Vận chuyển</b> <span>Trong ngày <samp>Miễn phí vận chuyển ngay hôm nay</samp></span></li>
                            <li><b>Chia sẻ</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row">

                <div class="col-lg-7 noibat">
                    <br>
                    <h5 style="font-size:27px;font-weight:600;color:#d70018">ĐẶT ĐIỂM NỔI BẬT</h5>
                    <br>
                    <div class="con">
                        <?php echo $sanpham->sp_chitiet ?>
                        <div class="contentchitiet"> <a href="#" id="loadMore">Đọc thêm <i class="fa fa-angle-down"></i></a></a></div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <h5 style="font-size:27px;font-weight:600; margin-top: 18px;">Thông số kỹ thuật</h5>
                    <br>
                    <div class="table table-striped"> <?php echo $sanpham->sp_tskt ?></div>
                </div>

            </div>
        </div>
    </form>
    <style>
        .form-color {
            background-color: #fafafa;
        }

        .form-control {
            height: 48px;
            border-radius: 25px
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #35b69f;
            outline: 0;
            box-shadow: none;
            text-indent: 10px
        }

        .c-badge {
            background-color: #35b69f;
            color: white;
            height: 20px;
            font-size: 11px;
            width: 92px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2px
        }

        .comment-text {
            font-size: 13px
        }

        .wish {
            color: #35b69f
        }

        .user-feed {
            font-size: 14px;
            margin-top: 12px
        }
    </style>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div>
                        <div class="p-3">
                            <h6 style="font-weight:bold;font-size:20px">Bình luận sản phẩm</h6>
                        </div>
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
                        <form action="binh-luan/{{$sanpham->sp_id}}" method="post">
                            @csrf
                            <div class="mt-3 d-flex flex-row align-items-center p-3 form-color">
                                <input type="text" name="bl_noidung" class="form-control" placeholder="Nhập bình luận cho sản phẩm..." id="binhluan" onkeypress="checkKey(event)">
                                <button type="submit" class="btn btn-primary rounded-3">Gửi</button>
                            </div>
                        </form>
                        <div class="mt-2">
                            @foreach($sanpham->comment->reverse() as $cm)
                            <div class="d-flex flex-row p-3">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex flex-row align-items-center"> <span class="mr-2 font-weight-bold">{{$cm->user->user_name}} <span class="font-weight-normal" style="font-size:14px;color: #99a2aa;">vào ngày {{date('d/m/Y', strtotime($cm->created_at))}}</span>
                                            </span> </div>
                                    </div>
                                    <p class="text-justify comment-text mb-0" style="color:#444b52;font-size:15px">{{$cm->bl_noidung}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layout.sectionproduct')
</section>
@endsection
@section('script')
<script>
    $(function() {
        $(".con p").slice(0, 4).show();
        $("#loadMore").on('click', function(e) {
            e.preventDefault();
            $(".con p:hidden").slice(0, 1000).slideDown();
            if ($(".con p:hidden").length == 0) {
                $("#load").fadeOut('slow');
                $("#loadMore").remove();
                $(".contentchitiet").remove();
            }
            $('.con,.con').animate({
                scrollTop: $(this).offset().top
            }, 2000);
        });
    });
</script>

@endsection