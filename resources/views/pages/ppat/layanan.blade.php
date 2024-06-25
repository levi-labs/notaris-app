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
                                <form action="{{ route('ppat.create') }}" method="GET">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Jenis Permohonan</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="layanan_select">
                                            <option selected disabled>Pilih Jenis Layanan Permohonan</option>
                                            @foreach ($data as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
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
