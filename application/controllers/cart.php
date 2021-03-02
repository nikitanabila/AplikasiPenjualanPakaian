<?php
defined('BASEPATH') or exit('No dorect script access allowed');
    class Cart extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('m_shop');
            $this->load->library('cart');
            $this->load->library('session');
        }
        public function index(){
            $data['items'] = $this->cart->contents();
            $data1['content']=$this->load->view('v_cart',$data,true);
            $this->load->view('v_template',$data1);

            // if(!$this->session->has_userdata('cart')){
            //     // $emptyArray= (array) null;
            //     // $data['items'] =var_dump($emptyArray);
            //     $data['total']=0;
            //     $data1['content']=$this->load->view('v_cart',$data,true);
            //     $this->load->view('v_template',$data1);
            // }
            // else{
            //     $data['items'] = array_values(unserialize($this->session->userdata('cart')));
            //     $data['total']=$this->total();
            //     $data1['content']=$this->load->view('v_cart',$data,true);
            //     $this->load->view('v_template',$data1);
            // }
        }
        public function buy($id){
            $product=$this->productModel->find($id);
            $item=array(
                'id'=>$product->kode,
                'name'=>$product->nama,                
                'price'=>$product->harga,
                'qty'=>1,
                'berat'=>$product->berat_barang,
                'photo'=>$product->gambar
            );
            // if(!$this->session->has_userdata('cart')){
            //     $cart=array($item);
            //     $this->session->set_userdata('cart',serialize($cart));
            // }else{
            //     $index = $this->exists($id);
            //     $cart = array_values(unserialize($this->session->userdata('cart')));
            //     if($index==-1){
            //         array_push($cart,$item);
            //         $this->session->set_userdata('cart',serialize($cart));
            //     }else{
            //         $cart[$index]['quantity']++;
            //         $this->session->set_userdata('cart',serialize($cart));
            //     }
            // }
            $this->cart->insert($item);
            redirect('cart/index');
        }

        public function remove($rowid){
            // $index = $this->exists($rowid);
            // $cart = array_values(unserialize($this->session->userdata('cart')));
            // unset($cart[$index]);
            // $this->session->set_userdata('cart', serialize($cart));
            $this->cart->remove($rowid);
            redirect('cart');
        }

        public function destroy(){
            // $this->session->set_userdata('cart', serialize($cart));
            $this->cart->destroy();
            redirect('cart');
        }

        private function exists($id){
            $cart=array_values((unserialize($this->session->userdata('cart'))));
            for($i=0;$i<count($cart);$i++){
                if($cart[$i]['id']==$id){
                    return $i;
                }
            }
            return -1;
        }
        
        private function total(){
            $item=array_values(unserialize($this->session->userdata('cart')));
            $s=0;
            foreach($item as $items){
                $s+=$items['price']*$items['quantity'];
            }
            return $s;
        }
    }
?>