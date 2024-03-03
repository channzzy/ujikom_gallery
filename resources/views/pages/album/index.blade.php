@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('album.create') }}" class="btn btn-primary rounded-pill">Tambah Album</a>
                <table class="table table-stripped">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deksripsi</th>
                        <th>Tanggal Pembuatan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($albums as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->created_at->diffForHumans() }}</td>
                            <td class="d-flex align-items-center gap-2">
                                <a href="{{ route('album.detail', $item->id) }}" class="btn btn-warning rounded-pill">Lihat Koleksi</a>
                                <a href="{{ route('album.edit', $item->id) }}" class="btn btn-success rounded-pill">Edit</a>
                                <form action="{{ route('album.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-pill">Hapus</button>
                                </form>
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection