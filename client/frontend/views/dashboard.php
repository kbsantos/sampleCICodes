<?php include 'templates/common/header.php'; ?>
<style>
    @import url("includes/css/morris.min.css");
</style>
        <!-- Page Content -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa fa-flag-checkered fa-lg"></i> Recent Activities
                            </div>
                            <div class="panel-body">
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
                                                        <td>3326</td>
                                                        <td>10/21/2013</td>
                                                        <td>3:29 PM</td>
                                                        <td>$321.33</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3325</td>
                                                        <td>10/21/2013</td>
                                                        <td>3:20 PM</td>
                                                        <td>$234.34</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3324</td>
                                                        <td>10/21/2013</td>
                                                        <td>3:03 PM</td>
                                                        <td>$724.17</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3323</td>
                                                        <td>10/21/2013</td>
                                                        <td>3:00 PM</td>
                                                        <td>$23.71</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3322</td>
                                                        <td>10/21/2013</td>
                                                        <td>2:49 PM</td>
                                                        <td>$8345.23</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3321</td>
                                                        <td>10/21/2013</td>
                                                        <td>2:23 PM</td>
                                                        <td>$245.12</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3320</td>
                                                        <td>10/21/2013</td>
                                                        <td>2:15 PM</td>
                                                        <td>$5663.54</td>
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
                    <div class="col-lg-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <i class="fa fa-map fa-lg"></i> Map Location
                            </div>
                            <div class="panel-body">
                                <div class="map-canvas"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
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
                    <div class="col-lg-6">
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
                
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                Tabstrip
                            </div>
                            <div class="panel-body">
                                <div class="tab-component">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Home</a>
                                        </li>
                                        <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Profile</a>
                                        </li>
                                        <li class=""><a href="#messages" data-toggle="tab" aria-expanded="false">Messages</a>
                                        </li>
                                        <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a>
                                        </li>
                                    </ul> 
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="home">
                                            <h4>Home Tab</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <h4>Profile Tab</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </div>
                                        <div class="tab-pane fade" id="messages">
                                            <h4>Messages Tab</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, doloremque!</p>
                                            
                                        </div>
                                        <div class="tab-pane fade" id="settings">
                                            <h4>Settings Tab</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                Widget Title
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium, odit, quos, explicabo molestiae ipsum quidem tempore nobis tenetur modi quis debitis mollitia dolorem? Assumenda, accusamus similique nostrum ex nulla non.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam, sapiente perspiciatis quisquam itaque modi? Quas, amet sed iusto recusandae reprehenderit vero vitae incidunt veritatis ipsum cupiditate numquam deleniti ut quasi ad corrupti dicta eveniet? Amet, deleniti animi harum deserunt eaque!</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem animi nihil expedita doloribus aspernatur.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Widget Title
                            </div>
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi autem eveniet porro ipsa adipisci impedit dolore cupiditate inventore ipsum tempore.
                            </div>
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
