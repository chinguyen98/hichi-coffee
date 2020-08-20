<?php

namespace App\Http\Controllers\Admin;

use App\CoffeeComment;
use App\CoffeeCommentImage;
use App\CoffeeCommentReply;
use App\CommentReply;
use App\Helpers\Slug;
use App\Http\Controllers\Controller;
use App\Mail\CoffeeCommentMail;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

use function GuzzleHttp\Promise\all;

class CoffeeCommentManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $comments = CoffeeComment::where('status', 0)->get();
        $rep_commnets = CoffeeCommentReply::where('status', 0)->get();
        return view('admins.coffeecommentManagement.index')->with([
            'title' => 'DANH SÁCH BÌNH LUẬN',
            'comment' => $comments,
            'rep_comment' => $rep_commnets,
        ]);
    }
    public function detail($id)
    {
        $id_coffee = explode('a', $id)[0];
        $id_customer = explode('a', $id)[1];
        $comments = CoffeeComment::where('id_coffee', $id_coffee)->where('id_customer', $id_customer)->first();


        return view('admins.coffeecommentManagement.detail')->with([
            'title' => 'CHI TIẾT BÌNH LUẬN',
            'comment' => $comments,

        ]);
    }
    public function replyDetail($id)
    {
        $detailcomment = CoffeeCommentReply::where('id', $id)->first();
        return view('admins.coffeecommentManagement.replydetail')->with([
            'title' => 'CHI TIẾT TRẢ LỜI BÌNH LUẬN',
            'repcomment' => $detailcomment,

        ]);
    }

    public function browser(Request $request, $id)
    {
        $id_coffee = explode('a', $id)[0];
        $id_customer = explode('a', $id)[1];

        DB::table('coffee_comments')->where('id_coffee', $id_coffee)->where('id_customer', $id_customer)->update(['status' => 1]);
        $request->session()->flash('flash_message', 'Duyệt Bình Luận Thành Công!');
        return redirect()->route('admins.manage.coffeecomment.index');
    }
    public function browser_rep(Request $request, $id)
    {
        DB::table('coffee_comment_replies')->where('id', $id)->update(['status' => 1]);
        $request->session()->flash('flash_message', 'Duyệt Trả Lời Bình Luận Thành Công!');
        return redirect()->route('admins.manage.coffeecomment.index');
    }

    public function delete(Request $request, $id)
    {
        $id_coffee = explode('a', $id)[0];
        $id_customer = explode('a', $id)[1];

        $coffee = DB::table('coffees')->where('id', $id_coffee)->first(['name', 'slug']);
        $coffeeComment = DB::table('coffee_comments')->where('id_coffee', $id_coffee)->where('id_customer', $id_customer)->first(['created_at']);
        $customer=DB::table('customers')->where('id', $id_customer)->first(['email']);

        // DB::table('coffee_comments')->where('id_coffee', $id_coffee)->where('id_customer', $id_customer)->update([
        //     'status' => 2,
        // ]);

        $details = [
            'coffeeName' => $coffee->name,
            'coffeeSlug'=>$coffee->slug,
            'created_at' => $coffeeComment->created_at,
        ];

        Mail::to($customer->email)->send(new CoffeeCommentMail($details));

        $request->session()->flash('flash_message', 'Hoàn thành!');
        return redirect()->route('admins.manage.coffeecomment.index');
    }
    public function delete_rep(Request $request, $id)
    {
        DB::table('coffee_comment_replies')->delete($id);
        $request->session()->flash('flash_message', 'Xóa Trả Lời Bình Luận Thành Công!');
        return redirect()->route('admins.manage.coffeecomment.index');
    }
}
