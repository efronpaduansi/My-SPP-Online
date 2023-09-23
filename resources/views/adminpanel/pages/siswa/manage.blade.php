@extends('layouts.adminpanel')

@section('title')
    Data Siswa
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('siswa.create') }}" class="btn btn-primary">Tambah Baru</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIS</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->nik }}</td>
                                    <td>{{ $siswa->name }}</td>
                                    <td class="text-uppercase">{{ $siswa->gender }}</td>
                                    <td>{{ $siswa->kelas->class_name }}</td>
                                    <td>
                                        <div class="dropdown-center">
                                            <button
                                                class="btn {{ $siswa->status == 'active' ? 'btn-success' : 'btn-danger' }} dropdown-toggle rounded-pill text-capitalize"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $siswa->status }}
                                            </button>
                                            <ul class="dropdown-menu">
                                                @if ($siswa->status == 'active')
                                                    <li><a class="dropdown-item text-danger"
                                                            href="{{ route('siswa.set-status', $siswa->nis) }}"
                                                            onclick="return confirm('Anda yakin?')">Nonaktifkan</a>
                                                    </li>
                                                @else
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('siswa.set-status', $siswa->nis) }}"
                                                            onclick="return confirm('Anda yakin?')">Aktifkan</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown-center">
                                            <button class="btn btn-info dropdown-toggle rounded-pill" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Pilih Aksi
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('siswa.show', $siswa->nis) }}"><i
                                                            class="fas fa-info"></i>
                                                        Detail</a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('siswa.edit', $siswa->nis) }}"><i
                                                            class="fas fa-edit"></i>
                                                        Edit</a></li>
                                                <li><a class="dropdown-item text-danger"
                                                        href="{{ route('siswa.destroy', $siswa->nis) }}"
                                                        onclick="return confirm('Anda yakin menghapus data ini?')"><i
                                                            class="fas fa-trash"></i> Delete</a></li>
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
