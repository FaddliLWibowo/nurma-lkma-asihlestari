<!DOCTYPE html>
<html>
<head>
	<title>Cetak Setoran</title>
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
		<th>tgl</th>
		<th>id simpanan</th>
		<th>Jumlah Setoran(Rp)</th>
	</tr>
	<?php foreach($view as $v):?>
		<tr>
			<td><?php echo $v['tgl'];?></td>
			<td><?php echo $v['id_simpanan'];?></td>
			<td><?php echo number_format($v['jumlah']);?></td>
		</tr>
	<?php endforeach; ?>
</table>
</body>
</html>