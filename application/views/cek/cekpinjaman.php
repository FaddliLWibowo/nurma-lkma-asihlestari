<!-- JNT0000OOU*** -->
<div id="wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- top navbar -->
    <?php $this->load->view('base/navbar');?>
    <!-- end of top navbar -->

    <div id="page-wrapper">

        <div class="container-fluid">

            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?php echo site_url('dashboard/laporananggota')?>">Laporan Anggota</a></li>
                <li>Pinjaman</li>
            </ol>
            <h1>Cek Pinjaman <?php echo $anggota['nama'];?></h1>
            <?php $this->load->view('anggota/detailAnggota',$data['anggota']=$anggota)?>
            <hr/>
            <ul class="nav nav-tabs">
                <li id="ceksimpanan"><a href="<?php echo site_url('cek/ceksimpanan/'.$anggota['no_anggota'])?>">Simpanan</a></li>
                <li id="cekpinjaman"><a href="<?php echo site_url('cek/cekpinjaman/'.$anggota['no_anggota'])?>">Pinjaman</a></li>
            </ul>
            <br/>
            <!-- /.container-fluid -->
            <br/>
            <h4>Daftar Pinjaman</h4>
            <a href="#tambahsetoran" data-toggle="modal" class="btn btn-primary">+ Pinjaman</a>
            <br/><br/>
            <table class="table table-striped">
                <tr>
                    <th>Id Pinjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Besar Pinjaman (Rp)</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                <?php
                   foreach($pinjaman as $p):
                    echo '<tr>';
                    echo '<td>'.$p['id_pinjaman'].'</td>';
                    echo '<td>'.$p['tgl_pinjam'].'</td>';
                    echo '<td>'.$p['jatuh_tempo'].'</td>';
                    echo '<td>Rp'.number_format($p['besar_pinjaman']).',-</td>';
                    echo '<td>'.$p['status'].'</td>';
                    echo '<td> <a class="btn btn-default btn-xs" href="'.site_url('cek/detailpinjaman/'.$p['id_pinjaman']).'">detail</a> <a onclick="return confirm(\'yakinkan dulu\')" class="btn btn-danger btn-xs" href="'.site_url('cek/hapuspinjaman/'.$p['id_pinjaman']).'">hapus</a></td>';
                    echo '</tr>';
                    endforeach;
                ?>
            </table>
            <br/>
            <center><?php echo $page; ?></center>
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>

<!-- start modal -->
<!-- Modal -->
<div class="modal fade" id="tambahsetoran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('cek/addPinjaman/'.$this->uri->segment(3))?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah Pinjaman</h4>
                </div>
                <div class="modal-body">
                    <!-- start form -->
                    <h4>Data Pinjaman</h4>
                    <label>Besar Pinjaman (Rp)<br/> <small>masukan tanpa tanda titik</small></label>
                    <input class="form-control" name="inputjumlah" type="number" required>
                    <br/>
                    <label>Jatuh Tempo<br/> <small>default 1 tahun dari tanggal sekarang</small></label>
                    <?php 
                    $nextN = mktime(0, 0, 0, date("m"), date("d"), date("Y")+1);//1 tahun berikutnya
                    $nextyear = date("d-m-Y", $nextN);
                    ?>
                    <input class="form-control" id="adddate" name="inputjatuhtempo" type="text"  value="<?php echo $nextyear?>" required>   
                    <hr/>
                    <h4>Data Jaminan</h4>
                    <label>Jenis Jaminan</label>
                    <input class="form-control" name="inputjaminan_jenis" type="text" required>
                    <br/>
                    <label>Nama Pemilik Jaminan</label>
                    <input class="form-control" name="inputjaminan_pemilik" type="text" required>
                    <br/>
                    <label>Alamat Pemilik Jaminan</label>
                    <textarea class="form-control" name="inputjaminan_alamat" required></textarea>
                    <br/>
                    <label>Keterangan Jaminan</label>
                    <textarea class="form-control" name="inputjaminan_keterangan" required></textarea>
                    <br/>
                    <!-- end form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end of modal -->
