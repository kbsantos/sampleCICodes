<?php include APPPATH."views/templates/common/header.php"; ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="page-header">
                        <h3><?php echo $pageTitle; ?></h3>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-circle"></i>  <a href="index.html">Parent Page</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-adjust"></i> Active Page
                            </li>
                        </ol>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Add Customer
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <form role="form">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Text Input</label>
                                                <input type="text" class="form-control" placeholder="Enter text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Text Input</label>
                                                <input type="text" class="form-control" placeholder="Enter text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Text Input</label>
                                                <input type="text" class="form-control" placeholder="Enter text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Text Input</label>
                                                <input type="text" class="form-control" placeholder="Enter text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-default">Submit Button</button>
                                            <button type="reset" class="btn btn-default">Reset Button</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<?php include APPPATH."views/templates/common/footer.php"; ?>