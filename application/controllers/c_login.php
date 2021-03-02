<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class c_login extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('m_admin');
        }

        public function login_form(){
            $data1['content'] = $this->load->view('v_login','',true);
            $this->load->view('v_template',$data1);
        }
        
        public function login(){
            $username=$this->input->post("username"); //yg kutip dari html
            $password=md5($this->input->post("password"));            
            $admin=$this->m_admin->getAdmin($username, $password);

            if($admin!=NULL){
                $this->session->set_userdata(['logged_user' => $admin]);                
                redirect("c_penjualan/display");
            }
            else{                
                redirect("c_home/display");
            }
        
        }

        public function logout(){
            $this->session->unset_userdata('logged_user');
            redirect("c_home/display");
        }
    }
?>