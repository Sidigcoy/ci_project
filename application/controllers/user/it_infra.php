<?php 

class It_infra extends CI_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		if($this->session->userdata('role') != "it_infra"){
			redirect(base_url("login/logout"));
		}
		$this->load->model('m_system');
		ini_set('max_execution_time', 0); 
	}

	function index(){ 
		//$a['dbl_spkl']	= $this->m_system->double_sit_spkl()->num_rows(); //untuk ambil data dari file model_admin.php dengan function tampil_jenis
		//$a['dbl_bee']	= $this->m_system->double_bee()->num_rows();
		//$a['dbl_ooa']	= $this->m_system->double_sit_ooa()->num_rows();
		//$a['dbl_bt']	= $this->m_system->double_sit_bt()->num_rows();
		//$a['dbl_stagging']	= $this->m_system->double_stagging()->num_rows();
		//$a['ttl_plan']	= $this->m_system->total_plan()->num_rows();
		//$a['ttl_user_myhris']	= $this->m_system->total_user_myhris()->num_rows();
		$a['data']	= $this->m_system->cek_tablespace2()->result_object();
		$a['cek_memori'] = $this->m_system->cek_memori()->result_object();
		$a['cek_DRC'] = $this->m_system->cek_DRC()->result_object(); //Tambahan 30 Jan 2017
		//$a['FINGER_ID_LOG'] = $this->m_system->FINGER_ID_LOG()->result_object(); //Tambahan 29 Mar 2017
		
		//$a['surat_keluar']	= $this->model_admin->tampil_surat_keluar()->num_rows();
		$a['page']	= "home";
		$this->load->view('it_infra/index', $a);
	}
	
	// function sisa_cuti(){ 
	// 	$a['data']	= $this->m_system->sisa_cuti()->result_object();
	// 	$a['page']	= "sisa_cuti";
	// 	$this->load->view('hr_system/index', $a);
	// }
	
	// function mp(){
	// 	$a['data']	= $this->m_system->man_power()->result_object();
	// 	$a['page']	= "mp";
	// 	//$this->load->model('m_services');
	// 	$this->load->view('hr_system/index', $a);
	// }	
}