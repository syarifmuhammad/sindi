<section class="content irigasi">
    <form action="<?=base_url('sda/irigasi_rawa/update')?>" method="POST">
        <input type="hidden" value="<?=$irigasi[0]->id?>" name="id">
        <h4 style="font-weight:bold;">Data Irigasi </h4>
        <hr>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;">Umum</h5>
            <hr>
            <label for="nama_daerah_irigasi">Nama Daerah Irigasi</label>
            <input value="<?=$irigasi[0]->nomenklatur?>" type="text" name="nomenklatur" class="form-control" id="nama_daerah_irigasi" placeholder="Nama Daerah Irigasi">
            <label for="jenis_daerah_irigasi">Jenis Daerah Irigasi</label>
            <select name="jenis_daerah" class="form-control" id="jenis_daerah_irigasi">
                <option <?=$irigasi[0]->jenis_daerah == "Rawa" ? "selected" : ""?> value="Rawa">Rawa</option>
                <option <?=$irigasi[0]->jenis_daerah == "Permukaan" ? "selected" : ""?> value="Permukaan">Permukaan</option>
            </select>	
        </div>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;">Luas Areal Irigasi (Ha)</h5>
            <hr>
            <label for="luas">Berdasarkan Permen 14/2015</label>
            <input step="0.01" value="<?=$irigasi[0]->luas?>" type="number" name="luas" class="form-control" id="luas" placeholder="Berdasarkan Permen 14/2015">
            <label for="baku">Baku (Pemetaan IGT)</label>
            <input step="0.01" value="<?=$irigasi[0]->baku?>" type="number" name="baku" class="form-control" id="baku" placeholder="Baku (Pemetaan IGT)">
            <label for="potensial">Potensial (Pemetaan IGT)</label>
            <input step="0.01" value="<?=$irigasi[0]->potensial?>" type="number" name="potensial" class="form-control" id="potensial" placeholder="Potensial (Pemetaan IGT)">
            <label for="fungsional">Sawah/ Fungsional (Pemetaan IGT)</label>
            <input step="0.01" value="<?=$irigasi[0]->fungsional?>" type="number" name="fungsional" class="form-control" id="fungsional" placeholder="Sawah/ Fungsional (Pemetaan IGT)">
            
        </div>
        <h4 style="font-weight:bold;">Fisik Jaringan Irigasi</h4>
        <hr>
        <?php $i=0; foreach($jaringan_irigasi as $data){ ?>
        <div class="form-group mb-4">
            <h5 style="font-weight:bold;"><?=$data->jenis?></h5>
            <hr>
            <?php foreach($data->jaringan_irigasi as $data2){ ?>
                <input type="hidden" value="<?=$data2->id?>" name="jaringan_irigasi[<?=$i?>][id]">
                <?php if($data->form=='number') { ?>
                    <label for="<?=$data2->name_form?>"><?=$data2->nama." (". ucfirst($data2->satuan) .")"?></label>
                    <input value="<?=$data2->jumlah?>" step="0.01" type="<?=$data->form?>" name="jaringan_irigasi[<?=$i?>][jumlah]" class="form-control" placeholder="<?=$data2->nama?>">
                <?php }else{ ?>
                    <label for="<?=$data2->name_form?>"><?=$data2->nama?></label>
                    <div style="margin-bottom:10px;">
                    <input <?=$data2->jumlah==1 ? 'checked' : ''?> type="<?=$data->form?>" name="jaringan_irigasi[<?=$i?>][jumlah]" value="1">
                    Ada
                    <input <?=$data2->jumlah==0 ? 'checked' : ''?> type="<?=$data->form?>" name="jaringan_irigasi[<?=$i?>][jumlah]" value="0">
                    Tidak Ada
                    </div>
                <?php } ?>
            <?php $i++; } ?>
        </div>
        <?php } ?>
        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</section>