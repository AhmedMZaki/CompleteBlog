<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Comment;
use App\Post;
use App\User;
use App\Auth;


class CommentController extends Controller
{

    public function store(Request $request,$id)
    {
      $this->validate($request,[
        'body'=> 'required|min:1'
      ]);
      $post=Post::find($id);
      $comment=new Comment;
      $comment->user_id=auth()->user()->id;
      $comment->post_id=$post->id;
      $comment->body=$request['body'];
      $comment->save();
      return redirect("/posts/".$post->id);
    }

}
