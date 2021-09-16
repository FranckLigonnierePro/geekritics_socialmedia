<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function store(Request $request) {
        $newComment = new Comment;
        $newComment->content = $request->content;
        $newComment->user_id = Auth::user()->id;
        $newComment->publication_id = $request->publication_id;
        $newComment->save();
        return back();
                       
    }

}
