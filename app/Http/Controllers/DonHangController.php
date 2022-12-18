<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donhang;
use App\Sanpham;
use App\Usernhanhang;
use App\User;
use App\Chitietdonhang;

class DonhangController extends Controller
{
    function __construct()
    {
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
    }
    public function getDanhSach()
    {
        $donhang = Donhang::orderby('dh_id', 'desc')->get();
        return view('admin.donhang.danhsach', ['donhang' => $donhang]);
    }
    public function getChiTietDonHang($id)
    {
        $donhang = Donhang::find($id);
        return view('admin.donhang.chitietdonhang', ['donhang' => $donhang]);
    }
    public function postDangGiaoHang(Request $request)
    {
        $donhang = Donhang::find($request['dh_id']);
        $donhang->dh_status = 1;
        $donhang->save();
        return json_encode($donhang);
    }
    public function postDaGiaoHang(Request $request)
    {
        $donhang = Donhang::find($request['dh_id']);
        $donhang->dh_status = 2;
        $donhang->save();
        return json_encode($donhang);
    }
    public function getInDonHang($id)
    {
        $donhang = Donhang::find($id);
        return view('admin.donhang.indonhang', ['donhang' => $donhang]);
    }
    public function getXoa($id)
    {
        $donhang = Donhang::find($id);
        $ct = Chitietdonhang::where('dh_id', '=', $id)->delete();
        $nhanhang = Donhang::select('nh_id')->distinct()->get();
        echo '<pre>' . $nhanhang . '</pre>';
        $donhang->delete();
        Usernhanhang::select()->whereNotIn('nh_id', Donhang::select('nh_id')->distinct()->get())->delete();
        return redirect('admin/donhang/danhsach')->with('thongbao', 'Xóa thành công');
    }
}
