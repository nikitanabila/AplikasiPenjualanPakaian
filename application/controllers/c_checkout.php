<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class c_checkout extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('m_shop');
            $this->load->model('m_penjualan');
            $this->load->model('m_jual');
            $this->load->library('cart');
        }

        public function display(){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "key: b34d00bf1ddb1fee5e55e0de620719ad"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {                
                $responseobject = json_decode($response); //agar agar json menjadi objek php menggunakan json decode
                $data['kota'] = $responseobject->rajaongkir->results;
            }

            $data1['content'] = $this->load->view('v_checkout',$data,true);
            $this->load->view('v_template',$data1);
        }
        
        public function checkout_submit(){
            $data["pembeli"]= array(
                "nama"=>$this->input->post("nama"),
                "nohp"=>$this->input->post("nohp"),
                "alamat"=>$this->input->post("alamat"),
                "kota"=>$this->input->post("kota"),
                "kodepos"=>$this->input->post("kodepos"),
                "total"=>$this->input->post('total'),
            
            );

            $no_penjualan=$this->m_penjualan->inputpenjualan($data["pembeli"]);
            echo json_encode($data["pembeli"]); //karean data pembeli iu objek php maka harus dijadiin json

            $data["jual"] = array(
                "no_penjualan"=>$no_penjualan,

            );

            foreach ($this->cart->contents() as $key => $cart) {
                $data["jual"]["kode_barang"]=$cart["id"];
                $data["jual"]["jumlah_jual"]=$cart["qty"];
                $data["jual"]["harga_jual"]=$cart["price"];

                $this->m_jual->inputjual($data["jual"]);
                $this->m_shop->reducestock($data["jual"]["kode_barang"], $data["jual"]["jumlah_jual"]);
            }

            $this->cart->destroy();

            redirect("c_home/display");
        }


        public function displayReceipt(){
            $total_berat=0;

            foreach ($this->cart->contents() as $key => $value) {
                $total_berat+=$value['berat']*$value['qty'];
            }

            $data["pembeli"]= array(
                "nama"=>$this->input->post("nama"),
                "nohp"=>$this->input->post("nohp"),
                "alamat"=>$this->input->post("alamat"),
                "kota"=>$this->input->post("kota"),
                "kodepos"=>$this->input->post("kodepos"),
                "total"=>$this->cart->total(),
                "totalberat"=> $total_berat
        
            );
            $idkota = $this->input->post('kotatujuan');

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "origin=501&destination=".$idkota."&weight=$total_berat&courier=jne",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: b34d00bf1ddb1fee5e55e0de620719ad"
                ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                echo "cURL Error #:" . $err;
                } else {
                echo $response;
                //     // $responseobject = json_decode($response);
                //     // $data['ongkir'] = $responseobject->rajaongkir->results[0]->costs[0]->cost[0]->value;
                    
                //     // $data1['content'] = $this->load->view('v_receipt',$data,true);
                //     // $this->load->view('v_template',$data1);
                }



        }

    }
?>