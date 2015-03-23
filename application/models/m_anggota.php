<?php
class M_anggota extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	//show anggota
	public function getAnggota($limit,$offset){
		$this->db->limit($limit,$offset);
		$query = $this->db->get('anggota');
		return $query->result_array();
	}
	//total anggota
	public function countGetAnggota(){return $this->db->count_all('anggota');}
	//search anggota
	public function searchAnggota($limit,$offset,$keyword){
		$this->db->or_like('nama',$keyword);
		$this->db->or_like('telepon',$keyword);
		$this->db->or_like('no_anggota',$keyword);
		$this->db->or_like('no_identitas',$keyword);
		$this->db->limit($limit,$offset);
		$query = $this->db->get('anggota');
		return $query->result_array();
	}
	//count search anggota
	public function countSearchAnggota($keyword){
		$this->db->or_like('nama',$keyword);
		$this->db->or_like('telepon',$keyword);
		$this->db->or_like('no_anggota',$keyword);
		$this->db->or_like('no_identitas',$keyword);
		return $this->db->count_all('anggota');
	}
	//detail anggota bersadasarkan nomor anggota
	public function detailAnggota($nomoranggota){
		$this->db->where('no_anggota',$nomoranggota);
		$query = $this->db->get('anggota');
		return $query->row_array();
	}

}