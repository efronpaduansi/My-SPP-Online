@extends('layouts.adminpanel')

@section('title')
    Detail Data Siswa
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>No. Induk Siswa </th>
                        <th>:</th>
                        <td>{{ $siswa->nis }}</td>
                    </tr>
                    <tr>
                        <th>No. Induk Kependudukan </th>
                        <th>:</th>
                        <td>{{ $siswa->nik }}</td>
                    </tr>
                    <tr>
                        <th>No. Kartu Keluarga </th>
                        <th>:</th>
                        <td>{{ $siswa->kartuKeluarga->no_kk }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap </th>
                        <th>:</th>
                        <td>{{ $siswa->name }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir </th>
                        <th>:</th>
                        <td>{{ date('d-m-Y', strtotime($siswa->date_of_birth)) }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin </th>
                        <th>:</th>
                        <td class="text-uppercase">{{ $siswa->gender }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Lengkap </th>
                        <th>:</th>
                        <td>{{ $siswa->address }}</td>
                    </tr>
                    <tr>
                        <th>Level Siswa </th>
                        <th>:</th>
                        <td>{{ $siswa->level->level_name }}</td>
                    </tr>
                    <tr>
                        <th>Kelas </th>
                        <th>:</th>
                        <td>{{ $siswa->kelas->class_name }}</td>
                    </tr>
                    <tr>
                        <th>Status </th>
                        <th>:</th>
                        <td>
                            @if ($siswa->status == 'active')
                                <span class="btn btn-success rounded-pill text-capitalize">{{ $siswa->status }}</span>
                            @elseif($siswa->status == 'inactive')
                                <span class="btn btn-danger rounded-pill text-capitalize">{{ $siswa->status }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Ditambahkan pada</th>
                        <th>:</th>
                        <td>{{ date('d-m-Y, H:i:s', strtotime($siswa->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Di Ubah</th>
                        <th>:</th>
                        <td>{{ $siswa->updated_at->diffForHumans() }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
@endsection
