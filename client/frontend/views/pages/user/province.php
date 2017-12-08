<?php include APPPATH."views/templates/common/header.php"; ?>

                <div class="row">
                    <div class="col-lg-11">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                             Province List
                             <span class="pull-right"><a href="#modal-add-new-customer" data-toggle="modal" id="add-new-customer"></a></span>
                          </div>
                          <div class="panel-body">
                            <table id="grid-province-data" class="display responsive" width="90%">
                              <thead>
                                  <tr>
                                      <th>Province ID</th>
                                      <th>Province</th>
                                      <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody></tbody>
                              <tfoot></tfoot>
                            </table>
                            <input type="hidden" name="province_return" id="province_return"/>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
   <script>
        $(document).ready(function() {
            var base_url = '<?php echo base_url();?>';
            var gridProvinceLookup = $('#grid-province-data').DataTable({
        		"bProcessing": true,
    	        "bServerSide": true,
    	        "bLengthChange":false,
    	        "bInfo":false,
    	        "sServerMethod": "POST",
    	        "sAjaxSource": base_url+"province/grid_province",
    	        "iDisplayLength": 10,
    	        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
    	        "aaSorting": [[1, 'asc']],
    		    "columnDefs":[{"targets":2, 
    		                   "data":"null",
    		                   "className": "dt-center",
    		                   "defaultContent":'&nbsp;<a href="#modal-edit-province" class="dtButtons" id="selected_province" data-toggle="modal"><i class="fa fa-edit fa-fw" title="Select this province"></i></a>'},]
            });
        });
    </script>
    

<?php include APPPATH."views/templates/components/modal_edit_province.php"; ?>
<?php include APPPATH."views/templates/common/footer.php"; ?>
            