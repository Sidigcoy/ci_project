<?php 

class Hr_payroll extends CI_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		if($this->session->userdata('role') != "hr_payroll"){
			redirect(base_url("login/logout"));
		}
		$this->load->library('email');
		$this->load->model('m_payroll');
		ini_set('max_execution_time', 0); 
	}

	function index(){
		//$a['jenis']	= $this->model_admin->tampil_jenis()->num_rows(); //untuk ambil data dari file model_admin.php dengan function tampil_jenis
		//$a['surat_keluar']	= $this->model_admin->tampil_surat_keluar()->num_rows();
		//$a['rekening']	= $this->m_payroll->rekening()->result_object();
		$a['data']	= $this->m_payroll->man_power()->result_object();
		$a['page']	= "home";
		$this->load->view('hr_payroll/index', $a);
	}
	
	function mp_to_excel(){
		$a['title'] = 'Laporan Preample Excel';
		$a['data'] = $this->m_payroll->man_power()->result_object();
		$this->load->view('hr_payroll/mp_to_excel',$a);
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
	
	function rekening(){
		//$a['title'] = 'Laporan Rekening Bank';
		$a['data'] = $this->m_payroll->rekening()->result_object();
		$a['page']	= "rekening";
		$this->load->view('hr_payroll/index', $a);
		
		
		//$this->email->from('hrmsf@bussan.co.id', 'Login Dulu Dongs');
        //$this->email->to('hrmsf@bussan.co.id');
		
 

        //$this->email->subject('NOTIFIKASI');
		//$this->email->attachment('NOTIFIKASI')->view('learning_and_development/mp_to_excel',$a);
		//$this->email->message->view('email');
        //$this->email->message("Dear gaes,\r\n \r\nSeseorang dengan keterangan:
		//\r\nComputer Barcode :".gethostbyaddr($_SERVER['REMOTE_ADDR'])." \r\nIP Address:".$_SERVER['REMOTE_ADDR']." \r\nUser Login: ".$this->session->userdata('role')." 
		//\r\nTelah login dan mendownload Data rekening per hari Ini.\r\n \r\n Regards, \r\n System Administrator\r\n");  

        //$this->email->send();

        //echo $this->email->print_debugger();
	}
	
	function rekening_to_excel(){
		$a['title'] = 'Laporan Data Rekening';
		$a['data'] = $this->m_payroll->rekening()->result_object();
		$this->load->view('hr_payroll/rekening_to_excel',$a);
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