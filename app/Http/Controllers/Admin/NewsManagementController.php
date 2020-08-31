<?php

namespace App\Http\Controllers\Admin;

use App\News;
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
        $news = News::orderByDesc('created_at')->get();
        return view('admins.newsManagement.index')->with([
            'title' => 'DANH SÁCH TIN',
            'listnews' => $news,
        ]);
    }

    public function create()
    {
        return view('admins.newsManagement.create')->with([
            'title' => 'THÊM TIN MỚI',
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

        $request->session()->flash('flash_message', 'Thêm Tin Mới Thành Công!');
        return redirect()->route('admins.manage.news.create');
    }
    public function renderNewUpdate($id)
    {
        $lstNew = DB::table('news')->where('id', $id)->first();
        return view('admins/newsManagement/update')->with([
            'title' => 'CẬP NHẬT TIN TỨC',
            'new' => $lstNew,
        ]);;
    }

    public function update(Request $request, $id)
    {
        $newSlug = new Slug();

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:10000',
            'description' => 'required|max:255',
    
        ], [
            'required' => ':attribute Không được để trống',
            'max' => ':attribute Không được lớn hơn :max',
        ], [
            'title' => 'Tiêu Đề Tin',
            'content' => 'Nội Dung Tin',
            'description' => 'Miêu Tả',
        ]);

        $news_update = $request->all();
        DB::table('news')->where('id', $id)->update([
            'title' => $news_update["title"],
            'content' => $news_update["content"],
            'description' => $news_update["description"],
            'status' => $news_update["status"],
            'slug' => $newSlug->createSlug($news_update["title"]),
            'updated_at' => now()
        ]);

        if ($request->hasFile("image")) {
            $file = $request->image;
            $oldFilePath = public_path() . '/apps/images/news/' . $news_update["oldImage"];
            File::delete($oldFilePath);
            DB::table('news')->where('id', $id)->update([
                'image' => $file->getClientOriginalName()
            ]);
            $file->move(public_path() . '/apps/images/news', $file->getClientOriginalName());
        }

        $request->session()->flash('flash_message', 'Cập Nhật Tin Tức Thành Công!');

        return redirect()->route('admins.manage.news.index', ['id' => $id]);
    }
}
