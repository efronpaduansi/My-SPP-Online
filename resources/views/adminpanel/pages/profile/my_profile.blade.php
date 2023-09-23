@extends('layouts.adminpanel')

@section('title')
    Profil
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Profil & Pengaturan Akun</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                    role="tab" aria-controls="profile" aria-selected="true"><i class="fas fa-user"></i>
                                    Profil</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password" role="tab"
                                    aria-controls="password" aria-selected="false"><i class="fas fa-key"></i> Kata Sandi</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="setting-tab" data-bs-toggle="tab" href="#setting" role="tab"
                                    aria-controls="setting" aria-selected="false"><i class="fas fa-cog"></i> Pengaturan
                                    Akun</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <p class="my-4">
                                <form action="{{ route('profile.updateProfile', $profile->id) }}" method="POST"
                                    data-parsley-validate>
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ $profile->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    value="{{ $profile->email }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                                </p>
                            </div>
                            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                <p class="my-4">
                                    <strong>Ubah Kata Sandi</strong>
                                <form action="{{ route('profile.updatePassword', $profile->id) }}" method="POST"
                                    data-parsley-validate>
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="oldPass">Kata Sandi Lama</label>
                                            <input type="password" name="oldPass" id="oldPass" class="form-control"
                                                required placeholder="Masukan Kata Sandi Saat ini">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="newPass">Kata Sandi Baru</label>
                                            <input type="password" name="newPass" id="newPass" class="form-control"
                                                required placeholder="Masukan Kata Sandi Baru">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="passConf">Konfirmasi Kata Sandi</label>
                                            <input type="password" name="passConf" id="passConf" class="form-control"
                                                required placeholder="Masukan Konfirmasi Kata Sandi">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary my-3">Simpan</button>
                                </form>
                                </p>
                            </div>
                            <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">
                                <p class="mt-4">
                                    <strong class="text-danger">Danger Zone</strong>
                                <div class="card border border-danger">
                                    <div class="card-body">
                                        <h5 class="text-danger">Hapus Akun</h5>
                                        <p>Dengan menghapus akun, Anda tidak bisa melakukan login kembali ke aplikasi dan
                                            Anda akan diarahkan keluar dari aplikasi.</p>
                                        <form action="{{ route('profile.deleteAccount', $profile->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Anda yakin menghapus akun ini?')">Ya, Saya
                                                Mengerti</button>
                                        </form>
                                    </div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
