<?php
$name=array(
    'name'=>'name',
    'id' =>'name',
	'type' => 'text',
	'value'=>set_value('name'),
    'class' =>'form-control'
);

$email=array(
    'name'=>'email',
    'id' =>'email',
	'type' => 'text',
	'set_value' => 'email',
	'value'=>set_value('email'),
    'class' =>'form-control'
);

$textarea = array(
      'name'        => 'message',
      'id'          => 'message',
      'rows'        => '5',
      'cols'        => '10',
	'value'=>set_value('message'),
    'class' =>'form-control'
    );

if(isset($message))
{
    $name['value']='';
    $password['value']='';
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

<div class="col-xs-10 col-sm-8 col-lg-8 col-md-8" style=" margin-top:30px;">
    <div class="usergropadminblock">


        <p style=" font-size:20px;">Contact Us

        <hr style="margin:0px; padding:10px;">


        <div class="Usergroup_serach">

            <?php
			$attributes = array('class' => 'form-horizontal', 'id' => 'form-horizontal');
			echo form_open('home/contactus',$attributes);
            $this->form_validation->set_error_delimiters('<span class="error" style="color:red">', '</span>');

            if(isset($message))
			{
				echo $message;
			}
			else
			{
            ?>

            <div class="form-group">
                <div class="col-xs-4 text-right control-label">
                    Name *
                </div>
                <div class="col-md-5 col-xs-8">
                    <?php echo form_input($name); ?>
                    <span> <?php echo form_error('name'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4 text-right control-label">
                    Email ID *
                </div>
                <div class="col-md-5 col-xs-8">
                    <?php echo form_input($email); ?>
                    <span> <?php echo form_error('email'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4 text-right control-label">
                    Message *
                </div>
                <div class="col-md-5 col-xs-8">
                    <?php echo form_textarea($textarea); ?>
                    <span> <?php echo form_error('message'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">

                </div>
            </div>


            <div class="form-group">
                <div class="col-xs-6 text-right" style="margin-left:20px;">
                    <?php echo form_submit(array('name'=>'save' ,'class'=>'btn btn-primary'),'Send');?>
                </div>
                <div class="col-xs-4" style="line-height:2; text-decoration:underline;">
                    <p><a href="<?php echo base_url('')?>login " onclick="formReset()" style="text-decoration:underline; padding:5px;">Cancel</a>
                </div1>
            </div>
			<?
			}
			?>

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
<script src="<?=base_url('')?>js/jquery-1.10.2.min.js"></script>

<script src="<?=base_url('')?>js/jquery-1.10.2.min.js"></script>

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
<script src="<?=base_url('')?>assets/js/bootstrap-formhelpers-phone.js">

<style>
    label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#form-horizontal').validate(
            {
                rules: {
                    userid: {
                        minlength: 2,

                        required: true
                    },
                    first_name: {
                        minlength: 1,
                        required: true
                    },
                    last_name: {
                        minlength: 1,
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
                        required: "Enter a username",
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