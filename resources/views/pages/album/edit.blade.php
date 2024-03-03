@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Upload Semua Momen Anda Disini</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('album.update', $album->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Judul Album</label>
                                    <input type="text" name="name" id="" class="form-control mb-3 @error('name') is-invalid @enderror" value="{{ old('name', $album->name) }}">
                                    <div class="invalid-feedback">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="">Deskripsi</label>
                                    <input type="text" name="description" id="" class="form-control mb-3 @error('description') is-invalid @enderror" value="{{ old('description', $album->description) }}">
                                    <div class="invalid-feedback">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill">Simpan Data</button>
                            <a href="{{ route('album.index') }}" class="btn btn-secondary rounded-pill"> Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection