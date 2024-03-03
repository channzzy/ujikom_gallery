@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @auth
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6>Upload Semua Momen Anda Disini</h6>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Judul Foto</label>
                                    <input type="text" name="title" id="" class="form-control mb-3">
                                </div>
                                <div class="col-12">
                                    <label for="">Deskripsi</label>
                                    <input type="text" name="description" id="" class="form-control mb-3">
                                </div>
                                <div class="col-12">
                                    <label for="">Album</label>
                                    <select name="" id="" class="form-control mb-3">
                                        <option selected disabled>Pilih Album</option>
                                        <option selected disabled>Pilih Album</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="">Pilih Foto</label>
                                    <input type="file" name="path" id="" class="form-control mb-3">
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
                        <div class="col-4">
                            <div class="card">
                                <img src="" alt="" class="card-img-top rounded-none">
                                <div class="card-header">
                                    Test
                                </div>
                                <div class="card-body">
                                    Oke aja biy
                                </div>
                                <div class="card-footer bg white">
                                    mang ea
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection