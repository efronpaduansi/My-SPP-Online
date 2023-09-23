@extends('layouts.adminpanel')

@section('title')
    Tambah Data Siswa
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.store') }}" method="POST" data-parsley-validate>
                    @csrf
                    <div class="row">
                        {{-- No KK --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_kk">No. KK</label>
                                <input type="text" name="no_kk" id="no_kk" class="form-control"
                                    data-parsley-required="true" data-parsley-required-message="Bidang ini wajib di isi!"
                                    data-parsley-validation-threshold="1" data-parsley-trigger="keyup"
                                    data-parsley-type="number" placeholder="Masukan No Kartu Keluarga" autofocus
                                    value="{{ old('no_kk') }}">
                            </div>
                        </div>
                        {{-- No Induk Kependudukan --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control"
                                    data-parsley-required="true" data-parsley-required-message="Bidang ini wajib di isi!"
                                    data-parsley-validation-threshold="1" data-parsley-trigger="keyup"
                                    data-parsley-type="number" placeholder="Masukan NIK" value="{{ old('nik') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- No Induk Siswa --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nis">No Induk Siswa</label>
                                <input type="text" name="nis" id="nis" class="form-control"
                                    data-parsley-required="true" data-parsley-required-message="Bidang ini wajib di isi!"
                                    data-parsley-validation-threshold="1" data-parsley-trigger="keyup"
                                    data-parsley-type="number" placeholder="Masukan No Induk Siswa"
                                    value="{{ $nextNIS }}" readonly>
                            </div>
                        </div>
                        {{-- Nama Lengkap --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    data-parsley-required="true" data-parsley-required-message="Bidang ini wajib di isi!"
                                    placeholder="Masukan Nama Lengkap" value="{{ old('name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Tanggal Lahir --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_of_birth">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                                    data-parsley-required="true" data-parsley-required-message="Bidang ini wajib di isi!"
                                    value="{{ old('date_of_birth') }}">
                            </div>
                        </div>
                        {{-- Jenis Kelamin --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select name="gender" id="gender" class="form-select" data-parsley-required="true"
                                    data-parsley-required-message="Bidang ini wajib di isi!">
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- Alamat --}}
                    <div class="form-group">
                        <label for="address">Alamat Lengkap</label>
                        <textarea name="address" id="address" cols="30" rows="2" class="form-control" data-parsley-required="true"
                            data-parsley-required-message="Bidang ini wajib di isi!" placeholder="Masukan Alamat Lengkap">{{ old('address') }}</textarea>
                    </div>
                    <div class="row">
                        {{-- Level Siswa --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="level_id">Level</label>
                                <select name="level_id" id="level_id" class="choices form-select"
                                    data-parsley-required="true" data-parsley-required-message="Bidang ini wajib di isi!">
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->level_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- Kelas --}}
                            <div class="form-group">
                                <label for="class_id">Kelas</label>
                                <select name="class_id" id="class_id" class="choices form-select"
                                    data-parsley-required="true" data-parsley-required-message="Bidang ini wajib di isi!">
                                    @foreach ($kelas as $kls)
                                        <option value="{{ $kls->id }}">{{ $kls->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <a href="" class="btn btn-danger">Batal</a>
                        <button type="submit" onclick="validate()" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
