@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('/') }}" class="btn btn-secondary rounded-pill">Kembali</a>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <img src="{{ Storage::url($photo->path) }}" alt="" class="card-img-top rounded-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p class="fw-bold">{{ $photo->title }}</p>
                                <p>
                                    "{{ $photo->description }}"
                                </p>
                            </div>
                            <form action="{{ route('comment.store', $photo->id) }}" method="post">
                                @csrf
                                <div class="col-12">
                                    <label for="">Apa Komentar Anda?</label>
                                    <textarea name="description" id="" cols="5" rows="5" class="form-control mb-3 @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    <div class="invalid-feedback">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill">Kirim Komentar</button>
                            </form>
                        </div>
                        <div class="comment-section">
                            <h6 class="mt-3">
                                Semua Komentar ({{ $comments->count() }})
                            </h6>
                            @foreach ($comments as $item)
                                <div class="card mb-2">
                                    <div class="card-body d-flex justify-content-between align-items-start">
                                        <div>
                                            <p class="pt-3 fw-medium">{{ $item->user->name }} ({{ $item->created_at->diffForHumans() }})</p>
                                            <p>"{{ $item->description }}"</p>
                                        </div>
                                        @if ($item->user_id == Auth::user()->id)    
                                        <div>
                                            <div class="dropdown">
                                                <button class="btn btn-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <li>
                                                    <form action="{{ route('comment.destroy', ['photo_id' => $photo->id , 'id' => $item->id]) }}" method="post" onsubmit="return confirm('Apakah Anda Yakin?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-white text-danger">Hapus</button>
                                                    </form>
                                                    </li>
                                                  <li>
                                                    <a href="" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit<?= $item['id']?>">Edit</a>
                                                </li>
                                                </ul>
                                              </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal fade" id="edit<?= $item['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="{{ route('comment.update', ['photo_id' => $photo->id, 'id' => $item->id]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                              <label for="">Komentar Anda</label>
                                              <textarea name="description" id="" cols="5" rows="5" class="form-control mb-3 @error('description') is-invalid @enderror">{{ old('description', $item->description) }}</textarea>
                                              <div class="invalid-feedback">
                                                  @error('description')
                                                      {{ $message }}
                                                  @enderror
                                              </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary rounded-pill">Edit Komentar</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection