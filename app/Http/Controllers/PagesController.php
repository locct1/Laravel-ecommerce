<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Xuatxu;
use App\Thuonghieu;
use App\Sanpham;
use App\User;
use App\Comment;
use App\Donhang;
use App\Hinhthucthanhtoan;
use Session;
use DB;
use View;
use App\Usernhanhang;
use App\Chitietdonhang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
  function __construct()
  {
    $thuonghieu = Thuonghieu::where('th_status', '=', '1')->get();
    $sanphammuanhieu = Sanpham::inRandomOrder()->where('sp_status', '=', '1')->take(3)->get();
    $sanphammuanhieu2 = Sanpham::inRandomOrder()->where('sp_status', '=', '1')->take(3)->get();
    $sanphamdanhgiacao = Sanpham::inRandomOrder()->where('sp_status', '=', '1')->take(3)->get();
    $sanphamdanhgiacao2 = Sanpham::inRandomOrder()->where('sp_status', '=', '1')->take(3)->get();
    $sanphamuudai = Sanpham::inRandomOrder()->where('sp_status', '=', '1')->take(3)->get();
    $sanphamuudai2 = Sanpham::inRandomOrder()->where('sp_status', '=', '1')->take(3)->get();
    view()->share('thuonghieu', $thuonghieu);
    view()->share('sanphammuanhieu', $sanphammuanhieu);
    view()->share('sanphammuanhieu2', $sanphammuanhieu2);
    view()->share('sanphamdanhgiacao', $sanphamdanhgiacao);
    view()->share('sanphamdanhgiacao2', $sanphamdanhgiacao2);
    view()->share('sanphamuudai', $sanphamuudai);
    view()->share('sanphamuudai2', $sanphamuudai2);
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
  }
  public function trangchu()
  {
    $sanphammoi = Sanpham::where('sp_status', '=', '1')->orderby('sp_id', 'desc')->take(8)->get();
    return view('pages.trangchu', ['sanphammoi' => $sanphammoi]);
  }
  public function lienhe()
  {
    return view('pages.lienhe');
  }
  public function thuonghieu($id)
  {
    $sanpham = Sanpham::where('th_id', '=', $id)->get();
    $thuonghieu_name = Thuonghieu::where('th_id', '=', $id)->first();
    return view('pages.thuonghieu', ['sanpham' => $sanpham, 'thuonghieu_name' => $thuonghieu_name]);
  }
  public function danhsachsanpham()
  {
    $sanpham = Sanpham::where('sp_status', '=', '1')->orderby('sp_id', 'desc')->get();
    return view('pages.danhsachsanpham', ['sanpham' => $sanpham]);
  }
  public function timkiem(Request $request)
  {
    $tukhoa = $request->tukhoa;
    $sanpham = Sanpham::where('sp_ten', 'like', "%$tukhoa%")->get();
    return view('pages.timkiem', ['sanpham' => $sanpham, 'tukhoa' => $tukhoa]);
  }
  public function chitietsanpham($id)
  {
    $sanpham = Sanpham::find($id);
    return view('pages.chitietsanpham', ['sanpham' => $sanpham]);
  }
  public function getDangnhap()
  {
    return view('pages.dangnhap');
  }
  public function postDangnhap(Request $request)
  {
    $this->validate($request, [
      'user_email' => 'required',
      'user_password' => 'required|min:3|max:32'
    ], [
      'user_email.required' => 'Bạn chưa nhập Email',
      'user_password.required' => 'Bạn chưa nhập mật khẩu',
      'user_password.min' => 'Mật khẩu không được nhỏ hơn 3 ký tự',
      'user_password.max' => 'Mật khẩu không được lớn hơn 32 ký tự'
    ]);
    $check = User::where('user_email', '=', $request->user_email)
      ->first();
    if (empty($check)) {
      return redirect('dang-nhap')->with('thongbao', 'Đăng nhập không thành công');
    } else {
      $password = ($request->user_password);
      if (Hash::check($password, $check->password)) {
        Session::put('user_id', $check->user_id);
        Session::put('user_name', $check->user_name);
        return redirect('trang-chu');
      } else {
        return redirect('dang-nhap')->with('thongbao', 'Đăng nhập không thành công');
      }
    }

    // if (Auth::attempt(['user_email' => $request->user_email, 'password' => $request->user_password])) {
    //   return redirect('trang-chu');
    // } else {
    //   return redirect('dang-nhap')->with('thongbao', 'Đăng nhập không thành công');
    // }
  }
  public function getDangxuat()
  {
    Session::forget('user_id');
    return redirect('trang-chu');
  }
  public function getDangky()
  {
    return view('pages.dangky');
  }
  public function postDangky(Request $request)
  {
    $this->validate($request, [
      'user_name' => 'required|min:3',
      'user_dienthoai' => 'required',
      'user_diachi' => 'required',
      'user_email' => 'required|email|unique:users,user_email',
      'user_password' => 'required|min:3|max:32',
      'user_passwordAgain' => 'required|same:user_password'
    ], [
      'user_name.required' => 'Bạn chưa nhập  họ và tên',
      'user_name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
      'user_dienthoai.required' => 'Bạn chưa nhập số điện thoại',
      'user_diachi.required' => 'Bạn chưa nhập số địa chỉ',
      'user_email.required' => 'Bạn chưa nhập email',
      'user_email.email' => 'Bạn chưa nhập đúng định dạng email',
      'user_email.unique' => 'Email đã tồn tại',
      'user_password.required' => 'Bạn chưa nhập mật khẩu',
      'user_password.min' => 'Mật khẩu có ít nhất 3 ký tự',
      'user_password.max' => 'Mật khẩu chỉ tối đa 3 ký tự',
      'user_passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
      'user_passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
    ]);
    $user = new User;
    $user->user_name = $request->user_name;
    $user->user_dienthoai = $request->user_dienthoai;
    $user->user_email = $request->user_email;
    $user->user_diachi = $request->user_diachi;
    $user->password = bcrypt($request->user_password);
    $user->user_quyen = 0;
    $user->save();
    Session::put('user_id', $user->user_id);
    Session::put('user_name', $user->user_name);
    return redirect('trang-chu');
  }
  public function getCapnhatthongtin()
  {
    if (Session::get('user_id')) {
      $id = Session::get('user_id');
      $user = User::find($id);
      return view('pages.capnhatthongtin', ['user' => $user]);
    } else {
      return redirect('trang-chu');
    }
  }
  public function postCapnhatthongtin(Request $request)
  {
    $id = Session::get('user_id');
    $user = User::find($id);
    $this->validate($request, [
      'user_name' => 'required|min:3',
      'user_dienthoai' => 'required',
      'user_diachi' => 'required',
    ], [
      'user_name.required' => 'Bạn chưa nhập tên người dùng',
      'user_name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
      'user_dienthoai.required' => 'Bạn chưa nhập số điện thoại',
      'user_diachi.required' => 'Bạn chưa nhập  địa chỉ',
    ]);

    $user->user_name = $request->user_name;
    $user->user_dienthoai = $request->user_dienthoai;
    $user->user_diachi = $request->user_diachi;
    if (isset($request->changePassword)) {
      $this->validate($request, [
        'user_password' => 'required|min:3|max:32',
        'user_passwordAgain' => 'required|same:user_password'
      ], [
        'user_password.required' => 'Bạn chưa nhập mật khẩu',
        'user_password.min' => 'Mật khẩu có ít nhất 3 ký tự',
        'user_password.max' => 'Mật khẩu chỉ tối đa 3 ký tự',
        'user_passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
        'user_passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
      ]);
      $user->password = bcrypt($request->user_password);
    }
    $user->save();
    Session::forget('user_name');
    Session::put('user_name', $user->user_name);
    return redirect('cap-nhat-thong-tin')->with('thongbao', 'Sửa thành công');
  }
  public function postBinhluan(Request $request, $id)
  {
    $this->validate($request, [
      'bl_noidung' => 'required|min:5',
    ], [
      'bl_noidung.required' => 'Bạn chưa nhập nội dung',
      'bl_noidung.min' => 'Nội dung phải ít nhất 5 ký tự',
    ]);
    if (Session::get('user_id')) {
      $binhluan = new Comment;
      $binhluan->sp_id = $id;
      $binhluan->user_id = Session::get('user_id');
      $binhluan->bl_noidung = $request->bl_noidung;
      $binhluan->save();
      return redirect('chi-tiet-san-pham/' . $id)->with('thongbao', 'Bình luận thành công');
    } else {
      return redirect('chi-tiet-san-pham/' . $id)->with('loi', 'Bạn vui lòng đăng nhập để bình luận');
    }
  }
  public function postThemsanpham(Request $request)
  {
    $data = $request->all();
    $sp_ma = $data['sp_ma'];
    $error['loisoluong'] = false;
    $sp = SanPham::find($sp_ma);
    if (Session::get('giohangdata') == true) {
      $cart = Session::get('giohangdata');
      if (isset($cart[$sp_ma])) {
        // Kiểm tra số lượng
        if ($sp->sp_soluong < $data['soluong'] + $cart[$sp_ma]['soluong']) {
          $error['loisoluong'] = true;
          return json_encode($error);
        }
        // Kết thúc
        $cart[$sp_ma] = array(
          'sp_ma' => $data['sp_ma'],
          'sp_ten' => $data['sp_ten'],
          'soluong' => ($data['soluong'] + $cart[$sp_ma]['soluong']),
          'gia' => $data['sp_gia'],
          'thanhtien' => ($data['soluong'] * $data['sp_gia'] + $cart[$sp_ma]['thanhtien']),
          'hinhdaidien' => $data['hinhdaidien']
        );
      } else {
        // Kiểm tra số lượng
        if ($sp->sp_soluong < $data['soluong']) {
          $error['loisoluong'] = true;
          return json_encode($error);
        }
        // Kết thúc
        $cart[$sp_ma] = array(
          'sp_ma' => $data['sp_ma'],
          'sp_ten' => $data['sp_ten'],
          'soluong' => ($data['soluong']),
          'gia' => $data['sp_gia'],
          'thanhtien' => ($data['soluong'] * $data['sp_gia']),
          'hinhdaidien' => $data['hinhdaidien']
        );
      }
      Session::put('giohangdata', $cart);
    } else {
      // Kiểm tra số lượng
      if ($sp->sp_soluong < $data['soluong']) {
        $error['loisoluong'] = true;
        return json_encode($error);
      }
      // Kết thúc
      $cart[$sp_ma] = array(
        'sp_ma' => $data['sp_ma'],
        'sp_ten' => $data['sp_ten'],
        'soluong' => $data['soluong'],
        'gia' => $data['sp_gia'],
        'thanhtien' => ($data['soluong'] * $data['sp_gia']),
        'hinhdaidien' => $data['hinhdaidien']
      );

      Session::put('giohangdata', $cart);
    }
    Session::save();
    return json_encode(Session::get('giohangdata'));
  }
  public function postXoasanpham(Request $request)
  {
    $sp_ma = $request['sp_ma'];
    if ((Session::get('giohangdata') == true)) {
      $data = Session::get('giohangdata');
      if (isset($data[$sp_ma])) {
        unset($data[$sp_ma]);
      }
      Session::put('giohangdata', $data);
      return json_encode(Session::get('giohangdata'));
    }
  }
  public function postXoatatcasanpham(Request $request)
  {
    if (Session::get('giohangdata')) {
      Session::forget('giohangdata');
    }
    return json_encode(Session::get('giohangdata'));
  }

  public function postCapnhatsanpham(Request $request)
  {
    $sp_ma = $request['sp_ma'];
    $soluong = $request['soluong'];
    $sp = SanPham::find($sp_ma);
    $error['loisoluong'] = false;
    if ((Session::get('giohangdata') == true)) {
      $data = Session::get('giohangdata');
      $sanphamcu = $data[$sp_ma];
      // Kiểm tra số lượng
      if ($sp->sp_soluong < $soluong) {
        $error['loisoluong'] = true;
        return json_encode($error);
      }
      // Kết thúc
      $data[$sp_ma] = array(
        'sp_ma' => $sanphamcu['sp_ma'],
        'sp_ten' => $sanphamcu['sp_ten'],
        'soluong' => $soluong,
        'gia' => $sanphamcu['gia'],
        'thanhtien' => ($soluong * $sanphamcu['gia']),
        'hinhdaidien' => $sanphamcu['hinhdaidien']
      );

      // lưu dữ liệu giỏ hàng vào session
      Session::put('giohangdata', $data);
    }
    return json_encode(Session::get('giohangdata'));
  }

  public function getGiohang()
  {
    $hinhthucthanhtoan = HinhThucThanhToan::where('ht_status', '=', '1')->get();
    if (Session::get('user_id')) {
      $id = Session::get('user_id');
      $user = User::find($id);
      return view('pages.giohang', ['hinhthucthanhtoan' => $hinhthucthanhtoan, 'user' => $user]);
    } else {
      return view('pages.giohang', ['hinhthucthanhtoan' => $hinhthucthanhtoan]);
    }
  }
  public function postDathang(Request $request)
  {
    $this->validate($request, [
      'nh_name' => 'required|min:3',
      'nh_email' => 'required|email',
      'nh_phone' => 'required',
      'nh_address' => 'required',
    ], [
      'nh_name.required' => 'Bạn chưa nhập tên người nhận hàng',
      'nh_name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
      'nh_email.required' => 'Bạn chưa nhập email',
      'nh_email.email' => 'Email không hợp lệ',
      'nh_phone.required' => 'Bạn chưa nhập số điện thoại',
      'nh_address.required' => 'Bạn chưa nhập  địa chỉ',
    ]);
    if ($request->dh_notes == '') {
      $request->dh_notes = 'Không có ghi chú';
    }
    $nhanhang = new Usernhanhang();
    $nhanhang->nh_name = $request->nh_name;
    $nhanhang->nh_email = $request->nh_email;
    $nhanhang->nh_phone = $request->nh_phone;
    $nhanhang->nh_address = $request->nh_address;
    $check_nh = Usernhanhang::where('nh_name', '=', $nhanhang->nh_name)
      ->where('nh_email', '=', $nhanhang->nh_email)
      ->where('nh_phone', '=', $nhanhang->nh_phone)
      ->where('nh_address', '=', $nhanhang->nh_address)
      ->first();
    if (empty($check_nh)) {
      $nhanhang->save();
      $nh_id = $nhanhang->nh_id;
    } else {
      $nh_id = $check_nh->nh_id;
    }
    $donhang = new Donhang();
    $donhang->user_id = Session::get('user_id');
    $donhang->ht_id = $request->httt;
    $donhang->dh_status = 0;
    $donhang->dh_tong = $request->dh_tong;
    $donhang->dh_notes = $request->dh_notes;
    $donhang->nh_id = $nh_id;
    $donhang->save();
    $dh_id = $donhang->dh_id;
    $giohang = Session::get('giohangdata');
    foreach ($giohang as $sp) {
      $ct = new Chitietdonhang();
      $ct->dh_id = $dh_id;
      $ct->sp_id = $sp['sp_ma'];
      $ct->ct_gia = $sp['gia'];
      $ct->ct_soluongmua = $sp['soluong'];
      $sanpham = SanPham::find($sp['sp_ma']);
      $sanpham->sp_soluong -= $sp['soluong'];
      $sanpham->save();
      $ct->save();
    }
    Session::forget('giohangdata');
    return redirect('thanh-cong');
  }
  public function getThanhcong()
  {
    return view('pages.thanhcong');
  }
  public function getXemdonhang()
  {
    $id = Session::get('user_id');
    $donhang = Donhang::where('user_id', '=', $id)->orderBy('dh_id', 'DESC')->get();
    return view('pages.xemdonhang', ['donhang' => $donhang]);
  }
  public function postChitietdonhangapi(Request $request)
  {
    $id = $request->donhang_id;
    $data = DB::table('donhang')
      ->join('chitietdonhang', 'chitietdonhang.dh_id', '=', 'donhang.dh_id')
      ->join('users_nhanhang', 'users_nhanhang.nh_id', '=', 'donhang.nh_id')
      ->join('sanpham', 'sanpham.sp_id', '=', 'chitietdonhang.sp_id')
      ->join('hinhthucthanhtoan', 'hinhthucthanhtoan.ht_id', '=', 'donhang.ht_id')
      ->where('donhang.dh_id', $id)
      ->get();
    return json_encode($data);
  }
}
