<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'application/controllers/base.php';
class Cek extends base {
    public function __construct()
    {
        parent::__construct();
        //only for member
        $session = $this->session->userdata('karyawan');
        if(empty($session)){redirect(site_url());}//jikan belum login = kembali ke halaman login
        //auto load model
        $this->load->model(array('m_user','m_anggota','m_simpanan','m_pinjaman'));
    }
    //cek detail anggota
    //cek meliputi detail simpanan maupun pinjaman yang dilakukan
    public function cekSimpanan(){
        $id = $this->uri->segment(3);//get id user
        $anggota = $this->m_anggota->detailAnggota($id);
        //pagination mutasi
        $config=array(
            'per_page'=>20,//tampilan perhalamnnya
            'uri_segment'=>4,
            'num_link'=>5,
            'use_page_number'=>TRUE,
            'total_rows'=>$this->m_simpanan->countMutasi($anggota['no_anggota']),
            'base_url'=>site_url('cek/cekSimpanan/'.$anggota['no_anggota']),
            );
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $uri = $this->uri->segment(4);
        if(!$uri) {
            $uri = 0;
        }
        //end of pagination mutasi
        $data = array(
            'title'=>'Cek Pinjaman '.$anggota['nama'],
            'script'=>'$("#anggota").addClass("active");$("#ceksimpanan").addClass("active")',
            'anggota'=>$anggota,
            'saldo'=>$this->m_simpanan->cekSaldo($anggota['no_anggota']),//cek sisa saldo
            'simpanan'=>$this->m_simpanan->byAnggota($anggota['no_anggota']),//detail simpanan berdasarkan id anggota
            'mutasi'=>$this->m_simpanan->getMutasi($config['per_page'],$uri,$anggota['no_anggota']),//show mutasi
            );
        if($config['total_rows'] < 15) {
            $data['page'] = 1;
        } else {
            $data['page'] = $this->pagination->create_links();
        }
        $this->baseView('cek/ceksimpanan',$data);
    }
    public function cekPinjaman(){
        $id = $this->uri->segment(3);//get id user
        $anggota = $this->m_anggota->detailAnggota($id);
        //pagination mutasi
        $config=array(
            'per_page'=>20,//tampilan perhalamnnya
            'uri_segment'=>4,
            'num_link'=>5,
            'use_page_number'=>TRUE,
            'total_rows'=>$this->m_pinjaman->countByAnggota($anggota['no_anggota']),
            'base_url'=>site_url('cek/cekSimpanan/'.$anggota['no_anggota']),
            );
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $uri = $this->uri->segment(4);
        if(!$uri) {
            $uri = 0;
        }
        //end of pagination mutasi
        $data = array(
            'title'=>'Cek Pinjaman '.$anggota['nama'],
            'script'=>'$("#anggota").addClass("active");$("#cekpinjaman").addClass("active")',
            'anggota'=>$anggota,
            'pinjaman'=>$this->m_pinjaman->byAnggota($config['per_page'],$uri,$anggota['no_anggota']),//detail simpanan berdasarkan id anggota
            );
        if($config['total_rows'] < 15) {
            $data['page'] = 1;
        } else {
            $data['page'] = $this->pagination->create_links();
        }
        $this->baseView('cek/cekpinjaman',$data);
    }
    //tambah aksi simpanan
    public function addAksiSimpanan(){
        $data = array(
            'id_simpanan'=>$_POST['inputidsimpanan'],
            'tgl'=>date('Y-m-d H:i:s'),
            'jumlah'=>$_POST['inputjumlah'],
            'status'=>$_POST['inputtype']
            );
        $this->db->insert('aksiSimpanan',$data);
        redirect($this->agent->referrer());//kembali ke halaman sebelumnya
    }
    //hapus aksi simpanan
    public function delAksiSimpanan(){
        $idaksi = $this->uri->segment(3);
        $this->db->where('id_aksi',$idaksi);
        $this->db->delete('aksiSimpanan');
        redirect($this->agent->referrer());
    }

    /*************
    * ALL ABOUT PINJAMAN
    *************/

    //menambah pinjam baru
    public function addPinjaman(){
        if(!empty($this->uri->segment(3))){
            $noanggota = $this->uri->segment(3);
        }else{
            $noanggota = $_POST['inputnomoranggota'];
        }
        print_r($_POST);//get all data
    //input data pinjaman
        $datapinjaman = array(
            'no_anggota'=>$noanggota,
            'tgl_pinjam'=>date('Y-m-d H:i:s'),
            'besar_pinjaman'=>$_POST['inputjumlah'],
            'jatuh_tempo'=>date('Y-m-d H:i:s',strtotime($_POST['inputjatuhtempo'])),
            'status'=>'pinjam'
            );
    //insert to database
        $this->db->insert('pinjaman',$datapinjaman);
    //get lattest id pinjaman
        $sql = "SELECT id_pinjaman FROM pinjaman ORDEr BY id_pinjaman DESC";
        $query = $this->db->query($sql);
        $query = $query->row_array();
        $lastidpinjaman = $query['id_pinjaman'];
    //input data jaminan
        $datajaminan = array(
            'id_pinjaman'=>$lastidpinjaman,
            'jenis_jaminan'=>$_POST['inputjaminan_jenis'],
            'nama_pemilik'=>$_POST['inputjaminan_pemilik'],
            'alamat_pemilik'=>$_POST['inputjaminan_alamat'],
            'keterangan'=>$_POST['inputjaminan_keterangan']
            );
        $this->db->insert('jaminan',$datajaminan);
    redirect($this->agent->referrer());//kembali kehalaman sebelumnya
}
    //detail pinjaman
public function detailpinjaman(){
    $idpinjaman = $this->uri->segment(3);
        //get detail pinjaman
    $pinjaman = $this->m_pinjaman->detailPinjaman($idpinjaman);
    $data = array(
        'title'=>'Detail Pinjaman',
        'anggota'=>$this->m_anggota->detailAnggota($pinjaman['no_anggota']),
        'pinjaman'=>$pinjaman,
        'terbayar'=>$this->m_pinjaman->totalAngsuran($idpinjaman),
        'angsuran'=>$this->m_pinjaman->listAngsuran($idpinjaman),
        'script'=>'$("#anggota").addClass("active");$("#cekpinjaman").addClass("active")',
        );
    $this->baseView('cek/detailpinjaman',$data);
}
//edit pinjaman
public function editPinjaman(){
    $idpinjaman = $this->uri->segment(3);
    $this->db->where('id_pinjaman',$idpinjaman);
    $datapinjaman = array(
        'besar_pinjaman'=>$_POST['inputjumlah'],
        'jatuh_tempo'=>date('Y-m-d H:i:s',strtotime($_POST['inputjatuhtempo'])),
        );
    $this->db->update('pinjaman',$datapinjaman);
    redirect($this->agent->referrer());//kembali kehalaman sebelumnya
}
//hapus pinjaman -- otomatis hapus jaminan
public function hapuspinjaman(){
    $idpinjaman = $this->uri->segment(3);
    $this->db->where('id_pinjaman',$idpinjaman);
    $this->db->delete('pinjaman');
    redirect($this->agent->referrer());
}
//edit jaminan
public function editJaminan(){
    $idjaminan = $this->uri->segment(3);
    $this->db->where('id_jaminan',$idjaminan);
    $datajaminan = array(
        'jenis_jaminan'=>$_POST['inputjaminan_jenis'],
        'nama_pemilik'=>$_POST['inputjaminan_pemilik'],
        'alamat_pemilik'=>$_POST['inputjaminan_alamat'],
        'keterangan'=>$_POST['inputjaminan_keterangan']
        );
    $this->db->update('jaminan',$datajaminan);
    redirect($this->agent->referrer());//kembali kehalaman sebelumnya
}
    /*************
    * ALL ABOUT ANGSURAN
    *************/
    //menambah angsuran
    public function addAngsuran(){
        // print_r($_POST);
        $data = array(
            'id_pinjaman'=>$_POST['inputidpinjaman'],
            'tgl_angsur'=>date('Y-m-d H:i:s'),
            'angsuran_pokok'=>$_POST['inputangsuranpokok'],
            'denda'=>$_POST['inputdenda'],
            'total_angsur'=>$_POST['inputtotalangsur']
            );
        $this->db->insert('angsuran',$data);
        redirect($this->agent->referrer());
    }
    //hapus angsuran
    public function hapusangsuran(){
        $idangsuran = $this->uri->segment(3);
        $this->db->where('id_angsuran',$idangsuran);
        $this->db->delete('angsuran');
        redirect($this->agent->referrer());
    }

}