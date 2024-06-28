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

                        <a href="{{ route('user.create') }}" class="btn btn-primary mt-4">Tambah</a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Type</th>
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
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->type_user }}</td>
                                            <td>
                                                <a href="{{ route('user.reset-password', $item->id) }}"
                                                    class="btn btn-info">Reset Password</a></a>
                                                <a href="{{ route('user.edit', $item->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="{{ route('user.destroy', $item->id) }}" class="btn btn-danger">
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
