<script type="text/javascript">
function save() {
    var field = {}
    var input = $('input, select')
    for(let i=0; i< input.length; i++){
        var id = input[i]
        field[id.id] = id.value
    }
	_H.Loading( true );
	$.post(_BASE_URL + 'sda/embung_pal/insert_ajax', field, function(response) {
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
    <input type="hidden" id="id" value="<?=$embung_pal[0]->id?>" name="id">
    <h4 style="font-weight:bold;">Data Embung & PAL</h4>
        <hr>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;">Umum</h5>
            <hr>
            <label for="nama_bangunan">Nama Bangunan</label>
            <input value="<?=$embung_pal[0]->nama_bangunan?>" type="text" name="nama_bangunan" class="form-control" id="nama_bangunan" placeholder="Nama Bangunan">
            <label for="tahun_dibangun">Tahun Dibangun</label>
            <input value="<?=$embung_pal[0]->tahun_dibangun?>" type="text" name="tahun_dibangun" class="form-control" id="tahun_dibangun" placeholder="Tahun Dibangun">
            <label for="pengelola">Pengelola</label>
            <input value="<?=$embung_pal[0]->pengelola?>" type="text" name="pengelola" class="form-control" id="pengelola" placeholder="Pengelola">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan">
                <?=$embung_pal[0]->keterangan?>
            </textarea>
            
        </div>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;">Lokasi Embung & PAL</h5>
            <hr>
            <label for="wilayah_sungai">Wilayah Sungai</label>
            <input value="<?=$embung_pal[0]->wilayah_sungai?>" type="text" name="wilayah_sungai" class="form-control" id="wilayah_sungai" placeholder="Wilayah Sungai">
            <label for="das">DAS</label>
            <input value="<?=$embung_pal[0]->das?>" type="text" name="das" class="form-control" id="das" placeholder="DAS">
            <label for="sungai">Sungai</label>
            <input value="<?=$embung_pal[0]->sungai?>" type="text" name="sungai" class="form-control" id="sungai" placeholder="Sungai">
            <label for="kab_kec">Kab/Kec</label>
            <input value="<?=$embung_pal[0]->kab_kec?>" type="text" name="kab_kec" class="form-control" id="kab_kec" placeholder="Kab/Kec">
            <label for="lat">Kordinat X</label>
            <input value="<?=$embung_pal[0]->lat?>" type="text" name="lat" class="form-control" id="lat" placeholder="Kordinat X">
            <label for="lng">Kordinat Y</label>
            <input value="<?=$embung_pal[0]->lng?>" type="text" name="lng" class="form-control" id="lng" placeholder="Kordinat Y">
        </div>
        <div class="form-group mb-4">
            <h4 style="font-weight:bold;">Fisik Embung & PAL</h4>
            <hr>
            <label for="luas_genangan">Luas Genangan Muka Air Normal (Ha)</label>
            <input value="<?=$embung_pal[0]->luas_genangan?>" step="0.01" type="number" name="luas_genangan" class="form-control" id="luas_genangan" placeholder="Luas Genangan Muka Air Normal (Ha)">
            <label for="air_baku">Air Baku (M3/dt)</label>
            <input value="<?=$embung_pal[0]->air_baku?>" step="0.01" type="number" name="air_baku" class="form-control" id="air_baku" placeholder="Air Baku (M3/dt)">
            <label for="irigasi">Irigasi (Ha)</label>
            <input value="<?=$embung_pal[0]->irigasi?>" step="0.01" type="number" name="irigasi" class="form-control" id="irigasi" placeholder="Irigasi (Ha)">
            <label for="reduksi_banjir">Reduksi Banjir (M3/dt)</label>
            <input value="<?=$embung_pal[0]->reduksi_banjir?>" step="0.01" type="number" name="reduksi_banjir" class="form-control" id="reduksi_banjir" placeholder="Reduksi Banjir (M3/dt)">
        </div>
        <button type="button" class="btn btn-secondary" onclick="parent.jQuery.fancybox.getInstance().close()">Close</button>
        <button type="button" onclick="save()" class="btn btn-primary">Save changes</button>
    </form>
</section>