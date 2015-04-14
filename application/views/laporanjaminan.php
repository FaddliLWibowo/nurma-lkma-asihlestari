 <div id="wrapper">

 	<!-- top navbar -->
 	<?php $this->load->view('base/navbar');?>
 	<!-- end of top navbar -->

 	<div id="page-wrapper">

 		<div class="container-fluid">
 			<ol class="breadcrumb">
 				<li><a href="<?php echo site_url()?>">Dashboard</a></li>
 				<li>Laporan Jaminan</li>
 			</ol>
 			<h1>Laporan Jaminan</h1>
            <div class="form-group row">
            <form method="GET" action="<?php echo site_url('dashboard/cetakjaminan');?>">
                  <div style="padding:0" class="col-sm-2">
                     <select name="bln" class="form-control">
                        <option value="0">Semua Bulan</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div style="padding:0" class="col-sm-2">
                   <select name="thn" class="form-control">
                      <option value="0">Semua Tahun</option>
                      <option value="2015">2015</option>
                  </select>
              </div>
              <div style="padding:0" class="col-sm-2">
                 <button class="btn btn-default" type="submit">Cetak</button>
             </div>
         </form>
     </div>
            <hr/>
 			<div class="row">
 				<div class="col-md-4"></div>
 				<div class="col-md-8">
 					<form action="" style="float:right" class="form-inline" role="form">
 						<div class="form-group">
 							<label class="sr-only" for="exampleInputPassword2">search id pinjaman</label>
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
 					<th>Id Jaminan</th>
                    <th>Id Pinjaman</th>
                    <th>Jenis Jaminan</th>  
 					<th>Nama Pemilik</th>
                    <th>Alamat Pemilik</th>
                    <th>Keterangan</th>
 				</tr>
                <?php foreach($view as $v):?>
 				<tr>
                    <td><?php echo $v['id_jaminan']?></td>
                    <td><?php echo $v['id_pinjaman']?></td>
                    <td><?php echo $v['jenis_jaminan']?></td>
                    <td><?php echo $v['nama_pemilik']?></td>
                    <td><?php echo $v['alamat_pemilik']?></td>
                    <td><?php echo $v['keterangan']?></td>
                    <td>
                    <a class="btn btn-xs btn-default" href="<?php echo site_url('cek/detailpinjaman/'.$v['id_pinjaman'])?>">detail</a>
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
             <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('cek/addAksiSimpanan')?>">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Tambah Setoran</h4>
                 </div>
                 <div class="modal-body">
                     <!-- start form -->
                     <label>Id Simpanan</label>
                     <input class="form-control" type="text" name="inputidsimpanan" placeholder="masukan id simpanan" required>
                     <br/>
                     <label>Jumlah <small>masukan tanpa titik</small></label>
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