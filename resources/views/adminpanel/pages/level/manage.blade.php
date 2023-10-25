@extends('layouts.adminpanel')

@section('title')
    Level Siswa
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahLevelModal">Tambah Baru</button> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Level</th>
                                <th>Nominal Minimum <sub>/Bulan</sub></th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $level)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $level->level_name }}</td>
                                    <td>{{ 'Rp. ' . number_format($level->start_nominal, 0, '.', '.') }}</td>
                                    <td class="d-flex">
                                        <button class="btn btn-sm btn-success me-2" data-bs-toggle="modal"
                                            data-bs-target="#editLevelModal{{ $level->id }}"><i
                                                class="fas fa-edit"></i></button>
                                        {{-- Edit Kelas Modal --}}
                                        <div class="modal fade" id="editLevelModal{{ $level->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Level</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('level.update', $level->id) }}"
                                                            method="POST" data-parsley-validate>
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group row">
                                                                {{-- <label for="level_name" class="col-form-label col-sm-2">Nama
                                                                    Level</label> --}}
                                                                <div class="col-sm-10">
                                                                    <input type="hidden" name="level_name" id="level_name"
                                                                        class="form-control"
                                                                        placeholder="Masukan Nama Level"
                                                                        data-parsley-required="true"
                                                                        data-parsley-required-message="Bidang ini wajib di isi!"
                                                                        value="{{ $level->level_name }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="start_nominal"
                                                                    class="col-form-label col-sm-2">Nominal Minimum
                                                                    (Rp)
                                                                </label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" name="start_nominal"
                                                                        id="start_nominal" class="form-control"
                                                                        placeholder="Masukan Nominal Minimum"
                                                                        data-parsley-required="true"
                                                                        data-parsley-required-message="Bidang ini wajib di isi!"
                                                                        value="{{ $level->start_nominal }}">
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

                                        {{-- <form action="{{ route('level.destroy', $level->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Anda yakin menghapus data?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form> --}}
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
    @include('adminpanel.pages.level.modal')
@endsection
