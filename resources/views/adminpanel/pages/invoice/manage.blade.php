@extends('layouts.adminpanel')

@section('title')
    Data Tagihan
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                @if (Auth::user()->role_id == 1)
                    <a href="{{ route('invoice.create') }}" class="btn btn-primary">Buat Tagihan</a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>Semester</th>
                                <th>Total</th>
                                <th>Diskon</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $invoice->siswa->name }}</td>
                                    <td>{{ $invoice->semester->semester_name }}</td>
                                    <td>{{ 'Rp. ' . number_format($invoice->sub_total, '0', '.', '.') }}</td>
                                    <td>{{ 'Rp. ' . number_format($invoice->discount, '0', '.', '.') }}</td>
                                    <td>{{ date('d/m/Y', strtotime($invoice->date)) }}</td>
                                    <td>
                                        @if ($invoice->status == 'Belum Bayar')
                                            <strong class="text-danger">{{ $invoice->status }}</strong>
                                        @else
                                            <strong class="text-success">{{ $invoice->status }}</strong>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown-center">
                                            <button class="btn btn-info dropdown-toggle rounded-pill" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Pilih Aksi
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('invoice.show', $invoice->id) }}"><i
                                                            class="fas fa-eye"></i>
                                                        Show</a></li>
                                                @if (Auth::user()->role_id == 1)
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('invoice.edit', $invoice->id) }}"><i
                                                                class="fas fa-edit"></i>
                                                            Edit</a></li>
                                                    <li><a class="dropdown-item text-danger"
                                                            href="{{ route('invoice.destroy', $invoice->id) }}"
                                                            onclick="return confirm('Anda yakin menghapus data ini?')"><i
                                                                class="fas fa-trash"></i> Delete</a></li>
                                                @endif
                                            </ul>
                                        </div>
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
