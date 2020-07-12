<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
        $listOfNews = News::where('status', 1)->get(['title', 'image', 'description', 'slug']);

        return view('customers.news.index')->with([
            'title' => 'Tin tức',
            'newsActive' => 'active',
            'listOfNews' => $listOfNews,
        ]);
    }

    public function show($slug)
    {
        $news = DB::table('news')->where('slug', $slug)->first(['slug', 'image', 'title', 'description', 'content']);

        return view('customers.news.detail')->with([
            'title' => $news->title,
            'newsActive' => 'active',
            'news' => $news,
        ]);
    }
}
