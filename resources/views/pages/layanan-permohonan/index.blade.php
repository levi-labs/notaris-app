@extends('layouts.master')

@section('content')
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $title }}</h3>
                        @if (session()->has('success'))
                            <div class="alert alert-success mt-4">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger mt-4">
                                {{ session()->get('error') }}
                            </div>
                        @endif

                        <a href="{{ route('layanan.create') }}" class="btn btn-primary mt-4">Buat Pengajuan</a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Nama Layanan Permohonan</th>
                                        <th>Deskripsi</th>
                                        <th>Syarat & Ketentuan</th>
                                        <th>Option</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <style>
                                        .more-text {
                                            max-width: 250px !important;
                                            white-space: pre-line !important;
                                        }
                                    </style>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>

                                            <td class="more-text">
                                                {!! $item->deskripsi !!}
                                                <div class="badge badge-info">
                                                    {{ $item->jenisPermohonan->nama }}
                                                </div>
                                            </td>
                                            <td class="more-text">
                                                {!! $item->syarat_ketentuan !!}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('layanan.edit', $item->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <a href="{{ route('layanan.destroy', $item->id) }}" class="btn btn-danger">
                                                    Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
