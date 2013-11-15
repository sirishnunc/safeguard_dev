<?php

class Users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //$this->load->library('jquery_ext');
        $this->load->helper(array('form'));
        $this->load->model('usermodel');
        if (!is_logged_in()) 
        {
            redirect('/login');
        }
        if (!is_access_permission($this->router->fetch_class())) {
            echo "You don't have permission to access this page";
            exit();
        }
		$session_id = session();
		$lastactivity = start_time();
		$this->usermodel->updateactivities($session_id,$lastactivity);
    }
	
	
    function index()
    {
        $this->load->library('table');
        $this->load->model('usermodel');
        $this->load->helper('form');
        $this->load->library("pagination");
        $this->userlist();
    }

    function search()
    {
        $this->load->library('table');
        $this->load->model('usermodel');
        $this->load->library("pagination");
        $firstname = $this->input->post('first_name');
        $lastname = $this->input->post('last_name');
        $usergroup = $this->input->post('Usergroup');
        $cms_id = $this->input->post('cms_id');
        $config = array();
        $config["base_url"] = site_url("users/userlist");
        $config["total_rows"] = $this->usermodel->user_count();
        //echo  $config["total_rows"];

        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 2;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['cur_tag_open'] = '&nbsp;<b>';
        $config['cur_tag_close'] = '</b>';
       // $this->pagination->initialize($config);


       // $search_result = $this->usermodel->user_search($firstname, $lastname, $usergroup, $cms_id);
        // $ug_id=$search_result[0]['UserGroupId'];
        // $ug_name=$this->usermodel->urg_name($ug_id);
        // $urg_name= $ug_name[0]['GroupDescription'];
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //echo 'page is'.$page;

        //echo '<br>start is<br>'.$start;

        if ($page) {
            //$start= $start+($config["per_page"]);
            $start = ($page - 1) * ($config["per_page"]);
            //echo 'start is'.$start;
            //echo 'per page is'.$config["per_page"];
        } else {
            $start = 0;
        }
        //$data["results"] = $this->usermodel->users_search_list($firstname, $lastname, $usergroup, $cms_id,$config["per_page"], $start);
        $data["links"] = $this->pagination->create_links();


        $data['search_result'] = $this->usermodel->user_search($firstname, $lastname, $usergroup, $cms_id);
        $search_result = $this->usermodel->user_search($firstname, $lastname, $usergroup, $cms_id);
        //$ug_id = $search_result[0]['UserGroupID'];
        /*$ug_id = (isset($search_result[0]['UserGroupID'])) ? $search_result[0]['UserGroupID'] : '';
        $ug_name = $this->usermodel->urg_name($ug_id);
        $urg_name = (isset($ug_name[0]['GroupName'])) ? $ug_name[0]['GroupName'] : '';*/


        $tmpl = array(
            'table_open' => '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">',

            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',

            'row_start' => '<tr>',
            'row_end' => '</tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',

            'row_alt_start' => '<tr>',
            'row_alt_end' => '</tr>',
            'cell_alt_start' => '<td>',
            'cell_alt_end' => '</td>',

            'table_close' => '</table>'
        );
        $this->table->set_template($tmpl);
           $this->table->set_heading("UserName", "FirstName", "LastName", "Email", "GroupName", "CMSID", "Status", "LastLogin", "actions");


        if ($search_result) {
            for ($i = 0; $i < count($search_result); $i++) {
                $d_id = $search_result[$i]['UserID'];
                $edit_button = '<a href=' . site_url("users/edit?id=" . $d_id . "&action=edit" . '') . ' style="color:#ffffff" target="_self"><button class="btn btn-sm btn-primary"><i class="icon-edit"></i>
                         Edit
                         </button></a>';
                $delete = '<a href=' . site_url("users/edit?id=" . $d_id) . ' style="color:#ffffff" target="_self">
                               <button class="btn btn-sm btn-danger"><i class="icon-ban-circle" onclick="return confirm(\'Are you sure want to delete\');"></i> Delete </button>';
                $ug_id = $search_result[$i]['UserGroupID'];
                $ug_name = $this->usermodel->urg_name($ug_id);
                $urg_name = (isset($ug_name[0]['GroupName'])) ? $ug_name[0]['GroupName'] : '';
                $this->table->add_row(
                    $search_result[$i]['UserName'],
                    $search_result[$i]['FirstName'],
                    $search_result[$i]['LastName'],
                    $search_result[$i]['Email'],
                    $urg_name,
                    $search_result[$i]['CMS_ID'],
                    'yes',
                    date('m/d/Y h:i:s a', time()),
                    $edit_button . '' . $delete
                );


            }
            $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
            $data['usrtype_result'] = $this->usermodel->usrtype();
            $this->load->view('dashboard/users_list', $data);

        } else {
             $data['no_results'] = 'No results found';
            $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
            $data['usrtype_result'] = $this->usermodel->usrtype();
             $this->load->view('dashboard/users_list', $data);


        }


        //echo $this->table->generate();

    }


    function userlist()
    {
        $this->load->library('table');
        $this->load->model('usermodel');
        $this->load->library("pagination");
        $start = '';
        $firstname = '';
        $lastname = '';
        $usergroup = '';
        $cms_id = '';
        $config = array();
        $config["base_url"] = site_url("users/userlist");
        $config["total_rows"] = $this->usermodel->user_count();
        //echo  $config["total_rows"];

        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 2;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['cur_tag_open'] = '&nbsp;<b>';
        $config['cur_tag_close'] = '</b>';
        $this->pagination->initialize($config);
        //$data['search_result'] = $this->usermodel->user_search($firstname, $lastname,$usergroup, $cms_id);
        $search_result = $this->usermodel->user_search($firstname, $lastname, $usergroup, $cms_id);
        // $ug_id=$search_result[0]['UserGroupId'];
        // $ug_name=$this->usermodel->urg_name($ug_id);
        // $urg_name= $ug_name[0]['GroupDescription'];
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //echo 'page is'.$page;

        //echo '<br>start is<br>'.$start;

        if ($page) {
            //$start= $start+($config["per_page"]);
            $start = ($page - 1) * ($config["per_page"]);
            //echo 'start is'.$start;
            //echo 'per page is'.$config["per_page"];
        } else {
            $start = 0;
        }
        $data["results"] = $this->usermodel->users_list('', $config["per_page"], $start, '');
        $data["links"] = $this->pagination->create_links();
        $tmpl = array(
            'table_open' => '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">',

            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',

            'row_start' => '<tr>',
            'row_end' => '</tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',

            'row_alt_start' => '<tr>',
            'row_alt_end' => '</tr>',
            'cell_alt_start' => '<td>',
            'cell_alt_end' => '</td>',

            'table_close' => '</table>'
        );
        // $d_id=$search_result[0]['UserID'];
        $this->table->set_template($tmpl);
        $radio = '<input type="radio" id="r1" name="r1">';
        $this->table->set_heading("UserName", "FirstName", "LastName", "Email", "GroupName", "CMSID", "Status", "LastLogin", "actions");
        if ($data["results"]) {
            if ($page) {
                $page_url = base_url() . 'users/userlist/' . $page;
            } else {
                $page_url = base_url() . 'users/userlist';
            }
            for ($i = 0; $i < count($data["results"]); $i++) {
                $d_id = $data["results"][$i]['UserID'];
                $edit_button = '<a href=' . site_url("users/edit?id=" . $d_id . '&action=edit&pageurl=' . $page_url) . ' style="color:#ffffff" target="_self"><button class="btn btn-sm btn-primary"><i class="icon-edit"></i>
                         Edit
                         </button></a>';
                $delete = '<a href=' . site_url("users/edit?id=" . $d_id . "&action=delete&pageurl=" . $page_url) . ' style="color:#ffffff" target="_self">
                               <button class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure want to delete\');"><i class="icon-ban-circle"></i> Delete </button>';
                $ug_id = $data["results"][$i]['UserGroupID'];
                $ug_name = $this->usermodel->urg_name($ug_id);
                //print_r($ug_name);
                $urg_name = $ug_name[0]['GroupName'];
                $this->table->add_row(
                    $data["results"][$i]['UserName'],
                    $data["results"][$i]['FirstName'],
                    $data["results"][$i]['LastName'],
                    $data["results"][$i]['Email'],
                    $urg_name,
                    $data["results"][$i]['CMS_ID'],
                    'yes',
                    date('m/d/Y h:i:s a', time()),
                    $edit_button . '' . $delete
                );


            }

        }
        $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
        $data['usrtype_result'] = $this->usermodel->usrtype();
        $this->load->view('dashboard/users_list', $data);

        //echo $this->table->generate();

    }

    function user_list_ajax()
    {
        //error_reporting(0);
        $this->load->model('usermodel');
        $columns = array("user_id", "first_name", "last_name", "title", "phone", "email", "department", "actions");
        $columns = array("Select", "UserName", "FirstName", "LastName", "Email", "GroupDescription", "CMSID", "Status", "LastLogin", "actions");

        $search_string = '';
        $start = (isset($_REQUEST["iDisplayStart"]) ? (int)$_REQUEST["iDisplayStart"] : 0);
        $limit = (isset($_REQUEST["iDisplayLength"]) ? (int)$_REQUEST["iDisplayLength"] : 10);

        $order_by = array();
        foreach ($_REQUEST as $key => $value) {
            if (substr($key, 0, 9) == "iSortCol_") {
                $col_num = $value;
                $order_by[$col_num] = ($columns[$col_num] == "client_id" ? "client_id" : $columns[$col_num]) . " " . $_REQUEST["sSortDir_0"];
            }
        }
        ksort($order_by);

        if (count($order_by) < 1) $order_by = "'client_id','asc'";
        else $order_by = join(',', $order_by);


        if (!empty($_REQUEST["sSearch"])) {
            $search_string = trim($_REQUEST["sSearch"]);
        }
        $data['records'] = $this->usermodel->users_list($order_by, $limit, $start, $search_string);
        print_r($data);

        $count = $this->db->get('[dbo].[User]')->num_rows();
        $aaData = array();

        foreach ($data['records'] as $info) {

            $d_id = $info['UserID'];
            $ug_id = $info['UserGroupId'];
            $ug_name = $this->usermodel->urg_name($ug_id);
            $urg_name = $ug_name[0]['GroupDescription'];
            //echo '<br>user name is'.$urg_name;
            foreach ($columns as $idx => $name) {


                $radio = '<input type="radio" id="r1" name="r1">';
                $row[0] = $radio;

                $row[0] = $radio;
                if ($name == "actions") {
                    //$row[$idx]= "<a href='".base_url()."process-manager/users/edit/".$info['user_id']."' class='btn btn-info'> <i class='icon-edit icon-white'></i>Edit</a>&nbsp;&nbsp;<a href='".base_url()."process_manager/users/delete_user/".$info['user_id']."' onclick='return deletescript();' class='btn btn-danger'><i class='icon-trash icon-white'></i>Delete</a>";
                    //$row[$idx]= "<a href='".base_url()."process-manager/users/edit/".$info['user_id']."' class='btn btn-info'> <i class='icon-edit icon-white'></i>Edit</a>&nbsp;&nbsp;<a href='".base_url()."process_manager/users/delete_user/".$info['user_id']."' onclick='return deletescript();' class='btn btn-danger'><i class='icon-trash icon-white'></i>Delete</a>";


                    $edit_button = '<a href=' . site_url("users/useredit?id=" . $d_id) . ' style="color:#ffffff" target="_self"><button class="btn btn-sm btn-primary"><i class="icon-edit"></i>
                     Edit
                     </button></a>';
                    $row[$idx] = $edit_button;

                } elseif ($name == "Status") {
                    $row[$idx] = 'Active';
                } elseif ($name == "LastLogin") {
                    $row[$idx] = date('m/d/Y h:i:s a', time());
                } elseif ($name == "GroupDescription") {

                    $row[$idx] = $urg_name;

                } else {
                    $row[$idx] = $info[$name];
                    //$row[7]= 'yes';

                }

            }


            reset($columns);
            //print_r($row);

            $aaData[] = $row;
            //print_r($aaData);

        }

        $output = array(
            "sEcho" => (int)$_REQUEST["sEcho"],
            "iTotalRecords" => $count,
            "iTotalDisplayRecords" => $count, //($count > $limit ? $count : $limit),
            "aaData" => $aaData
        );

        echo json_encode($output, true);
    }


    function edit()
    {
        $this->load->library('form_validation');
        $id = $this->input->get('id');
        $pageurl = $this->input->get('pageurl');
        $data['usr_id'] = $id;
        $action = $this->input->get('action');
        if ($action == 'delete') 
        {
            $usedelete = $this->usermodel->userdelete($id);
            header('Location:' . $pageurl);
        } 
        /*else if ($action == 'edit') 
        {
        	$id 	= $this->input->get('id');
	        $pageurl = $this->input->get('pageurl');
	        $data['usr_id'] = $id;
            //$data['result'] = $this->usermodel->useredit($id);
            $usedata = $this->usermodel->useredit($id);
			$first_name = $usedata[0]['FirstName'];
			$username 	= $userdata[0]['UserName'];
			$lastname = $usedata[0]['LastName'];
			$email = $usedata[0]['Email'];
			$cms = $usedata[0]['CMS_ID'];
			$phone = $usedata[0]['Phone'];
            $usrg_id = $usedata[0]['UserGroupID'];
            $usr_type = $usedata[0]['UserTypeID'];
            $ug_name = $this->usermodel->urg_name($usrg_id);
            $urg_name = $ug_name[0]['GroupName'];
            $data['usg_name'] = $urg_name;
            $data['usg_id'] = $usrg_id;
			$data['username'] = $username;
            $data['pageurl']=$pageurl;
			$data['first_name'] = $first_name;
			$data['lastname'] = $lastname;
			$data['email'] = $email;
			$data['cms'] = $cms;
			$data['phone'] = $phone;
            $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
            $data['usrtype_result'] = $this->usermodel->usrtype();
            $this->load->view('dashboard/user_edit_view', $data);
        }*/
		else if($action == "edit")
		{
			$id 	= $this->input->get('id');
	        $pageurl = $this->input->get('pageurl');
			$usedata = $this->usermodel->useredit($id);
			if($usedata)
			{
				foreach($usedata as $row)
				{
					$uid = $row->UserID;
					$uname = $row->UserName;
					$fname = $row->FirstName;
					$lname = $row->LastName;
					$cid = $row->CMS_ID;
					$email = $row->Email;
					$phone = $row->Phone;
					$ug_id = $row->UserGroupID;
					$ut_id = $row->UserTypeID;
					$data['id'] = $uid;
					$data['uname'] = $uname;
					$data['firstname'] = $fname;
					$data['lastname'] = $lname;
					$data['cms']  = $cid;
					$data['email'] = $email;
					$data['phone'] = $phone;
					$data['u_gid'] = $ug_id;
					$data['u_type'] = $ut_id;
					$data['pageurl'] = $pageurl;
					$ug_name = $this->usermodel->urg_name($ug_id);
					$ut_name = $this->usermodel->urg_type($ut_id);
					$data['user_group'] = $ug_name[0]['GroupName'];
					$user_group = $ug_name[0]['GroupName'];
					$data['user_type']= $ut_name[0]['UserTypeName'];
					$data['usrgrp_result'] = $this->usermodel->usrgrpdata();
            		$data['usrtype_result'] = $this->usermodel->usrtype();
				}
				$this->form_validation->set_rules('userid', 'userid', 'trim|required|alpha_numaric|min_length[1]|xss_clean');
	            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha_numaric|min_length[1]|xss_clean');
	            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha_numaric|min_length[1]|xss_clean');
	            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
	            $this->form_validation->set_rules('phone', 'phone', 'trim|max_length[20]');
	            $this->form_validation->set_rules('cms_id', 'CMS Id', 'trim|numaric|min_length[3]|max_length[10]');
	            $this->form_validation->set_rules('Usergroup', 'Group', 'trim|required');
	            $this->form_validation->set_rules('Usertype', 'Select Options', 'trim|required|greater_than[0]');
		            if ($this->form_validation->run() == FALSE) 
		            {
		                $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
		                $data['usrtype_result'] = $this->usermodel->usrtype();
		                $this->load->view('dashboard/user_edit_view', $data);
						//redirect(base_url().'users/edit?id='.$uid.'&action=edit&pageurl='.$pageurl,$data);
		            } 
		            else
					{
						try {
					            $pageurl = $this->input->post('pageurl');
					            $id = $this->input->post('user_id');
					            $userid = $this->input->post('userid');
					            $firstname = $this->input->post('first_name');
					            $lastname = $this->input->post('last_name');
								$email = $this->input->post('email');
					            $this->load->library('encrypt');
					            $cmsid = $this->input->post('cms_id');
					            $phone = $this->input->post('phone');
					            $usergroup = $this->input->post('Usergroup');
					            $usertype = $this->input->post('Usertype');
					            $date = date("Y-m-d H:i:s");
					            $this->usermodel->update_user($id, $userid, $firstname, $lastname, $email,$cmsid, $phone, $usergroup, $usertype, $date);
					            if($pageurl) 
					            {
					                header('Location:' . $pageurl);
					            } else 
					            {
					                header('Location: ' . base_url() . 'users/userlist');
					            }
					            //$data['message'] = "<h3 style='color:green'>Updated Successfully...". anchor('users' , 'Back')."</h3>";
					            //$this->load->view('dashboard/user_edit_view',$data);
					
					        } 
					        catch (Exception $e) 
					        {
					            //echo "we are in catch block";
					            //log_message('error','LOG'.$e->getMessage());
					            @trigger_error($e->getMessage(), E_USER_ERROR);
					            return;
					        }
					}
			}
		}
    }

    function save()
    {
        try {
            $pageurl = $this->input->post('pageurl');
            $id = $this->input->post('user_id');
            $userid = $this->input->post('userid');
            $firstname = $this->input->post('first_name');
            $lastname = $this->input->post('last_name');
            $this->load->library('encrypt');
            $cmsid = $this->input->post('cms_id');
            $phone = $this->input->post('phone');
            $usergroup = $this->input->post('Usergroup');
            $usertype = $this->input->post('Usertype');
            $date = date("Y-m-d H:i:s");
            $this->usermodel->update_user($id, $userid, $firstname, $lastname, $cmsid, $phone, $usergroup, $usertype, $date);
            if($pageurl) {
                header('Location:' . $pageurl);
            } else {
                header('Location: ' . base_url() . 'users/userlist');
            }

        } catch (Exception $e) {
            //echo "we are in catch block";
            //log_message('error','LOG'.$e->getMessage());
            @trigger_error($e->getMessage(), E_USER_ERROR);
            return;
        }
    }

    /*function add()
    {
        $this->load->library('form_validation');
        $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
        $data['usrtype_result'] = $this->usermodel->usrtype();
        //print_r($data);
        log_message('debug', 'mklm');
        $this->load->view('dashboard/user_view', $data);
        // $this->register();
    }*/
    
    function add()
	{
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$data['usrgrp_result'] = $this->usermodel->usrgrpdata();
        $data['usrtype_result'] = $this->usermodel->usrtype();
		log_message('debug', 'mklm');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('userid', 'userid', 'trim|required|alpha_numaric|min_length[1]|xss_clean');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha_numaric|min_length[1]|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha_numaric|min_length[1]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('phone', 'phone', 'trim|max_length[20]');
        $this->form_validation->set_rules('cms_id', 'CMS Id', 'trim|numaric|min_length[3]|max_length[10]');
        $this->form_validation->set_rules('Usergroup', 'Group', 'trim|required');
        $this->form_validation->set_rules('Usertype', 'Select Options', 'trim|required|greater_than[0]');
        if ($this->form_validation->run() == FALSE) 
        {
            $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
            $data['usrtype_result'] = $this->usermodel->usrtype();
            $this->load->view('dashboard/user_view', $data);
        } 
        else 
        {
            $username = $this->input->post('userid');
            $usernamecount = $this->usermodel->checkuser($username);
            $email = $this->input->post('email');
            $emailcheck = $this->usermodel->checkemail($email);
            if ($usernamecount > 0) 
            {
                $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
                $data['usrtype_result'] = $this->usermodel->usrtype();
                $data['usr_error'] = 'The username is already taken';
                $this->load->view('dashboard/user_view', $data);
            } 
            elseif ($emailcheck > 0) 
            {
                $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
                $data['usrtype_result'] = $this->usermodel->usrtype();
                $data['email_error'] = 'The email is already exist';
                $this->load->view('dashboard/user_view', $data);
            }
			else 
			{
                $firstname = $this->input->post('first_name');
                $middlename = '';
                $lastname = $this->input->post('last_name');
                $cmsid = $this->input->post('cms_id');
                $phone = $this->input->post('phone');
                $phonext = '1234';
                $company_id = '1234';
                $usergroup = $this->input->post('Usergroup');
                $usertype = $this->input->post('Usertype');
                $user_level='';
                $activationkey = $this->encrypt->encode($username);
                $key = str_replace(array('+','/','='),array('-','_',''),$activationkey);
                $this->usermodel->register_user($username, $firstname, $middlename, $lastname,$cmsid,$phone, $phonext, $usertype,$user_level, $usergroup, $email);
                $data['message'] = '<h1  style="color:green;">user added successfully </h1>';
                $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
                $data['usrtype_result'] = $this->usermodel->usrtype();
                $message = 'Hi '. $firstname .',</br> Please click the following link to activate your account </br>'. anchor('users/password/'.$key , 'Click here to activate');
                log_message('debug', $message);
                $this->load->view('dashboard/user_view', $data);
            }
        }
		$this->load->view('dashboard/user_view', $data);
	}

    function register()
    {
        $this->load->library('encrypt');
      // $this->output->enable_profiler(TRUE);

        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('userid', 'userid', 'trim|required|alpha_numaric|min_length[1]|xss_clean');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha_numaric|min_length[1]|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha_numaric|min_length[1]|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('phone', 'phone', 'trim|max_length[20]');
            $this->form_validation->set_rules('cms_id', 'CMS Id', 'trim|numaric|min_length[3]|max_length[10]');
            $this->form_validation->set_rules('Usergroup', 'Group', 'trim|required');
            $this->form_validation->set_rules('Usertype', 'Select Options', 'trim|required|greater_than[0]');
            if ($this->form_validation->run() == FALSE) {
                $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
                $data['usrtype_result'] = $this->usermodel->usrtype();
                $this->load->view('dashboard/user_view', $data);
            } else {
                $username = $this->input->post('userid');
                $usernamecount = $this->usermodel->checkuser($username);
                $email = $this->input->post('email');
                $emailcheck = $this->usermodel->checkemail($email);
                if ($usernamecount > 0) {
                    $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
                    $data['usrtype_result'] = $this->usermodel->usrtype();
                    $data['usr_error'] = 'The username is already taken';
                    $this->load->view('dashboard/user_view', $data);
                } elseif ($emailcheck > 0) {
                    $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
                    $data['usrtype_result'] = $this->usermodel->usrtype();
                    $data['email_error'] = 'The email is already exist';
                    $this->load->view('dashboard/user_view', $data);
                } else {

                    $firstname = $this->input->post('first_name');
                    $middlename = '';
                    $lastname = $this->input->post('last_name');
                    $cmsid = $this->input->post('cms_id');
                    $phone = $this->input->post('phone');
                    $phonext = '1234';
                    $company_id = '1234';
                    $usergroup = $this->input->post('Usergroup');
                    $usertype = $this->input->post('Usertype');
                    $user_level='';

                                        /*
                                         $subject = 'Activate Your Account';
                                         $encryption_key = $this->config->item('encryption_key');
                                         $activationkey = hash ("sha256", $username.'-'.$encryption_key);
                                         $config['mailtype'] = 'html';
                                         $this->email->initialize($config);
                                         $message = 'Hi '. $firstname .',</br> Please click the following link to activate your account </br>'. anchor('users/password/'.$key , 'Click here to activate').';
                                         $from='shaikfujale@gmail.com';
                                         $sendername='Fujale';
                                         $this->load->library('email');
                                         $this->load->helper('mysendemail');
                                         mysend_email($from,$sendername,$email,$subject,$message);

                                     */


                        $activationkey = $this->encrypt->encode($username);
                        $key = str_replace(array('+','/','='),array('-','_',''),$activationkey);

                    $this->usermodel->register_user($username, $firstname, $middlename, $lastname,$cmsid,$phone, $phonext, $usertype,$user_level, $usergroup, $email);
                    $data['message'] = '<h1  style="color:green;">user added successfully </h1>';
                    $data['usrgrp_result'] = $this->usermodel->usrgrpdata();
                    $data['usrtype_result'] = $this->usermodel->usrtype();
                    $message = 'Hi '. $firstname .',</br> Please click the following link to activate your account </br>'. anchor('users/password/'.$key , 'Click here to activate');
                    log_message('debug', $message);
                    // $this->output->enable_profiler(TRUE);
                    // return;
                    $this->load->view('dashboard/user_view', $data);


                }
            }

        } catch (Exception $e) {
            //echo "we are in catch block";
            //log_message('error','LOG'.$e->getMessage());
            @trigger_error($e->getMessage(), E_USER_ERROR);
            return;
        }
    }
    function password($key)
    {
        $encryption_key = $this->config->item('encryption_key');
        $data['uname'] = $key;
        try
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|alpha_numeric|matches[cpassword]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $data['message'] = '';
            }
            else
            {
                $pass = hash ("sha256", $this->input->post('password').'-'.$encryption_key);
                $person = array('Pwd' => $pass,
                    'isActive' => 'True');
                $this->load->model('usermodel');
                $this->load->library('encrypt');
                $key1 = str_replace(array('-','_',''),array('+','/','='),$key);
                $id = $this->encrypt->decode($key1);
                $this->usermodel->set_password($id,$person);

                $data['message'] = '<h1  style="color:green;">Password set Successfully</h1>';
            }
        }
        catch (Exception $e)
        {
            @trigger_error($e->getMessage(), E_USER_ERROR);
            return;
        }
        $this->load->view('dashboard/setpassword_view',$data);
    }

    public function password_check($str)
    {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
            return TRUE;
        }
        return FALSE;
    }


}