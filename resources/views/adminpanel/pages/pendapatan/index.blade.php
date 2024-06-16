@extends('layouts.adminpanel')

@section('title')
    Pendapatan
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
                        <i class="fas fa-file-excel"></i> Export Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="table1">
                    <thead>
                        <tr class="text-uppercase">
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $pendapatan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pendapatan->invoice->siswa->name }}</td>
                                <td>{{ 'Rp. ' . number_format($pendapatan->amount, 0, '.', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <td colspan="2" class="text-center font-weight-bold"><strong>TOTAL</strong></td>
                        <td colspan="3"><strong>{{ 'Rp. ' . number_format($totalPendapatan, 0, '.', '.') }}</strong></td>
                    </tfoot>
                </table>
            </div>
            @include('adminpanel.pages.pendapatan.modal')
        </div>
    </section>
@endsection
