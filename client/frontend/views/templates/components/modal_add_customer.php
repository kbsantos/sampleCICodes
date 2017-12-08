<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-add-new-customer">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" name="modal-add-closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New Farmer</h4>
      </div>
      <form role="form" id='frm_add_customer' name='frm_add_customer' method="POST" action="<?php echo current_url();?>/add">
        <div class="modal-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Farmer Name</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="add_customer_fname" name="add_customer_fname" class="form-control" placeholder="First Name" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="add_customer_mname" name="add_customer_mname" class="form-control" placeholder="Middle Name" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="add_customer_lname" name="add_customer_lname" class="form-control" placeholder="Last Name" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Gender</label>
                                <select id="add_customer_gender" name="add_customer_gender" class="form-control">
                                  <option value='0'>Select</option>
                                  <option value='M'>Male</option>
                                  <option value='F'>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Birth Date</label>
                                <input  id="add_customer_bday" name="add_customer_bday" type="text" class="form-control datepicker" placeholder="Choose Date" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Contact Informations</label>
                            </div>
                        </div>
<!--                            <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="add_customer_email" name="add_customer_email" class="form-control" placeholder="Email" />
                            </div>
                        </div>-->
                        <!--  <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="add_customer_telno" name="add_customer_telno" class="form-control" placeholder="Landline" data-mask="999-999-9999" />
                            </div>
                        </div> -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="add_customer_celno" name="add_customer_celno" class="form-control" placeholder="Mobile" data-mask="9999-999-9999" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="add_customer_farm_size" name="add_customer_farm_size" class="form-control" placeholder="Farm Size"/>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <select id="add_customer_crop" name="add_customer_crop" class="form-control">
                                  <option value='0'>Select Nexen...</option>
                                  <option value='Nexen in Corn'>Nexen in Corn</option>
                                  <option value='Nexen in Rice'>Nexen in Rice</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for="">Address</label>
                                <div class="form-group input-group">
                                  <span>Assigned Province : <?php echo $this->province;?></span>
                                </div>
                                <input type="hidden" id="add_customer_cities_id" name="add_customer_cities_id" />
                                <div class="form-group input-group">
                                    <span class="input-group-addon" data-target="#modal-cities-lookup" data-toggle="modal" id="customer_add_cities_btn" name="customer_add_cities_btn"><i class="fa fa-search"></i></span>
                                    <input disabled type="text" id="add_customer_cities" name="add_customer_cities" class="form-control" placeholder="Search City" placeholder="Search City">
                                </div>     

                                <!-- <input type="hidden" id="add_customer_add_loc_id" name="add_customer_add_loc_id" value='1'/> -->
                                


                                <!--<input id="add_customer_add_loc" name="add_customer_add_loc" type="text" class="form-control" placeholder="@art Pre region,province,city,brgy lookup panibagong modal" />-->

                               <!--  <div class="form-group input-group">
                                    <span class="input-group-addon" data-target="#modal-location-lookup" data-toggle="modal" id="customer_add_loc_btn" name="customer_add_loc_btn"><i class="fa fa-search"></i></span>
                                    <input disabled type="text" id="customer_add_loc" name="customer_add_loc" class="form-control" placeholder="Search location" placeholder="Search Location">
                                </div>                                
                                 -->
                                  <!--Test for lookup (using Select2)-->
                                 <!--  <div class="form-group">
                                    <select class="lookup-location-select2 form-control" style="width: 100%;"></select>
                                  </div> -->
                            </div>
                        </div>
                         <div class="col-lg-9">
                            <div class="form-group">
                                <input  id="add_customer_address" name="add_customer_address" type="text" class="form-control" placeholder="Bldg./Apartment/Street No." />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select id="add_customer_status" name="add_customer_status" class="form-control">
                                  <option value='0'>Select</option>
                                  <option selected="selected" value='PROSPECT'>PROSPECT</option>
                                  <option value='FARMER'>FARMER</option>
                                  <option value='DEALER'>DEALER</option>
                                  <option value='BLOCKED'>BLOCKED</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Fertilizer Program</label>
                                <select id="add_customer_fertilizer" name="add_customer_fertilizer" class="form-control">
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
          <button type="button" class="btn btn-default popover-close" name="modal-add-closer" data-dismiss="modal">Cancel</button>
          <button id="customer_add" name="customer_add" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    (function($){
        $('[name="modal-add-closer"]').on('click', function(e){
            e.preventDefault();
            $('#modal-add-new-customer').modal('hide');
        })
    })(jQuery);
</script>