<!DOCTYPE html>
<html>
<head>
    <title>Safe Guard</title>

    <meta name="viewport" content="width=device-width, initial-scale=0.63">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Bootstrap -->
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?=base_url()?>assets/css/dataTables.bootstrap.css" rel="stylesheet" media="all">



    <!--plugins css-->

    <!--custom css-->
    <link href="<?=base_url()?>assets/css/site_custom_styles1.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/css/offcanvas.css" rel="stylesheet" media="screen">



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/<?=base_url()?>assets/<?=base_url()?>assets/js/html5shiv.js"></script>
    <script src="assets/<?=base_url()?>assets/<?=base_url()?>assets/js/respond.min.js"></script>
    <![endif]-->



</head>



<body>


<?php require_once(APPPATH.'views/frames/header.php'); ?>




<?php require_once(APPPATH.'views/frames/sidebar.php'); ?>







<div class="col-md-10 col-md-12 fullwidtheffect" id="fullwidtheff">
    <br /><br /><br /><br />
    <button id="addreports" class="btn btn-primary btn-lg" onclick="window.location.href='<?php echo site_url('reports/add'); ?>'">
        Add Reports
    </button>
    <br /><br /><br /><br />
    <table id="reportslist">
        <?php
        if($UserTypeID=='2')
        {
            ?>
            <tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view/?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Dealer Group PDP New'); ?>">Dealer Group PDP New</a>
                </td>
            </tr>
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2')
        {
            ?>
            <tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Dealer Group PDP Original'); ?>">Dealer Group PDP Original</a>
                </td>
            </tr>
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2' || $UserTypeID=='3')
        {
            ?>
            <tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Dealer PDP New&as_dealercode=HYUOH018'); ?>">Dealer PDP New</a>
                    
                </td>
            </tr>
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2' || $UserTypeID=='3')
        {
            ?>
            <tr>
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Dealer PDP Original'); ?>">Dealer PDP Original</a>
                    
                </td>
            </tr>
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2' || $UserTypeID=='3')
        {
            ?>
            <!--<tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/DrillDown_Dealer PDP New'); ?>">DrillDown_Dealer PDP New</a>
                    
                </td>
            </tr>-->
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2' || $UserTypeID=='3')
        {
            ?>
        <!--<tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/DrillDown_Dealer PDP Original'); ?>">DrillDown_Dealer PDP Original</a>
                    
                </td>
            </tr>-->
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2' || $UserTypeID=='3')
        {
            ?>
        <!--<tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Drilldown_DetailedCancel'); ?>">Drilldown_DetailedCancel</a>
                </td>
            </tr>-->
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2' || $UserTypeID=='3')
        {
            ?>
        <!--<tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Drilldown_DetailedVolume'); ?>">Drilldown_DetailedVolume</a>
                </td>
            </tr>-->
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2')
        {
            ?>
            <tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/HCI Daily Report by Remit Date – External'); ?>">HCI Daily Report by Remit Date - External</a>
                    
                </td>
            </tr>
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2')
        {
            ?>
            <tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/HCI Daily Report by Remit Date – Internal'); ?>">HCI Daily Report by Remit Date - Internal</a>
                    
                </td>
            </tr>
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2')
        {
            ?>
            <tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/HCI Daily Report by Sales Date – InternalV1.1'); ?>">HCI Daily Report by Sales Date - InternalV1.1</a>
                    
                </td>
            </tr>
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2' || $UserTypeID=='3')
        {
            ?>
            <tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Launch Bonus Report'); ?>">Launch Bonus Report</a>
                    
                </td>
            </tr>
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2' || $UserTypeID=='3')
        {
            ?>
            <tr style="display:none;">
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/PDP_Rollup_Report'); ?>">PDP_Rollup_Report</a>
                </td>
            </tr>
        <?php
        }
        ?>
        <?php
        if($UserTypeID=='2' || $UserTypeID=='3')
        {
            ?>
            <tr>
                <td>
                    <a href="<?php echo site_url('reports/view?reportname=/WEBPORTAL_NEW/WEB_001900_PRODUCTION/Volume_Report'); ?>">Volume Report</a>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo site_url('reports/pdfreport'); ?>">Volume Report PDF</a>
                    
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>







<script src="<?=base_url()?>assets/js/jquery-1.10.2.min.js"></script>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#example').dataTable();
    } );
</script>


<script>

    $(document).ready( function(){



        $('#togglewin').click(function() {


            $('#sidebar').toggleClass('offcanvaspuss');

            $('#fullwidtheff').toggleClass('col-md-12');

            $('#fullwidtheff').toggleClass('fullwidtheffect');

        });


    });





</script>





<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->


<script type="text/javascript" language="javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<script  type="text/javascript">

    $(document).ready(function() {
        $('[data-toggle=offcanvas]').click(function() {
            $('.row-offcanvas').toggleClass('active');
        });

        $('#user').popover();
        $('#reportslist tr').show();
    });

</script>



<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
</body>
</html>