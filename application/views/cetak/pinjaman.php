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
		<th>Tanggal Pinjam</th>
		<th>Jatuh Tempo</th>
		<th>Id Pinjaman</th>
		<th>No Anggota</th>
		<th>Besar Pinjaman (Rp)</th>
		<th>Status</th>		
	</tr>
	<?php foreach($view as $v):?>
		<tr>
			<td><?php echo $v['tgl_pinjam'];?></td>
			<td><?php echo $v['jatuh_tempo'];?></td>
			<td><?php echo $v['id_pinjaman'];?></td>
			<td><?php echo $v['no_anggota'];?></td>
			<td><?php echo number_format($v['besar_pinjaman']);?></td>
			<td><?php echo $v['status'];?></td>
		</tr>
	<?php endforeach; ?>
</table>
</body>
</html>