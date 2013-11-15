<!DOCTYPE html>
<html>
<head>
    <title>Safe Guard</title>

    <meta name="viewport" content="width=device-width, initial-scale=0.63">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <!-- Bootstrap -->
    <link href="<?= base_url() ?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?= base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url() ?>assets/css/dataTables.bootstrap.css" rel="stylesheet" media="all">


    <!--plugins css-->

    <!--custom css-->
    <link href="<?= base_url() ?>assets/css/site_custom_styles1.css" rel="stylesheet" media="screen">
    <link href="<?= base_url() ?>assets/css/offcanvas.css" rel="stylesheet" media="screen">
    <!--<link href="<?= base_url() ?>assets/css/grid.css" rel="stylesheet" media="screen">-->


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/<?=base_url()?>assets/<?=base_url()?>assets/js/html5shiv.js"></script>
    <script src="assets/<?=base_url()?>assets/<?=base_url()?>assets/js/respond.min.js"></script>
    <![endif]-->

    <style>
        #reportslist td {
            width: 400px;
        }

        .align {
            text-align: center;
            height: 42px;
        }
        #box1{ width:380px; height:24px; float:left; margin:auto 0; padding-left: 85px;}

        #box4 { width:350px; padding-left:50px; height:24px; font-size:18px}
        .txt{  font-size:14px; color:#333; font-weight: normal; text-align:left;}

        .hd{ font-size:18px; color:#333; font-weight:normal; text-align:center; padding-right: 45px;}
    </style>

</head>


<body>


<?php require_once(APPPATH . 'views/frames/header.php'); ?>




<?php require_once(APPPATH . 'views/frames/sidebar.php'); ?>







<div class="col-md-10 col-md-12 fullwidtheffect" id="fullwidtheff">

<br /><br /><br />
    <div id="box1" align="left"><div class="hd">
            <b>SSRS Reports</b>

            <?php
            if($UserTypeID=='2')
            {
                ?>
                <div id="box4" class="txt" align="left"> <a href="<?php echo site_url('reports/view/?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Dealer Group PDP New'); ?>">Dealer Group PDP New</a> </div>

            <?php
            }
            ?>
            <?php
            if($UserTypeID=='2')
            {
                ?>
                <div id="box4" class="txt" align="left"> <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Dealer Group PDP Original'); ?>">Dealer Group PDP Original</a> </div>

            <?php
            }
            ?>
            <?php
            if($UserTypeID=='2' || $UserTypeID=='3')
            {
                ?>
            <div id="box4" class="txt" align="left"> <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Dealer PDP New&as_dealercode=HYUOH018'); ?>">Dealer PDP New</a> </div>

            <?php
            }
            ?>
            <?php
            if($UserTypeID=='2' || $UserTypeID=='3')
            {
                ?>
                <div id="box4" class="txt" align="left"> <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Dealer PDP Original'); ?>">Dealer PDP Original</a> </div>

            <?php
            }
            ?>
            <?php
            if($UserTypeID=='2' || $UserTypeID=='3')
            {
                ?>
                <div id="box4" class="txt" align="left"> <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Launch Bonus Report'); ?>">Launch Bonus Report</a> </div>

            <?php
            }
            ?>
            <?php
            if($UserTypeID=='2' || $UserTypeID=='3')
            {
                ?>
                <div id="box4" class="txt" align="left">  <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/PDP_Rollup_Report'); ?>">PDP_Rollup_Report</a></div>

            <?php
            }
            ?>
            <?php
            if($UserTypeID=='2' || $UserTypeID=='3')
            {
                ?>
                <div id="box4" class="txt" align="left"> <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Volume_Report'); ?>">Volume Report</a></div>

            <?php
            }
            ?>

        </div>

    </div>

    <?php
    if($UserTypeID=='2')
    {
    ?>

    <div id="box1" align="left"><div class="hd">
            <b>Tableau Reports</b></div>
        <div id="box4" class="txt" align="left">
            <a href="<?php echo site_url('reports/tableauview/?report=views/LDSDash1/AgentCommbyProductType'); ?>">AgentCommbyProductType</a>
        </div>
        <div id="box4" class="txt" align="left">
            <a href="<?php echo site_url('reports/tableauview/?report=views/LDSDash1/AgentCommissionbyRevenue'); ?>">AgentCommissionbyRevenue</a>
        </div>
        <div id="box4" class="txt" align="left">
            <a href="<?php echo site_url('reports/tableauview/?report=views/HyundaiProduction/CancellationDashboard'); ?>">CancellationDashboard</a>
        </div>
        <div id="box4" class="txt" align="left">
            <a href="<?php echo site_url('reports/tableauview/?report=views/LDSDash1/ContractsbyProductTypeFilter'); ?>">ContractsbyProductTypeFilter</a>
        </div>
        <div id="box4" class="txt" align="left">
            <a href="<?php echo site_url('reports/tableauview/?report=views/LDSDash1/FilterChoice'); ?>">FilterChoice</a>
        </div>
        <div id="box4" class="txt" align="left">
            <a href="<?php echo site_url('reports/tableauview/?report=views/SalesDashBoard/FormTypeDaily'); ?>">FormTypeDaily</a>
        </div>
        <div id="box4" class="txt" align="left">
            <a href="<?php echo site_url('reports/tableauview/?report=views/HPPDashboard-D1/HPPDashboard'); ?>">HPPDashboard</a>
        </div>
    </div>
    <?php
    }
    ?>
    <div id="box1"><div class="hd">
            <b>PDF Reports</b></div>
        <div id="box4" class="txt" align="left">
            <a href="<?php echo site_url('reports/pdfreport'); ?>">Volume Report PDF</a>
        </div>
    </div>
</div>


<script src="<?= base_url() ?>assets/js/jquery-1.10.2.min.js"></script>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#example').dataTable();
    });
</script>


<script>

    $(document).ready(function () {


        $('#togglewin').click(function () {


            $('#sidebar').toggleClass('offcanvaspuss');

            $('#fullwidtheff').toggleClass('col-md-12');

            $('#fullwidtheff').toggleClass('fullwidtheffect');

        });


    });


</script>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->


<script type="text/javascript" language="javascript"
        src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $('[data-toggle=offcanvas]').click(function () {
            $('.row-offcanvas').toggleClass('active');
        });

        $('#user').popover();
        $('#reportslist tr').show();
    });

</script>


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
</body>
</html>