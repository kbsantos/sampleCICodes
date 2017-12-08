<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit-location">
  <div class="modal-dialog" role="document">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit City</h4>
      </div>
      <div class="modal-body">
      
        <div class="row">
           <!-- Page Content -->
            <form role="form" id='frm_cities' name='frm_cities' method="POST" action="<?php echo current_url();?>">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                  		<div class="panel-body">
                    		<div class="row">
	                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Account Information</label>
                            </div>
	                        </div>
                          <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Test Label</label>
                                <input type="text" class="form-control" placeholder="Test Input" />
                            </div>
                          </div>	                        
		                        
	                    		<div class="col-md-12">
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
              </div>
            </form>
          </div>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->