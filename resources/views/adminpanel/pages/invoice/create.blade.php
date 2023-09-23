@extends('layouts.adminpanel')

@section('title')
    Tambah Tagihan Baru
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('invoice.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('invoice.preview') }}" method="GET" data-parsley-validate>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_id">Nama Siswa</label>
                                <select name="student_id" id="student_id" class="choices form-select"
                                    data-parsley-required="true" data-parsley-required-message="Bidang ini wajib di isi!">
                                    @foreach ($dataSiswa as $siswa)
                                        <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="semester_id">Semester</label>
                            <select name="semester_id" id="semester_id" class="choices form-select"
                                data-parsley-required="true" data-parsley-required-message="Bidang ini wajib di isi!">
                                @foreach ($dataSemester as $semester)
                                    <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex">
                        <a href="{{ route('invoice.index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Selanjutnya</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
