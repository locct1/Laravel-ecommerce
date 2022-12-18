<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{asset('')}}">
    <title>LKshop</title>

    <!-- Custom fonts for this template-->
    <link href="admin_asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="admin_asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="admin_asset/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="admin_asset/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="admin_asset/css/sweetalert2.min.css" rel="stylesheet">

</head>
<style>
      i.fa.fa-circle.active {
    color: green;
}
i.fa.fa-circle.inactive {
    color: red;
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
<body id="page-top">
<div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.layout.menu')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.layout.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    @yield('content')


                </div>
            </div>
            @include('admin.layout.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn thật sự muốn thoát?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" nếu muốn thoát?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <a class="btn btn-primary" href="admin/logout">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="admin_asset/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="admin_asset/vendor/datatables/vfs_fonts.js"></script>
    <script src="admin_asset/vendor/datatables/dataTables.buttons.min.js"></script>
    <script src="admin_asset/vendor/datatables/buttons.html5.min.js"></script>
    <script src="admin_asset/vendor/datatables/buttons.print.min.js"></script>
    <script src="admin_asset/vendor/datatables/jszip.min.js"></script>
    <script src="admin_asset/js/sweetalert2.all.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="admin_asset/vendor/jquery/jquery.min.js"></script>
    <script src="admin_asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <!-- Custom scripts for all pages-->
    <script src="admin_asset/js/sb-admin-2.min.js"></script>
    <script src="admin_asset/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="admin_asset/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="admin_asset/js/demo/datatables-demo.js"></script>
    <script src="admin_asset/js/jquery.validate.js"></script>
    <script src="admin_asset/vendor/chart.js/Chart.min.js"></script>
    


    <!-- Page level custom scripts -->
   
    <script>
		 $('#dataTable').DataTable({
			responsive: true,
				// dom: 'Bfrtip',
				// buttons: [
				// 	'copy', 'csv', 'excel', 'pdf', 'print'
				// ],
				order: [
					[0, 'desc']
				],
				'language': {
					'lengthMenu': "Hiển thị _MENU_ mục từng trang",
					'info': 'Hiển thị _START_ đến _END_ trong số _TOTAL_ mục',
					"emptyTable": "Không có dữ liệu trong bảng",
					"paginate": {
						"previous": "Trước",
						"next": "Sau",
						"infoEmpty": "Không có dữ liệu"
					},
					"search": "Lọc / Tìm kiếm:"
				},
		});
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
    @yield('script')
</body>

</html>