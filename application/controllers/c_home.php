<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class c_home extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('m_shop');
            $this->load->library('cart');
        }

        public function display(){
            $data['barang'] = $this->m_shop->getData();
            $data1['content'] = $this->load->view('v_home',$data,true);
            $this->load->view('v_template',$data1);
        }
    }
?>