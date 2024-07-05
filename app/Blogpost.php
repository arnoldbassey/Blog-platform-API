<?php

namespace App;

#use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogpost extends Model
{
       protected $fillable = ['title', 'content', 'author_id', 'created_at', 'updated_at'];

       public function author()
       {
           return $this->belongsTo(User::class, 'author_id');
       }
}
