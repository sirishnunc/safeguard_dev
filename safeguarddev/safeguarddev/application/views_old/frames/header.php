<div class="row" style="background-color: #1063B8;">

    <div class="col-lg-1">
        <a href="<?php echo site_url('/reports'); ?>"> <img src="<?=base_url();?>assets/images/logo.png" style="padding-top:7px;"></a>
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
                    <li class="<?php echo ($this->router->fetch_class()=='reports')?'active':'' ?>"><a href="<?php echo site_url('/reports'); ?>"><i class="icon-home "></i> <br> Home</a></li>
                    <!--<li class="<?php echo ($this->router->fetch_class()=='reports')?'active':'' ?>"><a href="<?php echo site_url('/reports'); ?>"><i class="icon-tags"></i><br> Sales</a></li>-->
                    <li class=""><a href="#"><i class="icon-tags"></i><br> Sales</a></li>
                    <li class="<?php echo ($this->router->fetch_class()=='claims')?'active':'' ?>"><a href="#"><i class="icon-bar-chart"></i> <br>Claims</a></li>
                    <li class=""><a href="#"><i class="icon-group"></i><br> Risk Management</a></li>
                    <li class=""><a href="#"><i class="icon-book"></i><br>  Accounting</a></li>
                    <li class=""><a href="<?php site_url('/login') ?>"><i class="icon-cogs"></i><br> Operations</a></li>

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

            <img src="<?=base_url();?>assets/images/eebf9429dd437ab83c926184e1625ff9.jpeg" width="74" class="pull-left hidden-xs">

        </div>


        <div class=" col-lg-2 col-md-2 pull-left usrdet pull-left" style="padding:0; margin:0;">



            <ul style="margin:0px;">
                <li><a>Hi, <?php echo $this->session->userdata('FirstName'); ?></a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="<?php echo site_url('/login/logout') ?>">Logout</a></li>
            </ul>

        </div>
    </div>


</div>