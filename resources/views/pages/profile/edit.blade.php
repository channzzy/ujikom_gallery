@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('profile.index') }}" class="btn btn-secondary rounded-pill">Kembali</a>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.update', $photo->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Judul Foto</label>
                                    <input type="text" name="title" id="" class="form-control mb-3 @error('title') is-invalid @enderror" value="{{ old('title', $photo->title) }}">
                                    <div class="invalid-feedback">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="">Deskripsi</label>
                                    <input type="text" name="description" id="" class="form-control mb-3 @error('description') is-invalid @enderror" value="{{ old('description', $photo->description) }}">
                                    <div class="invalid-feedback">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="">Album</label>
                                    <select name="album_photo_id" id="" class="form-control mb-3 @error('album_photo_id') is-invalid @enderror">
                                        <option selected disabled>Pilih Album</option>
                                        @foreach ($albums as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $photo->album_photo_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('album_photo_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="">Pilih Foto</label>
                                    <input type="file" name="path" id="" class="form-control mb-3 @error('path') is-invalid @enderror">
                                    <div class="invalid-feedback">
                                        @error('path')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill">Edit Postingan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection