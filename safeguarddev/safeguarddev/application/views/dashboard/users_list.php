<?php
$firstname=array(
    'name' => 'first_name',
    'id' => 'first_name',
    'class' => "form-control",
    'value' =>''
);
$lastname=array(
    'name' => 'last_name',
    'id' => 'last_name',
    'class' => "form-control",
    'value' =>''
);
$cmsid=array(
    'name' => 'cms_id',
    'id' => 'cms_id',
    'class' => "form-control",
    'value' =>''
);
if(isset($usrtype_result))
{
    foreach($usrtype_result as $data)
    {
        $grpid=$data['UserTypeID'];
        $usertype_options['']='Select';
        $usertype_options[$grpid] =$data['UserTypeName'];
    }
}

//$usertype_options= array('1101' => 'IEM');
if(isset($usrgrp_result))

{
    foreach($usrgrp_result as $data) {
        $grpid = $data['UserGroupID'];
        $usergroup_options['']='Select';
        $usergroup_options[$grpid] = $data['GroupName'];
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Safe Guard</title>

    <meta name="viewport" content="width=device-width, initial-scale=0.63">

    <!-- Bootstrap -->
    <link href="<?=base_url('')?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?=base_url('')?>assets/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?=base_url('')?>assets/css/dataTables.bootstrap.css" rel="stylesheet" media="all">



    <!--plugins assets/css-->

    <!--custom assets/css-->
    <link href="<?=base_url('')?>assets/css/site_custom_styles1.css" rel="stylesheet" media="screen">
    <link href="<?=base_url('')?>assets/css/offcanvas.css" rel="stylesheet" media="screen">



    <!-- HTML5 shim and Respond.assets/js IE8 support of HTML5 elements and media queries -->
 <!--[if lt IE 9]>
     <script src="<?=base_url('')?>assets/js/html5shiv.js"></script>
    <script src="<?=base_url('')?>assets/js/respond.min.js"></script>
    <![endif]-->



</head>

<body style="overflow-x: hidden !important;">

<?php require_once(APPPATH.'views/frames/header.php'); ?>

<?php require_once(APPPATH.'views/frames/sidebar.php'); ?>



<div class="col-md-10 col-md-12 fullwidtheffect" id="fullwidtheff">



         <div class="col-md-12">

          <p style="font-family:flat; font-size:20px; padding: 4px 4px;margin-top: 5px;">User Administration</p>
          <hr>
        </div>



<div class="col-md-12">

<div class="panel panel-success">
        <div class="panel-heading">Search Users</div>
        <div class="panel-body panel-default" style="padding:0">
      <?php

            $attributes = array('class' => 'form-horizontal', 'id' => 'form-horizontal');

            echo form_open('users/search',$attributes)?>
            <table class="table" style="margin-top:0px !important;">

                <tr>
                    <td>


                        <div class="form-group">
                            <div class="col-md-4 text-right control-label">
                                First Name
                            </div>
                            <div class="col-md-8">
                                <!--<input type="text" class="form-control">-->
                                <?php echo form_input($firstname); ?>


                            </div>
                        </div>

                    </td>

                    <td>


                        <div class="form-group">
                            <div class="col-md-4 text-right control-label">
                                Group
                            </div>

                            <div class="col-md-8  control-label" style="margin-top: -5px;">


                                <?php
                                $attr='class ="form-control" ';
                                $select=set_value('Usergroup');
                                if(isset($usergroup_options))
                                {
                                  echo form_dropdown('Usergroup', $usergroup_options, $select,$attr);
                                }
                                ?>
                                <!--
                                <select class="form-control">
                                     <option>Executives</option>
                                     <option>2</option>
                                     <option>3</option>
                                     <option>4</option>
                                     <option>5</option>
                                 </select>-->

                            </div>
                        </div>

                    </td>

                    <td>
                        <div class="form-group">
                            <div class="col-md-4 text-right control-label">
                                Status
                            </div>
                            <div class="col-md-8 control-label" style="margin-top: -5px;">
                                <select class="form-control">
                                    <option>Active</option>
                                    <option>Not Active</option>

                                </select>
                            </div>
                        </div>


                    </td>



                </tr>



                <tr>

                    <td>
                        <div class="form-group">
                            <div class="col-md-4 text-right control-label">
                                Last Name
                            </div>
                            <div class="col-md-8">
                                <?php echo form_input($lastname)?>
                            </div>
                        </div>


                    </td>


                    <td>

                        <div class="form-group">
                            <div class="col-md-4 text-right control-label" >
                                CMS Id
                            </div>

                            <div class="col-md-8">
                                <?php echo form_input($cmsid)?>


                            </div>
                        </div>


                    </td>

                    <td>


                        <div class="form-group">
                            <div class="col-md-12">
                           <button type="submit" class="btn btn-primary col-md-8 col-md-offset-4" style="margin-left: 36.233333%;width: 64.066667%;">
                                <i class="icon-search" style="font-size:18px;"></i> Search
                                                    </button>

                        <!----       <?php //echo form_submit(array('name'=>'Search','class'=>'btn btn-primary col-md-8'),'Search');?>
-->

                            </div>
                        </div>

                    </td>



                </tr>


            </table>

            <p style="float: left;margin-top: -5px;"><a href="#" onclick="formReset()" style="text-decoration:underline; padding:5px;">Clear fields</a></p>


            </form>






        </div>
    </div>




    <div class="container" style="float:right; padding-right:0px;">
          <div  class='row pull-right'>

           <!-- <div class="col-md-6"><a href=""><button class="btn btn-primary">Forget Password</button></a></div>-->

           <a href="<?php echo base_url().'users/add'?>"><button class="btn btn-primary">Add New User</button></a></div>



        </div>










</div>





<div class="col-md-12" style="float: left;">

<?php echo $this->table->generate();?>
    <p><?php
        if(isset($no_results))
        {
            echo '<h2 style="color:red;padding-top: 40px;margin: 46px 530px;">'.$no_results.'</h>';

        }
        else
        {
            echo (isset($links))?$links:'';

        }
        ?></p>
    <!--
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="data_table">
            <thead>
            <tr>
                <th width="20%">Select</th>
                <th width="20%">UserName</th>
                <th width="25%">FirstName</th>
                <th width="25%">LastName</th>
                <th width="15%">Email</th>
                <th width="15%">UserGroupId</th>
                <th width="15%">CMSID</th>
               <th width="25%">Action</th>

            </tr>
            </thead>
            <tbody>-->
    <!--
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data_table1">
        <thead>
        <tr>
            <th style="width:50px;">Select</th>
            <th>User</th>
            <th>First</th>
            <th>Last</th>
            <th>Email</th>
            <th>Group</th>
            <th>CMS id</th>
            <th>Status</th>
            <th>Last Login</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td colspan="5" class="dataTables_empty">Loading data from server</td>
        </tr>
        </tbody>
    </table>-->



</div>

</div>

<script>

    function formReset()
    {
        document.getElementById("form-horizontal").reset();
    }

</script>

<script src="<?=base_url('')?>assets/js/jquery-1.10.2.min.js"></script>

            <script type="text/javascript" charset="utf-8">


		</script>






<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->


<script type="text/javascript" language="javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<script  type="text/javascript">

$(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });

  $('#user').popover();

});

</script>



<script>

    $(document).ready( function(){

      $('#togglewin').click(function() {

            $('#fullwidtheff').toggleClass('col-md-12');

            $('#fullwidtheff').toggleClass('fullwidtheffect');

        });


    });


</script>





            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>