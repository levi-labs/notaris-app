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

                        <a href="{{ route('permohonan.create') }}" class="btn btn-primary mt-4">Buat Jenis Permohonan</a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Layanan Permohonan</th>
                                        <th>Deskripsi</th>
                                        <th>Option</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <style>
                                        .deskripsi {
                                            max-width: 250px !important;
                                            white-space: pre-line !important;
                                        }
                                    </style>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td class="deskripsi">{{ $item->deskripsi }}</td>
                                            <td>
                                                <a href="{{ route('permohonan.edit', $item->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <a href="{{ route('permohonan.destroy', $item->id) }}"
                                                    class="btn btn-danger"> Hapus</a>
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
