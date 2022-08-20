<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
    function __construct(){
        parent::__construct();
        
        // cek login
        if($this->session->userdata('status') != "login")
        {
        redirect(base_url().'welcome?pesan=belumlogin'); 
        }
    }
    function index(){
        $data['transaksi'] = $this->db->query("select * from transaksi order by transaksi_id desc limit 10")->result(); 
        $data['kostumer'] = $this->db->query("select * from kustomer order by kustomer_id desc limit 10")->result();
        $data['mobil'] = $this->db->query("select * from mobil order by mobil_id desc limit 10")->result();
        $this->load->view('admin/header');
        $this->load->view('admin/index',$data);
        $this->load->view('admin/footer');
    }
    function logout(){
        $this->session->session_desroy(); redirect(base_url(). 'Welcome?pesan=logout');
    }
    function ganti_password(){
        $this->load->view('admin/header');
        $this->load->view('admin/ganti_password');
        $this->load->view('admin/footer');
    }
    function ganti_password_act(){
        $pass_baru = $this->input->post ('pass_baru');
        $ulang_pass = $this-> input ->post ('ulang_pass');
        $this->form_validation->set_rules('pass_baru', 'Password Baru', 'required|matches [ulang_pass]');
        $this->form_validation->set_rules('ulang_pass', 'Ulangi Password Baru','required');
        if($this->form_validation->run() != false){
            $data = array(
                'admin_password' => $pass_baru
            );
            $w = array(
                'admin_id' => $this->session->userdata('id'),
            );
            $this->M_rental->update_data($w, $data, 'admin');
            redirect(base_url().'admin/ganti_password?pesan=berhasil'); 
        }else{
            $this->load->view('admin/header'); 
            $this->load->view('admin/ganti_password'); 
            $this->load->view('admin/footer');
        }
    }
    function mobil(){
        $data['mobil'] = $this->M_rental->get_data('mobil') -> result();
        $this->load->view('admin/header'); 
        $this->load->view('admin/mobil', $data); 
        $this->load->view('admin/footer');
        }
    function mobil_add_act(){
        $merk = $this->input->post('merk'); 
        $plat = $this->input->post('plat'); 
        $warna = $this->input->post('warna'); 
        $tahun = $this->input->post('tahun'); 
        $status = $this->input->post('status'); 
        $data = array(
            'mobil_merk' => $merk, 
            'mobil_plat' => $plat, 
            'mobil_warna' => $warna, 
            'mobil_tahun' => $tahun, 
            'mobil_status' => $status,
             );
            $this->M_rental->insert_data($data, 'mobil');
             redirect(base_url().'admin/mobil');
    }
    function mobil_hapus($id){
        $where = array(
            'mobil_id ' => $id
        );
        $this->M_rental->delete_data($where,'mobil');
        redirect(base_url(). 'admin/mobil');
    }
    function mobil_edit($id){
        $where = array(
            'mobil_id' => $id
        );
        $data ['mobil'] = $this->M_rental->edit_data($where,'mobil')->result();
        $this->load->view('admin/header');
        $this->load->view('admin/mobil_edit',$data);
        $this->load->view('admin/footer');
    }
    function mobil_update(){
        $id = $this->input->post('id');
        $merk = $this->input->post('merk'); 
        $plat = $this->input->post('plat'); 
        $warna = $this->input->post('warna'); 
        $tahun = $this->input->post('tahun');
        $status = $this->input->post('status'); 
        $where = array(
            'mobil_id' => $id
        );
        $data = array(
            'mobil_merk' => $merk,
            'mobil_plat' => $plat,
            'mobil_warna' => $warna,
            'mobil_tahun' => $tahun,
            'mobil_status' => $status            
        );
        $this->M_rental->update_data($where,$data,'mobil');
        redirect(base_url().'admin/mobil');
    }
    function mobil_add(){
        $this->load->view('admin/header');
        $this->load->view('admin/mobil_add');
        $this->load->view('admin/footer');
    }
}

