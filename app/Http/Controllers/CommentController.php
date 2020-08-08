<?php

namespace App\Http\Controllers;

use App\CoffeeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = CoffeeComment::where('id_customer', Auth::user()->id)->get();

        return view('customers.comments.index')->with([
            'title' => 'Đánh giá của tôi',
            'comments' => $comments,
        ]);
    }
}
