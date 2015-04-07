 <!-- Navigation -->
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">LKMA ASIH LESTARI</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata['karyawan']['username'];?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                       <!--  <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li> -->
                        <li>
                            <a href="<?php echo site_url('login/logout') ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                   <!--  <li id="dashboard">
                        <a href="<?php echo site_url();?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li> -->
                    <li id="anggota">
                        <a href="<?php echo site_url('dashboard/laporananggota');?>"><i class="fa fa-fw fa-user"></i> Laporan Anggota</a>
                    </li>
                    <li id="simpanan">
                        <a href="javascript:;" data-toggle="collapse" data-target="#simpananshow"><i class="fa fa-fw fa-bar-chart-o"></i> Laporan Simpanan<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="simpananshow" class="collapse">
                            <li id="setor">
                                <a href="<?php echo site_url('dashboard/setor');?>">Setor</a>
                            </li>
                            <li id="penarikan">
                                <a href="<?php echo site_url('dashboard/penarikan');?>">Penarikan</a>
                            </li>
                        </ul>
                    </li>
                    <li id="pinjaman">
                        <a href="javascript:;" data-toggle="collapse" data-target="#pinjamanshow"><i class="fa fa-fw fa-bar-chart-o"></i> Laporan Pinjaman<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="pinjamanshow" class="collapse">
                            <li id="pinjam">
                                <a href="<?php echo site_url('dashboard/pinjam');?>">Pinjam</a>
                            </li>
                            <li id="angsuran">
                                <a href="<?php echo site_url('dashboard/angsuran');?>">Angsuran</a>
                            </li>
                            <li id="jaminan">
                                <a href="<?php echo site_url('dashboard/jaminan');?>">Jaminan</a>
                            </li>
                        </ul>
                    </li>
                    <?php if($this->session->userdata['karyawan']['level']=='admin'):?>               
                        <li id="setting">
                        <a href="<?php echo site_url('dashboard/setting') ?>"><i class="fa fa-fw fa-gear"></i> Seting</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>