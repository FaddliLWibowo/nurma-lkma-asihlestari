<?php

class M_simpanan extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	//ALL ABOUT setor
	//menampilkan semua setor
	public function getSetor(){
		$this->db->limit($limit,$offset);
		$this->db->get('simpanan');
	}
	//menampilkan total setor
	public function countGetSetor(){
		$this->db->get('simpanan');
	}
}