 <div id="wrapper">

 	<!-- top navbar -->
 	<?php $this->load->view('base/navbar');?>
 	<!-- end of top navbar -->

 	<div id="page-wrapper">

 		<div class="container-fluid">
 			<ol class="breadcrumb">
 				<li><a href="#">Home</a></li>
 				<li><a href="#">Library</a></li>
 				<li class="active">Data</li>
 			</ol>
 			<h1>Laporan Setoran</h1>
 			<hr/>
 			<div class="row">
 				<div class="col-md-4"><a href="#" class="btn btn-primary">Tambah Setoran</a></div>
 				<div class="col-md-8">
 					<form style="float:right" class="form-inline" role="form">
 						<div class="form-group">
 							<label class="sr-only" for="exampleInputPassword2">search id setoran</label>
 							<input style="width:300px" type="text" class="form-control" id="exampleInputPassword2" placeholder="pencarian setorann">
 						</div>
 						<button type="submit" class="btn btn-default">Cari</button>
 					</form>
 				</div>
 			</div>
 			<!-- /.container-fluid -->
 			<br/>
 			<table class="table table-striped">
 				<tr>
 					<th>Id simpanan</th>
 					<th>Tanggal</th>  
 					<th>Nasabah</th>
 					<th>Debit</th>
 					<th>Kredit</th>
 					<th>Admin</th>
 				</tr>
 				<tr>
 					<td>233-34234</td>
 					<td>13/01/2015 05:56:34</td>
 					<td>pak Arif</td>
 					<td>Rp45.000.000,-</td>
 					<td>-</td>
 					<td>Yussan</td>
 				</tr>
 			</table>
 			<br/>
 			<center><?php echo $page; ?></center>
 		</div>
 	</div>
 </div>