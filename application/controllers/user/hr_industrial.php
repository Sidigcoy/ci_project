<?php 

class Hr_industrial extends CI_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		if($this->session->userdata('role') != "hr_industrial"){
			redirect(base_url("login/logout"));
		}
		$this->load->model('m_industrial');
		ini_set('max_execution_time', 0); 
	}

	function index(){ 
		$a['jenis']	= $this->m_industrial->tampil_jenis()->num_rows(); //untuk ambil data dari file model_admin.php dengan function tampil_jenis
		//$a['surat_keluar']	= $this->model_admin->tampil_surat_keluar()->num_rows();
		$a['page']	= "home";
		$this->load->view('hr_industrial/index', $a);
	}
	
	function sisa_cuti(){ 
		$a['data']	= $this->m_industrial->sisa_cuti()->result_object();
		$a['page']	= "sisa_cuti";
		$this->load->view('hr_industrial/index', $a);
	}
	
	  
}