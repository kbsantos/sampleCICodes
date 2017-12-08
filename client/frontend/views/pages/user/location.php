<?php include APPPATH."views/templates/common/header.php"; ?>

                <div class="row">
                    <div class="col-lg-11">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                             Location List
                             <span class="pull-right"><a href="#modal-add-new-customer" data-toggle="modal" id="add-new-customer"></a></span>
                          </div>
                          <div class="panel-body">
                            <table id="grid-location-data" class="display responsive" width="90%">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Region</th>
                                      <th>Province</th>
                                      <th>City/Municipality</th>
                                      <th>Brangay</th>
                                      <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody></tbody>
                              <tfoot></tfoot>
                            </table>
                            <input type="hidden" name="location_return" id="location_return"/>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
   <script>
        $(document).ready(function() {
            var base_url = '<?php echo base_url();?>';
            var gridLocationLookup = $('#grid-location-data').DataTable({
        		"bProcessing": true,
    	        "bServerSide": true,
    	        "bLengthChange":false,
    	        "bInfo":false,
    	        "sServerMethod": "POST",
    	        "sAjaxSource": base_url+"location/grid_location",
    	        "iDisplayLength": 10,
    	        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
    	        "aaSorting": [[1, 'asc']],
    		    "columnDefs":[{"targets":5, 
    		                   "data":"null",
    		                   "className": "dt-center",
    		                   "defaultContent":'&nbsp;<a href="#modal-edit-location" class="dtButtons" id="selected_location" data-toggle="modal"><i class="fa fa-edit fa-fw" title="Select this location"></i></a>'},]
            });
        });
    </script>
    

<?php include APPPATH."views/templates/components/modal_edit_location.php"; ?>
<?php include APPPATH."views/templates/common/footer.php"; ?>
            