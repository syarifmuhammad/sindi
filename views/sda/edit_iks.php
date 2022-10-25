<script type="text/javascript">
function save() {
    // console.log($('input'))
    // var field = {}
    // var input = $('input, select')
    // for(let i=0; i< input.length; i++){
    //     var id = input[i]
    //     field[id.id] = id.value
    // }
	_H.Loading( true );
	$.post(_BASE_URL + 'sda/irigasi_rawa/edit_iks/?'+$('form').serialize(), {}, function(response) {
		_H.Loading( false );
		var res = _H.StrToObject( response );
		if (res.status == 'success') {
			_H.Notify(res.status, _H.Message(res.message));
			parent.jQuery.fancybox.getInstance().close();
		} else {
			_H.Notify(res.status, _H.Message(res.message));
		}
	});
    
    // inputs = JSON.parse('{"' + decodeURI(inputs).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}')
    // console.log(inputs['1']['kondisi_baik'])
}
</script>
<section class="content irigasi">
    <form role="form"">
        <input type="hidden" id="id" value="<?=$irigasi[0]->id?>" name="id">
        <h4 style="font-weight:bold;">Data Irigasi </h4>
        <hr>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;">Umum</h5>
            <hr>
            <label for="nama_daerah_irigasi">Nama Daerah Irigasi</label>
            <p><?=$irigasi[0]->nomenklatur?></p>
        </div>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;">Luas Areal Irigasi (Ha)</h5>
            <hr>
            <label for="luas">Berdasarkan Permen 14/2015</label>
            <p><?=$irigasi[0]->luas?> Ha</p>
            <label for="fungsional">Sawah/ Fungsional (Pemetaan IGT)</label>
            <p><?=$irigasi[0]->fungsional?> Ha</p>
            
        </div>
        <h4 style="font-weight:bold;">Kondisi Fisik Jaringan Irigasi</h4>
        <hr>
        <?php $i=0; foreach($jaringan_irigasi as $data){ ?>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;">Kondisi Baik <?=$data->jenis?></h5>
            <hr>
            <?php foreach($data->jaringan_irigasi as $data2){ ?>
                <input type="hidden" value="<?=$data2->id?>" name="jaringan_irigasi[<?=$i?>][id]">
                <label for="<?=$data2->name_form?>"><?=$data2->nama?> (%)</label>
                <input value="<?=$data2->kondisi_baik?>" min="0" max="100" type="number" name="jaringan_irigasi[<?=$i?>][kondisi_baik]" class="form-control" placeholder="<?=$data2->nama?>">
            <?php $i++; } ?>
        </div>
        <?php } ?>
        <h4 style="font-weight:bold;">Indeks Kinerja Sistem Irigasi</h4>
        <hr>
        <div class="form-group mb-4">
            <label for="iks_prasarana">Prasarana Fisik Maks(45%)</label>
            <input value="<?=$irigasi[0]->iks_prasarana?>" min="0" max="45" type="number" name="iks_prasarana" class="form-control" placeholder="Prasarana Fisik Maks(45%)">
           
            <label for="iks_produktivitas">Produktivitas (Padi) Maks(15%)</label>
            <input value="<?=$irigasi[0]->iks_produktivitas?>" min="0" max=15" type="number" name="iks_produktivitas" class="form-control" placeholder="Produktivitas (Padi) Maks(15%)">
           
            <label for="iks_penunjang">Sarana Penunjang Maks(10%)</label>
            <input value="<?=$irigasi[0]->iks_penunjang?>" min="0" max="10" type="number" name="iks_penunjang" class="form-control" placeholder="Sarana Penunjang Maks(10%)">
           
            <label for="iks_organisasi">Organisasi Personalia Maks(15%)</label>
            <input value="<?=$irigasi[0]->iks_organisasi?>" min="0" max="15" type="number" name="iks_organisasi" class="form-control" placeholder="Organisasi Personalia(15%)">
           
            <label for="iks_dokumentasi">Dokumentasi Maks(5%)</label>
            <input value="<?=$irigasi[0]->iks_dokumentasi?>" min="0" max="5" type="number" name="iks_dokumentasi" class="form-control" placeholder="Dokumentasi Maks(5%)">
            
            <label for="iks_pppa">P3A/GP3A/IP3A Maks(10%)</label>
            <input value="<?=$irigasi[0]->iks_pppa?>" min="0" max="10" type="number" name="iks_pppa" class="form-control" placeholder="P3A/GP3A/IP3A Maks(10%)">
        </div>
        <h4 style="font-weight:bold;">Keterangan</h4>
        <hr>
        <div class="form-group mb-4">
            <textarea class="form-control" name="keterangan" id="keterangan"><?=$irigasi[0]->keterangan?></textarea>
        </div>
        <button type="button" class="btn btn-secondary" onclick="parent.jQuery.fancybox.getInstance().close()">Close</button>
        <button type="button" onclick="save()" class="btn btn-primary">Save changes</button>
    </form>
</section>