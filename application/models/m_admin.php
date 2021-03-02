<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class m_admin extends CI_Model{
        public function getAdmin($username, $password){
            $query = $this->db->query("select * from admin where username='$username' AND password='$password'");
            return $query->row_array(); // karena cuma satu
        }

    }
    
?>