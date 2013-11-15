<!DOCTYPE html>
<html>
<head>
    <title>Safe Guard</title>

    <meta name="viewport" content="width=device-width, initial-scale=0.63">

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
    <?php echo $resultHtml; ?>
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

    });

</script>



<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>

</body>
</html>