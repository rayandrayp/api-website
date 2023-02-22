@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>List Dokter</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Dokter</a></div>
            <div class="breadcrumb-item">List Dokter</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Dokter</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Dokter</th>
                                    <th>Spesialis</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($list_dokter as $dokter)
                                <tr>
                                    <td>{{ $dokter->kd_dokter }}</td>
                                    <td>{{ $dokter->nm_dokter }}</td>
                                    <td>{{ $dokter->spesialis->nm_sps }}</td>
                                    <td>
                                        @if ($dokter->status == 1)
                                        <div class="badge badge-success">Active</div>
                                        @else
                                        <div class="badge badge-danger">Non Active</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('dokter.edit', $dokter->kd_dokter) }}"
                                            class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="{{ $list_dokter->previousPageUrl() }}">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $list_dokter->lastPage(); $i++)
                                    <li class="page-item {{ ($list_dokter->currentPage() == $i) ? ' active' : '' }}">
                                        <a class="page-link" href="{{ $list_dokter->url($i) }}">{{ $i }}</a>
                                    </li>
                                    @endfor
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $list_dokter->nextPageUrl() }}">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('js/page/features-post-create.js') }}"></script>
<script src="{{ asset('modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

@endsection