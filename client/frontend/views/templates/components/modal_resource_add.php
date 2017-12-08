<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-add-new-resource">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" name="modal-add-closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">New Sales Representative</h4>
			</div>
			<!--form starts here-->
			<form role="form" id='frm_add_resource' name='frm_add_resource' method="POST" action="<?php echo current_url();?>/add">
				<div class="modal-body">
            		<div class="panel panel-default">
                		<div class="panel-body">
                    		<div class="row">
		                        <div class="col-lg-12">
		                            <div class="form-group">
		                                <label for="">Sales Representative Name</label>
		                            </div>
		                        </div>
		                        <div class="col-lg-4">
		                            <div class="form-group">
		                                <input type="text" id="add_resource_fname" name="add_resource_fname" class="form-control" placeholder="First Name" />
		                            </div>
		                        </div>
		                        <div class="col-lg-4">
		                            <div class="form-group">
		                                <input type="text" id="add_resource_mname" name="add_resource_mname" class="form-control" placeholder="Middle Name" />
		                            </div>
		                        </div>
		                        <div class="col-lg-4">
		                            <div class="form-group">
		                                <input type="text" id="add_resource_lname" name="add_resource_lname" class="form-control" placeholder="Last Name" />
		                            </div>
		                        </div>
		                        <div class="col-lg-6">
		                            <div class="form-group">
		                                <label for="">Gender</label>
		                                <select id="add_resource_gender" name="add_resource_gender" class="form-control">
		                                  <option value='0'>Select</option>
		                                  <option value='M'>Male</option>
		                                  <option value='F'>Female</option>
		                                </select>
		                            </div>
		                        </div>
		                        <div class="col-lg-6">
		                            <div class="form-group">
		                                <label for="">Birth Date</label>
		                                <input  id="add_resource_bday" name="add_resource_bday" type="text" class="form-control datepicker" placeholder="Choose Date" />
		                            </div>
		                        </div>
		                        <div class="col-lg-12">
		                            <div class="form-group">
		                                <label for="">Contact Informations</label>
		                            </div>
		                        </div>
		                           <div class="col-lg-4">
		                            <div class="form-group">
		                                <input type="text" id="add_resource_email" name="add_resource_email" class="form-control" placeholder="Email" />
		                            </div>
		                        </div>
		                        <div class="col-lg-4">
		                            <div class="form-group">
		                                <input type="text" id="add_resource_telno" name="add_resource_telno" class="form-control" placeholder="Landline" data-mask="999-999-9999" />
		                            </div>
		                        </div>
		                        <div class="col-lg-4">
		                            <div class="form-group">
		                                <input type="text" id="add_resource_celno" name="add_resource_celno" class="form-control" placeholder="Mobile" data-mask="9999-999-9999" />
		                            </div>
		                        </div>
		                        <div class="col-lg-10">
		                            <div class="form-group">
		                                <label for="">Address</label>
		                                <input type="hidden" id="add_resource_assigned_province_id" name="add_resource_assigned_province_id" />
		                                <div class="form-group input-group">
		                                    <span class="input-group-addon" data-target="#modal-province-lookup" data-toggle="modal" id="resource_add_province_btn" name="resource_add_province_btn"><i class="fa fa-search"></i></span>
		                                    <input disabled type="text" id="add_resource_assigned_province" name="add_resource_assigned_province" class="form-control" placeholder="Search province" placeholder="Search Location">
		                                </div>                                
		                                <!-- 
		                                <input type="hidden" id="resource_add_loc_id" name="resource_add_loc_id" value='1'/>
		                                <div class="form-group input-group">
		                                    <span class="input-group-addon" data-target="#modal-location-lookup" data-toggle="modal" id="resource_add_loc_btn" name="resource_add_loc_btn"><i class="fa fa-search"></i></span>
		                                    <input disabled type="text" id="resource_add_loc" name="resource_add_loc" class="form-control" placeholder="Search location" placeholder="Search Location">
		                                </div>                                 -->
		                            </div>
		                        </div>
		                         <div class="col-lg-9">
		                            <div class="form-group">
		                                <input  id="add_resource_address" name="add_resource_address" type="text" class="form-control" placeholder="Bldg./Apartment/Street No." />
		                            </div>
		                        </div>
                    		</div>
                    	</div>
                    </div>
                </div>
                <div class="modal-footer">
          			<button type="button" class="btn btn-default popover-close" name="modal-add-closer" data-dismiss="modal">Cancel</button>
          			<button id="resource_add" name="resource_add" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
        		</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    (function($){
        $('[name="modal-add-closer"]').on('click', function(e){
            e.preventDefault();
            $('#modal-add-new-customer').modal('hide');
        })
    })(jQuery);
</script>