<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Slug;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admins.newsManagement.index')->with([
            'title' => 'Danh sách tin',
        ]);
    }

    public function create()
    {
        return view('admins.newsManagement.create')->with([
            'title' => 'Thêm tin mới',
        ]);
    }

    public function store(Request $request)
    {
        $newsSlug = new Slug();

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'content' => 'required',
            'image' => 'required',
        ], [
            'required' => ':attribute không được để trống',
        ], [
            'title' => 'Tiêu đề',
            'description' => 'Mô tả',
            'content' => 'Nội dung',
            'image' => 'Hình ảnh',
        ]);

        $news_update = $request->all();
        if ($request->hasFile("image")) {
            $file = $request->image;
            DB::table('news')->insert([
                'title' => $news_update['title'],
                'description' => $news_update['description'],
                'content' => $news_update['content'],
                'image' => $file->getClientOriginalName(),
                'slug' => $newsSlug->createSlug($news_update["title"]),
                'status' => 1,
                'view_count' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $file->move(public_path() . '/apps/images/news', $file->getClientOriginalName());
        }

        $request->session()->flash('flash_message', 'Thêm tin mới thành công!');
        return redirect()->route('admins.manage.news.create');
    }
}
