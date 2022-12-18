<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Thuonghieu;
class DashBoardController extends Controller
{
    public function getDashBoard(){
        $users = DB::table('users')->count();
        $donhangxuly = DB::table('donhang')->where('dh_status','=','2')->count();
        $tongdonhang = DB::table('donhang')->count();
        $sanpham = DB::table('sanpham')->count();
        $doanhthu = DB::table('donhang')->where('dh_status','=','2')->sum('dh_tong');
        return view('admin.home.dashboard',['users'=>$users,'donhangxuly'=>$donhangxuly,'tongdonhang'=>$tongdonhang,'sanpham'=>$sanpham,'doanhthu'=>$doanhthu]);
    }
    public function getBaoCaoThongKeThuongHieu()
	{
			$thuonghieu = ThuongHieu::withCount('sanpham')->get();
		foreach ($thuonghieu as $th) {
			$data[] = array(
				'TenThuongHieu' => $th->th_ten,
				'SoLuong' => $th->sanpham_count
			);
		}
		echo json_encode($data);
	}
}
