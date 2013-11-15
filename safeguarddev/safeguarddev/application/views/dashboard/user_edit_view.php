<?php
//echo form_open('$base_url','user/register');

$userid=array(
    'name'=>'userid',
    'id' =>'userid',
    'class' =>'form-control',
    'readonly'=>'true',
);

$firstname_data=array(
    'name'=>'first_name',
    'id' =>'first_name',
    'class' =>'form-control',
);

$lastname_data=array(
    'name'=>'last_name',
    'id' =>'last_name',
    'class' =>'form-control',
);


$cmsid_data=array(
    'name'=>'cms_id',
    'id' =>'cms_id',
    'class' =>'form-control',
);

$phone_data=array(
    'name'=>'phone',
    'id' =>'phone',
    'class' =>'form-control',
    'class' =>'form-control bfh-phone',
    'data-format'=>'+1 (ddd) ddd-dddd',
);

$email_data=array(
    'name'=>'email',
    'id' =>'email',
    'class' =>'form-control',
);

foreach($usrtype_result as $data)
{
    $grpid=$data['UserTypeID'];
    $usertype_options['']='Select';
    $usertype_options[$grpid] =$data['UserTypeName'];
}

//$usertype_options= array('1101' => 'IEM');

foreach($usrgrp_result as $data) {
    $grpid=$data['UserGroupID'];
    $usergroup_options['']='Select';
    $usergroup_options[$grpid] = $data['GroupName'];
}


    $userid['value']			=	$uname;
    $firstname_data['value']	=	$firstname;
    $lastname_data['value']		=	$lastname;
    $email_data['value']		=	$email;
    $cmsid_data['value']		=	$cms;
    $phone_data['value']		=	$phone;
    $selected_grp_edit			=	$user_group;
	$selected_type_edit 		=	$user_type;
	$uid = $id;
	$pu = $pageurl;
 




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
<?php require_once(APPPATH.'views/frames/header.php'); ?>
<?php require_once(APPPATH.'views/frames/sidebar.php'); ?>

<div class="col-md-10" id="fullwidtheff">

<div class="col-md-12">
    <div class="usergropadminblock">


        <p style=" font-size:20px;">Edit User

        <hr style="margin:0px; padding:10px;">




        <div class="Usergroup_serach">

            <?php
            if(isset($message))
			{
				echo $message;
			}
			else {
	            $attributes = array('class' => 'form-horizontal', 'id' => 'form-horizontal');
            echo form_open(base_url().'users/edit?id='.$uid.'&action=edit&pageurl='.$pu,$attributes);

            $this->form_validation->set_error_delimiters('<span class="error" style="color:red">', '</span>'); ?>

                <div class="form-group">

                    <?php echo form_hidden('user_id', $usr_id);?>
                    <?php
                    if(isset($pageurl))
                    {
                     echo form_hidden('pageurl', $pageurl);
                   }?>
                    <div class="col-xs-4 text-right control-label">
                        First Name *
                    </div>
                    <div class="col-md-5 col-xs-8">
                        <?php echo form_input($firstname_data); ?>
                         <span> <?php echo form_error('first_name'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-4 text-right control-label">
                        Last Name *
                    </div>
                    <div class="col-md-5 col-xs-8">
                        <?php echo form_input($lastname_data); ?>
                        <span> <?php echo form_error('last_name'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-4 text-right control-label">
                        User Name *
                    </div>
                    <div class="col-md-5 col-xs-8">
                        <?php echo form_input($userid); ?>
                        <span class="error" style="color:red"><?php

                            echo (isset($usr_error))?$usr_error:'';?> </span>
                        <span> <?php echo form_error('userid'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-4 text-right control-label">
                        Email *
                    </div>
                    <div class="col-md-5 col-xs-8">
                        <?php echo form_input($email_data); ?>
                        <span> <?php echo form_error('email'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-4 text-right control-label">
                        Phone
                    </div>
                    <div class="col-md-5 col-xs-8">
                        <?php echo form_input($phone_data); ?>
                        <span> <?php echo form_error('phone'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-4 text-right control-label">
                        Group *
                    </div>
                    <div class="col-md-5 col-xs-8">
                        <?php
                        $attr='class ="form-control" ';
                        //$select=set_select($selected_grp_edit);
                        //echo $select;
                        $select1 = $u_gid;
                        //$select=$selected_grp_edit;
                        echo form_dropdown('Usergroup', $usergroup_options, $select1 , $attr);
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-4 text-right control-label">
                        User Type *
                    </div>
                    <div class="col-md-5 col-xs-8">
                        <?php
                        //$shirts_on_sale = array('small', 'large');
                        $select2=$u_type;
                        $attr='class ="form-control" ';
                       // $select2=$selected_type_edit;

                        echo form_dropdown('Usertype', $usertype_options, $select2,$attr);
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-4 text-right control-label">
                        CMS Id
                    </div>
                    <div class="col-md-5 col-xs-8">
                        <?php echo form_input($cmsid_data); ?>
                        <span> <?php echo form_error('cms_id'); ?></span>
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-xs-6 text-right" style="margin-left:20px;">
                        <?php echo form_submit(array('name'=>'save','class'=>'btn btn-primary'),'Save');?>
                    </div>
                    <div class="col-xs-4" style="line-height:2; text-decoration:underline;">
                        <p><a href="<? echo base_url('')?>users " onclick="formReset()" style="text-decoration:underline; padding:5px;">Cancel</a>
                    </div>
                </div>


            </form>
<?php
}?>
        </div>
    </div>
</div>



</div>



<style>
    label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
</style>



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
<script type="text/javascript" src="<?=base_url('')?>js/jquery.validate.min.js"></script>
<script src="<?=base_url('')?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url('')?>assets/js/bootstrap-formhelpers-phone.js">
<script type="text/javascript">
    $(document).ready(function() {
        $('#form-horizontal').validate(
            {
                rules: {
                    userid: {
                        minlength: 1,

                        required: true
                    },
                    first_name: {
                        minlength: 1,
                        required: true
                    },
                    last_name: {
                        minlength: 2,
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },

                    Usergroup: {
                        required: true

                    },
                    Usertype: {
                        required: true

                    }
                },


                messages: {
                    first_name: "Enter your firstname",
                    last_name: "Enter your lastname",
                    userid: {
                        required: "Enter an username",
                        minlength: jQuery.format("Enter at least {0} characters"),
                        remote: jQuery.format("{0} is already in use")
                    },
                    email:"Enter an Email",
                    Usergroup:"Select an Usergroup",
                    Usertype:"Select an UserType"
                }
            });
    });
</script>
</body>
</html>