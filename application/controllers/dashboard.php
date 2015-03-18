<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'application/controllers/base.php';
class Dashboard extends base {
	/**
	 * login page digunakan untuk login pegawai ketika melayani customer
	 */
	public function index()//do login for pegawai
	{
		$data = array('title'=>'Dashboard');
		$this->baseView('dashboard',$data);
	}
}
/* End of file login.php */
/* Location: ./application/controllers/welcome.php */
