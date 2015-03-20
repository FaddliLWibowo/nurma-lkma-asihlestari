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
                <table class="table table-striped">
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
                </table>
            </div>
        </div>
    </div>
</div>