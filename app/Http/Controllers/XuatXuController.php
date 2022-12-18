<?php

namespace App\Http\Controllers;

use App\Thuonghieu;
use Illuminate\Http\Request;
use App\Xuatxu;
class XuatXuController extends Controller
{
    public function getDanhSach(){
        $xuatxu=Xuatxu::orderby('xx_id','desc')->get();
        return view('admin.xuatxu.danhsach',['xuatxu'=>$xuatxu]);
    }
    public function getThem(){
        return view('admin.xuatxu.them');
    }
    public function postThem(Request $request){
        $this->validate($request,
        [
          'xx_ten'=> 'required|unique:Xuatxu|min:2|max:100',
        ],
        [
          'xx_ten.required'=>'Bạn chưa nhập tên xuất xứ',
          'xx_ten.unique'=>'Tên xuất xứ đã tồn tại',
          'xx_ten.min'=>'Tên xuất xứ phải có độ dài từ 2 cho đến 100 ký tự',
          'xx_ten.max'=>'Tên xuất xứ phải có độ dài từ 2 cho đến 100 ký tự',
        ]);
        $xuatxu=new Xuatxu;
        $xuatxu->xx_ten=$request->xx_ten;
        $xuatxu->xx_tenkhongdau=changeTitle($request->xx_ten);
        $xuatxu->save();
        return redirect('admin/xuatxu/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id){
         $xuatxu=Xuatxu::find($id);
         return view('admin.xuatxu.sua',['xuatxu'=>$xuatxu]);
     }
     public function postSua(Request $request,$id){
        $xuatxu=Xuatxu::find($id);
        $this->validate($request,
        [
          'xx_ten'=> 'required|unique:Xuatxu'.$xuatxu->id.'|min:2|max:100|',
        ],
        [
          'xx_ten.required'=>'Bạn chưa nhập tên xuất xứ',
          'xx_ten.unique'=>'Tên xuất xứ đã tồn tại',
          'xx_ten.min'=>'Tên xuất xứ phải có độ dài từ 2 cho đến 100 ký tự',
          'xx_ten.max'=>'Tên xuất xứ phải có độ dài từ 2 cho đến 100 ký tự',
        ]);
         $xuatxu=Xuatxu::find($id);
         $xuatxu->xx_ten=$request->xx_ten;
         $xuatxu->xx_tenkhongdau=changeTitle($request->xx_ten);
         $xuatxu->save();
          return redirect('admin/xuatxu/sua/'.$id)->with('thongbao','Sửa thành công');
      }
      public function getXoa($id){
        $xuatxu=Xuatxu::find($id);
        $thuonghieu=Thuonghieu::where('xx_id','=',$id)->delete();
        $xuatxu->delete();

        return redirect('admin/xuatxu/danhsach')->with('thongbao','Xóa thành công');
    }
}
