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
                <li>Detail Anggota</li>
            </ol>
            <h1>Cek Simpanan <?php echo $anggota['nama'];?> <!-- <a class="btn btn-default" href=""><i class="glyphicon glyphicon-print"></i> Cetak</a> --></h1>
            <?php $this->load->view('anggota/detailAnggota',$data['anggota']=$anggota)?>
            <hr/>
            <ul class="nav nav-tabs">
                <li id="ceksimpanan"><a href="<?php echo site_url('cek/ceksimpanan/'.$anggota['no_anggota'])?>">Simpanan</a></li>
                <li id="cekpinjaman"><a href="<?php echo site_url('cek/cekpinjaman/'.$anggota['no_anggota'])?>">Pinjaman</a></li>
            </ul>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <!--detail simpanan-->
                    <h4>Detail Simpanan</h4>
                    <?php if(!empty($simpanan)){?>
                    <!--end of detail simpanan-->
                    <table class="table table-striped">
                        <tr>
                            <td><strong>No Simpanan</strong></td>
                            <td><?php echo $simpanan['id_simpanan'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Tgl Buat Simpanan</strong></td>
                            <td><?php echo $simpanan['tgl_simpan'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Saldo</strong></td>
                            <td>Rp<?php echo number_format($saldo);?>,-</td>
                        </tr>
                    </table>
                    <?php } else {?>
                    <?php echo 'belum punya simpanan <a class="btn btn-primary" href="'.site_url('dashboard/buatsimpanan/'.$this->uri->segment(3)).'"> + Buat Simpanan</a>';}?>
                </div>
            </div>
            <!-- /.container-fluid -->
            <br/>
            <h4>Mutasi Simpanan</h4>
            <a href="#tambahsetoran" data-toggle="modal" class="btn btn-primary">+ Setoran</a> <a href="#tambahpenarikan" data-toggle="modal" class="btn btn-primary">+ Penarikan</a>
            <br/><br/>
            <table class="table table-striped">
                <tr>
                    <th>tanggal</th>
                    <th>jenis</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                <?php
                foreach($mutasi as $m):
                    echo '<tr>';
                    echo '<td>'.$m['tgl'].'</td>';
                    echo '<td>'.$m['status'].'</td>';
                    echo '<td>Rp'.number_format($m['jumlah']).',-</td>';
                    echo '<td><a onclick="return confirm(\'yakinkan dulu\')" class="btn btn-danger btn-xs" href="'.site_url('cek/delAksiSimpanan/'.$m['id_aksi']).'">hapus</a></td>';
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
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('cek/addAksiSimpanan')?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah Setoran</h4>
                </div>
                <div class="modal-body">
                    <!-- start form -->
                    <label>Id Simpanan</label>
                    <input class="form-control" type="text" name="inputidsimpanan" value="<?php echo $simpanan['id_simpanan'];?>" required>
                    <br/>
                    <label>Jumlah<small>masukan tanpa titik</small></label>
                    <input class="form-control" type="number" name="inputjumlah" value="0" required>
                    <br/>
                    <label>Type</label>
                    <select name="inputtype" id="" class="form-control">
                        <option value="setoran">setoran</option>
                        <option value="penarikan">penarikan</option>
                    </select>
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

<!-- start modal -->
<!-- Modal -->
<div class="modal fade" id="tambahpenarikan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('cek/addAksiSimpanan')?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah Penarikan</h4>
                </div>
                <div class="modal-body">
                    <!-- start form -->
                    <label>Id Simpanan</label>
                    <input class="form-control" type="text" name="inputidsimpanan" value="<?php echo $simpanan['id_simpanan'];?>" required>
                    <br/>
                    <label>Jumlah<small>masukan tanpa titik</small></label>
                    <input class="form-control" type="number" name="inputjumlah" value="0" required>
                    <br/>
                    <label>Type</label>
                    <select name="inputtype" id="" class="form-control">
                        <option value="penarikan">penarikan</option>
                        <option value="setoran">setoran</option>
                    </select>
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
