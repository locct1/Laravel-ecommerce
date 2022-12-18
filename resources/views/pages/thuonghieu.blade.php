@extends('layout.index')
@section('title')
LKshop | Thương hiệu
@endsection
@section('content')
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{$thuonghieu_name->th_ten}}</h2>
                        <div class="breadcrumb__option">
                            <a href="trang-chu">Trang chủ</a>
                            <span>{{$thuonghieu_name->th_ten}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Sản phẩm {{$thuonghieu_name->th_ten}}</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter" id="MixItUpBBD782">
            @foreach($sanpham as $sp)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="chi-tiet-san-pham/{{$sp->sp_id}}">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg zoom" data-setbg="upload/sanpham/{{$sp->sp_hinhanh}}">
                    </div>
                        <div class="featured__item__text">
                            <h6><a href="chi-tiet-san-pham/{{$sp->sp_id}}" class="name-product">{{$sp->sp_ten}}
                                </a></h6>
                            <?php if ($sp->sp_giacu != 0) { ?>
                                <h5 style="color:#d70018;" class="gia">
                                    <?php echo number_format($sp->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                    <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($sp->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                </h5>
                            <?php } else { ?>
                                <h5 style="color:#d70018;" class="gia">
                                    <?php echo number_format($sp->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
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
@endsection
@section('script')

@endsection