@extends('layouts.master')
@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard</h5>
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- table card-1 start -->
            <div class="col-md-6">
                <!-- widget primary card start -->
                <div class="card flat-card widget-info-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-briefcase"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{ $data }}</h4>
                            <h6>Pengajuan PPAT</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-eye text-c-green mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{ $data_1 }}</h5>
                                    <span>Pengajuan</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-thumbs-up text-c-red mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{ $data_2 }}</h5>
                                    <span>Terkonfirmasi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-file-text text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{ $data_3 }}</h5>
                                    <span>Terverifikasi</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-check-square text-c-yellow mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{ $data_4 }}</h5>
                                    <span>Terselesaikan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- table card-1 end -->
            <!-- table card-2 start -->
            <div class="col-md-6 ">
                <div class="card flat-card widget-info-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-briefcase"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>4000 +</h4>
                            <h6>Pengajuan Notaris</h6>
                        </div>
                    </div>
                </div>
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-eye text-c-green mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{ $data_1 }}</h5>
                                    <span>Pengajuan</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-thumbs-up text-c-red mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{ $data_2 }}</h5>
                                    <span>Terkonfirmasi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-file-text text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{ $data_3 }}</h5>
                                    <span>Terverifikasi</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-check-square text-c-yellow mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{ $data_4 }}</h5>
                                    <span>Terselesaikan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- widget primary card start -->

                <!-- widget primary card end -->
            </div>
            <!-- table card-2 end -->
            <!-- Widget primary-success card start -->

            <!-- Widget primary-success card end -->

            <!-- prject ,team member start -->
            <div class="col-xl-6 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Daftar Pengajuan PPAT</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i
                                                    class="feather icon-maximize"></i> maximize</span><span
                                                style="display:none"><i class="feather icon-minimize"></i>
                                                Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                                    class="feather icon-minus"></i> collapse</span><span
                                                style="display:none"><i class="feather icon-plus"></i>
                                                expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i
                                                class="feather icon-refresh-cw"></i> reload</a></li>
                                    {{-- <li class="dropdown-item close-card"><a href="#!"><i
                                                class="feather icon-trash"></i> remove</a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="chk-option">
                                                <label
                                                    class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                            Assigned
                                        </th>
                                        <th>Name</th>
                                        <th>Due Date</th>
                                        <th class="text-right">Priority</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftar_ppat as $ppat)
                                        <tr>
                                            <td>
                                                {{ $ppat->nomor_pengajuan }}
                                            </td>
                                            <td>{{ $ppat->layanan->nama }}</td>
                                            <td>{{ $ppat->created_at->format('d M Y') }}</td>
                                            <td class="text-right"><label
                                                    class="badge badge-light-danger">{{ $ppat->status_layanan }}</label>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Daftar Pengajuan Notaris</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i
                                                    class="feather icon-maximize"></i> maximize</span><span
                                                style="display:none"><i class="feather icon-minimize"></i>
                                                Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                                    class="feather icon-minus"></i> collapse</span><span
                                                style="display:none"><i class="feather icon-plus"></i>
                                                expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i
                                                class="feather icon-refresh-cw"></i> reload</a></li>
                                    {{-- <li class="dropdown-item close-card"><a href="#!"><i
                                                class="feather icon-trash"></i> remove</a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="chk-option">
                                                <label
                                                    class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                            Assigned
                                        </th>
                                        <th>Name</th>
                                        <th>Due Date</th>
                                        <th class="text-right">Priority</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftar_ppat as $ppat)
                                        <tr>
                                            <td>
                                                {{ $ppat->nomor_pengajuan }}
                                            </td>
                                            <td>{{ $ppat->layanan->nama }}</td>
                                            <td>{{ $ppat->created_at->format('d M Y') }}</td>
                                            <td class="text-right"><label
                                                    class="badge badge-light-danger">{{ $ppat->status_layanan }}</label>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- prject ,team member start -->


        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection
