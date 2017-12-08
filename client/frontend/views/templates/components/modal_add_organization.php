<div class="modal fade" tabindex="-1" role="dialog" id="model-add-organization">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                  <input type="hidden" id="org_customer_id" name="org_customer_id" />
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
                                  <!--<input type="hidden" id="add_org_loc_id" name="add_org_loc_id" value='1'/>
                                  <div class="form-group input-group">
                                      <span class="input-group-addon" data-target="#modal-location-lookup" data-toggle="modal" id="add_org_loc_btn" name="add_org_loc_btn"><i class="fa fa-search"></i></span>
                                      <input disabled type="text" id="add_org_loc" name="add_org_loc" class="form-control" placeholder="Search location" placeholder="Search Location">
                                  </div>   
                -->                  <!--Test for lookup (using Select2)-->
                                  <div class="form-group">
                                    <select id='add_org_loc_id' name='add_org_loc_id' class="lookup-location-select2 form-control" style="width: 100%;"></select>
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
                                    <option value='0'>Select</option>
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
</div><!-- /.modal -->

<script type="text/javascript">
  $(function(){
    var base_url = '<?php echo base_url();?>';
    
    $(".lookup-location-select2").select2({
      placeholder: "Region, Province, City, Branggay",
      tags: true,
      multiple: false,
      tokenSeparators: [',', ' '],
      minimumInputLength: 2,
      minimumResultsForSearch: 30,
      ajax: {
          url: base_url+"location/search",
          dataType: "json",
          type: "POST",
          quietMillis: 50,
          data: function (params) {
  
              var queryParameters = {
                  term: params.term
              }
              return queryParameters;
          },
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.label,
                          id: item.id
                      }
                  })
              };
          }
      }
    });
  });
</script>