<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Chitietdonhang;
use App\Comment;
use App\Donhang;
use DB;
class UserController extends Controller
{
  public function getDanhSach()
  {
    $user = User::orderby('user_id','desc')->get();
    return view('admin.user.danhsach', ['user' => $user]);
  }
  public function getThem()
  {
    return view('admin.user.them');
  }
  public function postThem(Request $request)
  {
    $this->validate($request, [
      'user_name' => 'required|min:3',
      'user_dienthoai' => 'required',
      'user_diachi' => 'required',
      'user_email' => 'required|email|unique:users,user_email',
      'user_password' => 'required|min:3|max:32',
      'user_passwordAgain' => 'required|same:user_password'
    ], [
      'user_name.required' => 'Bạn chưa nhập tên người dùng',
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
    $user->user_quyen = $request->user_quyen;
    $user->save();
    return redirect('admin/user/them')->with('thongbao', 'Thêm thành công');
  }
  public function getSua($id)
  {
    $user = User::find($id);
    return view('admin.user.sua', ['user' => $user]);
  }
  public function postSua(Request $request, $id)
  {
    $user = User::find($id);
    $this->validate($request, [
      'user_name' => 'required|min:3',
      'user_dienthoai' => 'required',
      'user_diachi' => 'required',
    ], [
      'user_name.required' => 'Bạn chưa nhập tên người dùng',
      'user_name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
      'user_dienthoai.required' => 'Bạn chưa nhập số điện thoại',
      'user_diachi.required' => 'Bạn chưa nhập số địa chỉ',
    ]);

    $user->user_name = $request->user_name;
    $user->user_dienthoai = $request->user_dienthoai;
    $user->user_diachi = $request->user_diachi;
    $user->user_quyen = $request->user_quyen;
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
    return redirect('admin/user/sua/' . $user->user_id)->with('thongbao', 'Sửa thành công');
  }
  public function getXoa($id)
  {
    $user = user::find($id);
    Comment::where('user_id',$id)->delete();
    $donhang=Donhang::where('user_id',$id)->get();
   foreach($donhang as $dh){
     $ct=Chitietdonhang::where('dh_id',$dh->dh_id)->delete();
      $dh=Donhang::where('dh_id',$dh->dh_id)->delete();
   }
    $user->delete();
    return redirect('admin/user/danhsach')->with('thongbao', 'Xóa thành công');
  }
  public function getDangNhapAdmin()
  {
    return view('admin.login');
  }
  public function postDangNhapAdmin(Request $request)
  {
    $this->validate($request, [
      'user_email' => 'required',
      'user_password' => 'required|min:3|max:32'
    ], [
      'user_email.required' => 'Bạn chưa nhập Email',
      'user_password.required' => 'Bạn chưa nhập Pasword',
      'user_password.min' => 'Password không được nhỏ hơn 3 ký tự',
      'user_password.max' => 'Password không được lớn hơn 32 ký tự'
    ]);
    if (Auth::attempt(['user_email' => $request->user_email, 'password' => $request->user_password])) {
      return redirect('admin/dashboard');
    } else {
      return redirect('admin/login')->with('thongbao', 'Đăng nhập không thành công');
    }
  }
  public function getDangXuatAdmin()
  {
    Auth::logout();
    return redirect('admin/login');
  }
}
