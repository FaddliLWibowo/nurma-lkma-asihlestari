<?php

class M_pinjaman extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	/*
	* ALL ABOUT PINJAMAN
	*/
	//menampilkan semua data pinjaman
	public function getPinjaman($limit,$offset,$orderby='',$ordertype=''){
		if(!empty($orderby)){
			$this->db->order($orderby,$ordertype);
		}
		$query=$this->db->get('pinjaman');
		return $query->result_array()
	}
	//total data pinjaman
	public function countGetPinjaman($limit,$offset,$orderby='',$ordertype=''){
		if(!empty($orderby)){
			$this->db->order($orderby,$ordertype);
		}
		return $this->db->count_all_results('pinjaman');
	}

	/*
	* ALL ABOUT ANGSURAN
	*/
}