<?php include APPPATH."views/templates/common/header.php"; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h4><span><i class="fa fa-building"></i></span> Company Details</h4>
                  <ul class="nav navbar-right utility-links">
                    <li>
                      <button class="btn btn-default btn-noskin" data-target="#modal-edit-company" data-toggle="modal"><i class="fa fa-edit"></i> Edit</button>
                    </li>
                  </ul>                               
                </div>
                <div class="panel-body set-min-height">
                  <div class="row">
                    <div class="col-md-7">
                      <div class="profile-info row row-bottom">
                        <div class="col-md-4 col-md-offset-4">
                            <a href="#" title="Company Name">
                              <img alt="Company Name" src="//placeimg.com/140/140/architecture/grayscale" id="img-user-pic" class="img-circle img-responsive" />
                            </a>
                            
                            <div class="text-center">
                              <h4>Company Name</h4>
                              <p><strong>We find ways.</strong></p>
                            </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-12">
                            <ul class="list-group profile-details">
                              
                              <li class="list-group-item">
                                <label class="text-success">General Information</label>
                              </li>
                              <li class="list-group-item">
                                <div class="row">
                                  <div class="col-md-6"><span>Company Name:</span> </div>
                                  <div class="col-md-6"><span>XYZ Brand</span></div>
                                </div>
                              </li>
                              <li class="list-group-item">
                                <div class="row">
                                  <div class="col-md-6"><span>Company Address</span> </div>
                                  <div class="col-md-6"><span>#44 Edsa, Quezon City</span></div>
                                </div>
                              </li>
                            </ul>         
                        </div>
                      </div>
                    </div>
                  </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->



<?php include APPPATH."views/templates/components/modal_edit_company.php"; ?>
<?php include APPPATH."views/templates/common/footer.php"; ?>
            