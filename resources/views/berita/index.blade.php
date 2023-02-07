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
                            <h2><a href="#">{{$berita->judul}}</a></h2>
                        </div>
                    </div>
                    <div class="article-details">
                        <p>
                            <!-- add elipsis after 100 characters -->
                            {{ strip_tags(Str::limit($berita->isi, 80)) }}
                        </p>
                        <div class="article-cta">
                            <a href="https://www.rssoepraoen.co.id/informasi/berita/{{+$berita->id}}"
                                class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection