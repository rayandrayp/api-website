@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Berita</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Berita</div>
        </div>
    </div>

    <div class="section-body">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="section-title">Berita</h2>
                <p class="section-lead">Daftar berita</p>
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <a href="berita/create" class="btn btn-primary">Tambah Berita</a>
            </div>
        </div>

        <div class="row">
            @foreach ($list_berita as $berita)
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article">
                    <div class="article-header">
                        <div class="article-image" data-background="{{asset('storage'.$berita->banner)}}">
                        </div>
                        <div class="article-title">
                            <h2>
                                <a href="#">
                                    {{ strip_tags(Str::limit($berita->judul, 40)) }}
                                </a>
                            </h2>
                        </div>
                    </div>
                    <div class="article-details">
                        <!-- <p>
                            {{ strip_tags(Str::limit($berita->isi, 80)) }}
                        </p> -->
                        <div class="article-cta">
                            <a href="https://www.rssoepraoen.co.id/informasi/berita/{{+$berita->id}}"
                                class="btn btn-primary w-100">Read More</a>
                            <button class="btn btn-danger mt-2 w-100" id="btn-delete-berita-{{ $berita->id }}">Hapus
                                Berita</button>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
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
// check if btn-delete-berita pressed
$('button[id^="btn-delete-berita-"]').on('click', function(e) {
    console.log('delete button pressed!');
    e.preventDefault();
    var berita_id = $(this).attr('id').split('-')[3];
    swal({
            title: "Apakah anda yakin?",
            text: "Setelah dihapus, Anda tidak akan dapat memulihkan berita ini!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            // if delete confirmed
            if (willDelete) {
                // delete request
                $.ajax({
                    url: "{{ url('berita') }}" + '/' + berita_id, // url berita
                    type: "POST",
                    data: {
                        '_method': 'DELETE',
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        swal("Berita berhasil dihapus!", {
                            icon: "success",
                        }).then((willDelete) => {
                            location.reload();
                        });
                    },
                    error: function(data) {
                        swal("Oops! Terjadi kesalahan.", {
                            icon: "error",
                        });
                    }
                });
            }
        });
});
</script>
@endsection