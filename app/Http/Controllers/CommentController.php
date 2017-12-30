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

    public function store(Request $request)
    {
      $this->validate($request,[
        'body'=> 'required|min:1'
      ]);
      $dd=Post::post_id();
      dd($dd);
      $comment=new Comment;
      $comment->user_id=auth()->user()->id;
      $comment->post_id=
      $comment->body=$request['body'];
      $comment->save();
      return redirect('/posts');
    }

}
