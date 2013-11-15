<?php
Class Reportsmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function addreport($report_name, $report_display_name, $report_path, $user_type)
    {
        try {
            $date = date("Y-m-d H:i:s");
            $insert_data = array(
                'ReportName' => $report_name,
                'ReportDisplayName' => $report_display_name,
                'ReportFilePath' => $report_path,
                'CreatedDate' => $date,
                'CreatedBy' => 'Admin',
            );

            if (!$this->db->insert('[dbo].[TblSSRSReports]', $insert_data)) {
                throw new Exception("query failed");
            } else {
                return TRUE;
            }
            return TRUE;


        } catch (Exception $e) {
            @trigger_error($e->getMessage(), E_USER_ERROR);
            return FALSE;
        }
    }
}