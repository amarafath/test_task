<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        /*
         * SELECT
	posts.id,
	description,
	( SELECT count( 'post_id' ) FROM comments WHERE post_id = posts.id ) AS comment_count
FROM
	posts
ORDER BY
	comment_count
         * */

        $posts = Post::with('comments:id,comment,post_id')
            ->withCount('comments')
            ->orderByDesc('comments_count')
            ->get();

        return response()->json(['data' => $posts]);
    }

    public function search(Request $request)
    {
//        $request->validate(['term' => 'required']);

        $term = $request->term;
        $posts = Post::with('comments:id,comment,post_id')
            ->withCount('comments')
            ->where(function ($query) use ($term) {
                $query->where('description', 'like', '%' . $term . '%')
                    ->orWhereHas('comments', function ($query) use ($term) {
                        $query->where('comment', 'like', '%' . $term . '%');
                    });
            })
            ->orderByDesc('comments_count')
            ->get();

        return response()->json(['data' => $posts]);
    }
}
