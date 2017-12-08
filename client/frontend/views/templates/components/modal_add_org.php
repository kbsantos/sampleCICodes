<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-add-org">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" name="modal-org-add-closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b><span id='org_cus_name' name='org_cus_name'>Customer</span></b> : New Customer Organization</h4>
      </div>
      <form role="form" id='frm_add_org' name='frm_add_org' method="POST" action="<?php echo current_url();?>/add_organization">
        <div class="modal-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                 <label for="org_title">Title</label>
                                <input type="hidden" id="org_customer_id" name=id="org_customer_id" />
                                <input type="text" id="org_title" name="org_title" class="form-control" placeholder="Title" />
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="form-group">
                               <label for="add_org_description">Description</label>
                               <textarea class="form-control" rows="4" id="add_org_description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" id="add_org_loc_id" name="add_org_loc_id"/>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" data-target="#modal-location-lookup" data-toggle="modal" id="add_org_loc_btn" name="add_org_loc_btn"><i class="fa fa-search"></i></span>
                                    <input disabled type="text" id="add_org_loc" name="add_org_loc" class="form-control" placeholder="Search location" placeholder="Search Location">
                                </div>                                
                                
                            </div>
                        </div>
                         <div class="col-lg-9">
                            <div class="form-group">
                                <input  id="add_org_address" name="add_org_address" type="text" class="form-control" placeholder="Bldg./Apartment/Street No." />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select  id="add_org_status" name="add_org_status" class="form-control">
                                  <option value=''>Select</option>
                                  <option value='Active'>ACTIVE</option>
                                  <option value='InActive'>INACTIVE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="form-group">
                               <label for="add_org_remarks">Remarks</label>
                               <textarea class="form-control" rows="4" id="add_org_remarks"></textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default popover-close" name="modal-org-add-closer" data-dismiss="modal">Cancel</button>
          <button id="org_add" name="org_add" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div> /.modal 

<script type="text/javascript">
    (function($){
        $('[name="modal-org-add-closer"]').on('click', function(e){
            e.preventDefault();
            $('#modal-add-org').modal('hide');
        })
    })(jQuery);
</script>