<?php

namespace App\Http\Controllers;

use App\Sanpham;
use Illuminate\Http\Request;
use App\Xuatxu;
use App\Thuonghieu;
use Illuminate\Support\Str;
class ThuongHieuController extends Controller
{
    public function getDanhSach()
    {
        $thuonghieu = Thuonghieu::orderby('th_id','desc')->get();
        return view('admin.thuonghieu.danhsach', ['thuonghieu' => $thuonghieu]);
    }
    public function getThem()
    {
        $xuatxu = Xuatxu::all();
        return view('admin.thuonghieu.them', ['xuatxu' => $xuatxu]);
    }
    public function postThem(Request $request)
    {
        $this->validate(
            $request,
            [
                'th_ten' => 'required|unique:Thuonghieu|min:3|max:100',
                'xx_id' => 'required',
                'th_hinhanh'=>'required'
            ],
            [
                'th_ten.required' => 'Bạn chưa nhập thương hiệu',
                'th_ten.unique' => 'Tên thương hiệu đã tồn tại',
                'th_ten.min' => 'Tên thương hiệu phải có độ dài từ 3 cho đến 100 ký tự',
                'th_ten.max' => 'Tên thương hiệu phải có độ dài từ 3 cho đến 100 ký tự',
                'xx_id.required' => 'Bạn chưa chọn xuất xứ',
                'th_hinhanh.required'=>'Bạn chưa nhập hình ảnh'
            ]
        );

        $thuonghieu = new Thuonghieu;
        $thuonghieu->xx_id = $request->xx_id;
        $thuonghieu->th_ten = $request->th_ten;
        $thuonghieu->th_status = $request->th_status;
        if ($request->hasFile('th_hinhanh')) {
            $file = $request->file('th_hinhanh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != "jpg" && $duoi != 'png' && $duoi != 'jpeg' && $duoi != "JPG" && $duoi != 'PNG' && $duoi != 'JPEG') {
                return redirect('admin/thuonghieu/them')->with('loi', 'Chỉ cho phép chọn file ảnh');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str::random(4) . "_" . $name;
            while (file_exists('upload/thuonghieu/' . $Hinh)) {
                $Hinh = str::random(4) . "_" . $name;
            }
            $file->move("upload/thuonghieu/", $Hinh);
            $thuonghieu->th_hinhanh = $Hinh;
        } 
        $thuonghieu->save();
        return redirect('admin/thuonghieu/them')->with('thongbao', 'Thêm thành công');
    }
    public function getSua($id)
    {
        $thuonghieu = Thuonghieu::find($id);
        $xuatxu = Xuatxu::all();
        return view('admin.thuonghieu.sua', ['thuonghieu' => $thuonghieu, 'xuatxu' => $xuatxu]);
    }
    public function postSua(Request $request, $th_id)
    {
        $thuonghieu = Thuonghieu::find($th_id);

        $this->validate(
            $request,
            [
                'th_ten' => 'required|unique:Thuonghieu,th_ten,' . $thuonghieu->th_id . ',th_id|min:3|max:100|',
                'xx_id' => 'required'
            ],
            [
                'th_ten.required' => 'Bạn chưa nhập thương hiệu',
                'th_ten.unique' => 'Tên thương hiệu đã tồn tại',
                'th_ten.min' => 'Tên thương hiệu phải có độ dài từ 3 cho đến 100 ký tự',
                'th_ten.max' => 'Tên thương hiệu phải có độ dài từ 3 cho đến 100 ký tự',
                'xx_id.required' => 'Bạn chưa chọn xuất xứ'
            ]
        );

        $thuonghieu->xx_id = $request->xx_id;
        $thuonghieu->th_ten = $request->th_ten;
        if ($request->hasFile('th_hinhanh')) {
            $file = $request->file('th_hinhanh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != "jpg" && $duoi != 'png' && $duoi != 'jpeg' && $duoi != "JPG" && $duoi != 'PNG' && $duoi != 'JPEG') {
                return redirect('admin/thuonghieu/sua')->with('loi', 'Chỉ cho phép chọn file ảnh');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str::random(4) . "_" . $name;
            while (file_exists('upload/thuonghieu/' . $Hinh)) {
                $Hinh = str::random(4) . "_" . $name;
            }
            $file->move("upload/thuonghieu/", $Hinh);
            unlink("upload/thuonghieu/" . $thuonghieu->th_hinhanh);
            $thuonghieu->th_hinhanh = $Hinh;
        } else {
        }
        $thuonghieu->save();
        return redirect('admin/thuonghieu/sua/' . $th_id)->with('thongbao', 'Sửa thành công');
    }
    public function getXoa($id)
    {
        $thuonghieu = thuonghieu::find($id);
        unlink("upload/thuonghieu/" . $thuonghieu->th_hinhanh);
        $sanpham=Sanpham::where('th_id','=',$id)->delete();
        $thuonghieu->delete();
        return redirect('admin/thuonghieu/danhsach')->with('thongbao', 'Xóa thành công');
    }
    public function Inactive($id)
    {
        $thuonghieu = Thuonghieu::find($id);
        $thuonghieu->th_status = 0;
        $thuonghieu->save();
        return redirect('admin/thuonghieu/danhsach');
    }
    public function Active($id)
    {
        $thuonghieu = Thuonghieu::find($id);
        $thuonghieu->th_status = 1;
        $thuonghieu->save();
        return redirect('admin/thuonghieu/danhsach');
    }
}
