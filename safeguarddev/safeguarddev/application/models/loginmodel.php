<?php
Class Loginmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getuserinfo($username)
    {
        // $sha1_password=sha1($password);
        try
        {
        //$query="insert into user (username,name,email,password) values(?,?,?,?)";
        //$query="insert into User (UserName,FirstName,MiddleInt,LastName,Pwd,CompanyId,Phone,PhoneExt,UserTypeId,UserGroupId,CreateDate,CreatedBy,ModifiedDate,ModifiedBy) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $where = "UserName='$username'";

        $query = $this->db->select('*');
        $this->db->from('[TblUser]');
        $this->db->where($where);
         $query = $this->db->get();
        $result=$query->result_array();
        if (empty($result))
        {
            return false;
        }
        else{
            return $result[0];
        }

        }
        catch (Exception $e)
        {
            //echo "we are in catch block";
            //log_message('error','LOG'.$e->getMessage());
            @trigger_error($e->getMessage(), E_USER_ERROR);
            return;
        }
    }
    function user_exists($uname)
		{
			$where = "UserName='$uname'";
			$query = $this->db->select('*');
			$this->db->from('[TblUser]');
			$this->db->where($where);
			$query = $this->db->get();
			$result=$query->result_array();
			return $query->num_rows();
		}


		function set_password($key1, $person)
		{
			$this->db->where('UserName', $key1);
			$this->db->update('[dbo].[TblUser]', $person);
	}
		
		public function check_user($name)
	{
		$query = $this -> db -> get_where('[dbo].[TblUser]' ,array('UserName' => $name ));

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}		
	}
	
	public function get_user($name , $password)
	{
		$query = $this -> db -> get_where('[dbo].[TblUser]' ,array('UserName' => $name , 'Pwd' => $password));

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}		
	}
	
	public function login_fail($name,$atmpt)
	{
		$data = array('LoginAttemptCount'=>$atmpt);
		$this->db->where('UserName',$name);
		$this->db->update('[dbo].[TblUser]',$data);
	}
	
	public function lock_user($name)
	{
		$data = array('IsAccountLocked'=>1);
		$this->db->where('UserName',$name);
		$this->db->update('[dbo].[TblUser]',$data);
	}
	
	public function reset_attempts($name)
	{
		$data = array('LoginAttemptCount'=>NULL);
		$this->db->where('Username',$name);
		$this->db->update('[dbo].[TblUser]',$data);
	}
	
	public function useractivities($id,$ip,$user,$version,$session_id,$session_start)
	{
		try
		{
			$data = array('UserID'=>$id,'SessionStartTime'=>$session_start,'IPAddress'=>$ip,'BrowserType'=>$user,'BrowserVersion'=>$version,'SessionID'=>$session_id);
			if(! $this->db->insert('[dbo].[TblUserActivity]', $data))
            {
                 echo 'query failed';
                throw new Exception("query failed");
            }
            else
            {
              //  echo 'success';
             //  echo '<h2>Thanq for registering</h2>';
            }			
		}
		catch(Exception $e)
		{
            @trigger_error($e->getMessage(), E_USER_ERROR);
            return;
        }
	}
}
?>