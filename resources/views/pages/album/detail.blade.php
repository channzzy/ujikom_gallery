@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('album.index') }}" class="btn btn-secondary rounded-pill">Kembali</a>
        <div class="row">
            <div class="col-12 mt-3">
                <div class="container">
                    <h6>Koleksi Album {{ $album->name }}</h6>
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
                                <div class="card-footer bg white">
                                    <a href=""> {{ $item->likes->count() }} Like</a>
                                    <a href="">Lihat Komentar</a>
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