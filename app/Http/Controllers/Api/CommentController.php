<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function storeCoffeeRatingComment()
    {
        return response()->json('OK');
    }
}