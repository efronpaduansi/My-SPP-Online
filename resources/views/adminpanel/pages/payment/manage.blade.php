@extends('layouts.adminpanel')

@section('title')
    Data Pembayaran
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>Jumlah</th>
                                <th>Tgl Bayar</th>
                                <th>Di Update Oleh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->invoice->siswa->name }}</td>
                                    <td>{{ 'Rp. ' . number_format($payment->amount, 0, '.', '.') }}</td>
                                    <td>{{ date('d/m/Y', strtotime($payment->date)) }}</td>
                                    <td>{{ $payment->user->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
