@extends('layouts.adminpanel')

@section('title')
    Edit Staff
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('staff.update', $staff->id) }}" method="POST" data-parsley-validate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Masukan Nama Staff" value="{{ $staff->name }}" required
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Masukan Email Address" value="{{ $staff->email }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select name="role_id" id="role_id" class="choices form-select" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Kata Sandi</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukan Kata Sandi">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="passConf">Konfirmasi Kata Sandi</label>
                                    <input type="password" name="passConf" id="passConf" class="form-control"
                                        placeholder="Masukan Konfirmasi Kata Sandi">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <a href="{{ route('staff.index') }}" class="btn btn-danger me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
