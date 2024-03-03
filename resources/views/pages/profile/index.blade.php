@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @auth
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                                <div class="col-md-12 text-center">
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=528AC8" alt="" style="width: 250px; height: 250px;border: 2px solid var(--primary-color); border-radius: 50%;">
                                    <h5 class="mt-2">{{ Auth::user()->name }}({{ Auth::user()->username }})</h5>
                                    <p>Alamat: {{ Auth::user()->address }}</p>
                                    <p>Email: {{ Auth::user()->email }}</p>
                                    <p>Bergabung pada: {{ Auth::user()->created_at->format('d-m-Y') }}</p>
                                </div>
                            </div>
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
                                <div class="card-header d-flex justify-content-between align-items-start">
                                    <p>{{ $item->user->name }} <span>({{ $item->created_at->diffForHumans() }})</span></p>
                                    <div class="dropdown">
                                        <button class="btn btn-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li>
                                            <form action="{{ route('profile.destroy', $item->id) }}" method="post" onsubmit="return confirm('Apakah Anda Yakin?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-white text-danger">Hapus</button>
                                            </form>
                                            </li>
                                          <li>
                                            <a href="{{ route('profile.edit', $item->id) }}" class="dropdown-item">Edit</a>
                                        </li>
                                        </ul>
                                      </div>
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
                                    {{ $item->likes->count() }} Likes
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