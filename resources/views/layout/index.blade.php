<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <base href="{{asset('')}}">
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/sweetalert2.min.css" type="text/css">

</head>
<style type="text/css">
    .name-product {
        color: #474c51;
        font-weight: 700;
    }

    .gia {
        /* font-family: Roboto,Helvetica,Arial,sans-serif; */
        font-weight: 700;
    }

    .product__details__text p {
        margin-bottom: 5px;
    }

    .header__top__right__auth a {
        color: black;
    }

    html {
        font-family: Roboto, sans-serif !important;
    }

    .zoom {
        padding: 50px;
        transition: transform .2s;
        /* Animation */
        width: 200px;
        height: 200px;
        margin: 0 auto;
    }

    .zoom:hover {
        transform: scale(1.1);
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }

    .hide {
        display: none;
    }

    .sp-hoverr:hover+.hide {
        display: block;
    }
</style>

@yield('css')

<body>
    <!-- Page Preloder -->


    <!-- Humberger Begin -->
    @include('layout.header')
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    @include('layout.sidebar')
    <!-- Hero Section End -->
    @yield('banner')
    @yield('content')

    <!-- Categories Section Begin -->
    <!-- Categories Section End -->
    @include('layout.blog')
    <!-- Featured Section Begin -->

    <!-- Blog Section End -->

    @include('layout.footer')

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script>
        $('.dropdown-toggle').dropdown();
    </script>
    @yield('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        function formatNumber(nStr, decSeperate, groupSeperate) {
            nStr += '';
            x = nStr.split(decSeperate);
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '<sup style="text-decoration:underline">đ</sup>';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
            }
            return x1 + x2;
        }

        function addSanPhamVaoGioHang() {
            // Chuẩn bị dữ liệu gởi
            var dulieugoi = {
                sp_ma: $('#sp_ma').val(),
                sp_ten: $('#sp_ten').val(),
                sp_gia: $('#sp_gia').val(),
                hinhdaidien: $('#hinhdaidien').val(),
                soluong: $('#soluong').val(),
                token: $('input[name="_token"]').val()
            };
            //console.log((dulieugoi));
            $.ajax({
                url: 'giohang-themsanpham',
                method: 'POST',
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    console.log(data)
                    if (data.loisoluong) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thông báo',
                            text: 'Số lượng sản phẩm thêm vào vượt qua số lượng trong kho',
                        })
                    } else {
                        var soluong_giohang = 0;
                        var tongtien_giohang = 0;
                        $.each(data, function(i, item) {
                            soluong_giohang++;
                            console.log(item.thanhtien);
                            tongtien_giohang = tongtien_giohang + item.thanhtien;
                        });
                        $('#soluong_giohang').text(soluong_giohang);
                        tongtien_giohang = tongtien_giohang.toString();
                        $('#tongtien_giohang').html(formatNumber(tongtien_giohang, '.', ','));
                        Swal.fire({
                            title: 'Đã thêm sản phẩm vào giỏ hàng',
                            text: "Vào giỏ hàng để cập nhật số lượng",
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Xem tiếp',
                            confirmButtonText: 'Vào giỏ hàng',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = 'gio-hang'
                            }
                        })
                    }
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

        // Đăng ký sự kiện cho nút Thêm vào giỏ hàng
        $('#btnThemVaoGioHang').click(function(event) {
            event.preventDefault();
            addSanPhamVaoGioHang();
        });
    </script>
</body>

</html>