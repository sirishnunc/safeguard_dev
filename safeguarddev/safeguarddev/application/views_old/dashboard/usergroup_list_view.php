<?php

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

$grpadmin_options=array(''=>'Select','1'=>'Super Admin','2'=>'Internal Admin','3'=>'External Admin');
$parentgrp_options=array(''=>'Select','1'=>'Executive','2'=>'Dealer','3'=>'Agents');


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



<body style="overflow-x: hidden !important;">


<?php require_once(APPPATH.'views/frames/header.php'); ?>
<?php require_once(APPPATH.'views/frames/sidebar.php'); ?>


<!--<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10" id='user_list_table'style="margin-top:10px;">-->
    <div class="col-md-10 col-md-12 fullwidtheffect" id="fullwidtheff">
    <div class="col-md-12">


    <p style="font-family:flat; font-size:20px;">User Groups Administration</p>

    <hr>
    </div>

    <div class="col-md-12">

    <div class="panel panel-success">
        <div class="panel-heading">Search Group</div>
        <div class="panel-body panel-default" style="padding:0">

            <?php

            $attributes = array('class' => 'form-horizontal', 'id' => 'form-horizontal');

            echo form_open('Usergroups/search',$attributes)?>

                <table class="table" style="margin-top:0px !important;">

                    <tr>
                        <td>


                            <div class="form-group">
                                <div class="col-md-4 text-right control-label">
                                    Group
                                </div>
                                <div class="col-md-8" style="margin-top: 7px;">
                                    <?php echo form_input($groupname);?>
                                </div>
                            </div>

                        </td>

                        <td>


                            <div class="form-group">
                                <div class="col-md-4 text-right control-label">
                                    Parent Group
                                </div>
                                <div class="col-md-8  control-label">
                                    <?php         $attr='class ="form-control" ';
                                    $select=set_value('ParentGroup');
                                    echo form_dropdown('ParentGroup', $parentgrp_options, $select,$attr);?>
                                </div>
                            </div>

                        </td>

                        <td>
                            <div class="form-group">
                                <div class="col-md-4 text-right control-label">
                                    Status
                                </div>
                                <div class="col-md-8 control-label">
                                    <select class="form-control">
                                        <option>Active</option>
                                        <option>Not Active</option>

                                    </select>
                                </div>
                            </div>


                        </td>

                        <td>


                            <div class="text-center">
                                <div class="col-md-12">

                                    <button type="submit" class="btn btn-primary col-md-8 col-md-offset-4" style="margin-top: 5px;">
                                        <i class="icon-search" style="font-size:18px;"></i> Search
                                    </button>


                                </div>
                            </div>

                        </td>

                    </tr>


                </table>

                <p><a href="# " onclick="formReset()" style="text-decoration:underline; padding:5px;">Clear fields</a></p>


            </form>




        </div>
    </div>



        <div class="container" style="float:right;">
            <div  class='row col-md-12'>

                <!-- <div class="col-md-6"><a href=""><button class="btn btn-primary">Forget Password</button></a></div>-->

                <a href="<?php echo base_url().'users/add'?>"><button class="btn btn-primary col-md-12" style="padding-right: 30px;">Add New User</button></a></div>



        </div>


   <!--- <div class="container" style="border-top:solid 1px rgb(233, 233, 233);; border-bottom:solid 1px rgb(233, 233, 233);; padding:10px;">
        <div  class='row pull-right'>
            <!-- <div class="col-md-6"><a href=""><button class="btn btn-primary">Forget Password</button></a></div>

            <a href="<?php echo base_url().'Usergroups/add'?>"><button class="btn btn-primary">Add New Group</button></a></div>


    </div>
</div> --->






<div class="col-md-12"  style="margin-top:10px;">







</div>





<div class="col-md-12"  style="margin-top: 10px;float: left;padding: 0;">
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
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<script type="text/javascript" language="javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<script  type="text/javascript">

    $(document).ready(function() {
        //alert('********************************************845655765');
        $('[data-toggle=offcanvas]').click(function() {
            $('.row-offcanvas').toggleClass('active');
        });

        $('#user').popover();

    });

</script>



<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?=base_url('')?>js/jquery.validate.min.js"></script>

<script src="<?=base_url('')?>js/bootstrap.min.js"></script>
<!--<script src="<?=base_url('')?>js/dataTables.bootstrap.js">-->
<script type="text/javascript" language="javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>


    <script>

        $(document).ready( function(){

            $('#togglewin').click(function() {

                $('#fullwidtheff').toggleClass('col-md-12');

                $('#fullwidtheff').toggleClass('fullwidtheffect');

            });


        });


    </script>



 <script>
 var detail_data_table_loaded=0;
    $(document).ready(function ()
    {

        if ( detail_data_table_loaded ) return;
        $('#data_table1').dataTable(
            {
                "iDisplayStart": 0,
                "iDisplayLength": 25,
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "aaSorting": [[ 0, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "bFilter": true,
                "aoColumns": [
                    {"bSortable": false, "sClass": "tar"},
                    {"bSortable": true, "sClass": "tar"},
                    {"bSortable": true, "sClass": "tar"},
                    {"bSortable": true, "sClass": "tar"},
                    {"bSortable": true, "sClass": "tar"},
                    {"bSortable": true, "sClass": "tar"},
                    {"bSortable": true, "sClass": "tar"},
                    {"bSortable": false, "sClass": "tar"},
                    {"bSortable": false, "sClass": "tar"},
                    {"bSortable": false, "sClass": "tar"}
                ],
                "sAjaxSource": '<?php echo site_url('userlistcontroller1/user_list_ajax')?>'
            });
        detail_data_table_loaded=1;
        return true;
    });
</script>





</body>
</html>