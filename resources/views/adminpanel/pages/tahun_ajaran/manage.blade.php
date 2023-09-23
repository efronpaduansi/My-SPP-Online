@extends('layouts.adminpanel')

@section('title')
    Tahun Ajaran
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTahunAjaranModal">Tambah Baru</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tahun Ajaran</th>
                                <th>Tgl Ditambahkan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $tahunAjaran)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tahunAjaran->ta_name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($tahunAjaran->created_at)) }}</td>
                                    <td class="d-flex">
                                        <button class="btn btn-sm btn-success me-2" data-bs-toggle="modal"
                                            data-bs-target="#editTahunAjaranModal{{ $tahunAjaran->id }}"><i
                                                class="fas fa-edit"></i></button>
                                        {{-- Edit Tahun Ajaran Modal --}}
                                        <div class="modal fade" id="editTahunAjaranModal{{ $tahunAjaran->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Tahun Ajaran</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('ta.update', $tahunAjaran->id) }}"
                                                            method="POST" data-parsley-validate>
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group row">
                                                                <label for="ta_name" class="col-form-label col-sm-2">Tahun Ajaran</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="ta_name" id="ta_name"
                                                                        value="{{ $tahunAjaran->ta_name }}"
                                                                        class="form-control"
                                                                        placeholder="Contoh: Ganjil 2023/2024"
                                                                        data-parsley-required="true"
                                                                        data-parsley-required-message="Bidang ini wajib di isi!">
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

                                        <form action="{{ route('ta.destroy', $tahunAjaran->id) }}" method="POST">
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
    @include('adminpanel.pages.tahun_ajaran.modal')
@endsection
