<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-edit-customer">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" name="modal-edit-closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Farmer</h4>
      </div>
      <form role="form" id='frm_update_customer' name='frm_update_customer' method="POST" action="<?php echo current_url();?>/update">
        <div class="modal-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Farmer Name</label>
                                <input type="hidden" id="customer_id" name="customer_id" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="customer_fname" name="customer_fname" class="form-control" placeholder="First Name" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="customer_mname" name="customer_mname" class="form-control" placeholder="Middle Name" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="customer_lname" name="customer_lname" class="form-control" placeholder="Last Name" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Gender</label>
                                <select id="customer_gender" name="customer_gender" class="form-control">
                                  <option value='0'>Select</option>
                                  <option value='M'>Male</option>
                                  <option value='F'>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Birth Date</label>
                                <input  id="customer_bday" name="customer_bday" type="text" class="form-control datepicker" placeholder="Choose Date" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Contact Informations</label>
                            </div>
                        </div>
                           <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="customer_email" name="customer_email" class="form-control" placeholder="Email" />
                            </div>
                        </div>
                        <!-- <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="customer_telno" name="customer_telno" class="form-control" placeholder="Landline" data-mask="999-999-9999" />
                            </div>
                        </div> -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="customer_celno" name="customer_celno" class="form-control" placeholder="Mobile" data-mask="9999-999-9999"  />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="customer_crop" name="customer_crop" class="form-control" placeholder="Crop" />
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for=""> Address</label>
                                <div class="form-group input-group">
                                  <span>Assigned Province : <?php echo $this->province;?></span>
                                </div>
                                <input type="text" id="customer_cities_id" name="customer_cities_id" hidden="hidden" />
                                <div class="form-group input-group">
                                    <span class="input-group-addon" data-target="#modal-cities-lookup" data-toggle="modal" id="customer_edit_cities_btn" >
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input disabled type="text" id="customer_cities" name="customer_cities" class="form-control" placeholder="Search city" placeholder="Search City">
                                </div>                                 
                                
                                <!-- <input type="text" id="customer_edit_loc_id" name="customer_edit_loc_id" hidden="hidden" /> -->
                                <!-- <div class="form-group input-group">
                                    <span class="input-group-addon" id="trigger-edit-search-lookup" data-target="#modal-location-lookup" data-toggle="modal"><i class="fa fa-search"></i></span>
                                    <input disabled type="text" id="customer_edit_loc" name="customer_edit_loc" class="form-control" placeholder="Search location library" placeholder="Search Location">
                                </div>    -->                              
                                
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <input  id="customer_address" name="customer_address" type="text" class="form-control" placeholder="Bldg./Apartment/Street No." />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select id="customer_status" name="customer_status" class="form-control">
                                  <option value='0'>Select</option>
                                  <option value='PROSPECT'>PROSPECT</option>
                                  <option value='REGULAR'>REGULAR</option>
                                  <option value='BLOCKED'>BLOCKED</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Fertilizer Program</label>
                                <select id="customer_fertilizer" name="customer_fertilizer" class="form-control">
                                  <option value='0'>Select</option>
                                  <option value='46-0-0'>46-0-0</option>
                                  <option value='14-14-14'>14-14-14</option>
                                  <option value='21-0-0'>21-0-0</option>
                                  <option value='16-20-0'>16-20-0</option>
                                  <option value='0-0-60'>0-0-60</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" name="modal-edit-closer" data-dismiss="modal">Cancel</button>
          <button id="customer_update" name="customer_update" type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    (function($){
        $('[name="modal-edit-closer"]').on('click', function(e){
            e.preventDefault();
            $('#modal-edit-customer').modal('hide');
        })
    })(jQuery);
</script>