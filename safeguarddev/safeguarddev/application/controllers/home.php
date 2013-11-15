<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
        {
             parent::__construct();
        }
        public function index()
	{
            $this->load->view('home/home');                   
	}   
	
	function contactus()
	{
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('message' , 'Message' , 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('home/contactview');
		}
		else 
		{
		$data['message'] = "<h3 style='color:green'>Your request has taken...we will get back to you soon...</h1>";
        $this->load->view('home/contactview',$data);
		}
	}     
}