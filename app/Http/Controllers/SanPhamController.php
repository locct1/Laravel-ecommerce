<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Xuatxu;
use App\Thuonghieu;
use App\SanPham;
use App\Comment;
use DB;
use Illuminate\Support\Str;
class SanPhamController extends Controller
{
    public function getDanhSach(){
        $sanpham=Sanpham::orderby('sp_id','desc')->get();
        return view('admin.sanpham.danhsach',['sanpham'=>$sanpham]);
    }
    public function getThem(){
        $thuonghieu=Thuonghieu::all();
        return view('admin.sanpham.them',['thuonghieu'=>$thuonghieu]);
    }
    public function postThem(Request $request){
        $this->validate($request,
        [
          'sp_ten'=> 'required|unique:Sanpham|min:3|max:100',
          'sp_soluong'=> 'required',
          'sp_gia'=> 'required',
          'sp_km'=> 'required',
          'sp_tskt'=> 'required',
          'sp_chitiet'=> 'required',
          'th_id'=>'required',
          'sp_hinhanh'=>'required'
        ],
        [
          'sp_ten.required'=>'Bạn chưa nhập tên sản phẩm',
          'sp_ten.unique'=>'Tên sản phẩm đã tồn tại',
          'sp_ten.min'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
          'sp_ten.max'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
          'sp_soluong.required'=>'Bạn chưa nhập số lượng',
          'sp_gia.required'=>'Bạn chưa nhập giá',
          'sp_km.required'=>'Bạn chưa nhập khuyến mãi',
          'sp_tskt.required'=>'Bạn chưa nhập thông số kỹ thuật',
          'sp_chitiet.required'=>'Bạn chưa mô tả chi tiết',
          'th_id.required'=>'Bạn chưa chọn thương hiệu',
          'sp_hinhanh.required'=>'Bạn chưa chọn ảnh'
        ]);
        $sanpham=new Sanpham;
        $sanpham->th_id=$request->th_id;
        $sanpham->sp_ten=$request->sp_ten;
        $sanpham->sp_tenkhongdau=changeTitle($request->sp_ten);
        $sanpham->sp_soluong=$request->sp_soluong;
        $sanpham->sp_gia=filter_var($request->sp_gia, FILTER_SANITIZE_NUMBER_INT);
        $sanpham->sp_giacu=0;
        $sanpham->sp_km=$request->sp_km;
        $sanpham->sp_tskt=$request->sp_tskt;
        $sanpham->sp_chitiet=$request->sp_chitiet;
        $sanpham->sp_status=$request->sp_status;
       
        if ($request->hasFile('sp_hinhanh')) {
            $file = $request->file('sp_hinhanh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != "jpg" && $duoi != 'png' && $duoi != 'jpeg' && $duoi != "JPG" && $duoi != 'PNG' && $duoi != 'JPEG') {
                return redirect('admin/sanpham/them')->with('loi', 'Chỉ cho phép chọn file ảnh');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str::random(4) . "_" . $name;
            while (file_exists('upload/sanpham/' . $Hinh)) {
                $Hinh = str::random(4) . "_" . $name;
            }
            $file->move("upload/sanpham/", $Hinh);
            $sanpham->sp_hinhanh = $Hinh;
        }
        $sanpham->save();
        return redirect('admin/sanpham/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id){
         $sanpham=Sanpham::find($id);
         $thuonghieu=Thuonghieu::all();
         return view('admin.sanpham.sua',['thuonghieu'=>$thuonghieu,'sanpham'=>$sanpham]);
     }
     public function postSua(Request $request,$id){
        $sanpham=Sanpham::find($id);
        $request->sp_gia=filter_var($request->sp_gia, FILTER_SANITIZE_NUMBER_INT);
        $request->sp_giacu=filter_var($request->sp_giacu, FILTER_SANITIZE_NUMBER_INT);
        $this->validate($request,
        [
          'sp_ten'=> 'required|unique:Sanpham,sp_ten,'.$sanpham->sp_id.',sp_id|min:3|max:100',
          'sp_soluong'=> 'required',
          'sp_gia'=> 'required',
          'sp_km'=> 'required',
          'sp_tskt'=> 'required',
          'sp_chitiet'=> 'required',
          'th_id'=>'required'
        ],
        [
          'sp_ten.required'=>'Bạn chưa nhập tên sản phẩm',
          'sp_ten.unique'=>'Tên sản phẩm đã tồn tại',
          'sp_ten.min'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
          'sp_ten.max'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
          'sp_soluong.required'=>'Bạn chưa nhập số lượng',
          'sp_gia.required'=>'Bạn chưa nhập giá',
          'sp_km.required'=>'Bạn chưa nhập khuyến mãi',
          'sp_tskt.required'=>'Bạn chưa nhập thông số kỹ thuật',
          'sp_chitiet.required'=>'Bạn chưa mô tả chi tiết',
          'th_id.required'=>'Bạn chưa chọn thương hiệu'
        ]);
        if(isset($request->sp_giacu)){
            $this->validate($request,
            [
              'sp_giacu'=> 'required',
            ],
            [
              'sp_giacu.required'=>'Vui lòng nhập giá cũ',
            ]);
            if($request->sp_giacu!=0 && $request->sp_giacu<=$request->sp_gia){
                return redirect('admin/sanpham/sua/'.$sanpham->sp_id)->with('thongbaogia','Giá cũ phải lớn hơn giá hiện tại');
            }
        }
        $sanpham->th_id=$request->th_id;
        $sanpham->sp_ten=$request->sp_ten;
        $sanpham->sp_tenkhongdau=changeTitle($request->sp_ten);
        $sanpham->sp_soluong=$request->sp_soluong;
        $sanpham->sp_gia=$request->sp_gia;
        $sanpham->sp_giacu=$request->sp_giacu;
        $sanpham->sp_km=$request->sp_km;
        $sanpham->sp_tskt=$request->sp_tskt;
        $sanpham->sp_chitiet=$request->sp_chitiet;
        if ($request->hasFile('sp_hinhanh')) {
            $file = $request->file('sp_hinhanh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != "jpg" && $duoi != 'png' && $duoi != 'jpeg' && $duoi != "JPG" && $duoi != 'PNG' && $duoi != 'JPEG') {
                return redirect('admin/sanpham/sua/'.$sanpham->sp_id)->with('loi', 'Chỉ cho phép chọn file ảnh');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str::random(4) . "_" . $name;
            while (file_exists('upload/sanpham/' . $Hinh)) {
                $Hinh = str::random(4) . "_" . $name;
            }
            $file->move("upload/sanpham/", $Hinh);
            unlink("upload/sanpham/".$sanpham->sp_hinhanh);
            $sanpham->sp_hinhanh = $Hinh;
        } else {
           
        }
        $sanpham->save();
        return redirect('admin/sanpham/sua/'.$sanpham->sp_id)->with('thongbao','Sửa thành công');
      }
      public function getXoa($id){
        $sanpham=Sanpham::find($id);
        $check=DB::table('chitietdonhang')->where('sp_id',$id)->get()->count();
        if($check>0){
            return redirect('admin/sanpham/danhsach')->with('thongbaoloi','Xóa không thành công, sản phẩm có trong đơn hàng.');
        }
        else{
            Comment::where('sp_id',$sanpham->sp_id)->delete();
            $sanpham->delete();
            unlink("upload/sanpham/".$sanpham->sp_hinhanh);
            return redirect('admin/sanpham/danhsach')->with('thongbao','Xóa thành công');
        }
       
    }
    public function Inactive($id){
        $sanpham=Sanpham::find($id);
        $sanpham->sp_status=0;
        $sanpham->save();
        return redirect('admin/sanpham/danhsach');
    }
    public function Active($id){
        $sanpham=Sanpham::find($id);
        $sanpham->sp_status=1;
        $sanpham->save();
        return redirect('admin/sanpham/danhsach');
    }
}


