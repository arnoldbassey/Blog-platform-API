<?php

namespace App;

#use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
       protected $fillable = ['content', 'blogposts_id', 'author_id', 'created_at', 'updated_at'];

       public function author()
       {
           return $this->belongsTo(User::class);
       }

       public function blogPost()
       {
           return $this->belongsTo(Blogpost::class);
       }
}
