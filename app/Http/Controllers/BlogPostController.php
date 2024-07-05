<?php

namespace App\Http\Controllers;

use App\Blogpost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    public function index()
       {
           $blogPosts = BlogPost::paginate(10);
           return response()->json($blogPosts);
       }

       public function show($id)
       {
           $blogPost = BlogPost::find($id);

           if (!$blogPost) {
               return response()->json(['error' => 'Blog post not found'], 404);
           }

           return response()->json($blogPost);
       }

       public function store(Request $request)
       {
           $validatedData = $request->validate([
               'title' => 'required|string|max:255',
               'content' => 'required|string',
           ]);

           $blogPost = Blogpost::create([
               'title' => $validatedData['title'],
               'content' => $validatedData['content'],
               'author_id' => Auth::id(),
           ]);

           return response()->json($blogPost, 201);
       }

       public function update(Request $request, $id)
       {
           $blogPost = BlogPost::find($id);

           if (!$blogPost) {
               return response()->json(['error' => 'Blog post not found'], 404);
           }

           $validatedData = $request->validate([
               'title' => 'sometimes|required|string|max:255',
               'content' => 'sometimes|required|string',
           ]);

           $blogPost->update($validatedData);

           return response()->json($blogPost);
       }

       public function destroy($id)
       {
           $blogPost = BlogPost::find($id);

           if (!$blogPost) {
               return response()->json(['error' => 'Blog post not found'], 404);
           }

           $blogPost->delete();

           return response()->json(['message' => 'Blog post deleted successfully']);
       }
}
