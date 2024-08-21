@extends('layouts.master')

@section('content')
    <style>
        .more-text {
            text-align: center !important;
            max-width: 250px !important;
            white-space: pre-line !important;

        }

        .custome-size {
            font-size: 100% !important;
        }
    </style>
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
                        <div class="row justify-content-between">
                            <div class="col-md-8">
                                <a href="{{ route('arsip-ppat.create') }}" class="btn btn-primary mt-4">Tambah Arsip</a>
                            </div>
                            <div class="col-md-4">
                                <form action="" class="mt-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Nomor Arsip / Nomor Akta"
                                            name="search" value="{{ request('search') }}">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- <div class="alert alert-info my-2">
                            <i class="feather icon-info"></i> <b>INFO</b> : &nbsp;Pengajuan dapat dibatalkan jika belom
                            dikonfirmasi, jika sudah dikonfirmasi, pengajuan dapat dibatalkan dengan menghubungi
                            <b>Admin</b>
                        </div> --}}
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nomor Arsip</th>
                                        <th>Nomor Akta</th>
                                        <th>Layanan Permohonan</th>
                                        <th>File</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($data as $item)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td>{{ $item->no_arsip }}</td>
                                            <td>{{ $item->no_akta }}</td>
                                            <td>

                                                {{ $item->nama_layanan }} |
                                                <div class="badge badge-info">
                                                    {{ $item->nama_jenis }}
                                                </div>
                                            </td>
                                            <td>
                                                <form action="{{ route('arsip-ppat.download') }}" method="POST">
                                                    @csrf <!-- Add this line to include a CSRF token -->
                                                    <input type="hidden" name="filename" value="{{ $item->file }}">
                                                    <button type="submit" class="btn btn-dark">
                                                        {{-- <img class="my-img"
                                                            src="{{ asset('assets/pdf-image-removebg-preview.png') }}"
                                                            alt="pdf-icon"> --}}
                                                        Download
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('ppat.show', $item->ppat_id) }}"
                                                    class="btn btn-secondary">
                                                    Detail
                                                </a>
                                                <a href="{{ route('ppat.cetak', $item->ppat_id) }}" target="_blank"
                                                    class="btn btn-light shadow-sm">Print</a>
                                                {{-- <a href="{{ route('ppat.edit', $item->id) }}"
                                                    class="btn btn-warning">Edit</a> --}}
                                                <form action="{{ route('arsip-ppat.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">hapus</button>
                                                </form>

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
