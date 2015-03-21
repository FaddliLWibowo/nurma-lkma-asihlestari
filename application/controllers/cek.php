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
        $this->load->model(array('m_user','m_anggota','m_simpanan'));
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
            'script'=>'$("#anggota").addClass("active");',
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
        $data = array(
            'title'=>'Cek Pinjaman',
        );
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
}