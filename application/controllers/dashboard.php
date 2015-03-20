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
		if(!empty($_POST) || !empty($_GET['act'])){//do action
			switch($_GET['act']){
				case 'add'://process add data
					//get input data anggota
                    $data = array(
                        'no_identitas'=>$_POST['inpunomorid'],
                        'nama'=>$_POST['inputnama'],
                        'alamat'=>$_POST['inputalamat'],
                        'jenis_kelamin'=>$_POST['inputkelamin'],
                        'tempat_lahir'=>$_POST['inputtempatlahir'],//get data tempat lahir
                        'tanggal_lahir'=>$_POST['inputtanggallahir'],//modifikasi tnggal berdasarkan database
                        'telepon'=>$_POST['inputtelp'],
                    );
                    print_r($data);
                    //process insert to database
                    $this->db->insert('anggota',$data);//insert into
                    redirect(site_url('dashboard/laporananggota'));//kembali ke halaman laporan anggota
					break;
				case 'edit'://process edit data
					$id = $_GET['id'];
                    $this->db->where('no_anggota',$id);
                    $data = array(
                        'no_identitas'=>$_POST['inpunomorid'],
                        'nama'=>$_POST['inputnama'],
                        'alamat'=>$_POST['inputalamat'],
                        'jenis_kelamin'=>$_POST['inputkelamin'],
                        'tempat_lahir'=>$_POST['inputtempatlahir'],//get data tempat lahir
                        'tanggal_lahir'=>$_POST['inputtanggallahir'],//modifikasi tnggal berdasarkan database
                        'telepon'=>$_POST['inputtelp'],
                    );
                    $this->db->where('no_anggota',$id);
                    $this->db->update('anggota',$data);
                    redirect($this->agent->referrer());
                    break;
				case 'delete'://process delete data
                    $id=$_GET['id'];
                    $this->db->where('no_anggota',$id);//jika nomor id adalah id yang di pilih
                    $this->db->delete('anggota');
                    redirect($this->agent->referrer());//kemabli kehalaman sebbelumnya
					break;
			}
		}else{//just showing
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
		$this->load->library('form_validation');//form validation

		if(!empty($_POST) || !empty($_GET['act'])){
			switch($_GET['act']){
				case 'edit':
					$userid = $_GET['id'];//get userid
//					print_r($_POST);
					if(empty($_POST['inputpassword'])){//not update password
						$password = $_POST['oldpassword'];
					}else{//new password
						$password = $_POST['inputpassword'];
					}
					//update database
					$this->db->where('user_id',$userid);
					$data = array(
						'nama_pegawai'=>$_POST['inputnama'],
						'alamat_pegawai'=>$_POST['inputalamat'],
						'tempatlahir_pegawai'=>$_POST['inputtempatlahir'],
						'tgllahir_pegawai'=>$_POST['inputtanggallahir'],
						'pendidikan'=>$_POST['inputpendidikan'],
						'jabatan'=>$_POST['inputjabatan'],
						'telp_pegawai'=>$_POST['inputtelepon'],
						'username'=>$_POST['inputusername'],
						'level'=>$_POST['inputlevel'],
						'password'=>$password
					);
					$this->db->update('user',$data);//update db
					redirect(site_url('dashboard/setting'));
				//end of set rules
				case 'add':
					$data = array(
						'nama_pegawai'=>$_POST['inputnama'],
						'alamat_pegawai'=>$_POST['inputalamat'],
						'tempatlahir_pegawai'=>$_POST['inputtempatlahir'],
						'tgllahir_pegawai'=>$_POST['inputtanggallahir'],
						'pendidikan'=>$_POST['inputpendidikan'],
						'jabatan'=>$_POST['inputjabatan'],
						'telp_pegawai'=>$_POST['inputtelepon'],
						'username'=>$_POST['inputusername'],
						'level'=>$_POST['inputlevel'],
						'password'=>$_POST['inputpassword']
					);
					//insert to database
					$this->db->insert('user',$data);//insert db
					redirect(site_url('dashboard/setting'));
					break;
				case 'delete':
					$userid = $_GET['id'];//get userid
					$this->db->where('user_id',$userid);
					$this->db->delete('user');
					redirect(site_url('dashboard/setting'));
					break;
			}
		}else{
			//pagination start
			//start pagination
			$config=array(
				'per_page'=>20,//tampilan perhalamnnya
				'uri_segment'=>3,
				'num_link'=>5,
				'use_page_number'=>TRUE,
				'total_rows'=>$this->m_user->countGetKaryawan(''),
				'base_url'=>site_url('dashboard/setting'),
			);
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$uri = $this->uri->segment(3);
			if(!$uri) {
				$uri = 0;
			}
			//end of pagination
			$data = array(
				'title'=>'Admin Setting',
				'script'=>'$("#setting").addClass("active");',
				'view'=>$this->m_user->getKaryawan($config['per_page'],$uri,''),
			);
			//pagination
			if($config['total_rows'] < 15) {
				$data['page'] = 1;
			} else {
				$data['page'] = $this->pagination->create_links();
			}
			//end of pagination
			$this->baseView('setting',$data);
		}
	}

}
/* End of file login.php */
/* Location: ./application/controllers/welcome.php */
