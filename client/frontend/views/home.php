<?php include 'templates/common/header.php'; ?>
<style>
    @import url("includes/css/morris.min.css");
</style>
        <!-- Page Content -->
                <div class="row">
                    <div class="col-lg-7">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa fa-flag-checkered fa-lg"></i> Recent Activities
                            </div>
                            <div class="panel-body" hidden="hidden">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>No Data</td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.col-lg-4 (nested) -->
                                    <div class="col-lg-8">
                                        <div id="morris-bar-chart"></div>
                                    </div>
                                    <!-- /.col-lg-8 (nested) -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <i class="fa fa-map fa-lg"></i> Map Location
                            </div>
                            <div class="panel-body" hidden="hidden">
                                <div class="map-canvas"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">26</div>
                                        <div>New Activities!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo base_url(); ?>Activity">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">12</div>
                                        <div>New Resources!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo base_url(); ?>resourceManagement">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

    
    <!--Google Map Assets-->
    <style type="text/css">
        @import url("includes/css/snazzy-info-window.min.css");
    </style>
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBAuUuzbcKdbdUPgCXmJTEDdRznU8QOKCk&v=3"></script>
    <script src="includes/js/vendor/snazzy-info-window.min.js"></script>
    <script type="text/javascript">
        (function($) {
            
            // Google Map Init
            var map = new google.maps.Map($('.map-canvas')[0], {
                zoom: 18,
                center: new google.maps.LatLng(14.5408671, 121.05031830000007)
            });
            var marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(14.5507339, 121.0505263)
            });
            var info = new SnazzyInfoWindow({
                marker: marker,
                content: '<div class="map-info"><h5 class="page-header">Mr. John Smith is here</h5><p>Activity on progress.</p></div>'
            });
            info.open();    
        })(window.jQuery);        
    </script>
    
    <script src="<?php echo base_url(); ?>includes/js/vendor/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>includes/js/vendor/morris.min.js"></script>
    <script src="<?php echo base_url();?>includes/data/datas.js"></script>
    

<?php include 'templates/common/footer.php'; ?>
