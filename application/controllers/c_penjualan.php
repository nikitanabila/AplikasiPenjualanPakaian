<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    class c_penjualan extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('m_shop');
            $this->load->model('m_penjualan');
            $this->load->model('m_jual');
            $this->load->library('cart');
            $this->load->library('pagination');
            if ($this->session->userdata('logged_user')==NULL){
                redirect('c_login/login_form');
            }
        }

        public function display(){
            $data["penjualan"] = $this->m_penjualan->getData();
            $data1['content'] = $this->load->view('v_penjualan',$data,true);
            $this->load->view('v_template',$data1);
        }
        
        public function setStatusPenjualan(){
            $id = $this->input->post('id');
            $newstatus = $this->input->post('newstatus');
            $this->m_penjualan->setStatusPenjualan($id, $newstatus);

            redirect('c_penjualan/display');
        }

        public function exportBarang(){
            $listbarang=$this->m_shop->getData();
            $spreadsheet = new Spreadsheet;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', "Kode")
                ->setCellValue('B1', "Nama Barang")
                ->setCellValue('C1', "Harga Barang")
                ->setCellValue('D1', "Stok Barang")
                ->setCellValue('E1', "Berat Barang")
                ->setCellValue('F1', "Gambar Barang")
                ->setCellValue('G1', "Keterangan Barang");
            
            $row=2;
            foreach($listbarang as $barang){
                $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'.$row, $barang["kode"])
                ->setCellValue('B'.$row, $barang["nama"])
                ->setCellValue('C'.$row, $barang["harga"])
                ->setCellValue('D'.$row, $barang["stok"])
                ->setCellValue('E'.$row, $barang["berat_barang"])
                ->setCellValue('F'.$row, $barang["gambar"])   
                ->setCellValue('G'.$row, $barang["keterangan"]);
                $row++;
            }

            $writer= new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Latihan.xlsx"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');

        }

        public function importbarangform(){
            $data1['content'] = $this->load->view('v_importbarang','',true);
            $this->load->view('v_template',$data1);
        }


        public function importbarang(){
            
            if(isset($_FILES['filebarang'])){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

                $spreadsheet = $reader->load($_FILES['filebarang']['tmp_name']);
                $sheet_data = $spreadsheet->getActiveSheet()->toArray();

                for($i=1; $i<count($sheet_data); $i++){
                    $barang = array(
                        'kode' => $sheet_data[$i][0],
                        'nama' => $sheet_data[$i][1],
                        'harga' => $sheet_data[$i][2],
                        'stok' => $sheet_data[$i][3],
                        'berat_barang' => $sheet_data[$i][4],
                        'gambar' => $sheet_data[$i][5],
                        'keterangan' => $sheet_data[$i][6],                        
                    );
                    $this->m_shop->insertbarang($barang);
                }
                redirect("c_penjualan/display");

            }
        }

        public function exportBarangpdf(){
            $this->load->library('pdf');
            $pdf= new FPDF('p', 'mm', 'A4');
            $pdf->AddPage();

            $pdf->Image(base_url().'asset/wirusjaya.png', 160, 6, 40, 0);
            $pdf->setY(40);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(190, 7, 'WIRUSJAYA', 0, 1, 'C');
            $pdf->setY(60);
            $pdf->Cell(15, 6, "Kode", 1, 0);
            $pdf->Cell(30, 6, 'nama', 1, 0);
            $pdf->Cell(50, 6, 'harga', 1, 0);
            $pdf->Cell(27, 6, 'stok', 1, 0);
            $pdf->Cell(70, 6, 'keterangan', 1, 1);

            
            $listbarang=$this->m_shop->getData();

            foreach($listbarang as $barang){
                $pdf->Cell(15, 6, $barang['kode'], 1, 0);
                $pdf->Cell(30, 6, $barang['nama'], 1, 0);
                $pdf->Cell(50, 6, $barang['harga'], 1, 0);
                $pdf->Cell(27, 6, $barang['stok'], 1, 0);
                $pdf->Cell(70, 6, $barang['keterangan'], 1, 1);
            }

            $pdf->Output();


        }

        public function barangpagination(){
            $listbarang=$this->m_shop->getData();

            $config['base_url'] = base_url().'index.php/c_penjualan/barangpagination/';
            $config['total_rows'] = count($listbarang);
            $config['per_page'] = 4;
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Prev';
            $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close'] = '</ul></nav></div>';
            $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] = '</span></li>';
            $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close'] = '</span>Next</li>';
            $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close'] = '</span></li>';

            if ($this->uri->segment(3)){
                $start=$this->uri->segment(3);
            }else{
                $start=0;
            }

            $this->pagination->initialize($config);
            $data['barang']=$this->m_shop->getbarangpagination($config['per_page'], $start);
            $data['link']=$this->pagination->create_links();

            $data1['content'] = $this->load->view('v_barangadmin',$data,true);
            $this->load->view('v_template',$data1);

        }

        public function searchbarangpagination(){
            $namabarang=$this->input->get('nama');
            if ($namabarang!=NULL){
                $this->session->set_userdata(['keyword' => $namabarang]);
            }else{
                // redirect('c_penjualan/barangpagination');
            }
            $keyword=$this->session->userdata('keyword');

            $listbarang=$this->m_shop->searchbarang($keyword);

            $config['base_url'] = base_url().'index.php/c_penjualan/searchbarangpagination/';
            $config['total_rows'] = count($listbarang);
            $config['per_page'] = 1;
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Prev';
            $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close'] = '</ul></nav></div>';
            $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] = '</span></li>';
            $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close'] = '</span>Next</li>';
            $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close'] = '</span></li>';

            if ($this->uri->segment(3)){
                $start=$this->uri->segment(3);
            }else{
                $start=0;
            }

            $this->pagination->initialize($config);
            $data['barang']=$this->m_shop->searchbarangpagination($config['per_page'], $start, $keyword);
            $data['link']=$this->pagination->create_links();

            $data1['content'] = $this->load->view('v_barangadmin',$data,true);
            $this->load->view('v_template',$data1);



        }


    }
?>