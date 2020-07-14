<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeCoffeeRatingComment(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        $rating = $request->rating;
        $id_coffee = $request->id_coffee;
        $id_customer = Auth::user()->id;
        $images = $request->image;

        foreach ($images as $image) {
            $imageName = 'commentImg_' . Uuid::generate() . '.jpeg';
            Storage::disk('comment_image')->put($imageName, file_get_contents($image));
        }

        return response()->json($images);
    }
}
