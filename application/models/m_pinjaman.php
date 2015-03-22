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
        return $query->result_array();
    }
    //total data pinjaman
    public function countGetPinjaman($limit,$offset,$orderby='',$ordertype=''){
        if(!empty($orderby)){
            $this->db->order($orderby,$ordertype);
        }
        return $this->db->count_all_results('pinjaman');
    }
    //menampilkan semua pinjaman oleh anggota
    public function byAnggota($limit,$offset,$noanggota){
        $this->db->limit($limit,$offset);
        $this->db->where('no_anggota',$noanggota);
        $query = $this->db->get('pinjaman');
        if($query->num_rows()>0){
            return $query->result_array();//menampilkan hasil
        }else{
            return array();//array kosong
        }
    }
    //menampilkan detail pinjaman berdasarkan no anggota
    public function countByAnggota($noanggota){
        $this->db->where('no_anggota',$noanggota);
        $query = $this->db->get('pinjaman');
        return $query->num_rows();
    }
    //menampilkan detail pinjaman berdasarkan idpinjaman
    public function detailPinjaman($idpinjam){
        $sql = "SELECT pinjaman.id_pinjaman AS 'id_pinjaman',pinjaman.no_anggota AS 'no_anggota',pinjaman.tgl_pinjam,pinjaman.jatuh_tempo,pinjaman.besar_pinjaman,pinjaman.status,
        jaminan.id_jaminan,jaminan.jenis_jaminan,jaminan.nama_pemilik,jaminan.alamat_pemilik,jaminan.keterangan FROM pinjaman
        LEFT JOIN jaminan ON jaminan.id_pinjaman=pinjaman.id_pinjaman
        WHERE pinjaman.id_pinjaman = $idpinjam
        ORDER BY pinjaman.tgl_pinjam DESC
        ";
//        echo $sql;
        $query = $this->db->query($sql);
        if($query->num_rows()>0){return $query->row_array();}else{return array();}
    }
    /*
    * ALL ABOUT ANGSURAN
    */

//    list angsuran berdasarkan id pinjaman
    public function listAngsuran($idpinjaman){
        $this->db->where('id_pinjaman',$idpinjaman);
        $query = $this->db->get('angsuran');
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
}