<?php

class Usergroups extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        //$this->load->library('jquery_ext');
        $this->load->helper(array('form'));
        $this->load->model('usermodel');
    }

    function index()
    {
        $this->load->library('table');
        $this->load->model('usermodel');
        $this->load->helper('form');
        $this->load->library("pagination");
        $this->usergrplist();
    }
    function search()
    {

        $this->load->library('table');
        $this->load->model('usermodel');
        $grp_name=$this->input->post('group_name');
        $data['search_result'] = $this->usermodel->usergrp_search($grp_name);
        $search_result = $this->usermodel->usergrp_search($grp_name);
         $table = array (
            'table_open'          => '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">',

            'heading_row_start'   => '<tr>',
            'heading_row_end'     => '</tr>',
            'heading_cell_start'  => '<th>',
            'heading_cell_end'    => '</th>',
            'row_start'           => '<tr>',
            'row_end'             => '</tr>',
            'cell_start'          => '<td>',
            'cell_end'            => '</td>',
            'row_alt_start'       => '<tr>',
            'row_alt_end'         => '</tr>',
            'cell_alt_start'      => '<td>',
            'cell_alt_end'        => '</td>',

            'table_close'         => '</table>'
        );
        $this->table->set_template($table);
        $this->table->set_heading("Group ID","Group Name","Parent Group","Status","Created Date","Action");
        if($search_result)
        {
            for($i=0;$i<count($search_result);$i++)
            {
                $d_id=$search_result[$i]['UserGroupID'];
                $edit_button='<a href='.site_url("usergroups/edit?id=".$d_id).' style="color:#ffffff" target="_self"><button class="btn btn-sm btn-primary"><i class="icon-edit"></i>
                         Edit
                         </button></a>';
                $delete='<a href='.site_url("usergroups/edit?id=".$d_id).' style="color:#ffffff" target="_self">
                               <button class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure want to delete\');"><i class="icon-ban-circle"></i> Delete </button>';
                 $this->table->add_row(
                                            $search_result[$i]['UserGroupID'],
                                            $search_result[$i]['GroupName'],
                                            '',
                                            'yes',
                                            $search_result[$i]['CreatedDate'],
                                            $edit_button.''. $delete
                                      );


            }
             $this->load->view('dashboard/usergroup_list_view',$data);

        }
        else
        {
            $data['no_results'] = 'No results found';
            $this->load->view('dashboard/usergroup_list_view', $data);
        }
    }
    function usergrplist()
    {

        $this->load->library('table');
        $this->load->model('usermodel');
        $this->load->library("pagination");

        $grp_name='';
        $config = array();
        $config["base_url"] = base_url() . "usergroups/usergrplist";
        $config["total_rows"] = $this->usermodel->usergrp_count();
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        //  $config['use_page_numbers'] = TRUE;
        //  $config['page_query_string'] = TRUE;
        $config['num_links'] = 2;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['cur_tag_open'] = '<b>';
        $config['cur_tag_close'] = '</b>';
        $this->pagination->initialize($config);
        //$data['search_result'] = $this->usermodel->user_search($firstname, $lastname,$usergroup, $cms_id);
        $search_result = $this->usermodel->usergrp_search($grp_name);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $start=0;
        if($page)
        {

            $start=($page-1)*($config["per_page"]);
        }
        $data["results"] = $this->usermodel->usergrp_list('', $config["per_page"],$start,'');
        $data["links"] = $this->pagination->create_links();
        $table = array (
            'table_open'          => '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">',

            'heading_row_start'   => '<tr>',
            'heading_row_end'     => '</tr>',
            'heading_cell_start'  => '<th>',
            'heading_cell_end'    => '</th>',

            'row_start'           => '<tr>',
            'row_end'             => '</tr>',
            'cell_start'          => '<td>',
            'cell_end'            => '</td>',

            'row_alt_start'       => '<tr>',
            'row_alt_end'         => '</tr>',
            'cell_alt_start'      => '<td>',
            'cell_alt_end'        => '</td>',

            'table_close'         => '</table>'
        );
        $this->table->set_template($table);
        $this->table->set_heading("GroupID","GroupName","Parent Group","Status","Created Date","Action");
        if($page)
        {
            $page_url=base_url().'usergroups/usergrplist/'. $page;
        }
        else
        {
            $page_url=base_url().'usergroups/usergrplist/';
        }
        if($data["results"])
        {
            for($i=0;$i<count($data["results"]);$i++)
            {
                $d_id=$data["results"][$i]['UserGroupID'];
                $edit_button='<a href='.site_url("usergroups/edit?id=".$d_id.'&action=edit&pageurl='. $page_url).' style="color:#ffffff" target="_self"><button class="btn btn-sm btn-primary"><i class="icon-edit"></i>
                Edit
                </button></a>';
                $delete='<a href='.site_url("usergroups/edit?id=".$d_id."&action=delete&pageurl=". $page_url).' style="color:#ffffff" target="_self">
                <button class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure want to delete\');"><i class="icon-ban-circle"></i> Delete </button>';
                $this->table->add_row(

                $data["results"][$i]['UserGroupID'],
                $data["results"][$i]['GroupName'],
                '',
                'yes',
                $data["results"][$i]['CreatedDate'],

                $edit_button.''. $delete
                );
            }
            $this->load->view('dashboard/usergroup_list_view',$data);
        }
 }
    function edit()
     {
         $this->load->library('form_validation');
         $id=$this->input->get('id');
         $data['grp_id'] = $id;
         $pageurl=$this->input->get('pageurl');
         $action=$this->input->get('action');
         if($action == 'delete')
         {
             $usedelete = $this->usermodel-> usergrp_delete($id);
             header('Location:'.$pageurl);
         }
         else if($action =='edit')
         {

             $data['result'] = $this->usermodel->usergrpedit($id);
             $usedata = $this->usermodel->usergrpedit($id);
             $data['pageurl']=$pageurl;

             $this->load->view('dashboard/usergroupedit_view', $data);
         }
     }

    function save()
    {
        $id=$this->input->post('grp_id');
        $grp_name=$this->input->post('group_name');
        $desc=$this->input->post('desc');
        $pageurl=$this->input->post('pageurl');
        $date=date("Y-m-d H:i:s");
        $this->usermodel->update_usergrp($id,$grp_name,$desc,$date);
        if(isset($pageurl))
        {
            header('Location:'.$pageurl);
        }
        else
        {
            header('Location: '.base_url() .'usergroups/usergrplist');

        }
  }

    function add()
    {
        $this->load->library('form_validation');
        $this->load->view('dashboard/usergroup_view');
    }


        function register()
        {

            //$this->output->enable_profiler(TRUE);
            try {

                $this->load->library('form_validation');


                $this->form_validation->set_rules('group_name','Group Name','trim|required|alpha_numaric|min_length[1]|xss_clean');
                $this->form_validation->set_rules('ParentGroup','Parent Group','trim|required|alpha_numaric|min_length[1]|xss_clean');

                //$this->load->view('view_register',$this->view_data);

                if($this->form_validation->run()==FALSE)
                {
                    //echo "*************8";
                    //$data['usrgrp_result'] = $this->usermodel->usrgrpdata();
                    //$data['usrtype_result'] = $this->usermodel->usrtype();

                    //$this->load->view('user_view', $data);
                    $this->load->view('dashboard/usergroup_view');

                }
                else
                {
                    $grp_name=$this->input->post('group_name');
                    $desc=$this->input->post('desc');
                    $grp_admin=$this->input->post('GroupAdmin');
                    $parent_grp=$this->input->post('ParentGroup');
                    $this->usermodel->register_usergrp($grp_name,$desc,$grp_admin,$parent_grp);
                    $data['message']='<h1  style="color:green;">User Group added successfully </h1>';
                    $this->load->view('dashboard/usergroup_view',$data);

                }


            }
            catch (Exception $e)
            {
                @trigger_error($e->getMessage(), E_USER_ERROR);
                return;
            }
        }


    }