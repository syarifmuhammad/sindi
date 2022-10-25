<script type="text/javascript">
function save() {
    var field = {}
    var input = $('input, select')
    for(let i=0; i< input.length; i++){
        var id = input[i]
        field[id.id] = id.value
    }
	_H.Loading( true );
	$.post(_BASE_URL + 'sda/pelindung_pantai/insert_ajax', field, function(response) {
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
    <input type="hidden" id="id" value="<?=$pelindung_pantai[0]->id?>" name="id">
    <h4 style="font-weight:bold;">Data Pelindung Pantai</h4>
        <hr>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;">Umum</h5>
            <hr>
            <label for="nama_pantai">Nama Pantai</label>
            <input value="<?=$pelindung_pantai[0]->nama_pantai?>" type="text" name="nama_pantai" class="form-control" id="nama_pantai" placeholder="Nama Pantai">
            <label for="wilayah_sungai">Wilayah Sungai</label>
            <input value="<?=$pelindung_pantai[0]->wilayah_sungai?>" type="text" name="wilayah_sungai" class="form-control" id="wilayah_sungai" placeholder="Wilayah Sungai">
            <label for="panjang_pantai">Panjang Pantai (Km)</label>
            <input  value="<?=$pelindung_pantai[0]->panjang_pantai?>" step="0.01" type="number" name="panjang_pantai" class="form-control" id="panjang_pantai" placeholder="Panjang Pantai">
            <label for="panjang_rawan_abrasi">Panjang Pantai Rawan Abrasi (Km)</label>
            <input step="0.01" value="<?=$pelindung_pantai[0]->panjang_rawan_abrasi?>" type="number" name="panjang_rawan_abrasi" class="form-control" id="panjang_rawan_abrasi" placeholder="Panjang Pantai Rawan Abrasi (Km)">
        </div>
        <div class="form-group mb-4">
            <h4 style="font-weight:bold;">Bangunan Seawall</h4>
            <hr>
            <label for="konstruksi_seawall">Konstruksi</label>
            <input value="<?=$pelindung_pantai[0]->konstruksi_seawall?>" type="text" name="konstruksi_seawall" class="form-control" id="konstruksi_seawall" placeholder="Konstruksi">
            <label for="panjang_seawall">Panjang (m)</label>
            <input value="<?=$pelindung_pantai[0]->panjang_seawall?>" step="0.01" type="number" name="panjang_seawall" class="form-control" id="panjang_seawall" placeholder="Panjang (m)">
            <label for="tinggi_seawall">Tinggi (m)</label>
            <input value="<?=$pelindung_pantai[0]->tinggi_seawall?>" step="0.01" type="number" name="tinggi_seawall" class="form-control" id="tinggi_seawall" placeholder="Tinggi (m)">
            <label for="kondisi_seawall">Kondisi</label>
            <select name="kondisi_seawall" class="form-control" id="kondisi_seawall" placeholder="Kondisi">
                <option <?=$pelindung_pantai[0]->kondisi_seawall=='B' ? 'selected' : ''?> value="B">Baik</option>
                <option <?=$pelindung_pantai[0]->kondisi_seawall=='RR' ? 'selected' : ''?> value="RR">Rusak Ringan</option>
                <option <?=$pelindung_pantai[0]->kondisi_seawall=='RS' ? 'selected' : ''?> value="RS">Rusak Sedang</option>
                <option <?=$pelindung_pantai[0]->kondisi_seawall=='RB' ? 'selected' : ''?> value="RB">Rusak Berat</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <h4 style="font-weight:bold;">Breakwater</h4>
            <hr>
            <label for="konstruksi_breakwater">Konstruksi</label>
            <input value="<?=$pelindung_pantai[0]->konstruksi_breakwater?>" type="text" name="konstruksi_breakwater" class="form-control" id="konstruksi_breakwater" placeholder="Konstruksi">
            <label for="panjang_breakwater">Panjang (m)</label>
            <input value="<?=$pelindung_pantai[0]->panjang_breakwater?>" step="0.01" type="number" name="panjang_breakwater" class="form-control" id="panjang_breakwater" placeholder="Panjang (m)">
            <label for="tinggi_breakwater">Tinggi (m)</label>
            <input value="<?=$pelindung_pantai[0]->tinggi_breakwater?>" step="0.01" type="number" name="tinggi_breakwater" class="form-control" id="tinggi_breakwater" placeholder="Tinggi (m)">
            <label for="lebar_breakwater">Lebar (m)</label>
            <input value="<?=$pelindung_pantai[0]->lebar_breakwater?>" step="0.01" type="number" name="lebar_breakwater" class="form-control" id="lebar_breakwater" placeholder="Lebar (m)">
            <label for="kondisi_breakwater">Kondisi</label>
            <select name="kondisi_breakwater" class="form-control" id="kondisi_breakwater" placeholder="Kondisi">
                <option <?=$pelindung_pantai[0]->kondisi_breakwater=='B' ? 'selected' : ''?> value="B">Baik</option>
                <option <?=$pelindung_pantai[0]->kondisi_breakwater=='RR' ? 'selected' : ''?> value="RR">Rusak Ringan</option>
                <option <?=$pelindung_pantai[0]->kondisi_breakwater=='RS' ? 'selected' : ''?> value="RS">Rusak Sedang</option>
                <option <?=$pelindung_pantai[0]->kondisi_breakwater=='RB' ? 'selected' : ''?> value="RB">Rusak Berat</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <h4 style="font-weight:bold;">Groin</h4>
            <hr>
            <label for="konstruksi_groin">Konstruksi</label>
            <input value="<?=$pelindung_pantai[0]->konstruksi_groin?>" type="text" name="konstruksi_groin" class="form-control" id="konstruksi_groin" placeholder="Konstruksi">
            <label for="tinggi_groin">Tinggi (m)</label>
            <input value="<?=$pelindung_pantai[0]->tinggi_groin?>" step="0.01" type="number" name="tinggi_groin" class="form-control" id="tinggi_groin" placeholder="Tinggi (m)">
            <label for="lebar_groin">Lebar (m)</label>
            <input value="<?=$pelindung_pantai[0]->lebar_groin?>" step="0.01" type="number" name="lebar_groin" class="form-control" id="lebar_groin" placeholder="Lebar (m)">
            <label for="kondisi_groin">Kondisi</label>
            <select name="kondisi_groin" class="form-control" id="kondisi_groin" placeholder="Kondisi">
                <option <?=$pelindung_pantai[0]->kondisi_groin=='B' ? 'selected' : ''?> value="B">Baik</option>
                <option <?=$pelindung_pantai[0]->kondisi_groin=='RR' ? 'selected' : ''?> value="RR">Rusak Ringan</option>
                <option <?=$pelindung_pantai[0]->kondisi_groin=='RS' ? 'selected' : ''?> value="RS">Rusak Sedang</option>
                <option <?=$pelindung_pantai[0]->kondisi_groin=='RB' ? 'selected' : ''?> value="RB">Rusak Berat</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <h4 style="font-weight:bold;">Jetty</h4>
            <hr>
            <label for="konstruksi_jetty">Konstruksi</label>
            <input value="<?=$pelindung_pantai[0]->konstruksi_jetty?>" type="text" name="konstruksi_jetty" class="form-control" id="konstruksi_jetty" placeholder="Konstruksi">
            <label for="panjang_jetty">Panjang (m)</label>
            <input value="<?=$pelindung_pantai[0]->panjang_jetty?>" step="0.01" type="number" name="panjang_jetty" class="form-control" id="panjang_jetty" placeholder="Panjang (m)">
            <label for="kondisi_jetty">Kondisi</label>
            <select name="kondisi_jetty" class="form-control" id="kondisi_jetty" placeholder="Kondisi">
                <option <?=$pelindung_pantai[0]->kondisi_jetty=='B' ? 'selected' : ''?> value="B">Baik</option>
                <option <?=$pelindung_pantai[0]->kondisi_jetty=='RR' ? 'selected' : ''?> value="RR">Rusak Ringan</option>
                <option <?=$pelindung_pantai[0]->kondisi_jetty=='RS' ? 'selected' : ''?> value="RS">Rusak Sedang</option>
                <option <?=$pelindung_pantai[0]->kondisi_jetty=='RB' ? 'selected' : ''?> value="RB">Rusak Berat</option>
            </select>
        </div>
        <button type="button" class="btn btn-secondary" onclick="parent.jQuery.fancybox.getInstance().close()">Close</button>
        <button type="button" onclick="save()" class="btn btn-primary">Save changes</button>
    </form>
</section>