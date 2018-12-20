<?php 

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');		
	}

	function index(){	
		$this->load->view('v_login');
	}

	function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => $password
			);
		
		//if($username == "DataCredit" && $password == "qwerty"){
		//	$data_session = array(
		//		'nama' => $username,
		//		'role' => "rizsan",
		//		'status' => "login"
		//		);
		//
		//	$this->session->set_userdata($data_session);
		//
		//	redirect(base_url("user/rizsan"));
		//}		


		// if($username == "qwe" && $password == "qwe"){
			// $data['nama']	= $username ;
			// $data['role']	= "erick";
			// $data['status']	= "login";

			// $this->session->set_userdata($data);
			// redirect('user/erick');
		// } 


		// if($username == "hr-payroll" && $password == "567890"){
			// $data_session = array(
				// 'nama' => $username,
				// 'role' => "hr_payroll",
				// 'status' => "login"
				// );

			// $this->session->set_userdata($data_session);

			// redirect(base_url("user/hr_payroll"));
		// }
		
		// if($username == "hr-services" && $password == "asdasd"){
			// $data_session = array(
				// 'nama' => $username,
				// 'role' => "hr_services",
				// 'status' => "login"
				// );

			// $this->session->set_userdata($data_session);

			// redirect(base_url("user/hr_services"));
		// }
		
		// if($username == "it-services" && $password == "support4it"){
			// $data_session = array(
				// 'nama' => $username,
				// 'role' => "it_services",
				// 'status' => "login"
				// );

			// $this->session->set_userdata($data_session);

			// redirect(base_url("user/it_services"));
		// }
		
		// if($username == "hr-industrial" && $password == "indus"){
			// $data_session = array(
				// 'nama' => $username,
				// 'role' => "hr_industrial",
				// 'status' => "login"
				// );

			// $this->session->set_userdata($data_session);

			// redirect(base_url("user/hr_industrial"));
		// }
		
		if($username == "hr-system" && $password == "foreheadache"){
			$data_session = array(
				'nama' => $username,
				'role' => "hr_system",
				'status' => "login"
				);

			$this->session->set_userdata($data_session);

			redirect(base_url("user/hr_system"));
		}
		
  		// if($username == "learninganddevelopment" && ( $password == "support4lnd" || $password == "mpuser" ) ){
			// $data_session = array(
				// 'nama' => $username,
				// 'role' => "learning_and_development",
				// 'status' => "login"
				// );

			// $this->session->set_userdata($data_session);

			// redirect(base_url("user/learning_and_development"));
		// }
		
		// if($username == "mky" && $password == "mky4support"){
			// $data_session = array(
				// 'nama' => $username,
				// 'role' => "mky",
				// 'status' => "login"
				// );

			// $this->session->set_userdata($data_session);

			// redirect(base_url("user/mky"));
		// }
		
		// if($username == "hr_organization_dev" && $password == "asd"){
			// $data_session = array(
				// 'nama' => $username,
				// 'role' => "hr_organization_dev",
				// 'status' => "login"
				// );

			// $this->session->set_userdata($data_session);

			// redirect(base_url("user/hr_organization_dev"));
		// }

		//Tambah user IT Infra
		// if($username == "it" && $password == "it"){
			// $data = array(
				// 'nama' => $username,
				// 'role' => "it_infra",
				// 'status' => "login"
				// );

			// $this->session->set_userdata($data);

			// redirect(base_url("user/it_infra"));
		// }
		
		//$cek = $this->m_login->cek_login("admin",$where)->num_rows();
		$cek = 0;
		if($cek > 0){

			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);

			$this->session->set_userdata($data_session);

			redirect(base_url("admin"));

		}else{
			?>
			<script>
				alert('Password Salah');
				javascript:window.location.assign("../login");
			</script>
			<?php
			echo "Username dan password salah !";
			 
		}
	}

	function logout(){
		$this->session->sess_destroy();
		//redirect(base_url('login/logout'));
		$this->load->view('v_login');
	}
}