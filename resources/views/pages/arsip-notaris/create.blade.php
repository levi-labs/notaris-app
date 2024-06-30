@extends('layouts.master')
@section('content')
    <div class="pcoded-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif

                    </div>

                    <div class="card-body">
                        @if (isset($notaris_id) && isset($layanan_permohonan_id))
                            <a class="btn btn-secondary" href="{{ route('notaris.show', $notaris->id) }}">Kembali</a>
                        @else
                            <a class="btn btn-secondary" href="{{ route('arsip-notaris.index') }}">Kembali</a>
                        @endif
                        {{-- <h5>Form controls</h5> --}}
                        <div class="row justify-content-center">

                            <div class="col-md-6">
                                <form action="{{ route('arsip-notaris.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($notaris_id) && isset($layanan_permohonan_id))
                                        <input type="hidden" name="notaris_id" value="{{ $notaris->id }}">
                                        <input type="hidden" name="layanan_permohonan_id"
                                            value="{{ $notaris->layanan_permohonan_id }}">
                                    @else
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Daftar Pengajuan Notaris </label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="notaris_id">
                                                <option selected disabled>Pilih Pengajuan Notaris yang dituju</option>
                                                @foreach ($notaris as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nomor_pengajuan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif



                                    <div class="form-group">
                                        <label>Nomor Akta</label>
                                        <input placeholder="" class="form-control" text="text" name="no_akta">
                                        @error('no_akta')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <span class="text-dark">File Salinan Akta * (JPG,JPEG,PNG)</span>
                                        <div class="custom-file my-2">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                                                name="file">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            @error('file')
                                                <p class="text-danger"> {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                </form>
                            </div>
                        </div>
                        {{-- <h5 class="mt-5">Sizing</h5> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
