@extends('layouts.adminpanel')

@section('title')
    Edit Invoice
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('invoice.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('invoice.update', $invoice->id) }}" method="POST" data-parsley-validate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" name="student_id" value="{{ $invoice->student_id }}">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_name">Nama Siswa</label>
                                <input type="text" name="student_name" id="student_name" class="form-control"
                                    value="{{ $invoice->siswa->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" name="semester_id" value="{{ $invoice->semester_id }}">
                            <div class="form-group">
                                <label for="semester_name">Semester</label>
                                <input type="text" name="semester_name" id="semester_name" class="form-control"
                                    value="{{ $invoice->semester->semester_name }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="level_id">Level</label>
                                <input type="text" name="level_id" id="level_id" class="form-control"
                                    value="{{ $invoice->siswa->level->level_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sub_total">Sub Total</label>
                                <input type="number" name="sub_total" id="sub_total" class="form-control"
                                    value="{{ $invoice->sub_total }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount">Diskon</label>
                                <input type="number" name="discount" id="discount" class="form-control"
                                    value="{{ $invoice->discount }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="date" name="date" id="date" class="form-control"
                                    value="{{ $invoice->date }}">
                            </div>
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
