<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{asset('')}}">
    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="admin_asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin_asset/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
    .bg-gradient-primary {
        background-image: url(admin_asset/img/Capture3.PNG);

    }

    #preloder {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999999;
        background: white;
    }

    .loader {
        width: 40px;
        height: 40px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -13px;
        margin-left: -13px;
        border-radius: 60px;
        animation: loader 0.8s linear infinite;
        -webkit-animation: loader 0.8s linear infinite;
    }

    @keyframes loader {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
            border: 4px solid #f44336;
            border-left-color: transparent;
        }

        50% {
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
            border: 4px solid #673ab7;
            border-left-color: transparent;
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
            border: 4px solid #f44336;
            border-left-color: transparent;
        }
    }

    @-webkit-keyframes loader {
        0% {
            -webkit-transform: rotate(0deg);
            border: 4px solid #f44336;
            border-left-color: transparent;
        }

        50% {
            -webkit-transform: rotate(180deg);
            border: 4px solid #673ab7;
            border-left-color: transparent;
        }

        100% {
            -webkit-transform: rotate(360deg);
            border: 4px solid #f44336;
            border-left-color: transparent;
        }
    }
</style>

<body class="bg-gradient-primary">
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" style="background-image: url('admin_asset/img/smartphone-png.png');  background-position: center;background-size: cover; height: 400px; width: 600px;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
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
                                    <form class="user" action="admin/login" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="user_email" placeholder="Nhập email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="user_password" id="exampleInputPassword" placeholder="Nhập mật khẩu">
                                        </div>
                                        <input type="submit" value="Login" class="btn btn-primary btn-user btn-block">

                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="admin_asset/vendor/jquery/jquery.min.js"></script>
    <script src="admin_asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin_asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin_asset/js/sb-admin-2.min.js"></script>
    <script>
        $(window).on('load', function() {
            $(".loader").fadeOut();
            $("#preloder").delay(200).fadeOut("slow");

            /*------------------
                Gallery filter
            --------------------*/
            $('.featured__controls li').on('click', function() {
                $('.featured__controls li').removeClass('active');
                $(this).addClass('active');
            });
            if ($('.featured__filter').length > 0) {
                var containerEl = document.querySelector('.featured__filter');
                var mixer = mixitup(containerEl);
            }
        });
    </script>
</body>

</html>