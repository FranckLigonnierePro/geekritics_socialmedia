<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Publication;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index(){
        $comments = Comment::all();
        return view('publications.commentDisplay',compact('comments'));
    }

    public function store(Request $request)
    {
        $comment = new Comment;

        $comment->content = $request->content;

        $comment->user()->associate($request->user());

        $post = Publication::find($request->id_publication);

        $post->comments()->save($comment);

        return back();
    }
}
