<?php 

class Hr_organization_dev extends CI_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		if($this->session->userdata('role') != "hr_organization_dev"){
			redirect(base_url("login/logout"));
		}
		$this->load->library('email');
		$this->load->model('m_od');
		ini_set('max_execution_time', 0); 
	}

	function index(){ 
		//$a['dbl_spkl']	= $this->m_lnd->double_sit_spkl()->num_rows(); //untuk ambil data dari file model_admin.php dengan function tampil_jenis
		//$a['dbl_bee']	= $this->m_lnd->double_bee()->num_rows();
		//$a['dbl_ooa']	= $this->m_lnd->double_sit_ooa()->num_rows();
		//$a['dbl_bt']	= $this->m_lnd->double_sit_bt()->num_rows();
		//$a['dbl_stagging']	= $this->m_lnd->double_stagging()->num_rows();
		//$a['ttl_plan']	= $this->m_lnd->total_plan()->num_rows();
		//$a['ttl_user_myhris']	= $this->m_lnd->total_user_myhris()->num_rows();
		//$a['data']	= $this->m_lnd->cek_tablespace()->result_object();
		//$a['cek_memori']	= $this->m_lnd->cek_memori()->result_object();
		//$a['cek_DRC'] = $this->m_lnd->cek_DRC()->result_object(); //Tambahan 30 Jan 2017
		//$a['FINGER_ID_LOG'] = $this->m_lnd->FINGER_ID_LOG()->result_object(); //Tambahan 29 Mar 2017
		
		//$a['surat_keluar']	= $this->model_admin->tampil_surat_keluar()->num_rows();
		$a['data']	= $this->m_od->man_power()->result_object();
		$a['page']	= "mp";
		$this->load->view('hr_organization_dev/index', $a);
	} 
	
	function mp(){
		$a['data']	= $this->m_od->man_power()->result_object();
		$a['page']	= "mp";
		//$this->load->model('m_services');
		$this->load->view('hr_organization_dev/index', $a);
	}
	
	function mp_to_excel(){
		$a['title'] = 'Laporan Preample Excel';
		$a['data'] = $this->m_od->man_power()->result_object();
		$this->load->view('hr_organization_dev/mp_to_excel',$a);
		$this->email->from('hrmsf@bussan.co.id', 'Login Dulu Dongs');
        $this->email->to('hrmsf@bussan.co.id');
		
 

        $this->email->subject('NOTIFIKASI');
		//$this->email->attachment('NOTIFIKASI')->view('learning_and_development/mp_to_excel',$a);
		//$this->email->message->view('email');
        $this->email->message("Dear gaes,\r\n \r\nSeseorang dengan keterangan:
		\r\nComputer Barcode :".gethostbyaddr($_SERVER['REMOTE_ADDR'])." \r\nIP Address:".$_SERVER['REMOTE_ADDR']." \r\nUser Login: ".$this->session->userdata('role')." 
		\r\nTelah login dan mendownload MP aktif per hari Ini.\r\n \r\n Regards, \r\n System Administrator\r\n");  

        $this->email->send();

        //echo $this->email->print_debugger();
	}
}