@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Artikel</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Forms</a></div>
            <div class="breadcrumb-item">Tambah Artikel</div>
        </div>
    </div>

    <div class="section-body">
        <!-- <h2 class="section-title">Tambah Artikel</h2>
        <p class="section-lead">Tulis artikel di sini</p> -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- add form -->
                    <form method="POST" action="/artikel" enctype='multipart/form-data'>
                        @csrf
                        <div class="card-header">
                            <h4>Tambah Artikel</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="judul">
                                </div>
                            </div>
                            <!-- <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric">
                                    <option>Tech</option>
                                    <option>News</option>
                                    <option>Political</option>
                                </select>
                            </div>
                        </div> -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Artikel</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea class="summernote" name="isi"></textarea>
                                </div>
                            </div>

                            <!-- upload image -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Upload
                                    Image</label>
                                <div class="col-sm-12 col-md-7">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" name="banner" id="image-upload" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary" type="submit">Publish</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection