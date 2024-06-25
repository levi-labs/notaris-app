@extends('layouts.master')

@section('content')
    <style>
        .more-text {
            max-width: 250px !important;
            white-space: pre-line !important;
        }
    </style>
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $title }}</h3>
                        <a href="{{ route('ppat.layanan') }}" class="btn btn-primary mt-4">Buat Pengajuan</a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Layanan Permohonan</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($data as $item)
                                        <tr>
                                            <td></td>
                                            <td>{{ $item->user->nama }}</td>
                                            <td class="more-text">
                                                {{ $item->layanan->nama }}
                                                <div class="badge badge-info">
                                                    {{ $item->layanan->jenisPermohonan->nama }}
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('ppat.show', $item->id) }}" class="btn btn-secondary">
                                                    Detail
                                                </a>
                                                <a href="{{ route('ppat.edit', $item->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="{{ route('ppat.destroy', $item->id) }}"
                                                    class="btn btn-danger">Hapus</a>
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
