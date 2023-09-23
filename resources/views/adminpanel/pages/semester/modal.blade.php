{{-- Tambah Semester Modal --}}
<div class="modal fade" id="tambahSemesterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Semester Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('semester.store') }}" method="POST" data-parsley-validate>
                    @csrf
                    <div class="form-group row">
                        <label for="ta_id" class="col-form-label col-sm-2">Tahun Ajaran</label>
                        <div class="col-sm-10">
                            <select name="ta_id" id="ta_id" class="form-control" data-parsley-required="true"
                                data-parsley-required-message="Pilih Tahun Ajaran!">
                                <option disabled selected hidden>Pilih Tahun Ajaran</option>
                                @foreach ($tahunAjaran as $ta)
                                    <option value="{{ $ta->id }}">{{ $ta->ta_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semester_name" class="col-form-label col-sm-2">Nama Semester</label>
                        <div class="col-sm-10">
                            <input type="text" name="semester_name" id="semester_name" class="form-control"
                                placeholder="Masukan Nama Semester" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start_date" class="col-form-label col-sm-2">Tanggal Mulai</label>
                        <div class="col-sm-10">
                            <input type="date" name="start_date" id="start_date" class="form-control"
                                data-parsley-required="true" data-parsley-required-message="Bidang ini wajib di isi!">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="close_date" class="col-form-label col-sm-2">Tanggal Selesai</label>
                        <div class="col-sm-10">
                            <input type="date" name="close_date" id="close_date" class="form-control"
                                data-parsley-required="true" data-parsley-required-message="Bidang ini wajib di isi!">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
