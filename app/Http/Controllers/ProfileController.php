<?php

namespace App\Http\Controllers;

use App\Models\AlbumPhoto;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index(){
        $photos = Photo::where('user_id', Auth::user()->id)->latest()->get();

        return view('pages.profile.index', compact('photos'));
    }

    public function destroy($id){
        $photo = Photo::find($id);
        $photo->delete();

        return redirect()->route('profile.index');
    }

    public function edit($id){
        $photo = Photo::find($id);
        $albums = AlbumPhoto::where('user_id', Auth::user()->id)->get();

        return view('pages.profile.edit', compact('photo', 'albums'));
    }

    public function update(Request $request, $id){
        $photo = Photo::find($id);

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

        $photo->album_photo_id = $request->album_photo_id;
        $photo->title = $request->title;
        $photo->description = $request->description;

        $file = $request->file('path');
        $fileName = Str::random(20) . $file->getClientOriginalExtension();
        $file->storeAs('public/photos', $fileName);

        $photo->path = 'photos/' . $fileName;
        $photo->save();

        return redirect()->route('profile.index');
    }
}
