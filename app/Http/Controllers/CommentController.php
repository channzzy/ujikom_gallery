<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($id){
        $photo = Photo::where('id' , $id)->first();
        $comments = Comment::where('photo_id', $id)->get();

        return view('pages.comment.index' ,compact('photo', 'comments'));
    }

    public function store(Request $request,$id){
        $request->validate([
            'description' => 'required|min:5|max:255',
        ],[
            'description.required' => 'Deskripsi harus diisi',
            'description.min' => 'Deskripsi harus :min karakter',
            'description.max' => 'Deskripsi harus :max karakter',
        ]);

        $comments = new Comment();
        $comments->user_id = Auth::user()->id;
        $comments->photo_id = $id;
        $comments->description = $request->description;
        $comments->save();

        return redirect()->route('comment.index', $id);
    }

    public function destroy($id,$photo_id){
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->route('comment.index', $photo_id);
    }

    public function update(Request $request,$id,$photo_id){
        $comment = Comment::find($id);
        $request->validate([
            'description' => 'required|min:5|max:255',
        ],[
            'description.required' => 'Deskripsi harus diisi',
            'description.min' => 'Deskripsi harus :min karakter',
            'description.max' => 'Deskripsi harus :max karakter',
        ]);
        
        $comment->description = $request->description;
        $comment->save();

        return redirect()->route('comment.index', $photo_id);
    }
}
