
<div class="container">
  <div class="card card-success mb-0">
    <div class="card-header">
      <div>
        <h3 class="text-center">Master Rak</h3>
      </div>
    </div>
  </div>
  <div class="card rounded-0">
    <div class="card-header d-flex justify-content-between align-items-center">
      <div>
        <button id="btnAdd" class="btn btn-primary btn-sm">
          <i class="fas fa-plus"></i> Tambah Rak
        </button>
        <button id="btnReload" class="btn btn-outline-secondary btn-sm ml-2">
          <i class="fas fa-sync"></i> Reload
        </button>
        <button id="btnBulkCapacity" class="btn btn-warning btn-sm ml-2">
          <i class="fas fa-exchange-alt"></i> Ubah Max Capacity (Semua)
        </button>
      </div>
    </div>

    <div class="card-body">
      <table id="tblMasterRak" class="table table-bordered table-striped w-100">
        <thead>
          <tr>
            <th style="width:60px">No.</th>
            <th>Location</th>
            <th>Max Capacity</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Add/Edit -->
<div class="modal fade" id="rakModal" tabindex="-1" role="dialog" aria-labelledby="rakModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="rakForm" autocomplete="off">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rakModalLabel">Tambah Rak</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="rak_id">
            <div class="form-group">
              <label for="location">Location <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="location" id="location" required placeholder="location">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="max_capacity">Max Capacity <span class="text-danger">*</span></label>
              <input type="text" inputmode="decimal" lang="en" step="0.01" min="0" class="form-control" name="max_capacity" id="max_capacity" placeholder="0.00" required>
              <small class="form-text text-muted">Untuk angka desimal gunakan tanda titik (.)</small>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Bulk Update Max Capacity -->
<div class="modal fade" id="bulkCapModal" tabindex="-1" role="dialog" aria-labelledby="bulkCapLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="bulkCapForm" autocomplete="off">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bulkCapLabel">Ubah Max Capacity untuk Semua Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-warning mb-3">
            Tindakan ini akan mengubah <b>seluruh</b> data <code>Master Rak</code>.
          </div>
          <div class="form-group">
            <label for="bulk_max_capacity">Max Capacity Baru <span class="text-danger">*</span></label>
            <input type="text" inputmode="decimal" lang="en" class="form-control" id="bulk_max_capacity" placeholder="0.00" required>
            <small class="form-text text-muted">Untuk angka desimal gunakan tanda titik (.)</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning">Ubah Semua</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
(function initMasterRakLoader(){
  function ready(){
    return window.jQuery && $.fn && $.fn.DataTable && window.Swal;
  }
  if(!ready()){
    return setTimeout(initMasterRakLoader, 50);
  }

  (function() {
    const CRUD_URL = 'pages/ajax/master_rak_crud.php';

    function toastOK(msg){ if(window.toastr) toastr.success(msg||'Berhasil'); else alert(msg||'Berhasil'); }
    function toastERR(msg){ if(window.toastr) toastr.error(msg||'Terjadi kesalahan'); else alert(msg||'Terjadi kesalahan'); }

    const table = $('#tblMasterRak').DataTable({
      processing: true,
      serverSide: false,
      searching: true,
      ordering: true,
      autoWidth: false,
      responsive: true,
      ajax: {
        url: CRUD_URL + '?action=list',
        type: 'POST',
        dataSrc: 'data'
      },
      columns: [
        { data: null, className: 'text-center',
            render: function(data, type, row, meta){ return meta.row + 1; }
        },
        { data: 'location' },
        { data: 'max_capacity', className: 'text-right',
          render: function(val){
            if(val === null || val === undefined) return '';
            return parseFloat(val).toLocaleString(undefined,{minimumFractionDigits:2, maximumFractionDigits:2});
          }
        },
        { data: null, orderable: false, className: 'text-center',
          render: function(row){
            return `
              <button class="btn btn-sm btn-info btnEdit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-danger btnDel ml-1" data-id="${row.id}" data-location="${row.location}"><i class="fas fa-trash"></i></button>
            `;
          }
        }
      ],
    //   order: [[1, 'desc']],
    //   dom: 'Bfrtip',
    //   buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
    });

    // Normalisasi ke angka mentah "1234.56" (terima koma/titik user)
    function toPlainNumber(val) {
        if (val === null || val === undefined) return '';
        let s = String(val).trim();
        if (!s) return '';
        // buang spasi & koma ribuan
        s = s.replace(/\s+/g,'').replace(/,/g,'');
        // izinkan satu titik desimal; jika user pakai koma desimal, ubah ke titik
        // (jaga kasus ".5" -> "0.5")
        s = s.replace(',', '.');
        if (s === '.') return '0.';
        // hapus semua karakter kecuali digit & titik
        s = s.replace(/[^0-9.]/g,'');
        // kalau ada lebih dari satu titik, sisakan yg pertama
        const firstDot = s.indexOf('.');
        if (firstDot !== -1) {
            s = s.slice(0, firstDot + 1) + s.slice(firstDot + 1).replace(/\./g, '');
        }
        // normalisasi leading: "" atau "." sudah ditangani; "00x" dibiarkan (user experience)
        return s;
    }

    // Format tampilan US: ribuan pakai koma, desimal pakai titik (tanpa memaksa 2 desimal)
    function formatNumberUS(val) {
        const plain = toPlainNumber(val);
        if (plain === '' || plain === '.') return '';
        const parts = plain.split('.');
        const intPart = parts[0] || '0';
        const decPart = parts[1] || '';
        const intWithSep = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return decPart ? intWithSep + '.' + decPart : intWithSep;
    }

    function validateAndBuildPayload() {
        const loc = $('#location').val().trim().toUpperCase();
        const cap = toPlainNumber($('#max_capacity').val()); // ← mentah "1234.56"

        if (!loc) { toastERR('Location wajib diisi'); return null; }
        if (cap === '' || isNaN(cap)) { toastERR('Max Capacity tidak valid'); return null; }

        return {
            id: $('#rak_id').val(),
            location: loc,
            max_capacity: cap
        };
    }

    // --- BULK UPDATE MAX CAPACITY ---
    // Buka modal
    $('#btnBulkCapacity').on('click', function(){
      $('#bulk_max_capacity').val('');
      $('#bulkCapModal').modal('show');
    });

    // UX input (mentah saat fokus, rapi saat blur)
    $('#bulk_max_capacity').on('focus', function(){
      this.value = toPlainNumber(this.value);
    });
    $('#bulk_max_capacity').on('input', function(){
      const caret = this.selectionStart;
      const before = this.value;
      const normalized = toPlainNumber(before);
      this.value = normalized;
      if (document.activeElement === this) {
        const diff = this.value.length - before.length;
        this.setSelectionRange(caret + diff, caret + diff);
      }
    });
    $('#bulk_max_capacity').on('blur', function(){
      this.value = formatNumberUS(this.value);
    });

    // Submit bulk
    $('#bulkCapForm').on('submit', function(e){
      e.preventDefault();
      const raw = toPlainNumber($('#bulk_max_capacity').val());
      if (raw === '' || isNaN(raw)) { toastERR('Nilai Max Capacity tidak valid'); return; }

      // Konfirmasi
      Swal.fire({
        title: 'Yakin ubah semua?',
        html: `Max Capacity seluruh data akan diset ke <b>${formatNumberUS(raw)}</b>. Tindakan ini tidak bisa dibatalkan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, ubah semua',
        cancelButtonText: 'Batal'
      }).then((res)=>{
        if(!res.isConfirmed) return;

        const $btn = $('#bulkCapForm button[type="submit"]').prop('disabled', true);
        $.post(CRUD_URL + '?action=bulk_update_capacity', { max_capacity: raw }, function(resp){
          if (resp && resp.success) {
            $('#bulkCapModal').modal('hide');
            toastOK(`Berhasil mengubah ${resp.affected ?? 'semua'} baris`);
            $('#tblMasterRak').DataTable().ajax.reload(null, false);
          } else {
            toastERR(resp && resp.message ? resp.message : 'Gagal mengubah semua data');
          }
        }, 'json').fail(()=>toastERR('Gagal mengubah semua data'))
          .always(()=> $btn.prop('disabled', false));
      });
    });
    // ---End of BULK UPDATE MAX CAPACITY ---

    // Saat masuk ke input: tampilkan mentah (tanpa ribuan) supaya ngetik enak
    $('#max_capacity').on('focus', function(){
        this.value = toPlainNumber(this.value);
        // Optional: select all agar cepat overwrite
        // setTimeout(()=> this.select(), 0);
    });

    // Saat mengetik: jangan kasih ribuan; cukup jaga agar valid "1234.56"
    $('#max_capacity').on('input', function(){
        const caret = this.selectionStart;
        const before = this.value;
        const normalized = toPlainNumber(before);
        this.value = normalized;
        // Pulihkan posisi kursor kira-kira (tidak ada penambahan koma, jadi aman)
        if (document.activeElement === this) {
            const diff = this.value.length - before.length;
            this.setSelectionRange(caret + diff, caret + diff);
        }
        });

        // Saat keluar dari input: tampilkan rapi "1,234.56"
        $('#max_capacity').on('blur', function(){
        this.value = formatNumberUS(this.value);
    });

    $('#btnReload').on('click', () => table.ajax.reload(null, false));
    $('#btnAdd').on('click', function(){
      $('#rakModalLabel').text('Tambah Rak');
      $('#rak_id').val('');
      $('#location').val('');
      $('#max_capacity').val('');
      $('#rakModal').modal('show');
    });
    $('#location').on('input', function(){ this.value = this.value.toUpperCase(); });

    $('#tblMasterRak').on('click', '.btnEdit', function(){
      const id = $(this).data('id');
      $.post(CRUD_URL + '?action=get', {id}, function(resp){
        if(!resp || !resp.success){ toastERR(resp && resp.message ? resp.message : 'Data tidak ditemukan'); return; }
        const d = resp.data;
        $('#rakModalLabel').text('Edit Rak');
        $('#rak_id').val(d.id);
        $('#location').val(d.location);
        $('#max_capacity').val( formatNumberUS(d.max_capacity) );
        $('#rakModal').modal('show');
      }, 'json').fail(()=>toastERR('Gagal mengambil data'));
    });

    $('#tblMasterRak').on('click', '.btnDel', function(){
      const id = $(this).data('id');
      const loc = $(this).data('location');
      Swal.fire({
        title: 'Hapus Rak?',
        html: `Location: <b>${loc}</b><br>Data akan dihapus permanen.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
      }).then((res)=>{
        if(!res.isConfirmed) return;
        $.post(CRUD_URL + '?action=delete', {id}, function(resp){
          if(resp && resp.success){
            toastOK('Data dihapus');
            table.ajax.reload(null, false);
          }else{
            toastERR(resp && resp.message ? resp.message : 'Gagal menghapus');
          }
        }, 'json').fail(()=>toastERR('Gagal menghapus'));
      });
    });

    $('#rakForm').on('submit', function(e){
        e.preventDefault();
        const payload = validateAndBuildPayload();
        if (!payload) return;

        const action = payload.id ? 'update' : 'create';
        $.post(CRUD_URL + '?action=' + action, payload, function(resp){
            if(resp && resp.success){
            $('#rakModal').modal('hide');
            toastOK('Tersimpan');
            $('#tblMasterRak').DataTable().ajax.reload(null, false);
            }else{
            toastERR(resp && resp.message ? resp.message : 'Gagal menyimpan');
            }
        }, 'json').fail(()=>toastERR('Gagal menyimpan'));
    });

  })();
})();
</script>

