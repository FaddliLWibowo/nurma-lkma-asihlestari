<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Data Lengkap Anggota
                </a>
                /
                <a href="<?php echo site_url('dashboard/laporananggota?view=edit&id='.$anggota['no_anggota']);?>">edit data</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-1"><strong>No Anggota</strong></div>
                    <div class="col-sm-11"><?php echo $anggota['no_anggota']?></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><strong>Nama</strong></div>
                    <div class="col-sm-11"><?php echo $anggota['nama']?></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><strong>Alamat</strong></div>
                    <div class="col-sm-11"><?php echo $anggota['alamat']?></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><strong>Kelaminnya</strong></div>
                    <div class="col-sm-11"><?php echo $anggota['jenis_kelamin']?></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><strong>Tempat Lahir</strong></div>
                    <div class="col-sm-11"><?php echo $anggota['tempat_lahir']?></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><strong>Tanggal Lahir</strong></div>
                    <div class="col-sm-11"><?php echo $anggota['tanggal_lahir']?></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><strong>Telepon</strong></div>
                    <div class="col-sm-11"><?php echo $anggota['telepon']?></div>
                </div>
            </div>
        </div>
    </div>
</div>