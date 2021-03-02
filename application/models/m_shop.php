<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class m_shop extends CI_Model{
        public function getData(){
            $query = $this->db->query("select * from barang");
            return $query->result_array();
        }

        public function find($id){
            return $this->db->where('kode', $id)->get('barang')->row();
        }

        public function reducestock($id, $qty){
            return $this->db->query("update barang set stok = stok - $qty WHERE kode = $id");
        }

        public function insertbarang($barang){
            $this->db->query("insert into barang(nama, harga, stok, berat_barang, gambar, keterangan) VALUES('$barang[nama]', '$barang[harga]', '$barang[stok]', '$barang[berat_barang]', '$barang[gambar]', '$barang[keterangan]')");
        }

        public function getbarangpagination($limit, $start){
            $query = $this->db->query("select * from barang limit $start, $limit");
            return $query->result_array();
        }

        public function searchbarangpagination($limit, $start, $nama){
            $query = $this->db->query("select * from barang WHERE nama like '%".$nama."%' limit $start, $limit");
            return $query->result_array();
        }

        public function searchbarang($nama){
            $query = $this->db->query("select * from barang WHERE nama like '%".$nama."%' ");
            return $query->result_array();
        }
    }
    
?>