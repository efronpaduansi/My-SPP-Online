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
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->invoice->siswa->name }}</td>
                                    <td>{{ 'Rp. ' . number_format($payment->amount, 0, '.', '.') }}</td>
                                    <td>{{ date('d/m/Y', strtotime($payment->date)) }}</td>
                                    <td>
                                        <form action="{{ route('payment.destroy', $payment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Anda yakin menghapus data ini?')"><i
                                                    class="fas fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
