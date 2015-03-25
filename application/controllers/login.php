<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'application/controllers/base.php';
class Login extends base {
	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->load->model(array('m_user'));
	}
	/**
	 * login page digunakan untuk login pegawai ketika melayani customer
	 */
	public function index()//login page
	{
		//if has logged in
		$session = $this->session->userdata('karyawan'); 
		if(!empty($session)){
			redirect(site_url('dashboard'));
		}else{ //not logged in
			if(!empty($_POST)){//do login
			$username = $_POST['inputusername'];//get username
			$password = md5($_POST['inputpassword']);//get password
			//is username and password match
			$userdata = $this->m_user->login($username,$password);
			$sessiondata['karyawan'] = $userdata;
			$this->session->set_userdata($sessiondata);//set new session
			if(!empty($userdata)){//username and password matches
				redirect($this->agent->referrer());
			}else{//username and password not match
				redirect(site_url().'?error=username dan password tidak cocok');
			}
		}
		$data = array(
			'title'=>'login'
			);
		$this->baseView('login',$data);
	}		
}
	//logout
	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url(),'refresh');
	}
}
/* End of file login.php */
/* Location: ./application/controllers/welcome.php */
