<?php

class M_simpanan extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    //ALL ABOUT setor
    //menampilkan setoran berdasarkan tanggal
    public function getSetoranByDate($bln,$thn,$type){
        //bln order
        if($bln != 0){
            $this->db->where('MONTH(aksiSimpanan.tgl) ='.$bln);
        } 
        //th order
        if($thn != 0){
             $this->db->where('YEAR(aksiSimpanan.tgl) ='.$thn);
        }
        //get result array
        $this->db->where('status',$type);
        $query = $this->db->get('aksiSimpanan');
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
    //menampilkan semua setor
    public function getSetor($limit,$offset){
        $this->db->limit($limit,$offset);
        $this->db->get('simpanan');
    }
    //menampilkan total setor
    public function countGetSetor(){
        $this->db->get('simpanan');
    }
    //cek saldo berdasarkan id anggota
    public function cekSaldo($idanggota){
        //mendapatkan total setoran
        $sqlsetoran = "SELECT SUM(aksiSimpanan.jumlah) AS 'jumlah' FROM aksiSimpanan
INNER JOIN simpanan ON simpanan.id_simpanan = aksiSimpanan.id_simpanan WHERE simpanan.no_anggota = ? AND aksiSimpanan.status = 'setoran'";
        $querysetoran  = $this->db->query($sqlsetoran,$idanggota);
        $querysetoran = $querysetoran->row_array();
        //get total setoran
        $totalsetoran = $querysetoran['jumlah'];

        //mendapatkan total penarikan
        $sqlpenarikan = "SELECT SUM(aksiSimpanan.jumlah) AS 'jumlah' FROM aksiSimpanan
INNER JOIN simpanan ON simpanan.id_simpanan = aksiSimpanan.id_simpanan WHERE simpanan.no_anggota = ? AND aksiSimpanan.status = 'penarikan'";
        $querypenarikan  = $this->db->query($sqlpenarikan,$idanggota);
        $querypenarikan = $querypenarikan->row_array();
        //get total setoran
        $totalpenarikan = $querypenarikan['jumlah'];
        $saldo = $totalsetoran-$totalpenarikan;
        return $saldo;
    }
    //get detail simpanan berdasarkan id anggota
    public function byAnggota($noanggota){
        $this->db->where('no_anggota',$noanggota);
        $query = $this->db->get('simpanan');
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return array();
        }
    }
    //get mutasi
    public function getMutasi($limit,$offset,$noanggota){
        $this->db->join('simpanan','simpanan.id_simpanan=aksiSimpanan.id_simpanan');
        $this->db->where('no_anggota',$noanggota);
        $this->db->order_by('tgl','DESC');
        $query = $this->db->get('aksiSimpanan');
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return array();
        }
    }
    //count mutasi
    public function countMutasi($noanggota){
        $this->db->join('simpanan','simpanan.id_simpanan=aksiSimpanan.id_simpanan');
        $this->db->where('no_anggota',$noanggota);
        $this->db->order_by('tgl','DESC');
        $query = $this->db->get('aksiSimpanan');
        return $query->num_rows();
    }
    //menampilkan semua setoran/$penarikan
    public function allSimpanan($limit,$offset,$type){
        $sql = "SELECT anggota.no_anggota,anggota.nama AS 'nama', aksiSimpanan.tgl AS 'tglaksi',aksiSimpanan.jumlah AS 'jumlah',aksiSimpanan.id_simpanan
        FROM aksiSimpanan
        INNER JOIN simpanan ON simpanan.id_simpanan = aksiSimpanan.id_simpanan
        INNER JOIN anggota ON simpanan.no_anggota = anggota.no_anggota
        WHERE aksiSimpanan.status = '$type'
        LIMIT $offset,$limit
        ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    //count all setoran
    public function countAllSimpanan($type){
        $sql = "SELECT anggota.no_anggota,anggota.nama AS 'nama', aksiSimpanan.tgl AS 'tglaksi',aksiSimpanan.jumlah AS 'jumlah',aksiSimpanan.id_simpanan
        FROM aksiSimpanan
        INNER JOIN simpanan ON simpanan.id_simpanan = aksiSimpanan.id_simpanan
        INNER JOIN anggota ON simpanan.no_anggota = anggota.no_anggota
        WHERE aksiSimpanan.status = '$type'
        ";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    //pencarian simpanan
    public function searchSimpanan($limit,$offset,$keyword,$type=''){
        $sql = "SELECT anggota.no_anggota,anggota.nama AS 'nama', aksiSimpanan.tgl AS 'tglaksi',aksiSimpanan.jumlah AS 'jumlah',aksiSimpanan.id_simpanan
        ,aksiSimpanan.status AS 'status' FROM aksiSimpanan
        INNER JOIN simpanan ON simpanan.id_simpanan = aksiSimpanan.id_simpanan
        INNER JOIN anggota ON simpanan.no_anggota = anggota.no_anggota
        WHERE aksiSimpanan.status = '$type' AND aksiSimpanan.id_simpanan = '$keyword'
        LIMIT $offset,$limit";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return array();
        }
    }
    //total hasil simpanan
    public function countSearchSimpanan($keyword,$type=''){
        $sql = "SELECT anggota.no_anggota,anggota.nama AS 'nama', aksiSimpanan.tgl AS 'tglaksi',aksiSimpanan.jumlah AS 'jumlah',aksiSimpanan.id_simpanan
        FROM aksiSimpanan
        INNER JOIN simpanan ON simpanan.id_simpanan = aksiSimpanan.id_simpanan
        INNER JOIN anggota ON simpanan.no_anggota = anggota.no_anggota
        WHERE aksiSimpanan.status = '$type'AND aksiSimpanan.id_simpanan = '$keyword'";
        $query = $this->db->query($sql);
        return $query->num_rows();//total hasil pencarian
    }

}