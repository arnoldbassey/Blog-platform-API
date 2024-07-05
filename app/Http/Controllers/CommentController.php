<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
       {
           $comments = Comment::paginate(10);
           return response()->json($comments);
       }

       public function show($id)
       {
           $comment = Comment::find($id);

           if (!$comment) {
               return response()->json(['error' => 'Comment not found'], 404);
           }

           return response()->json($comment);
       }

       public function store(Request $request)
       {
           $validatedData = $request->validate([
               'content' => 'required|string',
               'blogposts_id' => 'required|exists:blogposts,id',
           ]);

           $comment = Comment::create([
               'content' => $validatedData['content'],
               'blogposts_id' => $validatedData['blogposts_id'],
               'author_id' => Auth::id(),
           ]);

           return response()->json($comment, 201);
       }

       public function update(Request $request, $id)
       {
           $comment = Comment::find($id);

           if (!$comment) {
               return response()->json(['error' => 'Comment not found'], 404);
           }

           $validatedData = $request->validate([
               'content' => 'sometimes|required|string',
           ]);

           $comment->update($validatedData);

           return response()->json($comment);
       }

       public function destroy($id)
       {
           $comment = Comment::find($id);

           if (!$comment) {
               return response()->json(['error' => 'Comment not found'], 404);
           }

           $comment->delete();

           return response()->json(['message' => 'Comment deleted successfully']);
       }
}
