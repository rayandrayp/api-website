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
                        <form id="form-update-dokter">
                            @csrf
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
                                    <input type="text" class="form-control" name="nm_dokter"
                                        value="{{ $dokter->nm_dokter }}">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Spesialis</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="kd_sps">
                                        @foreach ($list_spesialis as $spesialis)
                                        <option value="{{ $spesialis->kd_sps }}"
                                            {{ $spesialis->kd_sps == $dokter->kd_sps ? 'selected' : '' }}>(
                                            {{ $spesialis->kd_sps }} ) - {{ $spesialis->nm_sps }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                                <div class="col-sm-12 col-md-7 d-flex">
                                    <!-- display image -->
                                    @if ($dokter->imagepath)
                                    <img src="{{ asset('storage/' . $dokter->imagepath) }}" alt="image"
                                        class="img-thumbnail" width="200px">
                                    @endif
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Ganti Foto</label>
                                        <input type="file" name="foto" id="image-upload" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary" type="button" id="update-dokter">Update
                                        Dokter</button>
                                </div>
                            </div>
                        </form>
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
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th style="width: 15%">Tahun</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-prestasi">
                                    @foreach ($dokter->prestasi as $prestasi)
                                    <tr id="prestasi-{{ $prestasi->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $prestasi->prestasi }}</td>
                                        <td>{{ $prestasi->tahun }}</td>
                                        <td class="d-flex">
                                            <button class="btn btn-warning btn-edit-prestasi mr-4"
                                                data-id="{{ $prestasi->id }}" data-name="{{ $prestasi->prestasi }}"
                                                data-tahun="{{ $prestasi->tahun }}">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </button>
                                            <!-- append token to button -->
                                            <button class="btn btn-danger btn-delete-prestasi"
                                                data-id="{{ $prestasi->id }}" data-name="{{ $prestasi->prestasi }}"
                                                data-tahun="{{ $prestasi->tahun }}" data-token="{{ csrf_token() }}">
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
                <div class="card" id="card-pendidikan-dokter">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Pendidikan</h4>
                        <button class="btn btn-primary" id="btn-add-pendidikan-dokter">Tambah Pendidikan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Pendidikan</th>
                                        <th>Perguruan Tinggi</th>
                                        <th style="width: 15%">Tahun</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-pendidikan">
                                    @foreach ($dokter->pendidikan as $pendidikan)
                                    <tr id="pendidikan-{{ $pendidikan->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pendidikan->pendidikan }}</td>
                                        <td>{{ $pendidikan->perguruan_tinggi }}</td>
                                        <td>{{ $pendidikan->tahun }}</td>
                                        <td class="d-flex">
                                            <button class="btn btn-warning btn-edit-pendidikan mr-4"
                                                data-id="{{ $pendidikan->id }}"
                                                data-pendidikan="{{ $pendidikan->pendidikan }}"
                                                data-perguruan_tinggi="{{ $pendidikan->perguruan_tinggi }}"
                                                data-tahun="{{ $pendidikan->tahun }}">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </button>
                                            <!-- append token to button -->
                                            <button class="btn btn-danger btn-delete-pendidikan"
                                                data-id="{{ $pendidikan->id }}"
                                                data-pendidikan="{{ $pendidikan->pendidikan }}"
                                                data-perguruan_tinggi="{{ $pendidikan->perguruan_tinggi }}"
                                                data-tahun="{{ $pendidikan->tahun }}" data-token="{{ csrf_token() }}">
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
            <form id="form-minat-klinis" action="javascript:minatKlinisPressEnterKey();">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="kd_dokter" value="{{ $dokter->kd_dokter }}">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="minat" class="col-form-label">Minat Klinis</label>
                            <input type="text" class="form-control" id="minat" name="minat">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="close-program-subsidiary">Close</button>
                    <button type="button" class="btn btn-primary" id="add-minat-klinis">+ Tambah Data</button>
                </div>
            </form>
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
                            <input type="text" class="form-control" name="prestasi">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="minat" class="col-form-label">Tahun Penerimaan</label>
                            <input type="text" class="form-control datepicker" name="tahun">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-program-subsidiary">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="add-prestasi-dokter">
                    + Tambah Data
                </button>
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
                            <input type="text" class="form-control datepicker" name="tahun">
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

$('#update-dokter').click(function() {
    if ($('#form-update-dokter')[0].checkValidity()) {
        var formData = new FormData();
        console.log("{{csrf_token()}}");
        formData.append('nm_dokter', $('input[name=nm_dokter]').val());
        formData.append('kd_sps', $('select[name=kd_sps]').val());
        formData.append('foto', $('input[name=foto]')[0].files[0]);
        formData.append('_token', $('input[name=_token]').val());
        formData.append('_method', 'PUT');
        $.ajax({
            url: "{{ route('dokter.update', $dokter->kd_dokter) }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}",
            },
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                swal("Berhasil!", "Data dokter berhasil diupdate", "success");
                location.reload();
            },
            error: function(xhr) {
                swal("Gagal!", "Data dokter gagal diupdate", "error");
            }
        });
    } else {
        $('#form-add-dokter').addClass('was-validated');
    }
});

function minatKlinisPressEnterKey() {
    $('#add-minat-klinis').click();
}

$('#btn-add-minat-klinis').click(function() {
    $('#modal-minat-klinis').modal('show');
});

$('#btn-add-prestasi-dokter').click(function() {
    $('#modal-prestasi-dokter').modal('show');
});

$('#btn-add-pendidikan-dokter').click(function() {
    $('#modal-pendidikan-dokter').modal('show');
});

$('#add-minat-klinis').click(function() {
    $.ajax({
        url: "{{ route('minat-klinis.store') }}",
        type: "POST",
        data: $('#form-minat-klinis').serialize(),
        success: function(response) {
            swal("Berhasil!", "Data minat klinis berhasil ditambahkan", "success");
            $('#modal-minat-klinis').modal('hide');
            $('#form-minat-klinis').trigger('reset');
            $('#table-minat-klinis').append(`
                <tr id="minat-klinis-${response.data.id}">
                    <td>${response.data.id}</td>
                    <td>${response.data.minat}</td>
                    <td class="d-flex">
                        <a href="#" class="btn btn-warning mr-4">
                            <!-- edit icon -->
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <button class="btn btn-danger btn-delete-minat-klinis"
                            data-id="${response.data.id}"
                            data-minat="${response.data.minat}" 
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
});

$('#add-prestasi-dokter').click(function() {
    $.ajax({
        url: "{{ route('prestasi-dokter.store') }}",
        type: "POST",
        data: $('#form-prestasi-dokter').serialize(),
        success: function(response) {
            $('#modal-prestasi-dokter').modal('hide');
            $('#form-prestasi-dokter').trigger('reset');
            swal("Berhasil!", "Data prestasi dokter berhasil ditambahkan", "success");
            $('#table-prestasi').append(`
                <tr id="prestasi-${response.data.id}">
                    <td>${response.data.id}</td>
                    <td>${response.data.prestasi}</td>
                    <td>${response.data.tahun}</td>
                    <td class="d-flex">
                        <a href="#" class="btn btn-warning mr-4">
                            <!-- edit icon -->
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <button class="btn btn-danger btn-delete-prestasi"
                            data-id="${response.data.id}"
                            data-prestasi="${response.data.prestasi}" 
                            data-token="{{ csrf_token() }}">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            `);
        },
        error: function(xhr) {
            swal("Gagal!", "Data prestasi dokter gagal ditambahkan", "error");
        }
    })
});

$('#add-pendidikan-dokter').click(function() {
    $.ajax({
        url: "{{ route('pendidikan-dokter.store') }}",
        type: "POST",
        data: $('#form-pendidikan-dokter').serialize(),
        success: function(response) {
            $('#modal-pendidikan-dokter').modal('hide');
            $('#form-pendidikan-dokter').trigger('reset');
            swal("Berhasil!", "Data pendidikan dokter berhasil ditambahkan", "success");
            $('#table-pendidikan').append(`
            <tr id="prestasi-${response.data.id}">
                    <td>${response.data.id}</td>
                    <td>${response.data.pendidikan}</td>
                    <td>${response.data.tahun}</td>
                    <td>${response.data.perguruan_tinggi}</td>
                    <td class="d-flex">
                        <a href="#" class="btn btn-warning mr-4">
                            <!-- edit icon -->
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <button class="btn btn-danger btn-delete-pendidikan"
                            data-id="${response.data.id}"
                            data-pendidikan="${response.data.pendidikan}" 
                            data-token="{{ csrf_token() }}">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            `);
        },
        error: function(xhr) {
            swal("Gagal!", "Data pendidikan dokter gagal ditambahkan", "error");
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
});

$('#table-prestasi').on('click', '.btn-delete-prestasi', function() {
    let id = $(this).data('id');
    let prestasi = $(this).data('prestasi');
    swal({
        title: "Apakah anda yakin?",
        text: `Data prestasi dokter ${prestasi} akan dihapus secara permanen`,
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
                url: "{{ route('prestasi-dokter.destroy', ':id') }}".replace(':id', id),
                type: "DELETE",
                success: function(response) {
                    swal("Berhasil!", "Data prestasi dokter berhasil dihapus", "success");
                    $(`#prestasi-${id}`).remove();
                },
                error: function(xhr) {
                    swal("Gagal!", "Data prestasi dokter gagal dihapus", "error");
                }
            });
        }
    });
});

$('#table-pendidikan').on('click', '.btn-delete-pendidikan', function() {
    let id = $(this).data('id');
    let pendidikan = $(this).data('pendidikan');
    swal({
        title: "Apakah anda yakin?",
        text: `Data pendidikan dokter ${pendidikan} akan dihapus secara permanen`,
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
                url: "{{ route('pendidikan-dokter.destroy', ':id') }}".replace(':id', id),
                type: "DELETE",
                success: function(response) {
                    swal("Berhasil!", "Data pendidikan dokter berhasil dihapus", "success");
                    $(`#pendidikan-${id}`).remove();
                },
                error: function(xhr) {
                    swal("Gagal!", "Data pendidikan dokter gagal dihapus", "error");
                }
            });
        }
    });
});
</script>
@endsection