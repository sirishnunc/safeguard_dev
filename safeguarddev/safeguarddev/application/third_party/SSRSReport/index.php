<?php
require_once 'bin/SSRSReport.php';
define("UID", 'sandeep');
//define("UID", 'ETCH\aravindr');
define("PWD", "nunc");
//define("PWD", "J46[x]:X");
//define("SERVICE_URL", "http://SANDEEPREDDY:80/ReportServer_SSRSEXPRESS");
define("SERVICE_URL", "http://localhost:90/ReportServer_SQLEXPRESS");
//define("SERVICE_URL", "http://sgdw-dev/ReportServer_SGDWDEV");
define("REPORT", "/Safe_Guard_Report/Safe Guard Report");
//define("REPORT", "RowLevelSecurity");
ini_set("memory_limit","2048M");

//echo "hi"; die();
//ExecutionID=2dcmdb55aqx2tiuxkacaor45&ControlID=c1983c0fe47d4c14b8e6cda80dc5bdcc&Culture=1033&UICulture=9&ReportStack=1&OpType=ReportArea&Controller=ReportViewerControl&PageCountMode=Estimate&LinkTarget=_top&&ZoomMode=Percent&ZoomPct=100&ActionType=PageNav&ActionParam=2&PageNumber=1
$parameters = array();
$parameters[0] = new ParameterValue();
$parameters[0]->Name = "pageno";
$parameters[0]->Value = 50;
try
{
    $ssrs_report = new SSRSReport(new Credentials(UID, PWD), SERVICE_URL);

    
    //&rs:Command=Render
    if (isset($_REQUEST['rs:ShowHideToggle']))
    {
       $ssrs_report->ToggleItem($_REQUEST['rs:ShowHideToggle']);
    }
    else
    {
            $ssrs_report->LoadReport2(REPORT, NULL);
    }
    $ssrs_report->SetExecutionParameters2($parameters);
    
    $renderAsHTML = new RenderAsHTML();
    $RenderAsIMAGE = new RenderAsPDF();
	$renderAsHTML->ReplacementRoot = getPageURL();
    $result_html = $ssrs_report->Render2($renderAsHTML,
                                PageCountModeEnum::$Actual,
                                $Extension,
                                $MimeType,
                                $Encoding,
                                $Warnings,
                                $StreamIds);
    $result_xml = $ssrs_report->Render2($RenderAsIMAGE,PageCountModeEnum::$Actual,
                                $Extension,
                                $MimeType,
                                $Encoding,
                                $Warnings,
                                $StreamIds);
    $myFile = "response.txt";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fwrite($fh, $result_xml);
    fclose($fh);
    
	echo '	
	<h1>Here is the report generated from PHP</h1>
	';
    echo '<div style="overflow:auto; width:100%; height:auto">';
    echo $result_html;
    echo '</div>';
    
    
}
catch (SSRSReportException $serviceException)
{
    print("<pre>");
    print_r($serviceException);
    print("</pre>");
    
    $myFile = "response.html";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fwrite($fh, serialize($serviceException));
    fclose($fh);
}

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
?> 
