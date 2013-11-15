<?php
//echo form_open('$base_url','user/register');


$groupname=array(
    'name'=>'group_name',
    'id' =>'group_name',
    'class' =>'form-control',
    'value'=> set_value('group_name')
);
$desc = array(
    'name'        => 'desc',
    'id'          => 'desc',
    'rows'       => '3',
    'class' =>'form-control',

);

$grpadmin_options=array(''=>'Select','1'=>1,'2'=>2,'3'=>3,'4'=>4);
$parentgrp_options=array(''=>'Select','1'=>1,'2'=>2,'3'=>3,'4'=>4);

//print_r($result);
foreach($result as $data)
{


    $groupname['value']=$data['GroupName'];
    $desc['value']=$data['GroupDescription'];



}


?><!DOCTYPE html>
<html>
<head>
    <title>Safe Guard</title>

    <meta name="viewport" content="width=device-width, initial-scale=0.63">

    <!-- Bootstrap -->
    <link href="<?=base_url('')?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?=base_url('')?>assets/css/font-awesome.min.css" rel="stylesheet" media="all">



    <!--plugins css-->

    <!--custom css-->
    <link href="<?=base_url('')?>assets/css/site_custom_styles1.css" rel="stylesheet" media="screen">
    <link href="<?=base_url('')?>assets/css/offcanvas.css" rel="stylesheet" media="screen">



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=base_url('')?>assets/js/html5shiv.js"></script>
    <script src="<?=base_url('')?>assets/js/respond.min.js"></script>
    <![endif]-->


</head>



<body>


<?php require_once(APPPATH.'views/frames/header.php'); ?>
<?php require_once(APPPATH.'views/frames/sidebar.php'); ?>

<div class="col-xs-10 col-sm-8 col-lg-8 col-md-8" style=" margin-top:30px;">
    <div class="usergropadminblock">


        <p style=" font-size:20px;">Edit Group

        <hr style="margin:0px; padding:10px;">




        <div class="Usergroup_serach">

            <?php

            $attributes = array('class' => 'form-horizontal', 'id' => 'form-horizontal');

            echo form_open('usergroups/save',$attributes);
            $this->form_validation->set_error_delimiters('<span class="error" style="color:red">', '</span>');?>
            <?php
            if(isset($usr_id))
            {
               echo form_hidden('user_id', $usr_id);
            }
            ?>
            <?php
            if(isset($pageurl))
            {
               echo form_hidden('pageurl', $pageurl);
            }
            ?>
            <div class="form-group">
                <?php echo form_hidden('grp_id', $grp_id);?>
                <div class="col-xs-4 text-right control-label">
                    Group Name*
                </div>
                <div class="col-md-5 col-xs-8">
                    <?php echo form_input($groupname);?>
                    <?php echo form_error('group_name'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4 text-right control-label">

                    Description
                </div>
                <div class="col-md-5 col-xs-8">
                    <?php echo form_textarea($desc);?>

                </div>
            </div>



            <div class="form-group">
                <div class="col-xs-4 text-right control-label">
                    Group Admin
                </div>
                <div class="col-md-5 col-xs-8">
                    <?php         $attr='class ="form-control" ';
                    $select=set_value('Usergroup');
                    echo form_dropdown('GroupAdmin', $grpadmin_options, $select,$attr);?>


                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4 text-right control-label">
                    Parent Group *
                </div>
                <div class="col-md-5 col-xs-8">

                    <?php         $attr='class ="form-control" ';
                    $select=set_value('ParentGroup');
                    echo form_dropdown('ParentGroup', $parentgrp_options, $select,$attr);?>
                    <?php echo form_error('ParentGroup'); ?>
                </div>
            </div>




            <div class="form-group">
                <div class="col-xs-6 text-right" style="margin-left:20px;">
                    <?php echo form_submit(array('name'=>'save','class'=>'btn btn-primary'),'Save');?>



                </div>
                <div class="col-xs-4" style="line-height:2; text-decoration:underline;">
                    <p><a href="# " onclick="formReset()" style="text-decoration:underline; padding:5px;">Cancel</a>

                </div>
            </div>


            </form>

        </div>
    </div>
</div>





</div>










<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=base_url('')?>assets/js/jquery-1.10.2.min.js"></script>

<script src="<?=base_url('')?>assets/js/jquery-1.10.2.min.js"></script>

<script  type="text/javascript">

    $(document).ready(function() {
        $('[data-toggle=offcanvas]').click(function() {
            $('.row-offcanvas').toggleClass('active');
        });

        $('#user').popover();

    });

</script>
<script>

    function formReset()
    {
        document.getElementById("form-horizontal").reset();
    }

</script>


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?=base_url('')?>assets/js/jquery.validate.min.js"></script>
<script src="<?=base_url('')?>js/bootstrap.min.js"></script>
</body>
</html>