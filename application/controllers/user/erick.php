<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		if($this->session->userdata('role') != "erick"){
			redirect(base_url("login/logout"));
		}
		// $this->load->model('m_rizsan');
		// ini_set('max_execution_time', 0); 
		
		$this->load->library('excel');
	}


	function index(){ 
		//$a['absensi_dept_terkait']	= $this->m_system->double_sit_spkl()->num_rows(); //untuk ambil data dari file model_admin.php dengan function tampil_jenis
		//$a['dbl_bee']	= $this->m_system->double_bee()->num_rows();
		//$a['dbl_ooa']	= $this->m_system->double_sit_ooa()->num_rows();
		//$a['dbl_bt']	= $this->m_system->double_sit_bt()->num_rows();
		//$a['dbl_stagging']	= $this->m_system->double_stagging()->num_rows();
		//$a['ttl_plan']	= $this->m_system->total_plan()->num_rows();
		//$a['ttl_user_myhris']	= $this->m_system->total_user_myhris()->num_rows();
		//$a['cek_memori']	= $this->m_system->cek_memori()->result_object();
		//$a['cek_DRC'] = $this->m_system->cek_DRC()->result_object(); //Tambahan 30 Jan 2017
		//$a['FINGER_ID_LOG'] = $this->m_system->FINGER_ID_LOG()->result_object(); //Tambahan 29 Mar 2017
		//$a['surat_keluar']	= $this->model_admin->tampil_surat_keluar()->num_rows();
		$a['page']	= "home";
		//$a['absensi_dept_terkait']	= $this->m_rizsan->absensi_dept_terkait()->result_object();
		$this->load->view('services/index', $a);
	}