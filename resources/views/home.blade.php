@extends('layouts.app')

@section('content')
    <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        <div class="row">
            @auth
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6>Upload Semua Momen Anda Disini</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('home.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Judul Foto</label>
                                    <input type="text" name="title" id="" class="form-control mb-3 @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                    <div class="invalid-feedback">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="">Deskripsi</label>
                                    <input type="text" name="description" id="" class="form-control mb-3 @error('description') is-invalid @enderror" value="{{ old('description') }}">
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
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                            <button type="submit" class="btn btn-primary rounded-pill">Unggah Postingan</button>
                        </form>
                    </div>
                </div>
            </div>
            @endauth
            <div class="col-12 mt-3">
                <div class="container">
                    <h6>Foto Terbaru</h6>
                    <div class="row">
                        @foreach ($photos as $item)
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <p>{{ $item->user->name }} <span>({{ $item->created_at->diffForHumans() }})</span></p>
                                </div>
                                <img src="{{ Storage::url($item->path) }}" alt="" class="card-img-top rounded-0 object-fit-cover" height="350px">
                                <div class="card-body">
                                    <p class="fw-bold"> {{ $item->title }}</p>
                                    {{ $item->description }}
                                </div>
                                @auth    
                                @php
                                    $userLiked = $item->likes->contains('user_id',auth()->user()->id);
                                @endphp
                                @endauth
                                <div class="card-footer d-flex gap-2 align-items-center">
                                    <form action="{{ route('like.action', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn text-decoration-none text-black">
                                            @auth    
                                            @if($userLiked)
                                                <span class="text-danger">Unlike</span>
                                            @else
                                                <span class="text-primary">Like</span>
                                            @endif
                                            @endauth
                                            {{ $item->likes->count() }} Likes
                                        </button>
                                    </form>
                                    <a href="{{ route('comment.index',$item->id) }}" class=" text-decoration-none text-black"><i class="fa-regular fa-comment"></i> Beri Komentar</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection