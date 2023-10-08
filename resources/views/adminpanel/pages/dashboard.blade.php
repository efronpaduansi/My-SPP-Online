@extends('layouts.adminpanel')

@section('title')
    Dashboard
@endsection

@section('content')
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon bg-danger mb-2">
                                        <i class="fas fa-file-invoice"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">
                                        Belum Bayar
                                    </h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($invoiceUnpaid, 0, '.', '.') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon bg-success mb-2">
                                        <i class="fas fa-file-invoice"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Lunas</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($invoicePaid, 0, '.', '.') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pendapatan</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($income, 0, '.', '.') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Diskon</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($invoiceDiscount, 0, '.', '.') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Siswa</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <h1><i class="fas fa-user-circle"></i></h1>
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                            <small class="text-muted mb-0">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Sistem</h4>
                </div>
                <div class="card-content pb-4">
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <i class="fab fa-chrome"></i>
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">{{ $browser }}</h5>
                            <h6 class="text-muted mb-0">Browser</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <i class="fab fa-chrome"></i>
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">{{ $browserVersion }}</h5>
                            <h6 class="text-muted mb-0">Browser Version</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">{{ $platform }}</h5>
                            <h6 class="text-muted mb-0">Operating System</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('customjs')
    <script>
        var options = {
            chart: {
                type: 'area'
            },
            series: [{
                name: 'Siswa',
                data: <?php echo json_encode($jumlah_user); ?>
            }],
            xaxis: {
                categories: <?php echo json_encode($label); ?>
            },
            stroke: {
                curve: 'smooth',
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
@endpush
