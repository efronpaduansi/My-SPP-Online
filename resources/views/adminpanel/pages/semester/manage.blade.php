@extends('layouts.adminpanel')

@section('title')
    Semester
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSemesterModal">Tambah
                    Baru</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Selesai</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $semester)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $semester->tahunAjaran->ta_name }}</td>
                                    <td>{{ $semester->semester_name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($semester->start_date)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($semester->close_date)) }}</td>
                                    <td>
                                        @if ($semester->close_date <= date('Y-m-d'))
                                            <span class="btn btn-sm btn-danger rounded-pill">Berakhir</span>
                                        @else
                                            <span class="btn btn-sm btn-success rounded-pill">Sedang berjalan</span>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        @if ($semester->close_date > date('Y-m-d'))
                                            <a href="{{ route('semester.close', $semester->id) }}"
                                                class="btn btn-sm btn-info"
                                                onclick="return confirm('Tutup semester berjalan?')"><i
                                                    class="fas fa-lock"></i></a>
                                        @endif
                                        <button class="btn btn-sm btn-success mx-2" data-bs-toggle="modal"
                                            data-bs-target="#editSemesterModal{{ $semester->id }}"><i
                                                class="fas fa-edit"></i></button>
                                        {{-- Edit Semester Modal --}}
                                        <div class="modal fade" id="editSemesterModal{{ $semester->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Semester
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('semester.update', $semester->id) }}"
                                                            method="POST" data-parsley-validate>
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group row">
                                                                <label for="ta_id" class="col-form-label col-sm-2">Tahun
                                                                    Ajaran</label>
                                                                <div class="col-sm-10">
                                                                    <select name="ta_id" id="ta_id"
                                                                        class="form-control" data-parsley-required="true"
                                                                        data-parsley-required-message="Pilih Tahun Ajaran!">
                                                                        <option disabled selected hidden>Pilih Tahun Ajaran
                                                                        </option>
                                                                        @foreach ($tahunAjaran as $ta)
                                                                            <option value="{{ $ta->id }}">
                                                                                {{ $ta->ta_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="semester_name"
                                                                    class="col-form-label col-sm-2">Nama Semester</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="semester_name"
                                                                        id="semester_name" class="form-control"
                                                                        placeholder="Masukan Nama Semester"
                                                                        data-parsley-required="true"
                                                                        data-parsley-required-message="Bidang ini wajib di isi!"
                                                                        value="{{ $semester->semester_name }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="start_date"
                                                                    class="col-form-label col-sm-2">Tanggal Mulai</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" name="start_date" id="start_date"
                                                                        class="form-control" data-parsley-required="true"
                                                                        data-parsley-required-message="Bidang ini wajib di isi!"
                                                                        value="{{ $semester->start_date }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="close_date"
                                                                    class="col-form-label col-sm-2">Tanggal Selesai</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" name="close_date" id="close_date"
                                                                        class="form-control" data-parsley-required="true"
                                                                        data-parsley-required-message="Bidang ini wajib di isi!"
                                                                        value="{{ $semester->close_date }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('semester.destroy', $semester->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Anda yakin menghapus data?')">
                                                <i class="fas fa-times"></i>
                                            </button>
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

    {{-- Include kelas modal --}}
    @include('adminpanel.pages.semester.modal')
@endsection
