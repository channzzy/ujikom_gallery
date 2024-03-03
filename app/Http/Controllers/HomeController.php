<?php

namespace App\Http\Controllers;

use App\Models\AlbumPhoto;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $albums = [];
        if (Auth::user()) {
            $albums = AlbumPhoto::where('user_id', Auth::user()->id)->latest()->get();
        }
        $photos = Photo::latest()->get();
        return view('home',compact('photos','albums'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
            'album_photo_id' => 'required',
            'path' => 'required|mimes:jpg,jpeg,png|max:3248',
        ],[
            'title.required' => 'Judul harus diisi',
            'title.min' => 'Judul harus :min karakter',
            'title.max' => 'Judul harus :max karakter',
            'description.required' => 'Deskripsi harus diisi',
            'description.min' => 'Deskripsi harus :min karakter',
            'description.max' => 'Deskripsi harus :max karakter',
            'album_photo_id.required' => 'Album harus diisi',
            'path.required' => 'Foto harus dipilih',
            'path.mimes' => 'Foto harus berupa JPG,JPEG,PNG',
            'path.max' => 'Foto harus berukuran 3MB',
        ]);

        $photos = new Photo();
        $photos->user_id = Auth::user()->id;

        $photos->album_photo_id = $request->album_photo_id;
        $photos->title = $request->title;
        $photos->description = $request->description;

        $file = $request->file('path');
        $fileName = Str::random(20) . $file->getClientOriginalExtension();
        $file->storeAs('public/photos', $fileName);

        $photos->path = 'photos/' . $fileName;
        $photos->save();

        return redirect()->route('/')->with('success', 'Postingan berhasil dibuat');
    }
}
