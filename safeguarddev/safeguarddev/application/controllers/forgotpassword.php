<?php
class Forgotpassword extends CI_Controller
{
    function __Construct()
    {
        parent :: __Construct();
    }

    function index()
    {
		$this->load->library('form_validation');
        $this->load->model('loginmodel');
        $this->load->view('home/reset_password_view');
    }

	function reset_password()
	{
		$this->load->helper('form');
		$this->load->model('loginmodel');
		if(isset($_POST['username']) && !empty($_POST['username']))
		{
			$this->load->library('form_validation');
			$this->load->library('encrypt');
			$this->form_validation->set_rules('username','Username','trim|required|alpha_numaric|min_length[1]|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('home/reset_password_view',array('user_error' => 'Please supplly valid username'));
			}
			else
			{
				$uname = $this->input->post('username');
				$result = $this->loginmodel->user_exists($uname);
				if($result > 0)
				{
					$ucode1 = $this->encrypt->encode($uname);
					$ucode = str_replace(array('+','/','='),array('-','_',''),$ucode1);
					$data['success'] = '<h1 style="color:white;font-size:18px;line-height:30px;">Dear '. $uname .',</br> We want to help you to reset your password <strong><a href="'.base_url().'forgotpassword/reset_password_form/'.$ucode.'" style="color:black">Click Here</a></strong> to reset your password</h1>';
					$this->load->view('home/reset_password_view',$data);
				}
				else
				{
					$data['user_error'] = '<h1 style="color:white;font-size:18px;">Username not registered with safegaurd</h1>';
					$this->load->view('home/reset_password_view',$data);
				}
			}
		}
		else
		{
			$data['user_error'] = '<h1 style="color:white;font-size:18px;">Please enter your username</h1>';
			$this->load->view('home/reset_password_view',$data);
		}
	}

	function send_reset_password_email($username,$email)
	{
		$this->load->library('email');
		$user_code = md5($this->config->item('salt') . $email);
		$this->email->set_mailtype('html');
		$this->email->from();
		$this->email->to();
	}

	function reset_password_form($ucode)
	{
		$data['ucode'] = $ucode;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('loginmodel');
		$this->load->view('home/setpassword_view',$data);
	}

	function reset_password_action($ucode)
	{
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->helper('form');
		$this->load->model('loginmodel');
		if(!isset($password) && !isset($cpassword))
		{
			try
			{
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|alpha_numeric|matches[cpassword]');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');
				if ($this->form_validation->run() == FALSE) 
				{	
					$data['ucode'] = $ucode;
					$this->load->view('home/setpassword_view',$data);
				}
				else
				{
					$encryption_key = $this->config->item('encryption_key');
					$pass = hash ("sha256", $this->input->post('password').'-'.$encryption_key);
					$person = array('password' => $pass);
					$key1 = str_replace(array('-','_',''),array('+','/','='),$ucode);
					$id = $this->encrypt->decode($key1);
					$this->loginmodel->set_password($id,$person);
					$data['ucode'] = $ucode;
					$data['message'] = '<h1  style="color:green;">Password set Successfully. Click here to <a href="">Login</a></h1>';
					$this->load->view('home/setpassword_view',$data);
				}
			}
			catch (Exception $e) 
			{
				@trigger_error($e->getMessage(), E_USER_ERROR);
				return;
			}
		}
		else
		{
			$data['ucode'] = $ucode;
			$this->load->view('home/setpassword_view',$data);
		}
	}

}


?>