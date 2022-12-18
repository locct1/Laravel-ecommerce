<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HinhThucThanhToan;
use App\DonHang;
class HinhThucThanhToanController extends Controller
{
    public function getDanhSach(){
        $hinhthucthanhtoan=Hinhthucthanhtoan::all();
        return view('admin.hinhthucthanhtoan.danhsach',['hinhthucthanhtoan'=>$hinhthucthanhtoan]);
    }
    public function getThem(){
        return view('admin.hinhthucthanhtoan.them');
    }
    public function postThem(Request $request){
        $this->validate($request,
        [
          'ht_ten'=> 'required|unique:hinhthucthanhtoan|min:3|max:100',
        ],
        [
          'ht_ten.required'=>'Bạn chưa nhập tên hình thức thanh toán',
          'ht_ten.unique'=>'Tên hình thức thanh toán đã tồn tại',
          'ht_ten.min'=>'Tên hình thức thanh toán phải có độ dài từ 3 cho đến 100 ký tự',
          'ht_ten.max'=>'Tên hình thức thanh toán phải có độ dài từ 3 cho đến 100 ký tự',
        ]);
        $hinhthucthanhtoan=new Hinhthucthanhtoan;
        $hinhthucthanhtoan->ht_ten=$request->ht_ten;
        $hinhthucthanhtoan->ht_status=$request->ht_status;
        $hinhthucthanhtoan->save();
        return redirect('admin/hinhthucthanhtoan/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id){
         $hinhthucthanhtoan=Hinhthucthanhtoan::find($id);
         return view('admin.hinhthucthanhtoan.sua',['hinhthucthanhtoan'=>$hinhthucthanhtoan]);
     }
     public function postSua(Request $request,$id){
        $hinhthucthanhtoan=Hinhthucthanhtoan::find($id);
        $this->validate($request,
        [
          'ht_ten'=> 'required|unique:hinhthucthanhtoan'.$hinhthucthanhtoan->id.'|min:3|max:100|',
        ],
        [
          'ht_ten.required'=>'Bạn chưa nhập tên hình thức thanh toán',
          'ht_ten.unique'=>'Tên hình thức thanh toán đã tồn tại',
          'ht_ten.min'=>'Tên hình thức thanh toán phải có độ dài từ 3 cho đến 100 ký tự',
          'ht_ten.max'=>'Tên hình thức thanh toán phải có độ dài từ 3 cho đến 100 ký tự',
        ]);
         $hinhthucthanhtoan=Hinhthucthanhtoan::find($id);
         $hinhthucthanhtoan->ht_ten=$request->ht_ten;
         $hinhthucthanhtoan->save();
          return redirect('admin/hinhthucthanhtoan/sua/'.$id)->with('thongbao','Sửa thành công');
      }
      public function getXoa($id){
        $hinhthucthanhtoan=Hinhthucthanhtoan::find($id);
        $check = DonHang::select()->where('ht_id', $id)->get()->count();
        if($check>0){
          return redirect('admin/hinhthucthanhtoan/danhsach')->with('thongbaoloi','Xóa không thành công, hình thức thanh toán có trong đơn hàng.');
        }
        else{
          $hinhthucthanhtoan->delete();
          return redirect('admin/hinhthucthanhtoan/danhsach')->with('thongbao','Xóa thành công');
        }
      
    }
    public function Inactive($id)
    {
        $hinhthucthanhtoan = Hinhthucthanhtoan::find($id);
        $hinhthucthanhtoan->ht_status = 0;
        $hinhthucthanhtoan->save();
        return redirect('admin/hinhthucthanhtoan/danhsach');
    }
    public function Active($id)
    {
        $hinhthucthanhtoan = hinhthucthanhtoan::find($id);
        $hinhthucthanhtoan->ht_status = 1;
        $hinhthucthanhtoan->save();
        return redirect('admin/hinhthucthanhtoan/danhsach');
    }
}
