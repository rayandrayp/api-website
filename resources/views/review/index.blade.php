@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>List Ulasan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Ulasan</a></div>
            <div class="breadcrumb-item">List Ulasan</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Ulasan</h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <table class="table table-striped" id="table-review">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Rating</th>
                                        <th>Ulasan</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-review">
                                    @foreach ($reviews as $review)
                                    <tr id="detail-review-{{$review->id}}">
                                        <td>{{ $review->name }}</td>
                                        <td>{{ $review->rating }}</td>
                                        <!-- <td>{{ $review->review }}</td> -->
                                        <td>{{ Str::limit($review->review, 50) }}</td>
                                        <td>{{ $review->phone ?? '-' }}</td>
                                        <td>
                                            {{ $review->email }}
                                        </td>
                                        <!-- <td>{{ $review->created_at }}</td> -->
                                        <!-- format date -->
                                        <td>{{ $review->created_at->format('d M Y') }} -
                                            {{ $review->created_at->format('H:i') }}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-detail-review" type="button"
                                                data-id="{{ $review->id }}">Detail</button>
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

<!-- Modal Detail Ulasan -->
<div class="modal fade" id="modal-detail-review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Ulasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Rating</label>
                        <input type="text" class="form-control" id="rating" name="rating" readonly>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="name">Tanggal</label>
                        <input type="text" class="form-control" id="tanggal" name="tanggal" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Jam</label>
                        <input type="text" class="form-control" id="jam" name="jam" readonly>
                    </div>
                </div>
                <div class="mt-2">
                    <label for="name">Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" readonly>
                </div>
                <div class="mt-2">
                    <label for="name">Email</label>
                    <input type="text" class="form-control" id="email" name="email" readonly>
                </div>
                <div class="mt-2">
                    <label for="name">Ulasan</label>
                    <textarea class="form-control" id="review" name="review" rows="4" readonly></textarea>
                </div>
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
    $('#table-review').DataTable({
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
$('#tbody-review').on('click', '.btn-detail-review', function() {
    var id = $(this).data('id');
    $.ajax({
        url: "{{ route('review.show',['review'=>':id']) }}".replace(':id', id),
        type: "GET",
        success: function(data) {

            const review = data.data;
            const date = new Date(review.created_at);
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
            $('#name').val(review.name);
            $('#rating').val(review.rating);
            $('#phone').val(review.phone);
            $('#email').val(review.email);
            $('#review').val(review.review);
            $('#tanggal').val(dateStr);
            $('#jam').val(timeStr);
            $('#modal-detail-review').modal('show');
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