<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createLabel">Ajukan Izin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('izin.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal-body">
                <div class="form-group">
                    <label for="tanggal_izin">Tanggal Izin</label>
                    <input type="date" class="form-control" id="tanggal_izin" name="tanggal_izin" required>
                </div>
                <div class="form-group">
                    <label for="jenis_izin">Jenis Izin</label>
                    <select id="jenis_izin" name="jenis_izin" class="form-control" required>
                      <option value="sakit">sakit</option>
                      <option value="sakit">cuti</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                </div>
                <div class="form-group">
                    <label for="file_bukti">Bukti</label>
                    <input type="file" class="form-control" id="file_bukti" name="file_bukti" required>
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