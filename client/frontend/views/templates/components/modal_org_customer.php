<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-customer-business">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" name="modal-org-closer" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Customer Organizations</h4>
      </div>
      <div class="modal-body">
        <div class="panel panel-default">
          <div class="panel-heading">
             <b></b><span id='org_cus_name_list' name='org_cus_name_list'>Location List</span></b>
             <span class="pull-right"><a href="#model-add-organization" data-toggle="modal" id="org-list"><i class="fa fa-plus-circle"></i> Add New Organization</a></a></span>
          </div>
          <div class="panel-body">
            <table id="grid-customer-business-data" class="display responsive" width="90%">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Address</th>
                      <th>Remarks</th>
                      <th>Status</th>
                  </tr>
              </thead>
              <tbody></tbody>
              <tfoot></tfoot>
          </table>
            <input type="hidden" name="customer_business_id" id="customer_business_id"/>
          </div>
        </div>
        
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" name="modal-org-closer" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
