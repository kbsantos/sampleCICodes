<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-cities-lookup">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" name="modal-lookup-closer" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Search City</h4>
      </div>
      <div class="modal-body">
        <div class="panel panel-default">
          <div class="panel-heading">
             List of City
             <span class="pull-right"><a href="#modal-add-new-customer" data-toggle="modal" id="add-new-customer"></a></span>
          </div>
          <div class="panel-body">
            <table id="grid-cities-data" class="display responsive" width="90%">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>City</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody></tbody>
              <tfoot></tfoot>
            </table>
            <input type="hidden" name="cities_return" id="cities_return"/>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" name="modal-lookup-closer" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
