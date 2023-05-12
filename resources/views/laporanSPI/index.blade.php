@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>List Pengaduan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pengaduan SPI</a></div>
            <div class="breadcrumb-item">List Pengaduan SPI</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Pengaduan SPI</h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <table class="table table-striped" id="table-pengaduan">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jenis Pengaduan</th>
                                        <th>Unit yang diadukan</th>
                                        <th>Personil yang diadukan</th>
                                        <th>Pengaduan</th>
                                        <th>Waktu Pengaduan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-pengaduan">
                                    @foreach ($list_laporan_spi as $pengaduan)
                                    <tr id="detail-pengaduan-{{$pengaduan->id}}">
                                        <td>{{ $pengaduan->nama }}</td>
                                        <td>
                                            @if ($pengaduan->lingkup == 1)
                                            <p>Penyimpangan peraturan dan
                                                perundang-undangan yang berlaku</p>
                                            @elseif($pengaduan->lingkup == 2)
                                            <p>Penyalahgunaan jabatan untuk kepentingan
                                                lain di luar TNI AD</p>
                                            @elseif($pengaduan->lingkup == 3)
                                            <p>Pemerasan</p>
                                            @elseif($pengaduan->lingkup == 4)
                                            <p>Perbuatan curang</p>
                                            @elseif($pengaduan->lingkup == 5)
                                            <p>Benturan kepentingan</p>
                                            @elseif($pengaduan->lingkup == 6)
                                            <p>Penggunaan dana dan aset TNI AD untuk
                                                kepentingan pribadi</p>
                                            @endif
                                        </td>
                                        <td>{{ $pengaduan->unit_dilaporkan }}</td>
                                        <td>{{ $pengaduan->personel_dilaporkan }}</td>
                                        <td>{{ strlen($pengaduan->laporan) > 20 ? substr($pengaduan->laporan, 0, 20) . '...' : $pengaduan->laporan }}
                                        </td>
                                        <td>{{ $pengaduan->created_at }}</td>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                        <label for="lingkup">Jenis Pengaduan</label>
                        <input type="text" readonly class="form-control" id="lingkup">
                    </div>
                    <div class="form-group">
                        <label for="unit_dilaporkan">Unit yang diadukan</label>
                        <input type="text" readonly class="form-control" id="unit_dilaporkan">
                    </div>
                    <div class="form-group">
                        <label for="personel_dilaporkan">Personil yang diadukan</label>
                        <input type="text" readonly class="form-control" id="personel_dilaporkan">
                    </div>

                    <div class="form-group">
                        <label for="pengaduan_detail">Pengaduan</label>
                        <textarea id="pengaduan_detail" cols="30" rows="10" class="col-12 bg-light"
                            style="height:150px; border: 0;" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kejadian_detail">Waktu Pengaduan</label>
                        <input type="text" readonly class="form-control" id="tanggal_kejadian_detail">
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> -->
                <button type="button" class="btn btn-primary" id="btn-respon" data-dismiss="modal">Selesai</button>
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
        "order": [
            [5, "desc"]
        ],
    });
});
// should use delegated event instead of direct calling the element
$('#tbody-pengaduan').on('click', '.btn-detail-pengaduan', function() {
    var id = $(this).data('id');
    console.log(id);
    $.ajax({
        url: "{{ route('laporan-spi.show',['laporan_spi'=>':id']) }}".replace(':id', id),
        type: "GET",
        success: function(data) {
            const pengaduan = data.data;
            const date = new Date(pengaduan.created_at);
            // get DD MM YYYY format for date
            const dateStr = date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            // get HH:MM format for time
            const timeStr = date.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            $('#pengaduan_id').val(pengaduan.id);
            $('#nama_detail').val(pengaduan.nama);
            $('#unit_dilaporkan').val(pengaduan.unit_dilaporkan);
            $('#personel_dilaporkan').val(pengaduan.personel_dilaporkan);
            $('#lingkup').val(pengaduan.lingkup);
            $('#pengaduan_detail').val(pengaduan.laporan);
            $('#tanggal_kejadian_detail').val(dateStr);

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
</script>

@endsection