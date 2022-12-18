@extends('layout.index')
@section('title')
LKshop | Trang chủ
@endsection
@section('slide')
<div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class=""></li>
        <li data-target="#demo" data-slide-to="1" class=""></li>
        <li data-target="#demo" data-slide-to="2" class=""></li>
        <li data-target="#demo" data-slide-to="3" class="active"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item" data-interval="3000">
            <img src="img/banner/banner1.png" alt="Los Angeles" width="1100" height="500" class="border">
        </div>
        <div class="carousel-item" data-interval="3000">
            <img src="img/banner/banner10.png" alt="Chicago" width="1100" height="500" class="border">
        </div>
        <div class="carousel-item" data-interval="3000">
            <img src="img/banner/banner11.jpg" alt="Chicago" width="1100" height="500" class="border">
        </div>
        <div class="carousel-item active" data-interval="3000">
            <img src="img/banner/banner4.png" alt="New York" width="1100" height="500" class="border">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <i class="fa fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <i class="fa fa-chevron-right"></i>
    </a>
</div>
@endsection
@section ('banner')
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner2.png" alt="" height="200px" class="border" style="width:100%;">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner12.png" alt="" height="200px" class="border" style="width:100%;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Sản phẩm mới nhất</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter" id="MixItUpBBD782">
            @foreach($sanphammoi as $spm)
            <div class="col-lg-3 col-md-4 col-sm-6" id="sp">
                <a href="chi-tiet-san-pham/{{$spm->sp_id}}">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg zoom" data-setbg="upload/sanpham/{{$spm->sp_hinhanh}}">
                    </div>
                        <div class="featured__item__text">
                            <h6><a href="chi-tiet-san-pham/{{$spm->sp_id}}" class="name-product">{{$spm->sp_ten}}
                                </a></h6>
                            <?php if ($spm->sp_giacu != 0) { ?>
                                <h5 style="color:#d70018;" class="gia">
                                    <?php echo number_format($spm->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                    <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($spm->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                </h5>
                            <?php } else { ?>
                                <h5 style="color:#d70018;" class="gia">
                                    <?php echo number_format($spm->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                </h5>
                        
                            <?php } ?>
                        </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@include('layout.sectionproduct')
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $("#sidebar").removeClass('hero-normal');
    });
</script>
@endsection