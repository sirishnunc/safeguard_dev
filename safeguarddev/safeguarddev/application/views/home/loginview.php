<?php
//echo form_open('$base_url','user/register');
echo form_open('login/logincheck');



$username=array(
    'name'=>'username',
    'id' =>'username',
    'value'=>'',
    'placeholder' => 'Username',
    'class'=>'form-control userani1'
);

$password=array(
    'name'=>'password',
    'id' =>'password',
    'value'=>'',
    'placeholder' => 'Password',
    'class'=>'form-control userani1'
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Safe Guard</title>

    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Bootstrap -->
    <link href="<?=base_url('')?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?=base_url('')?>assets/css/font-awesome.min.css" rel="stylesheet" media="all">



    <!--plugins css-->

    <!--custom css-->
    <link href="<?=base_url('')?>assets/css/site_custom_styles1.css" rel="stylesheet" media="screen">



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=base_url('')?>assets/js/html5shiv.js"></script>
    <script src="<?=base_url('')?>assets/js/respond.min.js"></script>
    <![endif]-->


</head>



<body style="background-color:#2980B9;">


<div class="container loginbox">

    <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-4  col-lg-offset-4 col-md-offset-4 col-sm-offset-4">


            <form class="form-horizontal" action="#" method="#">

                <div class="form-group text-center">

                    <div class="col-xs-12">
                        <img src="<?=base_url('')?>assets/images/logo.png">
                    </div>

                </div>

                <div class="form-group">

                    <div class="col-xs-12">
                        <?php echo (isset($login_error))?$login_error:''; ?>
                        <?php $this->form_validation->set_error_delimiters('<span class="error" style="color:red">', '</span>');?>
                        <?php echo form_input($username); ?>
                        <span> <?php echo form_error('username'); ?></span>

                    </div>
                </div>



                <div class="form-group">

                    <div class="col-xs-12">
                        <?php echo form_password($password); ?>
                        <span> <?php echo form_error('password'); ?></span>
                       <!-- <input type="text" placeholder="Password*" class="form-control userani1">-->

                    </div>
                </div>



                <div class="form-group">

                    <div class="col-xs-12">


                       <?php echo form_submit(array('name'=>'sign_in','value'=>'SIGN IN','class'=>'btn btn-success btn-block userani2'),'Logincheck');?>



                        <!--<input type="submit" class="btn btn-success btn-block userani2" value="SIGN IN">-->

                    </div>
                </div>


                <div class="form-group" style="color:wheat; font-weight:normal; font-family:flat;">

                    <div class="col-xs-6">

                        
                        <label><a href="<?=base_url('')?>forgotpassword/" style="color:white;text-decoration:none;">Forgot Password?</a></label>

                    </div>

                    <div class="col-xs-6 text-right">

                        <label><a href="<?=base_url('')?>home/contactus" style="color:white;text-decoration:none;">Contact Us</a></label>

                    </div>


                </div>





            </form>





        </div>


    </div>


</div>




<div class="row">

    <div class="col-xs-12"></div>


</div>












<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=base_url('')?>assets/js/jquery-1.10.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?=base_url('')?>assets/js/jquery.validate.min.js"></script>
<script src="<?=base_url('')?>assets/js/bootstrap.min.js"></script>
</body>
</html>