<?php 

class It_services extends CI_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		if($this->session->userdata('role') != "it_services"){
			redirect(base_url("login/logout"));
		}
		$this->load->library('email');
		$this->load->model('m_it_services');
		ini_set('max_execution_time', 0); 
	}

	function index(){ 
		//$a['dbl_spkl']	= $this->m_it_services->double_sit_spkl()->num_rows(); //untuk ambil data dari file model_admin.php dengan function tampil_jenis
		//$a['dbl_bee']	= $this->m_it_services->double_bee()->num_rows();
		//$a['dbl_ooa']	= $this->m_it_services->double_sit_ooa()->num_rows();
		//$a['dbl_bt']	= $this->m_it_services->double_sit_bt()->num_rows();
		//$a['dbl_stagging']	= $this->m_it_services->double_stagging()->num_rows();
		//$a['ttl_plan']	= $this->m_it_services->total_plan()->num_rows();
		//$a['ttl_user_myhris']	= $this->m_it_services->total_user_myhris()->num_rows();
		//$a['data']	= $this->m_it_services->cek_tablespace()->result_object();
		//$a['cek_memori']	= $this->m_it_services->cek_memori()->result_object();
		//$a['cek_DRC'] = $this->m_it_services->cek_DRC()->result_object(); //Tambahan 30 Jan 2017
		//$a['FINGER_ID_LOG'] = $this->m_it_services->FINGER_ID_LOG()->result_object(); //Tambahan 29 Mar 2017
		
		//$a['surat_keluar']	= $this->model_admin->tampil_surat_keluar()->num_rows();
		$a['data']	= $this->m_it_services->man_power()->result_object();
		$a['page']	= "mp";
		$this->load->view('it_services/index', $a);
	}
	
	function sisa_cuti(){ 
		$a['data']	= $this->m_it_services->sisa_cuti()->result_object();
		$a['page']	= "sisa_cuti";
		$this->load->view('it_services/index', $a);
	}
	
	function mp(){
		$a['data']	= $this->m_it_services->man_power()->result_object();
		$a['page']	= "mp";
		//$this->load->model('m_services');
		$this->load->view('it_services/index', $a);
	}
	
	function resign(){
		$a['data']	= $this->m_it_services->resign()->result_object();
		$a['page']	= "resign";
		//$this->load->model('m_services');
		$this->load->view('it_services/index', $a);
	}
	
	function mp_to_excel(){
		$a['title'] = 'Laporan Preample Excel';
		$a['data'] = $this->m_it_services->man_power()->result_object();
		$this->load->view('it_services/mp_to_excel',$a);
		$this->email->from('hrmsc@bussan.co.id', 'Ayuzha.Chyank.diaCllu');
        $this->email->to('hrm_system_all@bussan.co.id');
		
 

        $this->email->subject('NOTIFIKASI'); 
        $this->email->message("Dear gaes,\r\n \r\nSeseorang dengan IP berikut: ".$_SERVER['REMOTE_ADDR']." dan menggunakan User: ".$this->session->userdata('role').", telah login dan mendownload MP aktif per hari Ini.\r\n \r\n Regards, \r\n System Administrator\r\n");  

        $this->email->send();

        // echo $this->email->print_debugger();
	}
	
	function resign_to_excel(){
		$a['title'] = 'Laporan Preample Excel';
		$a['data'] = $this->m_it_services->resign()->result_object();
		$this->load->view('it_services/resign_to_excel',$a);
		$this->email->from('hrmsf@bussan.co.id', 'Login Dulu Dongs');
        $this->email->to('hrm_system_all@bussan.co.id');
		
 

        $this->email->subject('NOTIFIKASI');
		//$this->email->attachment('NOTIFIKASI')->view('it_services/mp_to_excel',$a);
		//$this->email->message->view('email');
        $this->email->message("Dear gaes,\r\n \r\nSeseorang dengan IP berikut: ".$_SERVER['REMOTE_ADDR']." dan menggunakan User: ".$this->session->userdata('role').", telah login dan mendownload MP Resign per hari Ini.\r\n \r\n Regards, \r\n System Administrator\r\n");  

        $this->email->send();

        //echo $this->email->print_debugger();
	}
}