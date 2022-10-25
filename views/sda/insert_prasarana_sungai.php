<script type="text/javascript">
function save() {
    var field = {}
    var input = $('input, select')
    for(let i=0; i< input.length; i++){
        var id = input[i]
        field[id.id] = id.value
    }
	_H.Loading( true );
	$.post(_BASE_URL + 'sda/prasarana_sungai/insert_ajax', field, function(response) {
		_H.Loading( false );
		var res = _H.StrToObject( response );
		if (res.status == 'success') {
			_H.Notify(res.status, _H.Message(res.message));
			parent.jQuery.fancybox.getInstance().close();
		} else {
			_H.Notify(res.status, _H.Message(res.message));
		}
	});
}
</script>
<section class="content irigasi">
    <form role="form">
    <h4 style="font-weight:bold;">Data Prasarana Sungai</h4>
        <hr>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;">Umum</h5>
            <hr>
            <label for="nama_sungai">Nama Sungai</label>
            <input type="text" name="nama_sungai" class="form-control" id="nama_sungai" placeholder="Nama Sungai">
            <label for="wilayah_sungai">Wilayah Sungai</label>
            <input type="text" name="wilayah_sungai" class="form-control" id="wilayah_sungai" placeholder="Wilayah Sungai">
            <label for="das">DAS</label>
            <input type="text" name="das" class="form-control" id="das" placeholder="DAS">
            <label for="panjang_sungai">Panjang Sungai (Km)</label>
            <input step="0.01" type="number" name="panjang_sungai" class="form-control" id="panjang_sungai" placeholder="Panjang Sungai (Km)">
        </div>
        <div class="form-group mb-4">
            <h4 style="font-weight:bold;">Bangunan Perkuatan Tebing</h4>
            <hr>
            <label for="konstruksi_perkuatan_tebing">Konstruksi</label>
            <input type="text" name="konstruksi_perkuatan_tebing" class="form-control" id="konstruksi_perkuatan_tebing" placeholder="Konstruksi">
            <label for="panjang_perkuatan_tebing">Panjang (m)</label>
            <input step="0.01" type="number" name="panjang_perkuatan_tebing" class="form-control" id="panjang_perkuatan_tebing" placeholder="Panjang (m)">
            <label for="tinggi_perkuatan_tebing">Tinggi (m)</label>
            <input step="0.01" type="number" name="tinggi_perkuatan_tebing" class="form-control" id="tinggi_perkuatan_tebing" placeholder="Tinggi (m)">
            <label for="kondisi_perkuatan_tebing">Kondisi</label>
            <select name="kondisi_perkuatan_tebing" class="form-control" id="kondisi_perkuatan_tebing" placeholder="Kondisi">
                <option value="B">Baik</option>
                <option value="RR">Rusak Ringan</option>
                <option value="RS">Rusak Sedang</option>
                <option value="RB">Rusak Berat</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <h4 style="font-weight:bold;">Tanggul</h4>
            <hr>
            <label for="konstruksi_tanggul">Konstruksi</label>
            <input type="text" name="konstruksi_tanggul" class="form-control" id="konstruksi_tanggul" placeholder="Konstruksi">
            <label for="panjang_tanggul">Panjang (m)</label>
            <input step="0.01" type="number" name="panjang_tanggul" class="form-control" id="panjang_tanggul" placeholder="Panjang (m)">
            <label for="tinggi_tanggul">Tinggi (m)</label>
            <input step="0.01" type="number" name="tinggi_tanggul" class="form-control" id="tinggi_tanggul" placeholder="Tinggi (m)">
            <label for="lebar_tanggul">Lebar (m)</label>
            <input step="0.01" type="number" name="lebar_tanggul" class="form-control" id="lebar_tanggul" placeholder="Lebar (m)">
            <label for="kondisi_tanggul">Kondisi</label>
            <select name="kondisi_tanggul" class="form-control" id="kondisi_tanggul" placeholder="Kondisi">
                <option value="B">Baik</option>
                <option value="RR">Rusak Ringan</option>
                <option value="RS">Rusak Sedang</option>
                <option value="RB">Rusak Berat</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <h4 style="font-weight:bold;">Dam Pengendali Banjir</h4>
            <hr>
            <label for="konstruksi_dam">Konstruksi</label>
            <input type="text" name="konstruksi_dam" class="form-control" id="konstruksi_dam" placeholder="Konstruksi">
            <label for="tinggi_dam">Tinggi (m)</label>
            <input step="0.01" type="number" name="tinggi_dam" class="form-control" id="tinggi_dam" placeholder="Tinggi (m)">
            <label for="lebar_dam">Lebar (m)</label>
            <input step="0.01" type="number" name="lebar_dam" class="form-control" id="lebar_dam" placeholder="Lebar (m)">
            <label for="kondisi_dam">Kondisi</label>
            <select name="kondisi_dam" class="form-control" id="kondisi_dam" placeholder="Kondisi">
                <option value="B">Baik</option>
                <option value="RR">Rusak Ringan</option>
                <option value="RS">Rusak Sedang</option>
                <option value="RB">Rusak Berat</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <h4 style="font-weight:bold;">Pintu Air</h4>
            <hr>
            <label for="konstruksi_pintu_air">Konstruksi</label>
            <input type="text" name="konstruksi_pintu_air" class="form-control" id="konstruksi_pintu_air" placeholder="Konstruksi">
            <label for="kondisi_pintu_air">Kondisi</label>
            <select name="kondisi_pintu_air" class="form-control" id="kondisi_pintu_air" placeholder="Kondisi">
                <option value="B">Baik</option>
                <option value="RR">Rusak Ringan</option>
                <option value="RS">Rusak Sedang</option>
                <option value="RB">Rusak Berat</option>
            </select>
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="save()" class="btn btn-primary">Save changes</button>
    </form>
</section>