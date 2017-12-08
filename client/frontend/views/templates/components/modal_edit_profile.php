<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit-profile">
  <div class="modal-dialog" role="document">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Profile</h4>
      </div>
      <div class="modal-body">
                
                  <div class="row">
                     <!-- Page Content -->
                      <form role="form" id='frm_profile' name='frm_profile' method="POST" action="<?php echo current_url();?>">
                          <div class="container-fluid">
                              <!--
                              <div class="row-fluid">
                                  <div class="page-header">
                                      <h3>Add New Customer</h3>
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
                              -->
                              
                              <div class="row">
                                  <div class="col-lg-12">
                                      <div class="panel panel-default">
                              		<div class="panel-body">
                                  		<div class="row">
              		                        <div class="col-lg-12">
              		                            <div class="form-group">
              		                                <label for="">Account Information</label>
              		                            </div>
              		                        </div>
              		                        <div class="col-lg-6">
              		                            <div class="form-group">
              		                                <label for="">Username</label>
              										<input  id="username" name="username" type="text" class="form-control" value="<?php echo $oUser->username; ?>" placeholder="Username" />
              		                            </div>
              		                        </div>
              		                        <div class="col-lg-6">
              		                            <div class="form-group">
              		                                <label for="">&nbsp;</label>
              		                                <!-- <input  id="password" name="password" type="password" class="form-control" value="<?php echo $oUser->password; ?>" placeholder="Password" /> -->
              		                                <br />
              		                                <span class="pull-left"><a href="#modal-change-password" data-toggle="modal" id="change-password"><i class="fa fa-plus-circle"></i> Change Password</a></span>
              		                            </div>
              		                        </div>
              		                        <div class="col-lg-12">
              		                            <div class="form-group">
              		                                &nbsp;
              		                            </div>
              		                        </div>
              		                        <div class="col-lg-4">
              		                            <div class="form-group">
              		                            	<label for="">First Name</label>
              		                                <input type="text" id="_fname" name="fname" class="form-control" placeholder="First Name" value="<?php echo $oUser->fname; ?>" />
              		                            </div>
              		                        </div>
              		                        <div class="col-lg-4">
              		                            <div class="form-group">
              		                            	<label for="">Middle Name</label>
              		                                <input type="text" id="mname" name="mname" class="form-control" placeholder="Middle Name"  value="<?php echo $oUser->mname; ?>" />
              		                            </div>
              		                        </div>
              		                        <div class="col-lg-4">
              		                            <div class="form-group">
              		                            	<label for="">Last Name</label>
              		                                <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" value="<?php echo $oUser->lname; ?>" />
              		                            </div>
              		                        </div>
              		                        <div class="col-lg-6">
              		                            <div class="form-group">
              		                                <label for="">Gender</label>
              		                                <select id="gender" name="gender" class="form-control">
              		                                  <option value='0'>Select</option>
              		                                  <option <?php echo ($oUser->gender == 'M' ? "selected" : ""); ?> value='M'>Male</option>
              		                                  <option <?php echo ($oUser->gender == 'F' ? "selected" : ""); ?> value='F'>Female</option>
              		                                </select>
              		                            </div>
              		                        </div>
              		                        <div class="col-lg-6">
              		                            <div class="form-group">
              		                                <label for="">Birth Date</label>
              		                                <input  id="bday" name="bday" type="text" class="form-control datepicker" value="<?php echo $oUser->bday; ?>" placeholder="Choose Date" />
              		                            </div>
              		                        </div>
              		                        
              		                        <div class="col-lg-12">
              		                            <div class="form-group">
              		                                &nbsp;
              		                            </div>
              		                        </div>		                        
              		                        
              		                        <div class="col-lg-12">
              		                            <div class="form-group">
              		                                <label for="">Contact Information</label>
              		                        </div>
              		                        </div>
              		                           <div class="col-lg-4">
              		                            <div class="form-group">
              		                            	<label for="">E-mail</label>
              		                                <input type="text" id="email" name="email" value="<?php echo $oUser->email; ?>" class="form-control" placeholder="Email" />
              		                            </div>
              		                        </div>
              		                        <div class="col-lg-4">
              		                            <div class="form-group">
              		                            	<label for="">Telephone No.</label>
              		                                <input type="text" id="telno" name="telno" value="<?php echo $oUser->telno; ?>" class="form-control" placeholder="Landline" data-mask="999-999-9999" />
              		                            </div>
              		                        </div>
              		                        <div class="col-lg-4">
              		                            <div class="form-group">
              		                            	<label for="">Mobile No.</label>
              		                                <input type="text" id="celno" name="celno" value="<?php echo $oUser->celno; ?>" class="form-control" placeholder="Mobile" data-mask="9999-999-9999" />
              		                            </div>
              		                        </div>
              
              		                         <div class="col-lg-9">
              		                            <div class="form-group">
              		                            	<label for="">Address</label>
              		                                <input  id="address" name="address" value="<?php echo $oUser->address; ?>" type="text" class="form-control" placeholder="Bldg./Apartment/Street No." />
              		                            </div>
              		                        </div>
              		                        
              	                    		<div class="col-lg-12">
              			                       <div class="form-group pull-right">
              			                       		<br />
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
              					                    <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Update</button>
              			                       </div>
              			                    </div>
              			            	</div>
                                  	</div>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->