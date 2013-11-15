<?php
class Login extends CI_Controller
{
    function __Construct()
    {
        parent :: __Construct();
    }

    function index()
    {
        if (is_logged_in())
        {
            redirect('/users');
        }
        $this->load->library('form_validation');
        $this->load->model('loginmodel');
        $this->load->view('home/loginview');
		$this->load->library('session');
		$session_id = $this->session->userdata('session_id');
    }

    /*function logincheck()
    {
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->model('loginmodel');
        $encryption_key = $this->config->item('encryption_key');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user_info = $this->loginmodel->getuserinfo($username);
        $epassword = hash ("sha256", $password.'-'.$encryption_key);
        //if($epassword == $user_info['Password'])
        if($password=='admin')
        {
            $user_data['UserID'] = $user_info['UserID'];
            $user_data['UserName'] = $user_info['UserName'];
            $user_data['FirstName'] = $user_info['FirstName'];
            $user_data['MiddleName'] = $user_info['MiddleName'];
            $user_data['LastName'] = $user_info['LastName'];
            $user_data['UserTypeID'] = $user_info['UserTypeID'];
            $user_data['signed_in'] = TRUE;

            $this->session->set_userdata($user_data);

            redirect(site_url('/users'));
        }
        else
        {
            $data['login_error'] = "<h6 style='color:red'>Invalid Login";
            redirect('/login');
        }
    }*/
    
    
    function logincheck()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
        $this->load->library('encrypt');
		$this->load->model('loginmodel');
		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
		 	$this->load->view('home/loginview');
		}
		else
	 	{
        	$encryption_key = $this->config->item('encryption_key');
	 		$name 		= $this->input->post('username');
		 	$password 	= $this->input->post('password');
			$epassword = hash ("sha256", $password.'-'.$encryption_key);
			$userchk = $this->loginmodel->check_user($name);
			if($userchk)
			{
			 	$result = $this->loginmodel->get_user($name , $epassword);
				if($result)
				{
					foreach($result as $row)
					{
						$id = $row->UserID;
						$uname = $row->UserName;
						$password = $row->Pwd;
						$active = $row->IsActive;
						$login_attempts = $row->LoginAttemptCount;
						$locked_status = $row->IsAccountLocked;
					}
					if($active == 0)
					{
						$data['login_error'] = "<h3 style='color:white'>Your Profile is inactive</h3>";
						$this->load->view('home/loginview',$data);
					}
					else
					{
						if($locked_status == 1)
						{
							$data['login_error'] = "<h3 style='color:white'>Your account has been locked</h3>";
							$this->load->view('home/loginview',$data);
						}
						else 
						{
							$this->loginmodel->reset_attempts($name);
							//$data['login_error'] = "<h3 style='color:white'>Logged in Successfully</h3>";
							//redirect(site_url('/users'));
							//$this->load->view('home/loginview',$data);
							$ip = ip_address();
							$user = user_agent();
							$version = browser_version();
							//$platform = user_platform();
							$session_id = session();
							$session_start = start_time();
							$this->loginmodel->useractivities($id,$ip,$user,$version,$session_id,$session_start);
							$user_info = $this->loginmodel->getuserinfo($name);
							$user_data['UserID'] = $user_info['UserID'];
            				$user_data['UserName'] = $user_info['UserName'];
				            $user_data['FirstName'] = $user_info['FirstName'];
				            $user_data['MiddleName'] = $user_info['MiddleName'];
				            $user_data['LastName'] = $user_info['LastName'];
				            $user_data['UserTypeID'] = $user_info['UserTypeID'];
				            $user_data['signed_in'] = TRUE;
				            $this->session->set_userdata($user_data);
				            redirect(site_url('/users'));	
						}
					}
				}
				else 
				{
					$name 		= $this->input->post('username');
					$result = $this->loginmodel->check_user($name);
					if($result)
					{
						foreach($result as $row)
						{
							$id = $row->UserID;
							$uname = $row->UserName;
							$password = $row->Pwd;
							$active = $row->IsActive;
							$login_attempts = $row->LoginAttemptCount;
							$locked_status = $row->IsAccountLocked;
						}
						if($login_attempts == 3)
						{
							$data['login_error'] = "<h3 style='color:white'>Your account has been locked..Contact Administrator</h3>";
							$this->loginmodel->lock_user($uname);
							$this->load->view('home/loginview',$data);	
						}
						else 
						{
							if($login_attempts == NULL)
							{
								$login_attempts = 1;
								$this->loginmodel->login_fail($uname,$login_attempts);
								$remaining = 3 - $login_attempts;
								//$data['login_error'] = "<h3 style='color:white'>Failed....You have ".$remaining . "attempts</h3>";
								$data['login_error'] = "<h3 style='color:white'>Invalid Login</h3>";
								$this->load->view('home/loginview',$data);
							}
							else 
							{
								$login_attempts = $login_attempts + 1;
								$this->loginmodel->login_fail($uname,$login_attempts);
								$remaining = 3 - $login_attempts;
								//$data['login_error'] = "<h3 style='color:white'>Failed....You have ".$remaining . "attempts</h3>";
								$data['login_error'] = "<h3 style='color:white'>Invalid Login</h3>";
								$this->load->view('home/loginview',$data);	 				
							}
						}
					}
					else
					{
						$data['login_error'] = "<h3 style='color:white'>Fail</h3>";
						$this->load->view('home/loginview',$data);
					}
				}
			}
			else 
			{
				$data['login_error'] = "<h3 style='color:white'>Invalid Login</h3>";
				$this->load->view('home/loginview',$data);
			}
	 	}
	}



    function logout()
    {
    	logout();
    }
	
	
    function test()
    {
        $sql="Exec [dbo].[sp_usergrouplist] null,null";
        $query = $this->db->query($sql);
        $result = $query->result_array();
    }


}


?>