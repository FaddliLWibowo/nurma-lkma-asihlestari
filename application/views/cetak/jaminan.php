<!DOCTYPE html>
<html>
<head>
	<title>Cetak Pinjaman</title>
<style rel="stylesheet" type="text/css">
	table{
		width: 100%;
		text-align: left;
	}
	tr{border:1px solid gray;}
	th{text-align: left;}
</style>
</head>
<body>
<h1><?php echo $title;?></h1>
<br/>
Dicetak : <?php echo Date('d-m-Y H:i:s');?>
<hr style="border:1px solid gray" />
<table>
	<tr>
		<th>Id Pinjaman</th>
		<th>Tgl Pinjaman</th>
		<th>Jenis Jaminan</th>
		<th>Nama Pemilik</th>
		<th>Alamat Pemilik</th>		
		<th>Keterangan</th>		
	</tr>
	<?php foreach($view as $v):?>
		<tr>
			<td><?php echo $v['id_pinjaman'];?></td>
			<td><?php echo $v['tgl_pinjam'];?></td>
			<td><?php echo $v['jenis_jaminan'];?></td>
			<td><?php echo $v['nama_pemilik'];?></td>
			<td><?php echo $v['alamat_pemilik'];?></td>
			<td><?php echo $v['keterangan'];?></td>
		</tr>
	<?php endforeach; ?>
</table>
</body>
</html>