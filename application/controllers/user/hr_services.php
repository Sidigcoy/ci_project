<?php 

class Hr_services extends CI_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		if($this->session->userdata('role') != "hr_services"){
			redirect(base_url("login/logout"));
		}
		$this->load->model('m_services');
		ini_set('max_execution_time', 0); 
	}

	function index(){ 
		$a['jenis']	= $this->m_services->tampil_jenis()->num_rows(); //untuk ambil data dari file model_admin.php dengan function tampil_jenis
		//$a['surat_keluar']	= $this->model_admin->tampil_surat_keluar()->num_rows();
		$a['page']	= "home";
		$this->load->view('hr_services/index', $a);
	}
	
	function absensi(){
		$a['data']	= $this->m_services->tampil_jenis()->result_object();
		$a['page']	= "absensi";
		
		$this->load->view('hr_services/index', $a);
	}
	
	function homebase(){
		//$a['data']	= $this->model_admin->tampil_jenis()->result_object();
		$a['page']	= "homebase";
		
		$this->load->view('hr_services/index', $a);
	}
	
	function mp(){
		$a['data']	= $this->m_services->man_power()->result_object();
		$a['page']	= "mp";
		//$this->load->model('m_services');
		$this->load->view('hr_services/index', $a);
	}
	
	function sisa_cuti(){
		$a['data']	= $this->m_services->sisa_cuti_resign()->result_object();
		$a['page']	= "sisa_cuti";
		//$this->load->model('m_services');
		$this->load->view('hr_services/index', $a);
	}
	
	function user_non_myhris(){
		$a['data']	= $this->m_services->non_myhris()->result_object();
		$a['page']	= "user_non_myhris";
		//$this->load->model('m_services');
		$this->load->view('hr_services/index', $a);
	}
	
	function history_employee(){
		$a['data']	= $this->m_services->history_employee()->result_object();
		$a['page']	= "history_employee";
		//ini_set('memory_limit', '256M');
		//$this->load->model('m_services');
		$this->load->view('hr_services/index', $a);
	}
	
	function mptoExcel() 
	{
		$a['data']	= $this->m_services->man_power()->result_object();
		//$query['data1'] = $this->model_admin->ToExcelAll(); 
		//$this->load->view('hr_services/mp_to_excel', $a);
		 
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        //$this->excel->setActiveSheetIndex(0);
        //name the worksheet
        //$this->excel->getActiveSheet()->setTitle('Users list');
 
        // load database
        //$this->load->database();
 
        // load model
        //$this->load->model('userModel');
 
        // get all users in array formate
        //$users = $this->userModel->get_users();
 
        // read data to active sheet
        //$this->excel->getActiveSheet()->fromArray($users);
 
        $filename='just_some_random_name.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
 
		
	}
}