<div style="width:600px; height: auto">
<?php
foreach($reports_list as $row)
{
    if($row['Type']=='Folder')
    {
?>
    <b><?php echo $row['Name']; ?></b><br />
<?php
    }
    else if($row['Type']=='Report')
    {
?>
    <a class="reportname" href="javascript:void(0);"><?php echo $row['Name']; ?></a><br />
<?php
    }
}
?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.reportname').click(function() {
            $.facebox.loading();
            var report_name = $(this).html();
            $.ajax({
                type:'POST',
                url:path_prefix+'reports/addreportpopup',
                data:
                {
                    report_name:report_name
                },
                success:function(response)
                {
                    $.facebox(response);
                },
                error:function(XMLHttpRequest,status,error)
                {
                    /*ajaxerror.handleerror(XMLHttpRequest.status,XMLHttpRequest.responseText);*/
                }
            });
        })
    });
</script>