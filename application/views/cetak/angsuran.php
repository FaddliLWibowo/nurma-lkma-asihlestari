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
		<th>Tanggal Angsur</th>
		<th>Id Angsuran</th>
		<th>Id Pinjaman</th>
		<th>No Anggota</th>
		<th>Angsuran Pokok (Rp)</th>
		<th>Denda (%)</th>		
		<th>Angsuran Dibayarkan (Rp)</th>		
	</tr>
	<?php foreach($view as $v):?>
		<tr>
			<td><?php echo $v['tgl_angsur'];?></td>
			<td><?php echo $v['id_angsuran'];?></td>
			<td><?php echo $v['id_pinjaman'];?></td>
			<td><?php echo $v['no_anggota'];?></td>
			<td><?php echo number_format($v['angsuran_pokok']);?></td>
			<td><?php echo $v['denda'];?></td>
			<td><?php echo number_format($v['total_angsur']);?></td>
		</tr>
	<?php endforeach; ?>
</table>
</body>
</html>