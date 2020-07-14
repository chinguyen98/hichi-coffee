<?php

namespace App\Http\Controllers\Api;

use App\CoffeeComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $now = now();

        $comments = CoffeeComment::where('id_customer', $id_customer)->get();

        if (count($comments) == 0) {
            $id_coffee_comments = DB::table('coffee_comments')->insertGetId([
                'title' => $title,
                'content' => $content,
                'rating' => $rating,
                'status' => 1,
                'id_coffee' => $id_coffee,
                'id_customer' => $id_customer,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            if ($images != null) {
                $listImagesToDb = [];
                foreach ($images as $image) {
                    $imageName = 'commentImg_' . Uuid::generate() . '.jpeg';
                    Storage::disk('comment_image')->put($imageName, file_get_contents($image));

                    $listImagesToDb[] = [
                        'name' => $imageName,
                        'id_comment' => $id_coffee_comments,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
                DB::table('coffee_comment_images')->insert($listImagesToDb);
            }
            return response()->json('OK');
        }

        /* Update Comment */

        $coffee_comment = CoffeeComment::where('id_customer', $id_customer)->first();
        $coffee_comment->title = $title;
        $coffee_comment->content = $content;
        $coffee_comment->rating = $rating;
        $coffee_comment->status = 1;
        $coffee_comment->updated_at = $now;
        $coffee_comment->save();


        $listOldImage = DB::table('coffee_comment_images')->where('id_comment', $coffee_comment->id)->get();
        if (count($listOldImage) > 0) {
            foreach ($listOldImage as $image) {
                Storage::disk('comment_image')->delete($image->name);
            }
        }
        DB::table('coffee_comment_images')->where('id_comment', $coffee_comment->id)->delete();

        if ($images != null) {
            $listImagesToDb = [];
            foreach ($images as $image) {
                $imageName = 'commentImg_' . Uuid::generate() . '.jpeg';
                Storage::disk('comment_image')->put($imageName, file_get_contents($image));

                $listImagesToDb[] = [
                    'name' => $imageName,
                    'id_comment' => $coffee_comment->id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            DB::table('coffee_comment_images')->insert($listImagesToDb);
        }

        return response()->json('OK');
    }
}
