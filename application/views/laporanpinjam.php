 <div id="wrapper">

 	<!-- top navbar -->
 	<?php $this->load->view('base/navbar');?>
 	<!-- end of top navbar -->

 	<div id="page-wrapper">

 		<div class="container-fluid">
 			<ol class="breadcrumb">
 				<li><a href="<?php echo site_url()?>">Dashboard</a></li>
 				<li>Laporan Pinjaman</li>
            </ol>
            <hr/>
            <div class="row">
               <div class="col-md-4"><a href="#tambahsetoran" data-toggle="modal" class="btn btn-primary">Tambah Pinjaman</a></div>
               <div class="col-md-8">
                  <form action="" style="float:right" class="form-inline" role="form">
                     <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword2">search id setoran</label>
                        <input name="q" style="width:300px" type="text" class="form-control" id="exampleInputPassword2" placeholder="pencarian berdasarkan id pinjaman">
                    </div>
                    <button type="submit" class="btn btn-default">Cari</button>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
        <br/>
        <table class="table table-striped">
           <tr>
              <th>Id Pinjaman</th>
              <th>Tanggal Pinjam</th>  
              <th>Jatuh Tempo</th>
              <th>Anggota</th>
              <th>Besar Pinjaman (Rp)</th>
              <th>Total Terbayar (Rp)</th>
              <th>Status</th>
              <th></th>
          </tr>
          <?php foreach($view as $v):?>
           <tr>
              <td><?php echo $v['id_pinjaman']?></td>
              <td><?php echo $v['tgl_pinjam']?></td>
              <td><?php echo $v['jatuh_tempo']?></td>
              <td><?php echo $v['nama']?></td>
              <td><?php echo number_format($v['besar_pinjaman'])?>,-</td>
              <td><?php echo number_format($this->m_pinjaman->totalAngsuran($v['id_pinjaman']))?>,-</td>
              <td><?php echo $v['status']?></td>
              <td>
              <?php echo '<a class="btn btn-default btn-xs" href="'.site_url('cek/detailpinjaman/'.$v['id_pinjaman']).'">detail</a> <a onclick="return confirm(\'yakinkan dulu\')" class="btn btn-danger btn-xs" href="'.site_url('cek/hapuspinjaman/'.$v['id_pinjaman']).'">hapus</a></td>';?>
              </td>
          </tr>
      <?php endforeach;?>
  </table>
  <br/>
  <center><?php echo $page; ?></center>
</div>
</div>
</div>

<!-- start modal -->
<!-- Modal -->
<div class="modal fade" id="tambahsetoran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('cek/addPinjaman')?>">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title">Tambah Pinjaman</h4>
               </div>
               <div class="modal-body">
                   <!-- start form -->
                   <h4>Data Pinjaman</h4>
                   <label>Nomor Anggota</label>
                    <input class="form-control" name="inputnomoranggota" type="number" required>
                    <br/>
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