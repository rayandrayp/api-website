@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>List Pengaduan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pengaduan</a></div>
            <div class="breadcrumb-item">List Pengaduan</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Pengaduan</h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <table class="table table-striped" id="table-pengaduan">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Pengaduan</th>
                                        <th>Kontak</th>
                                        <th>Jenis Laporan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-pengaduan">
                                    @foreach ($list_pengaduan as $pengaduan)
                                    <tr id="detail-pengaduan-{{$pengaduan->id}}">
                                        <td>{{ $pengaduan->nama }}</td>
                                        <td>{{ strlen($pengaduan->pengaduan) > 20 ? substr($pengaduan->pengaduan, 0, 20) . '...' : $pengaduan->pengaduan }}
                                        </td>
                                        <td>{{ $pengaduan->whatsapp }}</td>
                                        <td>
                                            {{ $pengaduan->jenis_laporan->jenis_laporan }}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-detail-pengaduan" type="button"
                                                data-id="{{ $pengaduan->id }}">Detail</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Detail Pengaduan -->
<div class="modal fade" id="modal-detail-pengaduan" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-respon">
                    @csrf
                    <input type="hidden" name="pengaduan_id" id="pengaduan_id">
                    <div class="form-group">
                        <label for="nama_detail">Nama</label>
                        <input type="text" readonly class="form-control" name="nama_detail" id="nama_detail">
                    </div>
                    <div class="form-group">
                        <label for="whatsapp_detail">Kontak</label>
                        <input type="text" readonly class="form-control" id="whatsapp_detail">
                    </div>
                    <div class="form-group">
                        <label for="jenis_laporan_detail">Jenis Laporan</label>
                        <input type="text" readonly class="form-control" id="jenis_laporan_detail">
                    </div>
                    <div class="form-group">
                        <label for="pengaduan_detail">Pengaduan</label>
                        <textarea id="pengaduan_detail" cols="30" rows="10" class="form-control" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kejadian_detail">Tanggal Kejadian</label>
                        <input type="text" readonly class="form-control" id="tanggal_kejadian_detail">
                    </div>
                    <div class="form-group">
                        <label for="lokasi_detail">Lokasi Kejadian</label>
                        <input type="text" readonly class="form-control" id="lokasi_detail">
                    </div>
                    <div class="form-group">
                        <label for="respon">Respon</label>
                        <textarea name="respon" id="respon" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-respon">Selesai</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('js/page/features-post-create.js') }}"></script>
<script src="{{ asset('modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<script>
$(document).ready(function() {
    $('#table-pengaduan').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
// should use delegated event instead of direct calling the element
$('#tbody-pengaduan').on('click', '.btn-detail-pengaduan', function() {
    var id = $(this).data('id');
    $.ajax({
        url: "{{ route('pengaduan.show',['pengaduan'=>':id']) }}".replace(':id', id),
        type: "GET",
        success: function(data) {
            const pengaduan = data.data.pengaduan;
            $('#pengaduan_id').val(pengaduan.id);
            $('#nama_detail').val(pengaduan.nama);
            $('#whatsapp_detail').val(pengaduan.whatsapp);
            $('#jenis_laporan_detail').val(pengaduan.jenis_laporan.jenis_laporan);
            $('#pengaduan_detail').val(pengaduan.pengaduan);
            $('#tanggal_kejadian_detail').val(pengaduan.tanggal_kejadian);
            $('#lokasi_detail').val(pengaduan.lokasi_kejadian);

            $('#modal-detail-pengaduan').modal('show');
        },
        error: function(data, textStatus, errorThrown) {
            console.log('Error:', data.responseJSON.message);
            console.log('Error:', textStatus);
            console.log('Error:', errorThrown);
            swal("Gagal", data.responseJSON.message, "error").then(function() {
                window.location.reload();
            });
        }
    });
});

$('#btn-respon').click(function() {
    var id = $('#pengaduan_id').val();
    var formData = new FormData($('#form-respon')[0]);
    $.ajax({
        url: "{{ route('respon-pengaduan.store') }}",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            swal("Berhasil", "Berhasil menyimpan respon", "success").then(function() {
                window.location.reload();
            });
        },
        error: function(data, textStatus, errorThrown) {
            console.log('Error:', data.responseJSON.message);
            console.log('Error:', textStatus);
            console.log('Error:', errorThrown);
            swal("Gagal", data.responseJSON.message, "error").then(function() {
                window.location.reload();
            });
        }
    });
});
</script>

@endsection