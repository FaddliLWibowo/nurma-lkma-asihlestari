<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'application/controllers/base.php';
class Dashboard extends base {
	public function __construct()
	{
		parent::__construct();
		//only for member
		$session = $this->session->userdata('karyawan');
		if(empty($session)){redirect(site_url());}//jikan belum login = kembali ke halaman login
		//auto load model
		$this->load->model(array('m_user','m_anggota','m_simpanan'));
	}
	/**
	 * login page digunakan untuk login pegawai ketika melayani customer
	 */
	public function index()//do login for pegawai
	{
		$data = array('title'=>'Dashboard');
		$this->baseView('dashboard',$data);
	}
	//laporan anggota
	public function laporananggota(){
		//start pagination
		$config=array(
			'per_page'=>20,//tampilan perhalamnnya
			'uri_segment'=>3,
			'num_link'=>5,
			'use_page_number'=>TRUE,
			'total_rows'=>$this->m_anggota->countGetAnggota(''),
			'base_url'=>site_url('dashboard/laporananggota'),
			);
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$uri = $this->uri->segment(3);		
		if(!$uri) {
			$uri = 0;
		}
		$data = array(
			'title'=>'Laporan Anggota',
			'script'=>'$("#anggota").addClass("active");',
			'view'=>$this->m_anggota->getAnggota($config['per_page'],$uri,''),
			);
		if($config['total_rows'] < 15) {
			$data['page'] = 1;
		} else {
			$data['page'] = $this->pagination->create_links();
		}	
		//end of pagination
		$this->baseView('laporananggota',$data);
	}
	//setor
	public function setor(){
		//start pagination
		$config=array(
			'per_page'=>20,//tampilan perhalamnnya
			'uri_segment'=>3,
			'num_link'=>5,
			'use_page_number'=>TRUE,
			'total_rows'=>0,
			'base_url'=>site_url('dashboard/setor'),
			);
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$uri = $this->uri->segment(3);		
		if(!$uri) {
			$uri = 0;
		}
		$data = array(
			'title'=>'Laporan Setor',
			'script'=>'$("#simpanan").addClass("active");$("#setor").addClass("activesub");$("#simpananshow").addClass("in")',
			);
		if($config['total_rows'] < 15) {
			$data['page'] = 1;
		} else {
			$data['page'] = $this->pagination->create_links();
		}	
		//end of pagination
		$this->baseView('laporansetor',$data);
	}
	//penarikan
	public function penarikan(){
		$data = array(
			'title'=>'Laporan Setor',
			'script'=>'$("#simpanan").addClass("active");$("#penarikan").addClass("activesub");$("#simpananshow").addClass("in")',
			);
		$this->baseView('laporansetor',$data);			
	}
	//pinjam
	public function pinjam(){
		$data = array(
			'title'=>'Laporan Setor',
			'script'=>'$("#pinjaman").addClass("active");$("#pinjam").addClass("activesub");$("#pinjamanshow").addClass("in")',
			);
		$this->baseView('laporansetor',$data);
	}
	//angsuran
	public function angsuran(){
		$data = array(
			'title'=>'Laporan Setor',
			'script'=>'$("#pinjaman").addClass("active");$("#angsuran").addClass("activesub");$("#pinjamanshow").addClass("in")',
			);
		$this->baseView('laporansetor',$data);
	}	
//admin only
public function setting(){
	$data = array(
		'title'=>'Admin Setting',
		'script'=>'$("setting").addClass("active");',
	);
	$this->baseView('setting',$data);
}
	
}
/* End of file login.php */
/* Location: ./application/controllers/welcome.php */
