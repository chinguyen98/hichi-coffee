<?php

namespace App\Http\Controllers\Api;

use App\CoffeeComment;
use App\CoffeeCommentReply;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class CommentController extends Controller
{
    public function storeCoffeeRatingComment(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        $rating = $request->rating;
        $id_coffee = $request->id_coffee;
        $id_customer = Auth::user()->id;
        $images = $request->image;
        $now = now();

        $comments = CoffeeComment::where('id_customer', $id_customer)->where('id_coffee', $id_coffee)->get();

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
                        'id_customer' => $id_customer,
                        'id_coffee' => $id_coffee,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
                DB::table('coffee_comment_images')->insert($listImagesToDb);
            }
            return response()->json('OK');
        }

        /* Update Comment */


        CoffeeComment::where('id_customer', '=', $id_customer)->where('id_coffee', '=', $id_coffee)->update([
            'title' => $title,
            'content' => $content,
            'rating' => $rating,
            'status' => 1,
            'updated_at' => $now,
        ]);


        $listOldImage = DB::table('coffee_comment_images')->where('id_customer', '=', $id_customer)->where('id_coffee', '=', $id_coffee)->get();
        if (count($listOldImage) > 0) {
            foreach ($listOldImage as $image) {
                Storage::disk('comment_image')->delete($image->name);
            }
        }
        DB::table('coffee_comment_images')->where('id_customer', '=', $id_customer)->where('id_coffee', '=', $id_coffee)->delete();

        if ($images != null) {
            $listImagesToDb = [];
            foreach ($images as $image) {
                $imageName = 'commentImg_' . Uuid::generate() . '.jpeg';
                Storage::disk('comment_image')->put($imageName, file_get_contents($image));

                $listImagesToDb[] = [
                    'name' => $imageName,
                        'id_customer' => $id_customer,
                        'id_coffee' => $id_coffee,
                        'created_at' => $now,
                        'updated_at' => $now,
                ];
            }
            DB::table('coffee_comment_images')->insert($listImagesToDb);
        }

        return response()->json('OK');
    }

    public function storeReplyComment(Request $request)
    {
        $content = $request->content;
        $id_comment = $request->id_comment;
        $id_customer = Auth::user()->id;
        $now = now();

        DB::table('coffee_comment_replies')->insert([
            'content' => $content,
            'id_comment' => $id_comment,
            'id_customer' => $id_customer,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return response()->json('Bình luận thành công. Chúng tôi sẽ xem xét bình luận của bạn!');
    }

    public function getReplyComment(Request $request)
    {
        $offset = $request->query('offset');
        $id_comment = $request->query('id_comment');

        $replyComments = DB::table('coffee_comment_replies')
            ->join('customers', 'customers.id', '=', 'coffee_comment_replies.id_customer')
            ->where('coffee_comment_replies.id_comment', $id_comment)
            ->skip($offset)->take(6)
            ->orderByDesc('coffee_comment_replies.created_at')
            ->get(['customers.name', 'coffee_comment_replies.content']);

        return response()->json($replyComments);
    }

    function storeCommentLike(Request $request)
    {
        $id_coffee = $request->id_coffee;
        $id_customer = $request->id_customer;
        $id_customer_like = Auth::user()->id;
        $now = now();

        //return response()->json($id_coffee);

        DB::table('coffee_comment_likes')->insert([
            'id_customer' => $id_customer,
            'id_customer_like' => $id_customer_like,
            'id_coffee' => $id_coffee,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $count = DB::table('coffee_comment_likes')->where('id_coffee', $id_coffee)->where('id_customer', $id_customer)->count();

        return response()->json($count);
    }
}
