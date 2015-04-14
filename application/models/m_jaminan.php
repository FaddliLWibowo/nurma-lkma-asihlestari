<?php
class M_jaminan extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	//show all jaminan
	public function getJaminan($limit,$offset){
		$this->db->limit($limit,$offset);
		$this->db->join('pinjaman','pinjaman.id_pinjaman=jaminan.id_pinjaman');
		$query = $this->db->get('jaminan');
		return $query->result_array();//menampilkan hasil di $arrayName = array('' => , );
	}
	//total jaminan
	public function countGetJaminan(){
		$this->db->join('pinjaman','pinjaman.id_pinjaman=jaminan.id_pinjaman');
		$query = $this->db->get('jaminan');
		return $this->db->count_all_results();//menampilkan hasil di array
	}
	//pencarian jaminan
	public function searchJaminan($limit,$offset,$q){
		$this->db->limit($limit,$offset);
		$this->db->where('pinjaman.id_pinjaman',$q);//search by id pinjaman
		$this->db->join('pinjaman','pinjaman.id_pinjaman=jaminan.id_pinjaman');
		$query = $this->db->get('jaminan');
		return $query->result_array();//menampilkan hasil di array
	}
	//total pencarian jaminan
	public function countSearchJaminan($q){
		$this->db->where('pinjaman.id_pinjaman',$q);//search by id pinjaman
		$this->db->join('pinjaman','pinjaman.id_pinjaman=jaminan.id_pinjaman');
		$query = $this->db->get('jaminan');
		return $this->db->count_all_results();//menampilkan hasil di array
	}
}