<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\User;

class Post extends Model
{
  protected $fillable = ['title', 'body','user_id'];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function comments(){
    return $this->hasMany(Comment::class);
  }


}
