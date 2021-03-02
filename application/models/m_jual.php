<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class m_jual extends CI_Model{
        public function inputjual($data){
            $this->db->query("insert into jual(no_penjualan, kode_barang, jumlah_jual, harga_jual) VALUES($data[no_penjualan], $data[kode_barang], $data[jumlah_jual], $data[harga_jual] )");

            
        }
    }
    
?>