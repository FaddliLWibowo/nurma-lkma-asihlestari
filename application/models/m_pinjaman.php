<?php

class M_pinjaman extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    //tampilan pinjaman untuk PDF
    public function getPinjamanByDate($bln,$thn){
        //bln order
        if($bln != 0){
            $this->db->where('MONTH(pinjaman.tgl_pinjam) ='.$bln);
        } 
        //th order
        if($thn != 0){
           $this->db->where('YEAR(pinjaman.tgl_pinjam) ='.$thn);
       }
       //get result array
       $query = $this->db->get('pinjaman');
       if($query->num_rows()>0){return $query->result_array();}else{return array();}
   }
   //tampilan angsuran untuk PDF
   public function getAngsuranByDate($bln,$thn){
        //bln order
    if($bln != 0){
        $this->db->where('MONTH(angsuran.tgl_angsur) ='.$bln);
    } 
        //th order
    if($thn != 0){
       $this->db->where('YEAR(angsuran.tgl_angsur) ='.$thn);
   }
       //get result array
   $this->db->join('pinjaman','angsuran.id_pinjaman=pinjaman.id_pinjaman');
   $query = $this->db->get('angsuran');
   if($query->num_rows()>0){return $query->result_array();}else{return array();}
}
   //tampilan jaminan untuk PDF
public function getJaminanByDate($bln,$thn){
    if($bln != 0){
        $this->db->where('MONTH(pinjaman.tgl_pinjam) ='.$bln);
    } 
        //th order
    if($thn != 0){
       $this->db->where('YEAR(pinjaman.tgl_pinjam) ='.$thn);
   }
       //get result array
   $this->db->join('pinjaman','pinjaman.id_pinjaman=jaminan.id_pinjaman');
   $query = $this->db->get('jaminan');
   if($query->num_rows()>0){return $query->result_array();}else{return array();}
}
    /*
    * ALL ABOUT PINJAMAN
    */
    //menampilkan semua data pinjaman
    public function getPinjaman($limit,$offset,$orderby='',$ordertype='',$keyword=''){
        if(!empty($orderby)){$this->db->order_by($orderby,$ordertype);}
        if(!empty($keyword)){$this->db->where('pinjaman.id_pinjaman',$keyword);}
        $this->db->join('anggota','anggota.no_anggota=pinjaman.no_anggota','left');
        $query=$this->db->get('pinjaman');
        return $query->result_array();
    }
    //total data pinjaman
    public function countGetPinjaman($keyword=''){
        if(!empty($keyword)){$this->db->where('pinjaman.id_pinjaman',$keyword);}
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
    //menampilkan semua angsuran
    public function getAngsuran($limit,$offset,$keyword=''){
        if(!empty($keyword)){
            $this->db->where('angsuran.id_pinjaman',$keyword);
        }
        $this->db->order_by('id_angsuran','DESC');
        $this->db->limit($limit,$offset);
        $this->db->join('pinjaman','pinjaman.id_pinjaman=angsuran.id_pinjaman');
        $query = $this->db->get('angsuran');
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
    //menghitung semua angsuran
    public function countGetAngsuran($keyword=''){
        if(!empty($keyword)){
            $this->db->where('angsuran.id_pinjaman',$keyword);
        }
        $this->db->order_by('id_angsuran','DESC');
        $this->db->join('pinjaman','pinjaman.id_pinjaman=angsuran.id_pinjaman');
        $query = $this->db->get('angsuran');
        return $query->num_rows();
    }
    //total angsuran
    public function totalAngsuran($idpinjaman){
        $this->db->where('id_pinjaman',$idpinjaman);
        $this->db->select_sum('total_angsur');
        $query = $this->db->get('angsuran');
        $query = $query->row_array();
        return $query['total_angsur'];
    }
    //list angsuran berdasarkan id pinjaman
    public function listAngsuran($idpinjaman){
        $this->db->where('id_pinjaman',$idpinjaman);
        $query = $this->db->get('angsuran');
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
    //tanggal terakhir bayar angsuran
    public function tanggalTerakhirAngsur($idpinjaman){
        $this->db->where('id_pinjaman',$idpinjaman);
        $this->db->order_by('id_angsuran','DESC');
        $this->db->select('tgl_angsur');
        $query = $this->db->get('angsuran');
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return array();
        }
    }
}