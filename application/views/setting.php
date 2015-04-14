<div id="wrapper">

    <!-- top navbar -->
    <?php $this->load->view('base/navbar');?>
    <!-- end of top navbar -->

    <div id="page-wrapper">

        <div class="container-fluid">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Setting</li>
            </ol>
            <h1>Setting</h1>
            <hr/>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Manajemen User</a></li>
            </ul>
            <!-- /.container-fluid -->
            <div class="tab-content">
                <?php
                if(!empty($_GET['edit'])){
                    $user_id = $_GET['edit'];
                    //get all user data
                    $data = $this->m_user->getUserByid($user_id);
               ?>
                    <h3>Edit Data User</h3>
                    <form method="POST" action="<?php echo site_url('dashboard/setting?act=edit&id='.$data['user_id'])?>" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Nama</label>
                            <div class="col-lg-10">
                                <input name="inputnama" type="text" class="form-control" id="inputEmail1" value="<?php echo $data['nama_pegawai']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Alamat</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" name="inputalamat"><?php echo $data['alamat_pegawai']?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tempat Lahir</label>
                            <div class="col-lg-10">
                                <input name="inputtempatlahir" type="text" class="form-control" id="inputEmail1" value="<?php echo $data['tempatlahir_pegawai']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tanggal Lahir</label>
                            <div class="col-lg-10">
                                <input name="inputtanggallahir" type="text" class="form-control" id="inputEmail1" value="<?php echo $data['tgllahir_pegawai']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Pendidikan</label>
                            <div class="col-lg-10">
                                <input name="inputpendidikan" type="text" class="form-control" id="inputEmail1" value="<?php echo $data['pendidikan']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Jabatan</label>
                            <div class="col-lg-10">
                                <input name="inputjabatan" type="text" class="form-control" id="inputEmail1" value="<?php echo $data['jabatan']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">No Telepon</label>
                            <div class="col-lg-10">
                                <input name="inputtelepon" type="text" class="form-control" id="inputEmail1" value="<?php echo $data['telp_pegawai']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Username</label>
                            <div class="col-lg-10">
                                <input name="inputusername" type="text" class="form-control" id="inputEmail1"value="<?php echo $data['username']?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Level</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="inputlevel" id="" required>
                                    <option value="">Pilih Level</option>
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Password <br/> <small>kosongkan jika tidak ingin ubah password</small></label>
                            <div class="col-lg-10">
                                <input name="inputpassword" type="password" class="form-control" id="inputEmail1" placeholder="kosongkan jika tidak ingin ubah password">
                                <input name="oldpassword" type="hidden" value="<?php echo $data['password']?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <a href="<?php echo site_url('dashboard/setting?act=delete&id='.$data['user_id'])?>" onclick="return confirm('anda yakin')" type="submit" class="btn btn-danger">Hapus User</a>
                                <button type="submit" class="btn btn-default">Simpan</button>
                            </div>
                        </div>
                    </form>
                <?php }//edit data user?>
                <br/>
                <a data-toggle="modal" href="#tambahuser" class="btn btn-primary ">Tambah User</a>
                <br/><br/>
                <table class="table table-striped">
                    <tr>
                    <th>id user</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Pendidikan</th>
                    <th>Jabatan</th>
                    <th>No Telepon</th>
                    <th>Username</th>
                    <th>level</th>
                    <th></th>
                    </tr>
                    <?php
                        foreach($view as $v):
                    ?>
                    <tr>
                        <td><?php echo $v['user_id']?></td>
                        <td><?php echo $v['nama_pegawai']?></td>
                        <td><?php echo $v['alamat_pegawai']?></td>
                        <td><?php echo $v['tempatlahir_pegawai']?></td>
                        <td><?php echo $v['tgllahir_pegawai']?></td>
                        <td><?php echo $v['pendidikan']?></td>
                        <td><?php echo $v['jabatan']?></td>
                        <td><?php echo $v['telp_pegawai']?></td>
                        <td><?php echo $v['username']?></td>
                        <td><?php echo $v['level']?></td>
                        <td><a href="?edit=<?php echo $v['user_id']?>" class="btn btn-default btn-xs">edit</a></td>
                    </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</div>

<!--modal-->
<div class="modal fade" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?php echo site_url('dashboard/setting?act=add')?>" class="form-horizontal" role="form">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah User</h4>
                </div>
                <div class="modal-body">
                    <!-- start form -->
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Nama</label>
                        <div class="col-lg-10">
                            <input name="inputnama" type="text" class="form-control" id="inputEmail1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Alamat</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="inputalamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Tempat Lahir</label>
                        <div class="col-lg-10">
                            <input name="inputtempatlahir" type="text" class="form-control" id="inputEmail1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Tanggal Lahir</label>
                        <div class="col-lg-10">
                            <input name="inputtanggallahir" type="text" class="form-control" id="inputEmail1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Pendidikan</label>
                        <div class="col-lg-10">
                            <input name="inputpendidikan" type="text" class="form-control" id="inputEmail1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Jabatan</label>
                        <div class="col-lg-10">
                            <input name="inputjabatan" type="text" class="form-control" id="inputEmail1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">No Telepon</label>
                        <div class="col-lg-10">
                            <input name="inputtelepon" type="text" class="form-control" id="inputEmail1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-10">
                            <input name="inputusername" type="text" class="form-control" id="inputEmail1"value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Level</label>
                        <div class="col-lg-10">
                            <select class="form-control" name="inputlevel" id="" required>
                                <option value="">Pilih Level</option>
                                <option value="admin">admin</option>
                                <option value="user">user</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input name="inputpassword" type="password" class="form-control" id="inputEmail1" >
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
<!--end of modal-->