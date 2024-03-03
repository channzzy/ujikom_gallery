<?php

namespace App\Http\Controllers;

use App\Models\AlbumPhoto;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumPhotoController extends Controller
{
    public function index(){
        $albums = AlbumPhoto::where('user_id', Auth::user()->id)->latest()->get();
        return view('pages.album.index', compact('albums'));
    }

    public function create(){
        return view('pages.album.create',);
    }

    public function edit($id){
        $album = AlbumPhoto::find($id);
        return view('pages.album.edit', compact('album'));
    }

    public function detail($id){
        $album = AlbumPhoto::find($id);
        $photos = Photo::where('album_photo_id', $id)->latest()->get();
        return view('pages.album.detail', compact('album', 'photos'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
        ],[
            'name.required' => 'Judul harus diisi',
            'name.min' => 'Judul harus :min karakter',
            'name.max' => 'Judul harus :max karakter',
            'description.required' => 'Deskripsi harus diisi',
            'description.min' => 'Deskripsi harus :min karakter',
            'description.max' => 'Deskripsi harus :max karakter',
        ]);

        $albumPhotos = new AlbumPhoto();
        $albumPhotos->user_id = Auth::user()->id;
        $albumPhotos->name = $request->name;
        $albumPhotos->description = $request->description;
        $albumPhotos->save();

        return redirect()->route('album.index');
    }

    public function update(Request $request, $id){
        $album = AlbumPhoto::find($id);

        $request->validate([
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
        ],[
            'name.required' => 'Judul harus diisi',
            'name.min' => 'Judul harus :min karakter',
            'name.max' => 'Judul harus :max karakter',
            'description.required' => 'Deskripsi harus diisi',
            'description.min' => 'Deskripsi harus :min karakter',
            'description.max' => 'Deskripsi harus :max karakter',
        ]);

        $album->name = $request->name;
        $album->description = $request->description;
        $album->save();

        return redirect()->route('album.index');
    }

    public function destroy($id){
        $album = AlbumPhoto::find($id);
        $album->delete();

        return redirect()->route('album.index');
    }
}
