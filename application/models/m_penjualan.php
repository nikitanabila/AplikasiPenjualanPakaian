<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class m_penjualan extends CI_Model{
        public function inputpenjualan($data){
            $this->db->query("insert into penjualan(nama, nohp, alamat, kota, kodepos, status, total) VALUES('$data[nama]', '$data[nohp]', '$data[alamat]', '$data[kota]', '$data[kodepos]', 'Belum Bayar', $data[total] )");

            return $this->db->insert_id();
            
        }

        public function getData(){
            $query = $this->db->query("select * from penjualan");
            return $query->result_array();
        }

        public function setStatusPenjualan($id, $newstatus){
            $this->db->query("update penjualan set status = '$newstatus' WHERE no_penjualan = $id ");
        }
    }
    
?>