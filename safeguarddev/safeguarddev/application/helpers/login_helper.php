<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function is_logged_in()
{

    $ci =& get_instance();

    if ($ci->session->userdata('signed_in') === TRUE)
        return TRUE;
    else
        return FALSE;
}

function is_access_permission($resource)
{

    /*$ci=& get_instance();
        
        $role_id = $ci->session->userdata('role_id');
        
        $ci->db->select('id')
            ->from('resource_permissions')
            ->join('resources','resources.resource_id = resource_permissions.resource_id','left')
            ->where(array("resource_permissions.role_id"=>$role_id,"resource"=>$resource));
            $query = $ci->db->get();
            $result = $query->result_array();
            if(empty($result))
                return FALSE;
            else*/
    return TRUE;
}

function logout()
{
    $ci =& get_instance();

    $ci->session->sess_destroy();
    redirect('/login');
}

?>