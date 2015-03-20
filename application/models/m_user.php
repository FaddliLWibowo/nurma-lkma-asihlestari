<?php
class M_user extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	//cek login
	public function login($username,$password){
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('user');
		if($query->num_rows()>0){
			return $query->row_array();//usernae and password match
		}else{
			return false;//username and password not match
		}
	}
	//menampilkan semua karyawan
	public function getKaryawan($limit,$offset,$level=''){
		if(!empty($level)){
			$this->db->where('level',$level);//show karyawan by level (admin/karyawan)
		}
		$this->db->limit($limit,$offset);
		$query = $this->db->get('user');
		return $query->result_array();
	}
	//total karyawan
	public function countGetKaryawan($level=''){
		if(!empty($level)){
			$this->db->where('level',$level);//show karyawan by level (admin/karyawan)
		}
		return $this->db->count_all_results('user');
	}
	//get user by user_id
	public function getUserByid($id){
		$this->db->where('user_id',$id);
		$query = $this->db->get('user');
		return $query->row_array();//get detail user
	}
}