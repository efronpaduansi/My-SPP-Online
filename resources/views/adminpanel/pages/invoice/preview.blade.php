@extends('layouts.adminpanel')

@section('title')
    Tambah Tagihan Baru
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('invoice.create') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('invoice.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_id" class="col-form-label col-sm-4">Nama Siswa</label>
                                <select name="student_id" id="student_id" class="form-select" readonly>
                                    <option value="{{ $getDetailSiswa->id }}">{{ $getDetailSiswa->name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="semester_id" class="col-form-label col-sm-4">Semester</label>
                                <select name="semester_id" id="semester_id" class="form-select" readonly>
                                    <option value="{{ $getDataSemester->id }}">{{ $getDataSemester->semester_name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="level_id" class="col-form-label col-sm-4">Level</label>
                                <input type="text" name="level_id" id="level_id" class="form-control"
                                    value="{{ $getDetailSiswa->level->level_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sub_total" class="col-form-label col-sm-4">Sub Total</label>
                                <input type="text" name="sub_total" id="sub_total" class="form-control"
                                    value="{{ $getDetailSiswa->level->start_nominal }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="discount_type">Tipe Diskon</label>
                                <select name="discount_type" id="discount_type" class="form-select">
                                    <option value="0">Pilih</option>
                                    <option value="1">Diskon Anak Guru</option>
                                </select>
                                <p id="diskon_anak_guru" class="mt-1 text-success">Potongan sebesar: 50% per anak</p>
                            </div>
                        </div>
                        <div class="col-md-4" id="discount_form">
                            <div class="form-group">
                                <label for="discount" class="col-form-label col-sm-4">Diskon</label>
                                <input type="text" name="discount" id="discount" class="form-control"
                                    value="{{ $discount }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date" class="col-form-label col-sm-4">Tanggal</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <a href="{{ route('invoice.index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('customjs')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var elemen = document.getElementById("diskon_anak_guru");
            elemen.style.display = "none";
        });

        $('#discount_type').change(function() {
            if ($('#discount_type').val() == 1) {
                $('#discount_form').hide();
                $('#diskon_anak_guru').show();
            } else {
                $('#discount_form').show();
                $('#diskon_anak_guru').hide();
            }
        });
    </script>
@endpush
