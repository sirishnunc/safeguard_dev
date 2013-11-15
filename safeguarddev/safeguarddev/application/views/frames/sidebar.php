<div class="row-offcanvas row-offcanvas-left">

    <div class="col-xs-2 sidebar-offcanvas" id="sidebar" role="navigation">
        <div class="list-group left_menu" >
            <a href="#" class="list-group-item active"><span style="font-weight:bold; font-size:20px;">Menu</span></a>
            <a href="#" class="list-group-item"> <i class="icon-dashboard"></i><p>Dashboard</p></a>
            <a href="<?php echo site_url('/reports'); ?>" class="list-group-item"><i class="icon-list-alt"></i><p>SSRS Reports</p></a>
            <a href="http://10.10.1.223/bt5/tableaureport.html" class="list-group-item"><i class="icon-search"></i><p>Tableau Reports PDF</p></a>
            <a href="#" class="list-group-item"><i class="icon-envelope"></i><p>Messages</p></a>
            <a href="#" class="list-group-item"><i class="icon-check"></i><p>Orders</p></a>
            <a href="#" class="list-group-item"><i class="icon-comment-alt"></i><p>F.A.Qs</p> </a>
            <a href="#" class="list-group-item"><i class="icon-bullhorn"></i><p>Announcements</p></a>
            <a href="<?=base_url('').'users'?>" class="list-group-item"><p>User Management</p></a>
            <a href="<?=base_url('').'usergroups'?>" class="list-group-item"><p>User Group Management</p></a>
            <a href="http://10.10.1.223/bt5/tableaureport1.html" class="list-group-item"><p>Tableau Reports HTML</p></a>
        </div>
    </div>



    <button type="button" id="togglewin" class="btn btn-primary btn-xs toggleiconmenu" data-toggle="offcanvas" style="z-index: 200; top: 3px; position: absolute;left:2px;">
        <i class="icon-align-justify"></i></button>


</div>