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
		<th>No Anggota</th>
		<th>Nama Lengkap</th>
		<th>Alamat</th>
		<th>Jenis Kelamin</th>
		<th>Tempat Lahir</th>		
		<th>Tanggal Lahir</th>		
		<th>Nomor Telepon</th>		
	</tr>
	<?php foreach($view as $v):?>
		<tr>
			<td><?php echo $v['no_anggota'];?></td>
			<td><?php echo $v['nama'];?></td>
			<td><?php echo $v['alamat'];?></td>
			<td><?php echo $v['jenis_kelamin'];?></td>
			<td><?php echo $v['tempat_lahir'];?></td>
			<td><?php echo $v['tanggal_lahir'];?></td>
			<td><?php echo $v['telepon'];?></td>
		</tr>
	<?php endforeach; ?>
</table>
</body>
</html>