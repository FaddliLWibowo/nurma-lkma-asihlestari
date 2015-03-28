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
		$data = array(
            'title'=>'Dashboard',
            'script'=>'$("#dashboard").addClass("active");',
        );
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
				'per_page'=>35,//tampilan perhalamnnya
				'uri_segment'=>3,
				'num_link'=>5,
				'use_page_number'=>TRUE,
				'base_url'=>site_url('dashboard/laporananggota'),
			);
			if(!empty($_GET['q'])){//search something
				$keyword = $_GET['q'];//get keyword
				$config['total_rows'] = $this->m_anggota->countSearchAnggota($keyword);
			}else{//not searching
				$config['total_rows'] = $this->m_anggota->countGetAnggota('');
			}
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$uri = $this->uri->segment(3);
			if(!$uri) {
				$uri = 0;
			}
			$data = array(
				'title'=>'Laporan Anggota',
				'script'=>'$("#anggota").addClass("active");',
			);
			//searching
			if(!empty($_GET['q'])){//search something
				$keyword = $_GET['q'];//get keyword
				$data['view'] = $this->m_anggota->searchAnggota($config['per_page'],$uri,$keyword);
			}else{//not searching
				$data['view'] = $this->m_anggota->getAnggota($config['per_page'],$uri,'');
			}
			//end of searching
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
			'total_rows'=>$this->m_simpanan->countAllsimpanan('setoran'),
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
		    'view'=>$this->m_simpanan->allSimpanan($config['per_page'],$uri,'setoran'),//menmpilkan semua setoran
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
        //start pagination
        $config=array(
            'per_page'=>20,//tampilan perhalamnnya
            'uri_segment'=>3,
            'num_link'=>5,
            'use_page_number'=>TRUE,
            'total_rows'=>$this->m_simpanan->countAllsimpanan('penarikan'),
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
            'script'=>'$("#simpanan").addClass("active");$("#penarikan").addClass("activesub");$("#simpananshow").addClass("in")',
            'view'=>$this->m_simpanan->allSimpanan($config['per_page'],$uri,'penarikan'),//menmpilkan semua setoran
        );
        if($config['total_rows'] < 15) {
            $data['page'] = 1;
        } else {
            $data['page'] = $this->pagination->create_links();
        }
        //end of pagination
        $this->baseView('laporanpenarikan',$data);
	}
    //pencarian simpanan
    public function searchsimpanan(){
        if(!empty($_GET['q'])){redirect(site_url('dashboard/searchsimpanan/'.$this->uri->segment(3).'/'.$_GET['q']));}
        $type = $this->uri->segment(3);
        $keyword = $this->uri->segment(4);
        $config=array(
            'per_page'=>20,//tampilan perhalamnnya
            'uri_segment'=>5,
            'num_link'=>5,
            'use_page_number'=>TRUE,
            'total_rows'=>$this->m_simpanan->countSearchSimpanan($keyword,$type),
            'base_url'=>site_url('dashboard/setor'),
        );
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $uri = $this->uri->segment(5);
        if(!$uri) {
            $uri = 0;
        }
        $data = array(
            'title'=>'Laporan Setor',
            'script'=>'$("#simpanan").addClass("active");$("#penarikan").addClass("activesub");$("#simpananshow").addClass("in")',
            'total'=>$config['total_rows'],
            'view'=>$this->m_simpanan->searchSimpanan($config['per_page'],$uri,$keyword,$type),//menmpilkan semua setoran
        );
        if($config['total_rows'] < 15) {
            $data['page'] = 1;
        } else {
            $data['page'] = $this->pagination->create_links();
        }
        //end of pagination
        $this->baseView('pencariansimpanan',$data);
    }
    //buat simpanan baru
    public function buatSimpanan(){
    	$idanggota = $this->uri->segment(3);
    	$data = array(
    		'no_anggota'=>$idanggota,
    		'tgl_simpan'=>date('Y-m-d'),
    		'jenis_simpanan'=>0
    		);
    	$this->db->insert('simpanan',$data);
    	redirect($this->agent->referrer());
    }
	//pinjam
	public function pinjam(){
		$this->load->model('m_pinjaman');
		$config=array(
            'per_page'=>20,//tampilan perhalamnnya
            'uri_segment'=>5,
            'num_link'=>5,
            'use_page_number'=>TRUE,
            'base_url'=>site_url('dashboard/pinjam'),
        );
        //pencarian atau bukan
        if(!empty($_GET['q'])){
        	$config['total_rows'] = $this->m_pinjaman->countGetPinjaman($_GET['q']);
        }else{
        	$config['total_rows'] = $this->m_pinjaman->countGetPinjaman('');
        }
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $uri = $this->uri->segment(5);
        if(!$uri) {
            $uri = 0;
        }
		$data = array(
			'title'=>'Laporan Pinjaman',
			'script'=>'$("#pinjaman").addClass("active");$("#pinjam").addClass("activesub");$("#pinjamanshow").addClass("in")',
		);
		//pencarian atau bukan
        if(!empty($_GET['q'])){
        	$data['view']=$this->m_pinjaman->getPinjaman($config['per_page'],$uri,'id_pinjaman','desc',$_GET['q']);
        }else{
        	$data['view']=$this->m_pinjaman->getPinjaman($config['per_page'],$uri,'id_pinjaman','desc','');
        }
		if($config['total_rows'] < 15) {
            $data['page'] = 1;
        } else {
            $data['page'] = $this->pagination->create_links();
        }
		$this->baseView('laporanpinjam',$data);
	}
	//angsuran
	public function angsuran(){
		$this->load->model('m_pinjaman');
		$config=array(
            'per_page'=>20,//tampilan perhalamnnya
            'uri_segment'=>5,
            'num_link'=>5,
            'use_page_number'=>TRUE,
            'base_url'=>site_url('dashboard/angsuran'),
        );
        //pencarian atau bukan
		if(!empty($_GET['q'])){
			$config['total_rows']=$this->m_pinjaman->countGetAngsuran($_GET['q']);
		}else{//semua data
			$config['total_rows']=$this->m_pinjaman->countGetAngsuran('');
		}
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $uri = $this->uri->segment(5);
        if(!$uri) {
            $uri = 0;
        }
		$data = array(
			'title'=>'Laporan Setor',
			'script'=>'$("#pinjaman").addClass("active");$("#angsuran").addClass("activesub");$("#pinjamanshow").addClass("in")',
		);
		//pencarian atau bukan
		if(!empty($_GET['q'])){
			$data['view']=$this->m_pinjaman->getAngsuran($config['per_page'],$uri,$_GET['q']);
		}else{//semua data
			$data['view']=$this->m_pinjaman->getAngsuran($config['per_page'],$uri,'');
		}
		if($config['total_rows'] < 15) {
            $data['page'] = 1;
        } else {
            $data['page'] = $this->pagination->create_links();
        }
		$this->baseView('laporanangsuran',$data);
	}
	//jaminan
	//angsuran
	public function jaminan(){
		$this->load->model(array('m_pinjaman','m_jaminan'));//laod auto model
		$config=array(
            'per_page'=>20,//tampilan perhalamnnya
            'uri_segment'=>5,
            'num_link'=>5,
            'use_page_number'=>TRUE,
            'base_url'=>site_url('dashboard/jaminan'),
        );
        //pencarian atau bukan
		if(!empty($_GET['q'])){
			$config['total_rows']=$this->m_jaminan->countSearchJaminan($_GET['q']);
		}else{//semua data
			$config['total_rows']=$this->m_jaminan->countGetJaminan('');
		}
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $uri = $this->uri->segment(5);
        if(!$uri) {
            $uri = 0;
        }
		$data = array(
			'title'=>'Laporan Jaminan',
			'script'=>'$("#pinjaman").addClass("active");$("#jaminan").addClass("activesub");$("#pinjamanshow").addClass("in")',
		);
		//pencarian atau bukan
		if(!empty($_GET['q'])){
			$data['view']=$this->m_jaminan->searchJaminan($config['per_page'],$uri,$_GET['q']);
		}else{//semua data
			$data['view']=$this->m_jaminan->getJaminan($config['per_page'],$uri,'');
		}
		if($config['total_rows'] < 15) {
            $data['page'] = 1;
        } else {
            $data['page'] = $this->pagination->create_links();
        }
		$this->baseView('laporanjaminan',$data);
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

	/*
	* ALL ABOUT CETAK PDF
	*/
	//cetak setoran
	public function cetaksetoran(){
		$bln = $_GET['bln'];
		$thn = $_GET['thn'];
		$data['view'] = $this->m_simpanan->getSetoranByDate($bln,$thn,'setoran');//data yang akan dimasukan ke pdf
		$data['title'] = "Setoran Bulan $bln Tahun $thn";
		$this->load->view('cetak/setoran',$data);
		$html = $this->output->get_output();
		$this->load->library('dompdf_gen');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Setoran Bulan $bln Tahun $thn.pdf");//pdf file name
	}
	//cetak penarikan
	public function cetakpenarikan(){
		$bln = $_GET['bln'];
		$thn = $_GET['thn'];
		$data['view'] = $this->m_simpanan->getSetoranByDate($bln,$thn,'penarikan');//data yang akan dimasukan ke pdf
		$data['title'] = "Penarikan Bulan $bln Tahun $thn";
		$this->load->view('cetak/penarikan',$data);
		$html = $this->output->get_output();
		$this->load->library('dompdf_gen');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Penarikan Bulan $bln Tahun $thn.pdf");//pdf file name
	}
	//cetak pinjaman
	public function cetakpinjaman(){
		$this->load->model('m_pinjaman');
		$bln = $_GET['bln'];
		$thn = $_GET['thn'];
		$data['view'] = $this->m_pinjaman->getPinjamanByDate($bln,$thn);//data yang akan dimasukan ke pdf
		$data['title'] = "Pinjaman Bulan $bln Tahun $thn";
		$this->load->view('cetak/pinjaman',$data);
		$html = $this->output->get_output();
		$this->load->library('dompdf_gen');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Pinjaman Bulan $bln Tahun $thn.pdf");//pdf file name
	}
	//cetak angsuran
	public function cetakangsuran(){
		$this->load->model('m_pinjaman');
		$bln = $_GET['bln'];
		$thn = $_GET['thn'];
		$data['view'] = $this->m_pinjaman->getAngsuranByDate($bln,$thn);//data yang akan dimasukan ke pdf
		$data['title'] = "Angsuran Bulan $bln Tahun $thn";
		$this->load->view('cetak/angsuran',$data);
		$html = $this->output->get_output();
		$this->load->library('dompdf_gen');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Angsuran Bulan $bln Tahun $thn.pdf");//pdf file name
	}
	//cetak jaminan
	public function cetakjaminan(){
		$this->load->model('m_pinjaman');
		$bln = $_GET['bln'];
		$thn = $_GET['thn'];
		$data['view'] = $this->m_pinjaman->getJaminanByDate($bln,$thn);//data yang akan dimasukan ke pdf
		$data['title'] = "Jaminan Bulan $bln Tahun $thn";
		$this->load->view('cetak/jaminan',$data);
		$html = $this->output->get_output();
		$this->load->library('dompdf_gen');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Jaminan Bulan $bln Tahun $thn.pdf");//pdf file name
	}
	//cetak anggota
	public function cetakanggota(){
		$this->load->model('m_anggota');
		$limit = 100;
		$offset = 0;
		$data['view'] = $this->m_anggota->getAnggota($limit,$offset);//data yang akan dimasukan ke pdf
		$data['title'] = "Laporan Anggota";
		$this->load->view('cetak/anggota',$data);
		$html = $this->output->get_output();
		$this->load->library('dompdf_gen');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Anggota.pdf");//pdf file name
	}
}
/* End of file login.php */
/* Location: ./application/controllers/welcome.php */
