<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if(!is_logged_in())
        {
            redirect('/login');
        }

        if(!is_access_permission($this->router->fetch_class()))
        {
            echo "You don't have permission to access this page"; exit();
        }
        require_once(APPPATH . 'third_party/SSRSReport/bin/SSRSReport.php');
    }

    public function index()
    {
        $data['UserTypeID'] = $this->session->userdata('UserTypeID');
        $this->load->view('reports/reportslist',$data);
    }

    public function view()
    {
        //$this->output->cache(120);
        $this->config->load('reports');
        //echo '<pre>'; print_r($_GET); die();
        //echo base_url().ltrim($_SERVER['REQUEST_URI'], '/'); die();
        $parameters = $required_parameters_keys = array();
        $i = 0;

        $ssrs_report = new SSRSReport(new Credentials($this->config->item('ssrs_UID'), $this->config->item('ssrs_PWD')), $this->config->item('ssrs_SERVICE_URL'));

        // todo
        //if (!isset($_GET['reportname'])) {
        if(0){
            $report_name = "/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Volume_Report";
            $parameters = array();
            $required_parameters_object = $ssrs_report->GetReportParameters($report_name);
        } // todo
        else {
            $query = explode('&', urldecode($_SERVER['QUERY_STRING']));
            $query_strings_array = array();

            foreach ($query as $param) {
                list($name, $val) = explode('=', $param);
                $query_strings_array[urldecode($name)][] = urldecode($val);
            }

            //$report_name = $this->getReportName($this->config->item('ssrs_SERVICE_URL'),$query_strings_array);

            $report_name = urldecode($_GET['reportname']);
            //echo $_GET['ps:OrginalUri'];
            if (isset($_GET['ps:OrginalUri'])) {
                if ($_GET['ps:OrginalUri'] != '' && $_GET['ps:OrginalUri']!='ps:OrginalUri') {
                    $report_name = '/'.$this->getReportName($_GET['ps:OrginalUri'],$query_strings_array);
                }
            }
            //echo $report_name; die();
            //hardcode
            /*if (isset($_GET['ps:OrginalUri'])) {
                if ($_GET['ps:OrginalUri'] != '') {
                    $report_name = '/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Drilldown_DetailedVolume';
                }
            }*/
            //echo $report_name; die();
            //hardcode
            $required_parameters_object = $ssrs_report->GetReportParameters($report_name, null, TRUE);
            $required_parameters = object_to_array($required_parameters_object);
            //echo '<pre>'; print_r($required_parameters); die();
            //echo $ssrs_report->GetReportDefinition($report_name); die();
            //to check that all default values in required parameters are empty
            $defaultvalueempty_trigger = $i = 0;
            foreach ($required_parameters as $reportParameter) {
                if (empty($reportParameter['DefaultValues'])) {
                    $defaultvalueempty_trigger++;
                }
                $i++;
            }
            //echo $defaultvalueempty_trigger; die();
            if ($defaultvalueempty_trigger == $i && $defaultvalueempty_trigger > 0 && $report_name != '/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Drilldown_DetailedVolume') {
                if (isset($_GET['ps:OrginalUri'])) $origin = 'ps:OrginalUri'; else $origin = '';
                $controls_html = $this->convertParameter($required_parameters_object, $report_name, $origin, $query_strings_array);
                $data['resultHtml'] = $controls_html;
                $this->load->view('reports/reportsview', $data);
                return;
            }
            foreach ($required_parameters as $key => $value) {
                $required_parameters_keys[] = $value['Name'];
            }
            $parameters_values = array_intersect($required_parameters_keys, array_keys($query_strings_array));
            foreach (array_keys($query_strings_array) as $key => $value) {
                if (!in_array($value, $parameters_values)) {
                    unset($query_strings_array[$value]);
                }
            }
            //echo '<pre>'; print_r($query_strings_array); die();
            $i = 0;
            foreach ($query_strings_array as $key => $value) {
                if (strpos($key, ":")) {
                    continue;
                }

                if (!is_array($value)) {
                    $key2 = urldecode($key);
                    $value2 = urldecode($value);

                    $parameters[$i] = new ParameterValue();
                    $parameters[$i]->Name = $key2;
                    $parameters[$i]->Value = $value2;

                    //$i++;
                } else {
                    $key2 = urldecode($key);
                    foreach ($value as $v) {
                        $value2 = urldecode($v);

                        $parameters[$i] = new ParameterValue();
                        $parameters[$i]->Name = $key2;
                        $parameters[$i]->Value = $value2;

                        //$j++;
                    }
                    //$i++;
                }
                $i++;
            }
        }
        //$parameters = array_values($parameters);
        //echo '<pre>'; print_r($parameters); die();
        //$parameters_object = arrayToObject($parameters);
        //echo '<pre>'; print_r($parameters_object); die();
        if (isset($_GET['rs:ShowHideToggle'])) {
            error_reporting(0); //SDK generates some "warnings" that are displayed
            $ssrs_report->ToggleItem($this->_request->getQuery('rs:ShowHideToggle'));
        } else {
            $executionInfo = $ssrs_report->LoadReport2($report_name, NULL);
            $ssrs_report->SetExecutionParameters2($parameters, "en-us");
        }
        $htmlFormat = new RenderAsHTML();
        //echo getPageURL() . '?reportname=' . $report_name;
        $htmlFormat->ReplacementRoot = getPageURL() . '?reportname=' . $report_name;
        $htmlFormat->StreamRoot = 'assets/ssrsreportsimages';
        $resultHtml = $ssrs_report->Render2(
            $htmlFormat,
            PageCountModeEnum::$Estimate,
            $Extension,
            $MimeType,
            $Encoding,
            $Warnings,
            $StreamIds
        );

        $resultHtml = preg_replace(
            '/\<IMG.*?\/\>/',
            "\n$0\n",
            $resultHtml
        );

        $oldPieces = explode("\n", $resultHtml);
        $newPieces = array();
        foreach ($oldPieces as $line) {
            if (substr($line, 0, 2) == "<I") { //completely unnecessary? nope. It makes this run MUCH faster
                $line = preg_replace(
                    '/SRC="http.*?ToggleMinus\.gif"/',
                    'SRC="' . base_url() . '/public/images/reports/ToggleMinus.gif" ',
                    $line
                );

                $line = preg_replace(
                    '/SRC="http.*?TogglePlus\.gif"/',
                    'SRC="' . base_url() . '/public/images/reports/TogglePlus.gif" ',
                    $line
                );
            }
            $newPieces[] = $line;
        }

        $resultHtml = implode('', $newPieces);
        $resultHtml = html_entity_decode($resultHtml);
        if (isset($_GET['ps:OrginalUri'])) $origin = 'ps:OrginalUri'; else $origin = '';
        $controls_html = $this->convertParameter($required_parameters_object, $report_name, $origin, $query_strings_array);

        if (preg_match('/text/i', $controls_html) || preg_match('/<select/i', $controls_html)) {
            $data['resultHtml'] = $controls_html . $resultHtml;
        } else {
            $data['resultHtml'] = $resultHtml;
        }
        if(preg_match('/Drilldown/i', $report_name))
        {
            $data['resultHtml'] = $resultHtml;
        }
        //$data['resultHtml'] = $controls_html.$resultHtml;
        $this->load->view('reports/reportsview', $data);
    }
    public function tableauview()
    {
        $report = $this->input->get('report');
        
        $server = '10.10.1.189'; //'sgqatableau-1';
        $username = 'nchitra';
        $clientIp = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
        $url = $report.'?format=html';
        
        $params = compact('username');

        if ($clientIp) {
        $params['client_ip'] =$clientIp;
        }
        //echo file_get_contents("http://10.10.1.189");
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => "http://{$server}/trusted",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $params,
        CURLOPT_RETURNTRANSFER => true,
        ));

        $ticket = curl_exec($ch);
        curl_close($ch);
        
        if ($ticket <= 0) {
        throw new Exception("Server did not return a valid ticket.");
        }

        // At this point we have a valid trusted ticket ID, so let's request the content
        $url = ltrim(trim($url), '/');
        $fullUrl = "http://{$server}/trusted/{$ticket}/{$url}";
        $data['resultHtml'] = '<iframe frameborder="0" scrolling="no" width="95%" height="1500" src="'.$fullUrl.'"></iframe>';
        $this->load->view('reports/reportsview', $data);        
    }

    public function getReportName($ssrsUrl)
    {
        $reportarray = explode('?/',$ssrsUrl);
        return $reportarray[1];
    }

    public function convertParameter($reportParameters, $report_name, $origin, $reportParameters_array)
    {
        $parmVals = null;
        $controls = "<form id=\"ssrsParamsForm\" action='" . site_url('/reports/view') . "'>\n";
        $controls .= "\n<fieldset style='border: 1px solid rgb(0, 0, 0); padding:21px 73px; width:95%;float:left;padding: 9px 0px;'>\n";
        $controls .= '<input type="hidden" name="reportname" value="' . $report_name . '">';
        $controls .= '<input type="hidden" name="ps:OrginalUri" value="' . $origin . '">';
        $controls .= '<div class="center"  style="float:right; margin:-3px 12px -32px 12px;"><button type="submit" class="btn btn-primary btn-sm" value="View Report">View Report </button></div></form>';
        $controls .= '<div id="paramSelection" class="center" style="float:left;">';

        foreach ($reportParameters as $reportParameter) {
            //get the default value
            $default = null;

            foreach ($reportParameter->DefaultValues as $vals) {
                foreach ($vals as $key => $def) {
                    $default = $def;
                }
            }
            if (substr($reportParameter->Name, 0, 6) == "hidden") {
                //if (substr($reportParameter->Name,0,1) == "h" && $reportParameter->Name!='hs_dealer') {
                $controls .= "\n<input name='$reportParameter->Name' id='$reportParameter->Name' type='hidden' " .
                    "value='$default'/>\n";
                //continue;
            } else {

                $controls .= "&nbsp;&nbsp;<label for='$reportParameter->Name'>" . ucfirst(substr($reportParameter->Name, 3)) . '</label>';
            }
            //If there is a list, then it needs to be a Select box
            if (sizeof($reportParameter->ValidValues) > 0) {
                // dependencies: we have removed the capability for fields to have depencies

                if ($reportParameter->MultiValue === true) {
                    $multiple = "multiple = 'multiple'";
                    $formName = $reportParameter->Name . "[]";
                } else {
                    $formName = $reportParameter->Name;
                    $multiple = '';
                }

                $controls .= "\n<b>".$reportParameter->Prompt.":</b>&nbsp;<select name='$formName' id='$reportParameter->Name' {$multiple} >";
                foreach ($reportParameter->ValidValues as $values) {
                    //choose the default value only if nothing is set
                    if ($parmVals == null) {
                        $selected = ($values->Value == $default) ? "selected='selected'" : "";
                    }
                    else {
                        $selected = (key_exists($reportParameter->Name, $arr) && $values->Value == $arr[$reportParameter->Name]) ? "selected='selected'" : "";
                    }
                    // added the lines for previous selected value in the combo box
                    //echo $reportParameters_array['hs_dealer'][0];
                    if(isset($reportParameters_array['hs_dealer'][0]))
                    {
                        $selected = ($values->Value == $reportParameters_array['hs_dealer'][0]) ? "selected='selected'" : "";
                    }
                    if(isset($reportParameters_array['as_dealercode'][0]))
                    {
                        $selected = ($values->Value == $reportParameters_array['as_dealercode'][0]) ? "selected='selected'" : "";
                    }
                    if(isset($reportParameters_array['as_dealergroup'][0]))
                    {
                        $selected = ($values->Value == $reportParameters_array['as_dealergroup'][0]) ? "selected='selected'" : "";
                    }

                    // added the lines for previous selected value in the combo box

                    $controls .= "\n<option value='{$values->Value}' label='{$values->Label}' $selected>{$values->Label}</option>";
                }

                $controls .= "</select>";
            } else if ($reportParameter->Type == "Boolean") { //Boolean needs to be a CheckBox
                //choose the default value only if nothing is set
                if ($parmVals == null) {
                    $selected = (!empty($default) && $default != "False") ? "checked='checked'" : "";
                } else {
                    $selected = (key_exists($reportParameter->Name, $arr) && !empty($arr[$reportParameter->Name])) ? "checked='checked'" : "";
                }

                $controls .= "\n<input name='$reportParameter->Name' type='checkbox' $selected  />";
            } else { //the other types should be entered in TextBoxes (DateTime, Integer, Float)
                if (substr($reportParameter->Name, 1, 1) == 'd') {
                    $addDateAttr = '';

                    if (!empty($default)) {
                        $default = substr($default, 0, strpos($default, " "));
                    }
                } else {
                    $addDateAttr = '';
                }

                //choose the default value only if nothing is set
                if ($parmVals == null) {
                    $selected = (!empty($default)) ? "value='" . $default . "'" : "";
                } else {
                    $selected = (key_exists($reportParameter->Name, $arr) && !empty($arr[$reportParameter->Name])) ? "value='" . $arr[$reportParameter->Name] . "'" : "";
                }

                $controls .= "\n<input name='$reportParameter->Name' id='$reportParameter->Name' type='text' $selected />";
            }

            //$controls .= "</div>\n";
        }

        $controls .= "\n</fieldset>\n";

        return $controls;
    }

    public function exportreport()
    {
        $this->config->load('reports');
        //$ssrs_report = new SSRSReport(new Credentials($this->config->item('ssrs_UID'), $this->config->item('ssrs_PWD')), $this->config->item('ssrs_SERVICE_URL'));

        $fullReportName = $this->input->get('reportname');
        $reportName = basename($fullReportName);
        $exporttype = $this->input->get('exporttype');
        if (strtoupper($exporttype) == 'EXCEL') {
            $render = new RenderAsEXCEL();
            $extension = ".xlsx";
            $contentType = 'application/vnd.ms-excel';
        } elseif (strtoupper($exporttype) == 'PDF') {
            $render = new RenderAsPDF();
            $extension = ".pdf";
            $contentType = 'application/pdf';
        } else {
            echo "invalid export type requested";
            die();
        }

        $parameters = array();
        $i = 0;
        foreach($_GET as $key => $value) {
            if(strpos($key, ":")) {
                continue;
            }

            $key2 = urldecode($key);
            $value2 = urldecode($value);

            $parameters[$i] = new ParameterValue();
            $parameters[$i]->Name = $key2;
            $parameters[$i]->Value = $value2;

            if ($parameters[$i]->Name == 'hscmsid' && empty($parameters[$i]->Value)) {
                $parameters[$i]->Value = $this->_user->cmsid;
            }

            $i++;
        }


        $executionInfo = $this->ssrsReport->LoadReport2($fullReportName, NULL);
        $this->ssrsReport->SetExecutionParameters2($parameters, "en-us");

        $filename = date('Ymd') . '_' . str_replace(" ", '_', $reportName) . $extension;


        $content = $this->ssrsReport->Render2(
            $render,
            PageCountModeEnum::$Estimate,
            $Extension,
            $MimeType,
            $Encoding,
            $Warnings,
            $StreamIds
        );

        // todo
        try {
            $tmpFile = Zend_Registry::get('config')->os->path->tmp . $filename;
            file_put_contents($tmpFile, $content);
        } catch (Exception $e) {
            Sg_Log_Manager::error(__METHOD__, $e, true);
            $this->setMessage("There was a problem generating the export. Please try again.");
            return $this->_helper->redirector('error', 'index', 'default');
        }

        return $this->_helper->redirector('file', 'download', 'fileprocessing', array('file' => $filename));
    }

    public function add()
    {
        $this->load->view('reports/reports_add');
    }
    public function reportslistpopup()
    {
        $this->config->load('reports');

        $report_name = '/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Volume_Report';
        $ssrs_report = new SSRSReport(new Credentials($this->config->item('ssrs_UID'), $this->config->item('ssrs_PWD')), $this->config->item('ssrs_SERVICE_URL'));
        //echo $ssrs_report->GetReportDefinition($report_name); die();
        $reports_list_object = $ssrs_report->ListChildren('/WEBPORTAL_NEW',true); //die();
        $reports_list = object_to_array($reports_list_object);
        //echo '<pre>'; print_r($reports_list); echo '</pre>'; die();
        $data['reports_list'] = $reports_list;
        $this->load->view('reports/reports_list_popup',$data);
    }
    public function addreportpopup()
    {
        $this->load->helper('form');
        $this->load->model('usermodel');
        $data['usertypes_result'] = $this->usermodel->usrtype();
        $report_name =  $this->input->post('report_name');

        $data['report_name'] = $report_name;
        $this->load->view('reports/reports_add_popup',$data);
    }
    public function addreportaction()
    {
        $this->load->model('reportsmodel');

        $report_name =  $this->input->post('report_name');
        $report_display_name =  $this->input->post('report_display_name');
        $report_path =  ''; //$this->input->post('report_name');
        $user_type =  $this->input->post('user_type');
        $return_status = $this->reportsmodel->addreport($report_name, $report_display_name, $report_path, $user_type);
        if($return_status===TRUE)
        {
            echo '<b>Report Added Successfully</b>';
        }
        else
        {
            echo '<b>Report Failed to Added</b>';
        }
    }
    public function pdfreport()
    {
        $this->config->load('reports');
        $i = 0;

        $ssrs_report = new SSRSReport(new Credentials($this->config->item('ssrs_UID'), $this->config->item('ssrs_PWD')), $this->config->item('ssrs_SERVICE_URL'));

        if (isset($_REQUEST['rs:ShowHideToggle']))
        {
            $ssrs_report->ToggleItem($_REQUEST['rs:ShowHideToggle']);
        }
        else
        {
            $ssrs_report->LoadReport2('/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Volume_Report', NULL);
        }

        $renderAsHTML = new RenderAsPDF();
        $renderAsHTML->ReplacementRoot = getPageURL();
        $result_html = $ssrs_report->Render2($renderAsHTML,
            PageCountModeEnum::$Estimate,
            $Extension,
            $MimeType,
            $Encoding,
            $Warnings,
            $StreamIds);

        $myFile = "response.pdf";
        $fh = fopen($myFile, 'w') or die("can't open file");
        fwrite($fh, $result_html);
        fclose($fh);
        $data['resultHtml'] = '
         <embed width="90%" height="600" src="'.base_url().'response.pdf">
        ';
        $this->load->view('reports/reportsview', $data);
    }
}