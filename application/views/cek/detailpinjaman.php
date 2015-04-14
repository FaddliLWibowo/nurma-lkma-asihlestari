<script type="text/javascript">
    function cekTotalAngsur()
    {
        var pokok = parseInt($('#inputangsuranpokok').val());
        var denda = parseInt($('#inputdenda').val());
        var totaldenda = parseInt(pokok + (pokok*denda));
        var totalangsur = parseInt(totaldenda + (pokok*0,0125));
        $('#totalangsur').val(totalangsur);
    }
</script>
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
                <li>Detail Pinjaman</li>
            </ol>
            <h1>Cek Pinjaman <?php echo $anggota['nama'];?> <!-- <a class="btn btn-default" href=""><i class="glyphicon glyphicon-print"></i> Cetak</a> --></h1>
            <?php $this->load->view('anggota/detailAnggota',$data['anggota']=$anggota)?>
            <hr/>
            <a class="btn btn-default" href="<?php echo site_url('cek/cekpinjaman/'.$anggota['no_anggota'])?>"><- Kembali Ke Daftar Pinjaman</a>
            <br/><br/><br/>
            <ul class="nav nav-tabs">
                <li id="ceksimpanan"><a href="<?php echo site_url('cek/ceksimpanan/'.$anggota['no_anggota'])?>">Simpanan</a></li>
                <li id="cekpinjaman"><a href="<?php echo site_url('cek/cekpinjaman/'.$anggota['no_anggota'])?>">Pinjaman</a></li>
            </ul>
            <br/>
            <!-- /.container-fluid -->
            <br/>
            <h4>Detail Pinjaman <a data-toggle="modal" href="#editpinjaman">edit</a></h4>
            <table class="table table-striped">
                <tr>
                    <td>Id Pinjaman</td><td><?php echo $pinjaman['id_pinjaman']?></td>
                </tr>
                <tr>
                    <td>Tanggal Pinjam</td><td><?php echo $pinjaman['tgl_pinjam']?></td>
                </tr>
                <tr>
                    <td>Jatuh Tempo Terakhir</td><td><?php echo $pinjaman['jatuh_tempo']?></td>
                </tr>
                <tr>
                    <td>Total Pinjaman</td><td>Rp<?php echo number_format($pinjaman['besar_pinjaman'])?>,-</td>
                </tr>
                <tr>
                    <td>Total Terbayar</td><td>Rp<?php echo number_format($terbayar)?>,-</td>
                </tr>
                <?php
                //menghitung total bulan antara tanggal pinjaman dan jatuh tempo
                $today = date_create(date('Y-m-d',strtotime($pinjaman['tgl_pinjam'])));
                $last = date_create(date('Y-m-d',strtotime($pinjaman['jatuh_tempo'])));
                $diff=date_diff($today,$last);
                $log = $diff->days;
                $angsur = $log/30;
                $angsurarray = explode('.', $angsur);
                $angsur = $angsurarray[0];//total angsuran
                //menghitung angsuran pokok
                $angsuranpokok = $pinjaman['besar_pinjaman']/$angsur;
                ?>
                <tr>
                    <td>Jatuh Tempo Bulan Ini</td><td>
                    <?php 
                    //apakah sudah melakukan pembayaran angsuran
                    $angsuranterakhir = $this->m_pinjaman->tanggalTerakhirAngsur($pinjaman['id_pinjaman']);
                    $n=1;
                    if(!empty($angsuranterakhir)){//belum pernah melakukan pembayaran angsuran
                        // echo 'ada';
                     $nextN = date('d-m-Y',strtotime('+1 month',strtotime($angsuranterakhir['tgl_angsur'])));
                    }else{//sudah membayar angsuran
                        // echo 'kosong';
                        $nextN = date('d-m-Y',strtotime('+1 month',strtotime($pinjaman['tgl_pinjam'])));
                    }
                    $jatuhtempobulanini = $nextN;
                    echo $jatuhtempobulanini;
                    ?>
                    <?php
                    $today = date('Y-m-d');
                    if($today<=$jatuhtempobulanini){
                        $denda =0;
                    }else{
                        $denda = 0.0115;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Angsuran Pokok</td><td>Rp<?php echo number_format($angsuranpokok)?>,-</td>
            </tr>
            <tr>
                <td>Total Banyak Angsuran</td><td><?php echo $angsur?> Kali</td>
            </tr>
            <tr>
                <td>Status</td><td><?php echo $pinjaman['status']?></td>
            </tr>
        </table>
        <h4>Detail Jaminan <a data-toggle="modal" href="#editjaminan">edit</a></h4>
        <table class="table table-striped">
            <tr>
                <td>Id Jaminan</td><td><?php echo $pinjaman['id_jaminan']?></td>
            </tr>
            <tr>
                <td>Jenis Jaminan</td><td><?php echo $pinjaman['jenis_jaminan']?></td>
            </tr>
            <tr>
                <td>Nama Pemilik</td><td><?php echo $pinjaman['nama_pemilik']?></td>
            </tr>
            <tr>
                <td>Alamat Pemilik</td><td><?php echo $pinjaman['alamat_pemilik']?></td>
            </tr>
            <tr>
                <td>Keterangan</td><td><?php echo $pinjaman['keterangan']?></td>
            </tr>
        </table>
        <h4>Data Angsuran</h4>
        <a href="#tambahangsuran" data-toggle="modal" class="btn btn-primary">+ Tambah Anguran</a>
        <br/><br/>
        <table class="table table-striped">
            <tr>
                <th>Tanggal angsuran</th>
                <th>Angsuran Pokok</th>
                <th>Denda</th>
                <th>Total Angsur</th>
                <th></th>
            </tr>
            <?php foreach($angsuran as $a):?>
                <tr>
                    <td><?php echo $a['tgl_angsur']?></td>
                    <td>Rp<?php echo number_format($a['angsuran_pokok'])?>,-</td>
                    <td><?php echo $a['denda']?>%</td>
                    <td>Rp<?php echo number_format($a['total_angsur'])?>,-</td>
                    <th><a onclick="return confirm('yakinkan!')" class="btn btn-xs btn-danger" href="<?php echo site_url('cek/hapusangsuran/'.$a['id_angsuran'])?>">hapus</th>
                <?php endforeach;?>
            </table>
            <br/>
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>

<!-- start modal -->
<!-- Modal -->
<div class="modal fade" id="tambahangsuran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('cek/addangsuran')?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah Angsuran</h4>
                </div>
                <div class="modal-body">
                    <!-- start form -->
                    <label>Id Pinjaman</label>
                    <input id="inputidpinjaman" class="form-control" type="text" name="inputidpinjaman" value="<?php echo $this->uri->segment(3);?>"><br/>
                    <label>Angsuran Pokok (Rp)<br/><small>masukan tanpa tanda titik</small></label>
                    <input id="inputangsuranpokok" class="form-control" type="text" name="inputangsuranpokok" value="<?php echo ceil($angsuranpokok);?>"><br/>
                    <label>Denda (%)<br/><smal><small>denda otomatis berubah ketika lewat 1 bulan dari jatuh tempo<br/>masukan angka tanpa tanda persen</small></label>
                    <input id="inputdenda" class="form-control" type="text" name="inputdenda" value="<?php echo $denda?>"><br/>
                    <label>Total Angsur (Rp)<br/><small>bunga perbulan 15%<br/>klik tombol cek untuk menghitung</small></label>
                    <input id="totalangsur" class="form-control" type="text" name="inputtotalangsur" placeholder="Klik tombol cek untuk hitung total angsuran" required><br/>
                    <!-- end form -->
                </div>
                <div class="modal-footer">
                    <button onclick="cekTotalAngsur()" style="float:left" type="button" class="btn btn-primary">Cek</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Angsuran</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end of modal -->

<!-- start modal -->
<!-- Modal -->
<div class="modal fade" id="editpinjaman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('cek/editPinjaman/'.$pinjaman['id_pinjaman'])?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Data Pinjaman</h4>
                </div>
                <div class="modal-body">
                    <!-- start form -->
                    <label>Besar Pinjaman (Rp)<br/> <small>masukan tanpa tanda titik</small></label>
                    <input class="form-control" name="inputjumlah" type="number" value="<?php echo $pinjaman['besar_pinjaman']?>" required>
                    <br/>
                    <label>Jatuh Tempo<br/> <small>default 1 tahun dari tanggal pinjam</small></label>
                    <input class="form-control" id="adddate" name="inputjatuhtempo" type="text"  value="<?php echo $pinjaman['jatuh_tempo']?>" required>   
                    <!-- end form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end of modal -->

<!-- start modal -->
<!-- Modal -->
<div class="modal fade" id="editjaminan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('cek/editjaminan/'.$pinjaman['id_jaminan'])?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Data Jaminan</h4>
                </div>
                <div class="modal-body">
                    <!-- start form -->
                    <label>Jenis Jaminan</label>
                    <input class="form-control" name="inputjaminan_jenis" type="text" value="<?php echo  $pinjaman['jenis_jaminan']?>" required>
                    <br/>
                    <label>Nama Pemilik Jaminan</label>
                    <input class="form-control" name="inputjaminan_pemilik" type="text" value="<?php echo $pinjaman['nama_pemilik']?>" required>
                    <br/>
                    <label>Alamat Pemilik Jaminan</label>
                    <textarea class="form-control" name="inputjaminan_alamat" required><?php echo $pinjaman['alamat_pemilik']?></textarea>
                    <br/>
                    <label>Keterangan Jaminan</label>
                    <textarea class="form-control" name="inputjaminan_keterangan" required><?php echo  $pinjaman['keterangan']?></textarea>
                    <!-- end form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end of modal -->
