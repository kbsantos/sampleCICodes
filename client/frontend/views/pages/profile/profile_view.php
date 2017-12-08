

<?php include APPPATH."views/templates/common/header.php"; ?>

  <div class="row">
    <div class="col-md-12 ">
    
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4><span><i class="fa fa-user"></i></span> User Profile</h4>
          <ul class="nav navbar-right utility-links">
            <li>
              <button class="btn btn-default btn-noskin" data-target="#modal-edit-profile" data-toggle="modal"><i class="fa fa-edit"></i> Edit</button>
            </li>
          </ul>
          
        </div>
        <div class="panel-body">
          
          <div class="row">
            <div class="col-md-7">
              <div class="profile-info row row-bottom">
                <div class="col-md-4 col-md-offset-4">
                    <a href="#" title="<?php echo $oUser->username; ?>">
                      <img alt="<?php echo $oUser->username; ?>" src="//placeimg.com/140/140/people/grayscale" id="img-user-pic" class="img-circle img-responsive" />
                    </a>
                    
                    <div class="text-center">
                      <h4><?php echo $oUser->username; ?></h4>
                      <p><strong>Aspirant</strong></p>
                    </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                    <ul class="list-group profile-details">
                      
                      <li class="list-group-item">
                        <label class="text-success">Account Information</label>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-md-6"><span>First Name:</span> </div>
                          <div class="col-md-6"><span><?php echo $oUser->fname; ?></span></div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-md-6"><span>Middle Name:</span> </div>
                          <div class="col-md-6"><span><?php echo $oUser->mname; ?></span></div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-md-6"><span>Last Name:</span> </div>
                          <div class="col-md-6"><span><?php echo $oUser->lname; ?></span></div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-md-6"><span>Gender:</span> </div>
                          <div class="col-md-6"><span><?php echo $oUser->gender; ?></span></div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-md-6"><span>Birth Date:</span> </div>
                          <div class="col-md-6"><span><?php  echo $oUser->bday; ?></span></div>
                        </div>
                      </li>
                      
                      <li class="list-group-item">
                        <label class="text-success">Contact Information</label>
                      </li>
                      
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-md-6"><span>E-mail Address:</span> </div>
                          <div class="col-md-6"><span><?php  echo $oUser->email; ?></span></div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-md-6"><span>Telephone Number:</span> </div>
                          <div class="col-md-6"><span><?php  echo $oUser->telno; ?></span></div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-md-6"><span>Mobile Number:</span> </div>
                          <div class="col-md-6"><span><?php  echo $oUser->celno; ?></span></div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-md-6"><span>Address:</span> </div>
                          <div class="col-md-6"><span><?php  echo $oUser->address; ?></span></div>
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



<?php

	include APPPATH."views/templates/components/modal_edit_profile.php";
    include APPPATH."views/templates/components/modal_change_password.php";
	include APPPATH."views/templates/common/footer.php";
?>