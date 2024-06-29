@extends('layouts.master')
@section('content')
    <div class="pcoded-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>


                    </div>

                    <div class="card-body">
                        <a class="btn btn-secondary" href="{{ route('ppat.show', $ppat->id) }}">Kembali</a>
                        {{-- <h5>Form controls</h5> --}}
                        <div class="row justify-content-center">

                            <div class="col-md-6">
                                <form action="{{ route('arsip-ppat.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="ppat_id" value="{{ $ppat->id }}">
                                    <input type="hidden" name="layanan_permohonan_id"
                                        value="{{ $ppat->layanan_permohonan_id }}">
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
    <script></script>
@endsection
