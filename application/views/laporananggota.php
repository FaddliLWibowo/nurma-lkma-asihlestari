<!-- JNT0000OOU*** -->
<div id="wrapper">
    <!-- top navbar -->
    <?php $this->load->view('base/navbar');?>
    <!-- end of top navbar -->

    <div id="page-wrapper">

        <div class="container-fluid">

            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?php echo site_url('dashboard/laporananggota')?>">Laporan Anggota</a></li>
            </ol>
            <h1>Laporan Anggota</h1>
            <div class="form-group row">
                <form method="GET" action="<?php echo site_url('dashboard/cetakanggota');?>">
                   <div style="padding:0 15px" class="col-sm-2">
                     <button class="btn btn-default" type="submit">Cetak</button>
                 </div>
             </form>
         </div>
         <hr/>
         <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">Semua Anggota</a></li>
        </ul>
        <br/>
        <div class="row">
            <!--edit peserta-->
            <?php if(!empty($_GET['view']) && $_GET['view']=='edit'):
                    $anggota = $this->m_anggota->detailAnggota($_GET['id']);//get detail anggota berdasarkan nomor anggota
//                    print_r($anggota);//get full detail anggota
                    ?>
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('dashboard/laporananggota?act=edit&id='.$_GET['id'])?>">
                        <div class="modal-header">
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                            <h4 class="modal-title">Edit Anggota</h4>
                        </div>
                        <div class="modal-body">
                            <!-- start form -->
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 control-label">No  Identitas</label>
                                <div class="col-lg-10">
                                    <input name="inpunomorid" type="text" class="form-control" id="inputEmail1" placeholder="Masukan Nomor Identitas" value="<?php echo $anggota['no_identitas']?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 control-label">Nama</label>
                                <div class="col-lg-10">
                                    <input name="inputnama" type="text" class="form-control" id="inputEmail1" placeholder="Masukan Nama Lengkap" value="<?php echo $anggota['nama'];?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 control-label">Alamat</label>
                                <div class="col-lg-10">
                                    <textarea name="inputalamat" class="form-control" placeholder="Masukan alamat lengkap" required><?php echo $anggota['alamat'];?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 control-label">Jenis Kelamin</label>
                                <div class="col-lg-10">
                                    <select name="inputkelamin" class="form-control" required>
                                        <option value="pria">pria</option>
                                        <option value="wanita">wanita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 control-label">Tempat Lahir</label>
                                <div class="col-lg-10">
                                    <input name="inputtempatlahir" type="text" class="form-control" id="inputEmail1" placeholder="Masukan kota tempat lahir" value="<?php echo $anggota['tempat_lahir'];?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 control-label">Tanggal Lahir</label>
                                <div class="col-lg-10">
                                    <input name="inputtanggallahir" type="text" class="form-control" id="adddate" placeholder="Masukan tanggal lahir" value="<?php echo $anggota['tanggal_lahir'];?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 control-label">No Telp</label>
                                <div class="col-lg-10">
                                    <input name="inputtelp" type="text" class="form-control" id="inputEmail1" placeholder="Masukan nomot telp/mobile yang mudah" value="<?php echo $anggota['telepon'];?>" required>
                                </div>
                            </div>
                            <!-- end form -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    <hr/>
                <?php endif; //end of if edit data?>
                <!--end of edit peserta-->
                <div class="col-md-4"><a data-toggle="modal" href="#tambahanggota" class="btn btn-primary">Tambah Anggota</a></div>
                <div class="col-md-8">
                    <form style="float:right" class="form-inline" role="form" action="" method="get">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword2">Password</label>
                            <input name="q" style="width:300px" type="search" class="form-control" id="exampleInputPassword2" placeholder="pencarian nama anggota">
                        </div>
                        <button type="submit" class="btn btn-default">Cari</button>
                    </form>
                </div>
            </div>
            <!-- /.container-fluid -->
            <br/>
            <?php if(empty($view)){echo 'data tidak ditemukan';} else {?>
            <table class="table table-striped">
                <tr>
                    <th>id anggota</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>No Telp.</th>
                    <th></th>
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
                        <td>
                            <a href="<?php echo site_url('dashboard/laporananggota?view=edit&id='.$v['no_anggota'])?>" class="btn btn-default btn-xs">edit</a>
                            <a href="<?php echo site_url('cek/cekSimpanan/'.$v['no_anggota'])?>" class="btn btn-default btn-xs">detail</a>
                            <a href="<?php echo site_url('dashboard/laporananggota?act=delete&id='.$v['no_anggota'])?>" class="btn btn-danger btn-xs">hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <br/>
            <center><?php echo $page; ?></center>
            <?php } ?>
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>

<!-- start modal -->
<!-- Modal -->
<div class="modal fade" id="tambahanggota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('dashboard/laporananggota?act=add')?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah Anggota</h4>
                </div>
                <div class="modal-body">
                    <!-- start form -->
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">No  Identitas</label>
                        <div class="col-lg-10">
                            <input name="inpunomorid" type="text" class="form-control" id="inputEmail1" placeholder="Masukan Nomor Identitas" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Nama</label>
                        <div class="col-lg-10">
                            <input name="inputnama" type="text" class="form-control" id="inputEmail1" placeholder="Masukan Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Alamat</label>
                        <div class="col-lg-10">
                            <textarea name="inputalamat" class="form-control" placeholder="Masukan alamat lengkap" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Jenis Kelamin</label>
                        <div class="col-lg-10">
                            <select name="inputkelamin" class="form-control" required>
                                <option value="pria">pria</option>
                                <option value="wanita">wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Tempat Lahir</label>
                        <div class="col-lg-10">
                            <input name="inputtempatlahir" type="text" class="form-control" id="inputEmail1" placeholder="Masukan kota tempat lahir" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Tanggal Lahir</label>
                        <div class="col-lg-10">
                            <input name="inputtanggallahir" type="text" class="form-control" id="adddate" placeholder="Masukan tanggal lahir" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">No Telp</label>
                        <div class="col-lg-10">
                            <input name="inputtelp" type="text" class="form-control" id="inputEmail1" placeholder="Masukan nomot telp/mobile yang mudah ">
                        </div>
                    </div>
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
