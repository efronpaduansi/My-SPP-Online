{{-- Tambah Tahun Ajaran Modal --}}
<div class="modal fade" id="tambahTahunAjaranModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Tahun Ajaran Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ta.store') }}" method="POST" data-parsley-validate>
                    @csrf
                    <div class="form-group row">
                        <label for="ta_name" class="col-form-label col-sm-2">Tahun Ajaran</label>
                        <div class="col-sm-10">
                            <input type="text" name="ta_name" id="ta_name" class="form-control"
                                placeholder="Contoh: Ganjil 2023/2024" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!">
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
