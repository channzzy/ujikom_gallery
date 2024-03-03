<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function action($photo_id){
        $user = auth()->user();
        $like = $user->likes()->where('photo_id', $photo_id)->first();

        if ($like) {
            $like->delete();
        } else {
            $user->likes()->create(['photo_id' => $photo_id]);
        }

        return back();
    }
}
