<script type="text/javascript">
function save() {
	var values = {
		nama_bangunan: $('#nama_bangunan').val(),
		tahun_dibangun: $('#tahun_dibangun').val(),
		pengelola: $('#pengelola').val(),
		keterangan: $('#keterangan').val(),
		wilayah_sungai: $('#wilayah_sungai').val(),
		das: $('#das').val(),
		sungai: $('#sungai').val(),
		kab_kec: $('#kab_kec').val(),
		lat: $('#lat').val(),
		lng: $('#lng').val(),
		luas_genangan: $('#luas_genangan').val(),
		air_baku: $('#air_baku').val(),
		irigasi: $('#irigasi').val(),
		reduksi_banjir: $('#reduksi_banjir').val(),
	};
	_H.Loading( true );
	$.post(_BASE_URL + 'sda/embung_pal/insert_ajax', values, function(response) {
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
    <form role="form" class="embung_pal-form">
    <h4 style="font-weight:bold;">Data Embung & PAL</h4>
        <hr>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;">Umum</h5>
            <hr>
            <label for="nama_bangunan">Nama Bangunan</label>
            <input type="text" name="nama_bangunan" class="form-control" id="nama_bangunan" placeholder="Nama Bangunan">
            <label for="tahun_dibangun">Tahun Dibangun</label>
            <input type="text" name="tahun_dibangun" id="tahun_dibangun" class="form-control" id="tahun_dibangun" placeholder="Tahun Dibangun">
            <label for="pengelola">Pengelola</label>
            <input type="text" name="pengelola" class="form-control" id="pengelola" placeholder="Pengelola">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan"></textarea>
            
        </div>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;">Lokasi Embung & PAL</h5>
            <hr>
            <label for="wilayah_sungai">Wilayah Sungai</label>
            <input type="text" name="wilayah_sungai" class="form-control" id="wilayah_sungai" placeholder="Wilayah Sungai">
            <label for="das">DAS</label>
            <input type="text" name="das" class="form-control" id="das" placeholder="DAS">
            <label for="sungai">Sungai</label>
            <input type="text" name="sungai" class="form-control" id="sungai" placeholder="Sungai">
            <label for="kab_kec">Kab/Kec</label>
            <input type="text" name="kab_kec" class="form-control" id="kab_kec" placeholder="Kab/Kec">
            <label for="lat">Kordinat X</label>
            <input type="text" name="lat" class="form-control" id="lat" placeholder="Kordinat X">
            <label for="lng">Kordinat Y</label>
            <input type="text" name="lng" class="form-control" id="lng" placeholder="Kordinat Y">
        </div>
        <div class="form-group mb-4">
            <h4 style="font-weight:bold;">Fisik Embung & PAL</h4>
            <hr>
            <label for="luas_genangan">Luas Genangan Muka Air Normal (Ha)</label>
            <input step="0.01" type="number" name="luas_genangan" class="form-control" id="luas_genangan" placeholder="Luas Genangan Muka Air Normal (Ha)">
            <label for="air_baku">Air Baku (M3/dt)</label>
            <input step="0.01" type="number" name="air_baku" class="form-control" id="air_baku" placeholder="Air Baku (M3/dt)">
            <label for="irigasi">Irigasi (Ha)</label>
            <input step="0.01" type="number" name="irigasi" class="form-control" id="irigasi" placeholder="Irigasi (Ha)">
            <label for="reduksi_banjir">Reduksi Banjir (M3/dt)</label>
            <input step="0.01" type="number" name="reduksi_banjir" class="form-control" id="reduksi_banjir" placeholder="Reduksi Banjir (M3/dt)">
        </div>
        <button type="button" class="btn btn-secondary" onclick="parent.jQuery.fancybox.getInstance().close();">Close</button>
        <button class="btn btn-primary"  onclick="save(); return false;">Save</button>
    </form>
</section>