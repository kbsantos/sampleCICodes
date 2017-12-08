<?php include APPPATH."views/templates/common/header.php"; ?>

    <div class="row set-min-height">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-building fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <!--<div class="huge">Company</div>-->
                            <h3>Company</h3>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url('company'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">See Company Settings</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <!--<div class="huge">Company</div>-->
                            <h3>User</h3>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url('user'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">See User Settings</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-map-marker fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <!--<div class="huge">Company</div>-->
                            <h3>Location</h3>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url('location'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">See Location Settings</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>


<?php include APPPATH."views/templates/common/footer.php"; ?>