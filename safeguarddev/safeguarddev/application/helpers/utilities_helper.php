<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('object_to_array'))
{
	function object_to_array($array)
	{
            if (is_array($array) || is_object($array))
            {
                $result = array();
                foreach ($array as $key => $value)
                {
                    $result[$key] = object_to_array($value);
                }
                return $result;
            }
            return $array;
	}
}
if ( ! function_exists('array_to_obj'))
{
    function array_to_obj($array, &$obj)
    {
      foreach ($array as $key => $value)
      {
        if (is_array($value))
        {
        $obj->$key = new stdClass();
        array_to_obj($value, $obj->$key);
        }
        else
        {
          $obj->$key = $value;
        }
      }
    return $obj;
    }
}
if ( ! function_exists('arrayToObject'))
{
    function arrayToObject($array)
    {
     $object= new stdClass();
     return array_to_obj($array,$object);
    }
}
if ( ! function_exists('getPageURL'))
{
    function getPageURL()
    {
        error_reporting(0);
            $PageUrl = $_SERVER["HTTPS"] == "on"? 'https://' : 'http://';
        $uri = $_SERVER["REQUEST_URI"];
        $index = strpos($uri, '?');
        if($index !== false)
        {
            $uri = substr($uri, 0, $index);
        }
        $PageUrl .= $_SERVER["SERVER_NAME"] .
                    ":" .
                    $_SERVER["SERVER_PORT"] .
                    $uri;
        return $PageUrl;
    }
}


if(! function_exists('ip_address'))
{
	function ip_address() 
    {
    	$obj =& get_instance();
        $correct_ip_address = $obj->input->ip_address(); 
        return $correct_ip_address;
    }		
}

if(! function_exists('user_agent'))
{
	function user_agent()
	{
		$obj =& get_instance();
		$obj->load->library('user_agent');
		if ($obj->agent->is_browser())
		{
		    //$agent = $obj->agent->browser().' '.$obj->agent->version();
		    $agent = $obj->agent->browser();
		}
		elseif ($obj->agent->is_robot())
		{
		    $agent = $obj->agent->robot();
		}
		elseif ($obj->agent->is_mobile())
		{
		    $agent = $obj->agent->mobile();
		}
		else
		{
		    $agent = 'Unidentified User Agent';
		}
		
		return $agent;
	}
}


if(! function_exists('user_platform'))
{	
	function user_platform()
	{
		$obj =& get_instance();
		$agent = user_agent();
		return $obj->agent->platform();
	}
}
	
if(! function_exists('browser_version'))
{
	function browser_version()
	{
		$obj =& get_instance();
		$agent = user_agent();
		$version = $obj->agent->version();
		return $version;
	}
}

if(! function_exists('session'))
{	
	function session()
	{
		$obj =& get_instance();		
		$obj->load->library('session');
		$session_id = $obj->session->userdata('session_id');
		return $session_id;
	}
}

if(! function_exists('start_time'))
{	
	function start_time()
	{
		$date=date("Y-m-d H:i:s");
		return $date;
	}
}
if(! function_exists('start_time'))
{
    function send_email($from, $sendername, $to, $subject, $message)
    {
        // todo
        echo file_get_contents('http://d1145998-16594.site.myhosting.com/sendemail/index.php?from='.$from.'&sendername='.$sendername.'&to='.$to.'&subject='.$subject.'&message='.$message);
        /*
        $CI =& get_instance();
        $CI->load->library('email');

        $CI->email->from($from,$sendername);
        $CI->email->to($to);
        $CI->email->subject($subject);
        $CI->email->message($message);
        if($CI->email->send())
        {
            echo 'Your email was sent, successfully.';
        }

        else
        {
            show_error($CI->email->print_debugger());
        }
        */
    }
}
/* End of file utilities_helper.php */
/* Location: ./application/helpers/utilities_helper.php */