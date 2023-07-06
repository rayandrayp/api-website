@extends('layouts.main')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="balance-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-success bg-success">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Laporan WBS</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('laporan-spi.index') }}"
                            class="text-success font-weight-bold">{{ $list_pengaduan_spi->count() }} Laporan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="sales-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pengaduan</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('pengaduan.index') }}"
                            class="text-primary font-weight-bold">{{ $list_pengaduan->count() }} Pengaduan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="review-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-warning">
                    <i class="fas fa-star"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Ulasan</h4>
                    </div>
                    <div class="card-body">

                        <a href="{{ route('review.index') }}" class="text-warning font-weight-bold">
                            {{ $list_ulasan->count() }} Ulasan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- add script -->
@section('script')
<script src="{{ asset('js/page/index.js') }}"></script>
@endsection
@endsection