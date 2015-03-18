<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'application/controllers/base.php';
class Login extends base {

	/**
	 * login page digunakan untuk login pegawai ketika melayani customer
	 */
	public function index()//login page
	{
		if(!empty($_POST)){//do login
			$username = $_POST['inputusername'];//get username
			$password = md5($_POST['inputpassword']);//get password
			//is username and password match
		}
		$data = array(
			'title'=>'login'
			);
		$this->baseView('login',$data);
	}
}
/* End of file login.php */
/* Location: ./application/controllers/welcome.php */
