<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//start base class
class base extends CI_Controller { 
	public function __construct()
    {
        parent::__construct();
       date_default_timezone_set('Asia/Jakarta');
    }
	//base display
	 protected function baseView($content_user, $data) {
            //menyimpan variabel content_user
            $data['content_user'] = $content_user;
            //menyisipkan file display-user.php
            $this->load->view('base/base.php', $data);
      }
}
