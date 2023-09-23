@extends('layouts.adminpanel')

@section('title')
    Detail Invoice
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex mb-4">
                <a href="{{ route('invoice.index') }}" class="btn btn-secondary me-3">Kembali</a>
                @if ($invoice->status != 'Lunas')
                    <form action="{{ route('invoice.setlunas', $invoice->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $invoice->id }}">
                        <button type="submit" class="btn btn-success"
                            onclick="return confirm('Anda yakin menandai sebagai Lunas?')">Tandai
                            Lunas</button>
                    </form>
                @endif
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Nama Siswa</th>
                        <th>:</th>
                        <td class="text-uppercase">{{ $invoice->siswa->name }}</td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <th>:</th>
                        <td class="text-uppercase">{{ $invoice->semester->semester_name }}</td>
                    </tr>
                    <tr>
                        <th>Sub Total</th>
                        <th>:</th>
                        <td class="text-uppercase">{{ 'Rp. ' . number_format($invoice->sub_total, 0, '.', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Diskon</th>
                        <th>:</th>
                        <td class="text-uppercase">{{ 'Rp. ' . number_format($invoice->discount, 0, '.', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <th>:</th>
                        <td class="text-uppercase">{{ date('d/m/Y', strtotime($invoice->date)) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
@endsection
