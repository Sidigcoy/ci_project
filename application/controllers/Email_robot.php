<?php 

class Email_robot extends CI_Controller{

    function Email()
    {
        parent::CI_Controller();   
        $this->load->library('email');
		 
		
    }

    function index()
    { 
		$this->load->library('email');
		//$this->load->view('email');
		

        $this->email->from('baf-no-reply@bussan.co.id');
        $this->email->to('hrmsf@bussan.co.id'); 

        $this->email->subject('TEST');
		//$this->email->message->view('email');
        $this->email->message("hai");  

        $this->email->send();

        echo $this->email->print_debugger();

        //$this->load->view('email');
    }
}