<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use App\SanPham;
use Illuminate\Support\Facades\Auth;
class   CommentController extends Controller
{
    public function getXoa($id,$idSanPham){
        $comment=Comment::find($id);
        $comment->delete();
        return redirect('admin/sanpham/sua/'.$idSanPham)->with('thongbao','Bạn đã xóa bình luận thành công');
    }
    // public function postComment($id,Request $request){
    //     $idTinTuc=$id;
    //     $tintuc=TinTuc::find($id);
    //     $comment=new Comment;
    //     $comment->idTinTuc=$idTinTuc;
    //     $comment->idUser=Auth::user()->id;
    //     $comment->NoiDung=$request->NoiDung;
    //     $comment->save();
    //     return redirect('tintuc/'.$id.'/'.$tintuc->TieuDeKhongDau.'.html')->with('thongbao','Viết bình luận thành công');

    // }
}
