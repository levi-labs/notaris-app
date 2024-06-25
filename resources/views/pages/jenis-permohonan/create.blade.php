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
                        {{-- <h5>Form controls</h5> --}}


                        <div class="row justify-content-center">

                            <div class="col-md-6">
                                <form action="{{ route('permohonan.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama Layanan Permohonan</label>
                                        <input placeholder="" class="form-control" text="text" name="nama">
                                        @error('nama')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Deskripsi</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="deskripsi"></textarea>
                                        @error('deskripsi')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
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
