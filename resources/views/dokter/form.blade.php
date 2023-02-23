@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Input data dokter</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dokter</a></div>
            <div class="breadcrumb-item">Input data dokter</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Input data dokter</h4>
                    </div>
                    <div class="card-body">
                        <form id="form-add-dokter">
                            @csrf
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIP Dokter</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="kd_dokter" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Dokter</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="nm_dokter" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Spesialis</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="kd_sps" required>
                                        @foreach ($list_spesialis as $spesialis)
                                        <option value="{{ $spesialis->kd_sps }}">( {{ $spesialis->kd_sps }} ) -
                                            {{ $spesialis->nm_sps }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                                <div class="col-sm-12 col-md-7">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Pilih File</label>
                                        <!-- <input type="file" name="foto" id="image-upload" /> -->
                                        <input type="file" accept="image/*" name="foto" id="image-upload">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary" type="button" id="btn-add-dokter">Tambahkan
                                        Dokter</button>
                                </div>
                            </div>
                        </form>
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

<script>
$('#btn-add-dokter').click(function() {
    if ($('#form-add-dokter')[0].checkValidity()) {
        var formData = new FormData();
        formData.append('kd_dokter', $('input[name=kd_dokter]').val());
        formData.append('nm_dokter', $('input[name=nm_dokter]').val());
        formData.append('kd_sps', $('select[name=kd_sps]').val());
        formData.append('foto', $('input[name=foto]')[0].files[0]);
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: "{{ route('dokter.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data.data);
                swal({
                    title: "Berhasil!",
                    text: "Data dokter berhasil ditambahkan",
                    icon: "success",
                    buttons: false,
                    timer: 2000,
                }).then(function() {
                    window.location.href = "{{ route('dokter.index') }}/" + data.data
                        .kd_dokter +
                        "/edit";
                });
            },
            error: function(data) {
                console.log(data);
                swal({
                    title: "Gagal!",
                    text: "Data dokter gagal ditambahkan",
                    icon: "error",
                    buttons: false,
                    timer: 2000,
                })
            }
        });
    } else {
        $('#form-add-dokter')[0].reportValidity();
    }
});
</script>
@endsection