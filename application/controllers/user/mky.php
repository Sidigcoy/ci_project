<?php 

class Mky extends CI_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		if($this->session->userdata('role') != "mky"){
			redirect(base_url("login/logout"));
		}
		$this->load->model('m_mky');
		ini_set('max_execution_time', 0); 
	}

	function index(){  
		
		//$a['surat_keluar']	= $this->model_admin->tampil_surat_keluar()->num_rows();
		$a['page']	= "home";
		$this->load->view('mky/index', $a);
	}
 
	
	function mp(){
		$a['data']	= $this->m_mky->man_power()->result_object();
		$a['page']	= "mp"; 
		$this->load->view('mky/index', $a);
	}
	
	function mp_to_excel(){
		$a['title'] = 'Laporan Preample Excel';
		$a['data'] = $this->m_mky->man_power()->result_object();
		$this->load->view('mky/mp_to_excel',$a);
	}
}