<?php
$report_name_data = array(
'name'=>'report_name',
'id' =>'report_name',
'class' =>'form-control',
'value'=>$report_name,
'readonly'=>'readonly'
);
$report_display_name_data = array(
    'name'=>'report_display_name',
    'id' =>'report_display_name',
    'class' =>'form-control',
    'value'=>set_value('report_display_name')
);
foreach($usertypes_result as $row)
{
    $UserTypeID = $row['UserTypeID'];
    $usertype_options[''] = 'Select User Type';
    $usertype_options[$UserTypeID] = $row['UserTypeName'];
}
?>
<div style="width:600px; height: auto">
    <div class="form-group">
        <div class="col-xs-4 text-right control-label">
            Report Name
        </div>
        <div class="col-md-5 col-xs-8">
            <?php echo form_input($report_name_data); ?>
            <span> <?php echo form_error('report_name'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 text-right control-label">
            Report Display Name
        </div>
        <div class="col-md-5 col-xs-8">
            <?php echo form_input($report_display_name_data); ?>
            <span> <?php echo form_error('report_display_name'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 text-right control-label">
            User Types
        </div>
        <div class="col-md-5 col-xs-8">
            <?php
            $attr='class="form-control" id="user_types"';
            echo form_dropdown('user_types', $usertype_options, '',$attr);
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-6 text-right" style="margin-left:20px;">
            <?php echo form_button(array('name'=>'Add','class'=>'btn btn-primary','id'=>'addbutton'),'Add');?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#addbutton').click(function() {
            $.facebox.loading();
            var report_name = $('#report_name').html();
            var report_display_name = $('#report_display_name').html();
            var user_types = $('#user_types').html();
            $.ajax({
                type:'POST',
                url:path_prefix+'reports/addreportaction',
                data:
                {
                    report_name:report_name,
                    report_display_name:report_display_name,
                    user_types:user_types
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