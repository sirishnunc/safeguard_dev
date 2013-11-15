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
if(isset($message))
{
    $groupname['value']='';
    $desc['value']='';

  }

$grpadmin_options=array(''=>'Select','1'=>'Super Admin','2'=>'Internal Admin','3'=>'External Admin');
$parentgrp_options=array(''=>'Select','1'=>'Executive','2'=>'Dealer','3'=>'Agents');





    /*
foreach($usrtype_result as $data)
{
    $grpid=$data['UserTypeID'];
    $usertype_options['']='Select';
    $usertype_options[$grpid] =$data['UserTypeName'];
}

//$usertype_options= array('1101' => 'IEM');

foreach($usrgrp_result as $data) {
    $grpid=$data['UserGroupId'];
    $usergroup_options['']='Select';
    $usergroup_options[$grpid] = $data['GroupDescription'];
}
*/

//print_r($usergroup_options);

//$usergroup_options= array('1' => 'GRP1','2' => 'GRP2',);



$checkbox = array(
    'name'        => 'send_email',
    'id'          => 'send_email',
    'value'       => 'accept',
    //'checked'     => TRUE,
    'style'       => 'margin:10px',
);

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


<div class="row" style="background-color: #1063B8;">

    <div class="col-lg-1">
        <img src="<?=base_url('')?>assets/images/logo.png" style="padding:14px 0 13px 0px;">
    </div>


    <div class="col-lg-8 col-md-8 col-sm-8">

        <nav class="navbar navbar" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <ul  class="nav navbar-nav nav-pills   pull-right text-center topnav">
                    <li class="active"><a href="#"><i class="icon-home "></i> <br> Home</a></li>
                    <li class=""><a href="#"><i class="icon-tags"></i><br> Sales</a></li>
                    <li class=""><a href="#"><i class="icon-bar-chart"></i> <br>Claims</a></li>
                    <li class=""><a href="#"><i class="icon-group"></i><br> Risk Management</a></li>
                    <li class=""><a href="#"><i class="icon-book"></i><br>  Accounting</a></li>
                    <li class=""><a href="#"><i class="icon-cogs"></i><br> Operations</a></li>

                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>

        <!--<ul  class="nav navbar-nav nav-pills   pull-right text-center topnav">
              <li class="active"><a href="#"><i class="icon-home "></i> <br> Home</a></li>
              <li class=""><a href="#"><i class="icon-tags"></i><br> Sales</a></li>
              <li class=""><a href="#"><i class="icon-bar-chart"></i> <br>Claims</a></li>
              <li class=""><a href="#"><i class="icon-group"></i><br> Risk Management</a></li>
              <li class=""><a href="#"><i class="icon-book"></i><br>  Accounting</a></li>
              <li class=""><a href="#"><i class="icon-cogs"></i><br> Operations</a></li>

              </li>
        </ul>
        -->
    </div>

    <div class="profiledet">

        <div class=" col-lg-1 col-md-1 col-lg-1  pull-left">

            <img src="<?=base_url('')?>images/eebf9429dd437ab83c926184e1625ff9.jpeg" class="pull-left hidden-xs">

        </div>


        <div class=" col-lg-1 col-md-1 col-lg-1 pull-left usrdet pull-left" style="padding:0; margin:0;">



            <ul>
                <li><a href="#">Edit Profile</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Logout</a></li>
            </ul>

        </div>
    </div>


</div>


<?php require_once(APPPATH.'views/frames/sidebar.php'); ?>


<div class="col-xs-10 col-sm-8 col-lg-8 col-md-8" style=" margin-top:30px;">
    <div class="usergropadminblock">


        <p style=" font-size:20px;">Add Group

        <hr style="margin:0px; padding:10px;">




        <div class="Usergroup_serach">

                <?php

                $attributes = array('class' => 'form-horizontal', 'id' => 'form-horizontal');

                echo form_open('usergroups/register',$attributes);
                $this->form_validation->set_error_delimiters('<span class="error" style="color:red">', '</span>');
                echo (isset($message))?$message:'';?>

                <div class="form-group">
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





<script>

    function formReset()
    {
        document.getElementById("form-horizontal").reset();
    }

</script>




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



<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?=base_url('')?>assets/js/jquery.validate.min.js"></script>
<script src="<?=base_url('')?>assets/js/bootstrap.min.js"></script>
</body>
</html>