<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Post;
use App\User;
use App\Auth;

class PostsController extends Controller
{
  private $fileNmaeToStore=null;
  public function __construct()
  {
      $this->middleware('auth',['except'=>['index','show']]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
      //  $posts=Post::orderBy('title','desc')->paginate(1);
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validate data
      $this->validate($request,[
        'title'=> 'required|min:2',
        'body'=> 'required|min:2',
        'cover_image'=>'image|nullable|max:1999'
      ]);
      // handle file upload
      if ($request->hasFile('cover_image')) {
        // get the file name with extention
        $covernamewithEXT=$request->file('cover_image')->getClientOriginalName();
        // get just the file name
        $filename=pathinfo($covernamewithEXT,PATHINFO_FILENAME);
        // get just the extention
        $extention=$request->file('cover_image')->getClientOriginalExtension();
        // file to store
        $fileNmaeToStore=$filename.'_'.time().'.'.$extention;
        // upload image
        $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNmaeToStore);
      } else {
        $fileNmaeToStore='noimage.jpg';
      }
      // create post
      $post=new Post;
      $post->title=$request['title'];
      $post->body=$request['body'];
      $post->user_id=auth()->user()->id;
      $post->cover_image=$fileNmaeToStore;
      $post->save();
      return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post=Post::find($id);
      if(auth()->user()->id !== $post->user->id){
        return redirect('/posts');
      } else{
      return view('posts.edit',compact('post'));
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'title'=> 'required|min:2',
        'body'=> 'required|min:2'
        // ,'cover_image'=>'image|nullable|max:1999'
      ]);

      // handle file upload
      if ($request->hasFile('cover_image')) {
        // get the file with extention
        $covernamewithEXT=$request->file('cover_image')->getClientOriginalName();
        // get just the file name
        $filename=pathinfo($covernamewithEXT,PATHINFO_FILENAME);
        // get just the extention
        $extention=$request->file('cover_image')->getClientOriginalExtension();
        // file to store
        $fileNmaeToStore=$filename.'_'.time().'.'.$extention;
        // upload image
        $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNmaeToStore);
      }

      $post=Post::find($id);
      $post->user_id=auth()->user()->id;
      $post->title=$request['title'];
      $post->body=$request['body'];
      if ($request->hasFile('cover_image')) {
      $post->cover_image=$fileNmaeToStore;
    }
      $post->save();
      return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        if(auth()->user()->id !== $post->user->id){
          return redirect('/posts');
        }
        if($post->cover_image != 'noimage.jpg'){
            Storage::delete('/public/cover_images/'.$post->cover_image);
          }
          $post->delete();
          return redirect('/posts');

  }



}
