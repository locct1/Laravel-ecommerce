<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Aws\Middleware;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('admin/login','UserController@getDangNhapAdmin');
Route::post('admin/login','UserController@postDangNhapAdmin');
Route::get('admin/logout','UserController@getDangXuatAdmin');
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
    Route::get('dashboard','DashBoardController@getDashBoard');
    Route::get('baocao-thongkethuonghieu', 'DashBoardController@getBaoCaoThongKeThuongHieu');

    Route::group(['prefix'=>'hinhthucthanhtoan'],function(){
        // admin/hinhthucthanhtoan/them
        Route::get('danhsach','HinhThucThanhToanController@getDanhSach');
        Route::get('sua/{id}','HinhThucThanhToanController@getSua');
        Route::post('sua/{id}','HinhThucThanhToanController@postSua');
        Route::get('them','HinhThucThanhToanController@getThem');
        Route::post('them','HinhThucThanhToanController@postThem');
        Route::get('xoa/{id}','HinhThucThanhToanController@getXoa');
        Route::get('active/{id}','HinhThucThanhToanController@Active');
        Route::get('inactive/{id}','HinhThucThanhToanController@Inactive');
    });
    Route::group(['prefix'=>'xuatxu'],function(){
        // admin/xuatxu/them
        Route::get('danhsach','XuatXuController@getDanhSach');
        Route::get('sua/{id}','XuatXuController@getSua');
        Route::post('sua/{id}','XuatXuController@postSua');
        Route::get('them','XuatXuController@getThem');
        Route::post('them','XuatXuController@postThem');
        Route::get('xoa/{id}','XuatXuController@getXoa');
    });
    Route::group(['prefix'=>'thuonghieu'],function(){
        // admin/thuonghieu/them
        Route::get('danhsach','ThuongHieuController@getDanhSach');
        Route::get('sua/{id}','ThuongHieuController@getSua');
        Route::post('sua/{th_id}','ThuongHieuController@postSua');
        Route::get('them','ThuongHieuController@getThem');
        Route::post('them','ThuongHieuController@postThem');
        Route::get('xoa/{id}','ThuongHieuController@getXoa');
        Route::get('active/{id}','ThuongHieuController@Active');
        Route::get('inactive/{id}','ThuongHieuController@Inactive');
    });
    Route::group(['prefix'=>'sanpham'],function(){
        // admin/sanpham/them
        Route::get('danhsach','SanPhamController@getDanhSach');
        Route::get('sua/{id}','SanPhamController@getSua');
        Route::post('sua/{id}','SanPhamController@postSua');
        Route::get('them','SanPhamController@getThem');
        Route::post('them','SanPhamController@postThem');
        Route::get('xoa/{id}','SanPhamController@getXoa');
        Route::get('active/{id}','SanPhamController@Active');
        Route::get('inactive/{id}','SanPhamController@Inactive');
    });
    Route::group(['prefix'=>'donhang'],function(){
        // admin/donhang/them
        Route::get('danhsach','DonHangController@getDanhSach');
        Route::get('xoa/{id}','DonHangController@getXoa');
        Route::get('chitietdonhang/{id}','DonHangController@getChiTietDonHang');
        Route::post('donhang-danggiaohang','DonHangController@postDangGiaoHang');
        Route::post('donhang-dagiaohang','DonHangController@postDaGiaoHang');
        Route::get('indonhang/{id}','DonHangController@getInDonHang');
    });
    Route::group(['prefix'=>'comment'],function(){
        // admin/comment/xoa
        Route::get('xoa/{id}/{idSanPham}','CommentController@getXoa');
    });
    Route::group(['prefix'=>'slide'],function(){
        // admin/slide/them
        Route::get('danhsach','SlideController@getDanhSach');
        Route::get('sua/{id}','SlideController@getSua');
        Route::post('sua/{id}','SlideController@postSua');
        Route::get('them','SlideController@getThem');
        Route::post('them','SlideController@postThem');
        Route::get('xoa/{id}','SlideController@getXoa');
    });
    Route::group(['prefix'=>'user'],function(){
        // admin/user/them
        Route::get('danhsach','UserController@getDanhSach');
        Route::get('sua/{id}','UserController@getSua');
        Route::post('sua/{id}','UserController@postSua');
        Route::get('them','UserController@getThem');
        Route::post('them','UserController@postThem');
        Route::get('xoa/{id}','UserController@getXoa');
    });
    Route::group(['prefix'=>'ajax'],function(){
        Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
    });
});
Route::get('trang-chu','PagesController@trangchu');
Route::get('lien-he','PagesController@lienhe');
Route::get('thuong-hieu/{id}','PagesController@thuonghieu');
Route::get('danh-sach-san-pham','PagesController@danhsachsanpham');
Route::post('tim-kiem','PagesController@timkiem');
Route::get('chi-tiet-san-pham/{id}','PagesController@chitietsanpham');
Route::get('/','PagesController@trangchu');
Route::get('dang-nhap','PagesController@getDangnhap');
Route::post('dang-nhap','PagesController@postDangnhap');
Route::get('dang-xuat','PagesController@getDangxuat');
Route::get('dang-ky','PagesController@getDangky');
Route::post('dang-ky','PagesController@postDangky');
Route::get('cap-nhat-thong-tin','PagesController@getCapnhatthongtin');
Route::post('cap-nhat-thong-tin','PagesController@postCapnhatthongtin');
Route::post('binh-luan/{id}','PagesController@postBinhluan');
Route::post('giohang-themsanpham','PagesController@postThemsanpham');
Route::post('giohang-xoasanpham','PagesController@postXoasanpham');
Route::post('giohang-capnhatsanpham','PagesController@postCapnhatsanpham');
Route::post('giohang-xoatatca','PagesController@postXoatatcasanpham');
Route::post('dat-hang','PagesController@postDathang');
Route::get('gio-hang','PagesController@getGiohang');
Route::get('thanh-cong','PagesController@getThanhcong');
Route::get('xem-don-hang','PagesController@getXemdonhang');
Route::post('chi-tiet-don-hang-api','PagesController@postChitietdonhangapi');





