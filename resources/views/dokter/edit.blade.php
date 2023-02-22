@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Update data dokter</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dokter</a></div>
            <div class="breadcrumb-item">Update data dokter</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update data dokter</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIP Dokter</label>
                            <div class="col-sm-12 col-md-7">
                                <!-- <input type="text" class="form-control" name="kd_dokter"> -->
                                <!-- fill input with kd_dokter -->
                                <input type="text" class="form-control" name="kd_dokter"
                                    value="{{ $dokter->kd_dokter }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Dokter</label>
                            <div class="col-sm-12 col-md-7">
                                <!-- <input type="text" class="form-control" name="nm_dokter"> -->
                                <!-- fill input with nm_dokter -->
                                <input type="text" class="form-control" name="nm_dokter"
                                    value="{{ $dokter->nm_dokter }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Spesialis</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric" name="kd_sps">
                                    @foreach ($list_spesialis as $spesialis)
                                    <!-- <option value="{{ $spesialis->kd_sps }}">( {{ $spesialis->kd_sps }} ) -
                                        {{ $spesialis->nm_sps }}</option> -->
                                    <!-- select selected option -->
                                    <option value="{{ $spesialis->kd_sps }}"
                                        {{ $spesialis->kd_sps == $dokter->kd_sps ? 'selected' : '' }}>(
                                        {{ $spesialis->kd_sps }} ) - {{ $spesialis->nm_sps }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Pilih File</label>
                                    <input type="file" name="image" id="image-upload" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary">Update Dokter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" id="card-minat-klinis">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Kondisi & Minat Klinis</h4>
                        <button class="btn btn-primary" id="btn-add-minat-klinis">Tambah Minat Klinis</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Kondisi</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-minat-klinis">
                                    @foreach ($dokter->minat_klinis as $minat_klinis)
                                    <tr id="minat-klinis-{{ $minat_klinis->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $minat_klinis->minat }}</td>
                                        <td class="d-flex">
                                            <button class="btn btn-warning btn-edit-minat-klinis mr-4"
                                                data-id="{{ $minat_klinis->id }}"
                                                data-minat="{{ $minat_klinis->minat }}">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </button>
                                            <!-- append token to button -->

                                            <button class="btn btn-danger btn-delete-minat-klinis"
                                                data-id="{{ $minat_klinis->id }}"
                                                data-minat="{{ $minat_klinis->minat }}" data-token="{{ csrf_token() }}">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card" id="card-prestasi-dokter">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Prestasi, Penghargaan, & Kehormatan</h4>
                        <button class="btn btn-primary" id="btn-add-prestasi-dokter">Tambah Prestasi</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Tahun</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Kids Choice Award</td>
                                        <td>2019</td>
                                        <td class="d-flex">
                                            <a href="#" class="btn btn-warning mr-4">
                                                <!-- edit icon -->
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                            <a href="#" class="btn btn-danger">
                                                <!-- delete icon -->
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card" id="card-pendidikan-dokter">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Pendidikan</h4>
                        <button class="btn btn-primary" id="btn-add-pendidikan-dokter">Tambah Pendidikan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Pendidikan</th>
                                        <th>Perguruan Tinggi</th>
                                        <th>Tahun</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Dokter Umum</td>
                                        <td>Politeknik Negeri Malang</td>
                                        <td>2019</td>
                                        <td class="d-flex">
                                            <a href="#" class="btn btn-warning mr-4">
                                                <!-- edit icon -->
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                            <a href="#" class="btn btn-danger">
                                                <!-- delete icon -->
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL kondisi & minat klinis -->
<div class="modal fade" id="modal-minat-klinis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kondisi & Minat Klinis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-minat-klinis">
                    @csrf
                    <input type="hidden" class="form-control" name="kd_dokter" value="{{ $dokter->kd_dokter }}">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="minat" class="col-form-label">Minat Klinis</label>
                            <input type="text" class="form-control" id="minat" name="minat">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="close-program-subsidiary">Close</button>
                <button type="button" class="btn btn-primary" id="add-minat-klinis">+ Tambah Data</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL kondisi & minat klinis -->

<!-- MODAL prestasi dokter -->
<div class="modal fade" id="modal-prestasi-dokter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi, Penghargaan, & Kehormatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-prestasi-dokter">
                    @csrf
                    <input type="hidden" class="form-control" name="kd_dokter" value="{{ $dokter->kd_dokter }}">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="minat" class="col-form-label">Prestasi, Penghargaan, & Kehormatan</label>
                            <input type="text" class="form-control" id="minat" name="minat">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="minat" class="col-form-label">Tahun Penerimaan</label>
                            <input type="text" class="form-control datepicker">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="close-program-subsidiary">Close</button>
                <button type="button" class="btn btn-primary" id="add-prestasi-dokter">+ Tambah Data</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL prestasi dokter -->

<!-- MODAL pendidikan dokter -->
<div class="modal fade" id="modal-pendidikan-dokter" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pendidikan Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-pendidikan-dokter">
                    @csrf
                    <input type="hidden" class="form-control" name="kd_dokter" value="{{ $dokter->kd_dokter }}">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="pendidikan" class="col-form-label">Nama Pendidikan</label>
                            <input type="text" class="form-control" id="pendidikan" name="pendidikan">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="perguruan_tinggi" class="col-form-label">Perguruan Tinggi</label>
                            <input type="text" class="form-control" id="perguruan_tinggi" name="perguruan_tinggi">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="minat" class="col-form-label">Tahun Kelulusan</label>
                            <input type="text" class="form-control datepicker" name="tahun_lulus">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="close-program-subsidiary">Close</button>
                <button type="button" class="btn btn-primary" id="add-pendidikan-dokter">+ Tambah Data</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL pendidikan dokter -->

@endsection

@section('script')
<script src="{{ asset('modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('js/page/features-post-create.js') }}"></script>
<script src="{{ asset('modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>


<script>
$(document).ready(function() {
    $('html, body').animate({
        scrollTop: $("#card-minat-klinis").offset().top
    }, 1000);
});

$('#add-minat-klinis').click(function() {
    $.ajax({
        url: "{{ route('minat-klinis.store') }}",
        type: "POST",
        data: $('#form-minat-klinis').serialize(),
        success: function(response) {
            swal("Berhasil!", "Data minat klinis berhasil ditambahkan", "success");
            $('#modal-minat-klinis').modal('hide');
            $('#table-minat-klinis').append(`
                <tr id="minat-klinis-${response.minat.id}">
                    <td>${response.minat.id}</td>
                    <td>${response.minat.minat}</td>
                    <td class="d-flex">
                        <a href="#" class="btn btn-warning mr-4">
                            <!-- edit icon -->
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <button class="btn btn-danger btn-delete-minat-klinis"
                            data-id="${response.minat.id}"
                            data-minat="${response.minat.minat}" 
                            data-token="{{ csrf_token() }}">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            `);
        },
        error: function(xhr) {
            swal("Gagal!", "Data minat klinis gagal ditambahkan", "error");
        }
    });
})

$('#table-minat-klinis').on('click', '.btn-delete-minat-klinis', function() {
    let id = $(this).data('id');
    let minat = $(this).data('minat');
    swal({
        title: "Apakah anda yakin?",
        text: `Data minat klinis ${minat} akan dihapus secara permanen`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                url: "{{ route('minat-klinis.destroy', ':id') }}".replace(':id', id),
                type: "DELETE",
                success: function(response) {
                    swal("Berhasil!", "Data minat klinis berhasil dihapus", "success");
                    $(`#minat-klinis-${id}`).remove();
                },
                error: function(xhr) {
                    swal("Gagal!", "Data minat klinis gagal dihapus", "error");
                }
            });
        }
    });
})

$('#btn-add-minat-klinis').click(function() {
    $('#modal-minat-klinis').modal('show');
});

$('#btn-add-prestasi-dokter').click(function() {
    $('#modal-prestasi-dokter').modal('show');
});

$('#btn-add-pendidikan-dokter').click(function() {
    $('#modal-pendidikan-dokter').modal('show');
});
</script>
@endsection