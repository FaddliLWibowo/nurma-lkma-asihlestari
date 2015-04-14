<div id="wrapper">

    <!-- top navbar -->
    <?php $this->load->view('base/navbar');?>
    <!-- end of top navbar -->

    <div id="page-wrapper">

        <div class="container-fluid">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url()?>">Dashboard</a></li>
                <li>Pencarian Simpanan</li>
            </ol>
            <h1>Laporan Pencarian Simpanan</h1>
            <p>keyword "<?php echo $this->uri->segment(4) ?>", total hasil : <?php echo $total;?></p>
            <hr/>
            <div class="row">
                <div class="col-md-4"><a href="#tambahsetoran" data-toggle="modal" class="btn btn-primary">Tambah Penarikan/Setoran</a></div>
                <div class="col-md-8">
<!--                    <form  style="float:right" class="form-inline" role="form">-->
<!--                        <div class="form-group">-->
<!--                            <label class="sr-only" for="exampleInputPassword2">search id setoran</label>-->
<!--                            <input style="width:300px" type="text" class="form-control" id="exampleInputPassword2" value="--><?php //echo $this->uri->segment(4)?><!--" placeholder="pencarian berdasar id simpanan">-->
<!--                        </div>-->
<!--                        <button type="submit" class="btn btn-default">Cari</button>-->
<!--                    </form>-->
                </div>
            </div>
            <!-- /.container-fluid -->
            <br/>
            <table class="table table-striped">
                <tr>
                    <th>Id simpanan</th>
                    <th>Tanggal</th>
                    <th>Anggota</th>
                    <th>Setoran (Rp)</th>
                    <th>Penarikan (Rp)</th>
                    <th></th>
                </tr>
                <?php foreach($view as $v):?>
                    <tr>
                        <td><?php echo $v['id_simpanan']?></td>
                        <td><?php echo $v['tglaksi']?></td>
                        <td><?php echo $v['nama']?></td>
                        <td>
                            <?php
                            if($v['status']=='setoran'){
                                echo number_format($v['jumlah']);
                            }else if($v['status']=='penarikan'){
                                echo '-';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($v['status']=='penarikan'){
                                echo number_format($v['jumlah']);
                            }else if($v['status']=='setoran'){
                                echo '-';
                            }
                            ?>
                        </td>
                        <td><a class="btn btn-xs btn-default" href="<?php echo site_url('cek/cekSimpanan/'.$v['no_anggota'])?>">detail</a></td>
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
                    <h4 class="modal-title">Tambah Penarikan</h4>
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
                        <option value="penarikan">penarikan</option>
                        <option value="setoran">setoran</option>
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