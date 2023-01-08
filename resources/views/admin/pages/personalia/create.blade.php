<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createLabel">Tambah Personalia Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('master-personalia.store') }}">
            @csrf
            @method('POST')
            <div class="modal-body">
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" name="status" required>
                </div>
                <label for="gaji_perday">Gaji/Hari</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Rp</span>
                    </div>
                    <input type="text" class="form-control" id="gaji_perday" name="gaji_perday" required>
                </div>
                <div class="form-group">
                    <label for="master_jabatan_id">Jabatan</label>
                    <select name="master_jabatan_id" id="master_jabatan_id" class="form-control">
                      @foreach ($jabatan as $item)
                      <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="master_division_id">Divisi</label>
                    <select name="master_division_id" id="master_division_id" class="form-control">
                      @foreach ($divisi as $item)
                      <option value="{{ $item->id }}">{{ $item->nama_divisi }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>