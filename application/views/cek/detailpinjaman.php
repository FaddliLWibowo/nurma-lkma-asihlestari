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
            <h1>Cek Pinjaman <?php echo $anggota['nama'];?></h1>
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
                    <td>Id Simpanan</td><td><?php echo $pinjaman['id_pinjaman']?></td>
                </tr>
                <tr>
                    <td>Tanggal Pinjam</td><td><?php echo $pinjaman['tgl_pinjam']?></td>
                </tr>
                <tr>
                    <td>Jatuh Tempo</td><td><?php echo $pinjaman['jatuh_tempo']?></td>
                </tr>
                <tr>
                    <td>Total Pinjaman</td><td>Rp<?php echo number_format($pinjaman['besar_pinjaman'])?>,-</td>
                </tr>
                <tr>
                    <td>Total Terbayar</td><td>Rp<?php echo number_format($pinjaman['besar_pinjaman'])?>,-</td>
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
                </tr>
                <?php foreach($angsuran as $a):?>
                <tr>
                    <td><?php echo $a['tgl_angsur']?></td>
                    <td><?php echo $a['angsuran_pokok']?></td>
                    <td><?php echo $a['denda']?></td>
                    <td><?php echo $a['total_angsur']?></td>
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
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('cek/addAksiSimpanan')?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah Angsuran</h4>
                </div>
                <div class="modal-body">
                    <!-- start form -->
                    <label>Id Pinjaman</label>
                    <input class="form-control" type="text" input="inputidpinjaman" value="<?php echo $this->uri->segment(3);?>"><br/>
                    <label>Angsuran Pokok</label>
                    <input class="form-control" type="text" input="inputidpinjaman" value=""><br/>
                    <label>Denda <br/><smal>masukan angka tanpa tanda persen</smal></label>
                    <input class="form-control" type="text" input="inputidpinjaman" value=""><br/>
                    <label>Total Angsur</label>
                    <input class="form-control" type="text" input="inputidpinjaman" value=""><br/>
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
<div class="modal fade" id="editpinjaman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('cek/addAksiSimpanan')?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Data Pinjaman</h4>
                </div>
                <div class="modal-body">
                    <!-- start form -->

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
<div class="modal fade" id="editjaminan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('cek/addAksiSimpanan')?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Data Jaminan</h4>
                </div>
                <div class="modal-body">
                    <!-- start form -->
                    <label>Nama Pemilik</label>
                    <input class="form-control" type="text" placeholder="masukan nama pemilik">
                    <br/>
                    <label>Alamat Pemilik</label>
                    <input class="form-control" type="text" placeholder="masukan nama pemilik">
                    <br>
                    <label>Keterangan</label>
                    <textarea name="" id="" cols="30" rows="10" placeholder="masukan keterangan jaminan" class="form-control"></textarea>
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
