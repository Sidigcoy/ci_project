<?php 

class Hr_system extends CI_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		if($this->session->userdata('role') != "hr_system"){
			redirect(base_url("login/logout"));
		}
		$this->load->library('email');
		$this->load->model('m_system');
		ini_set('max_execution_time', 0); 
	}

	function index(){ 
		$a['dbl_spkl']	= $this->m_system->double_sit_spkl()->num_rows(); //untuk ambil data dari file model_admin.php dengan function tampil_jenis
		$a['dbl_bee']	= $this->m_system->double_bee()->num_rows();
		$a['dbl_ooa']	= $this->m_system->double_sit_ooa()->num_rows();
		$a['dbl_bt']	= $this->m_system->double_sit_bt()->num_rows();
		$a['dbl_stagging']	= $this->m_system->double_stagging()->num_rows();
		$a['ttl_plan']	= $this->m_system->total_plan()->num_rows();
		$a['user_hcm']	= $this->m_system->user_hcm()->num_rows();
		$a['data']	= $this->m_system->cek_tablespace()->result_object();
		$a['cek_memori']	= $this->m_system->cek_memori()->result_object();
		$a['cek_drc'] = $this->m_system->cek_drc()->result_object(); //tambahan 30 jan 2017
		$a['compare_emp_num'] = $this->m_system->compare_emp_num()->result_object(); //tambahan 30 jan 2017
		$a['fail_route_detail'] = $this->m_system->fail_route_detail()->num_rows(); //tambahan 30 jan 2017
		//$a['finger_id_log'] = $this->m_system->finger_id_log()->result_object(); //tambahan 29 mar 2017
		$this->load->helper('tambahan');
		
		//$a['surat_keluar']	= $this->model_admin->tampil_surat_keluar()->num_rows();
		
		$a['page']	= "home";
		$this->email->from('baf-no-reply@bussan.co.id', 'Tukang Pantau HCM');
        //$this->email->to('hrm_system_all@bussan.co.id');
		$this->email->to('hrmsq@bussan.co.id','hrmsc@bussan.co.id','hrmsd@bussan.co.id');
		$this->email->cc('hrmsf@bussan.co.id');
        $this->email->subject('Notifikasi'); 
        //$this->email->message("Dear gaes,\r\n \r\nSeseorang dengan IP berikut: ".$_SERVER['REMOTE_ADDR']." dan menggunakan User: ".$this->session->userdata('role').", telah login dan mendownload MP aktif per hari Ini.\r\n \r\n Regards, \r\n System Administrator\r\n");
		
		if($this->m_system->compare_emp_num()->num_rows() > 0 ){
			foreach ($a['compare_emp_num'] as $lihat):	
				$a['message'] 		= $this->email->message(
						"Dear bu Umi,\r\n \r\nTelah ditemukan NIK karyawan yang tidak memenuhi standard. Berikut NIK tersebut: 
						\r\nNIK : ".$lihat->NIK." \r\nDATE_HIRE : ".$lihat->DATE_HIRE."\r\nNIK_COMPARE : ".$lihat->NIK_COMPARE."\r\nDATEHIRE_COMPARE : ".$lihat->DATEHIRE_COMPARE."\r\nLAST_UPD_BY_NIK : ".$lihat->LAST_UPD_BY_NIK."
						\r\nMohon bantuannya untuk memfollow up case tsb.\r\n \r\n Regards, \r\n Tukang Pantau\r\n"			 
				);
			endforeach;	 $a['send'] = $this->email->send();
		}
		
		
		$this->load->view('hr_system/index', $a);
	} 
	function sisa_cuti(){ 
		$a['data']	= $this->m_system->sisa_cuti()->result_object();
		$a['page']	= "sisa_cuti";
		$this->load->view('hr_system/index', $a);
	}
	
	function mp(){
		$a['data']	= $this->m_system->man_power()->result_object();
		$a['page']	= "mp";
		//$this->load->model('m_services');
		$this->load->view('hr_system/index', $a);
	}
	
	function mp_to_excel(){
		$a['title'] = 'Laporan Preample Excel';
		$a['data'] = $this->m_system->man_power()->result_object();
		$this->load->view('hr_system/mp_to_excel',$a);
		$this->email->from('hrmsf@bussan.co.id', 'Login Dulu Dongs');
        $this->email->to('hrmsf@bussan.co.id');
		
 

        $this->email->subject('NOTIFIKASI');
		//$this->email->attachment('NOTIFIKASI')->view('learning_and_development/mp_to_excel',$a);
		//$this->email->message->view('email');
        $this->email->message("Dear gaes,\r\n \r\nSeseorang dengan keterangan:
		\r\nComputer Barcode :".gethostbyaddr($_SERVER['REMOTE_ADDR'])." \r\nIP Address:".$_SERVER['REMOTE_ADDR']." \r\nUser Login: ".$this->session->userdata('role')." 
		\r\nTelah login dan mendownload MP aktif per hari Ini.\r\n \r\n Regards, \r\n System Administrator\r\n");  

        $this->email->send();

        echo $this->email->print_debugger();
	}
	
	
}