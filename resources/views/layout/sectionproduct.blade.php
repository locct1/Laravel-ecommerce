<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner6.png" alt="" height="200px" class="border" style="width:100%;">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner7.png" alt="" height="200px" class="border" style="width:100%;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4 style="    font-size: 21.5px;">Sản phẩm mua nhiều</h4>
                    <div class="latest-product__slider owl-carousel owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <div class="owl-item active" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($sanphammuanhieu as $spmn)
                                        <a href="chi-tiet-san-pham/{{$spmn->sp_id}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/{{$spmn->sp_hinhanh}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product">{{$spmn->sp_ten}}</h6>
                                                <?php if ($spmn->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($spmn->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($spmn->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($spmn->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($sanphammuanhieu2 as $spmn2)
                                        <a href="chi-tiet-san-pham/{{$spmn2->sp_id}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/{{$spmn2->sp_hinhanh}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product">{{$spmn2->sp_ten}}</h6>
                                                <?php if ($spmn2->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($spmn2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($spmn2->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($spmn2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span class="fa fa-angle-left"><span></span></span></button><button type="button" role="presentation" class="owl-next"><span class="fa fa-angle-right"><span></span></span></button></div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4 style="    font-size: 21.5px;">Sản phẩm đánh giá cao</h4>
                    <div class="latest-product__slider owl-carousel owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(-720px, 0px, 0px); transition: all 1.2s ease 0s; width: 2160px;">
                                <div class="owl-item active" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($sanphamdanhgiacao as $dgc)
                                        <a href="chi-tiet-san-pham/{{$dgc->sp_id}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/{{$dgc->sp_hinhanh}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product">{{$dgc->sp_ten}}</h6>
                                                <?php if ($dgc->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($dgc->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($dgc->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($dgc->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($sanphamdanhgiacao2 as $dgc2)
                                        <a href="chi-tiet-san-pham/{{$dgc2->sp_id}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/{{$dgc2->sp_hinhanh}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product">{{$dgc2->sp_ten}}</h6>
                                                <?php if ($dgc2->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($dgc2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($dgc2->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($dgc2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span class="fa fa-angle-left"><span></span></span></button><button type="button" role="presentation" class="owl-next"><span class="fa fa-angle-right"><span></span></span></button></div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4 style="    font-size: 21.5px;">Sản phẩm ưu đãi</h4>
                    <div class="latest-product__slider owl-carousel owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(-720px, 0px, 0px); transition: all 1.2s ease 0s; width: 2160px;">
                                <div class="owl-item active" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($sanphamuudai as $ud)
                                        <a href="chi-tiet-san-pham/{{$ud->sp_id}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/{{$ud->sp_hinhanh}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product">{{$ud->sp_ten}}</h6>
                                                <?php if ($ud->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($ud->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($ud->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($ud->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($sanphamuudai2 as $ud2)
                                        <a href="chi-tiet-san-pham/{{$ud2->sp_id}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/{{$ud2->sp_hinhanh}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product">{{$ud2->sp_ten}}</h6>
                                                <?php if ($ud2->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($ud2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($ud2->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($ud2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span class="fa fa-angle-left"><span></span></span></button><button type="button" role="presentation" class="owl-next"><span class="fa fa-angle-right"><span></span></span></button></div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

<!-- Blog Section Begin -->