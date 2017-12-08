<?php include APPPATH."views/templates/common/header.php"; ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                             Activity Reports
                             <!--<span class="pull-right"><a href="#modal-add-new-customer" data-toggle="modal" id="add-new-customer"></a></span>-->
                          </div>
                          <div class="panel-body">
                              
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Report Type</label>
                                    <select name="" id="" class="selectpicker show-menu-arrow form-control">
                                        <option value="">Summary Activity By Technician</option>
                                        <option value="">Summary Activity By Users</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date Coverage</label>
                                    <div class="input-daterange input-group" id="report-date-coverage">
                                        <input type="text" class="input-sm form-control" id="date-start-coverage" name="start" placeholder="Enter Start Date" />
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control" id="date-end-coverage" name="end" placeholder="Enter End Date" />
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm element-without-label" type="button" name="btn-generate-date-coverage">Generate</button>
                                </div>
                            </div>
                              
                              
                            <table id="grid-reports-data" class="display responsive" width="100%">
                              <thead>
                                  <tr>
                                      <th>Activity ID</th>
                                      <th>Manager Name</th>
                                      <th>Technician Name</th>
                                      <th>Activity Type</th>
                                      <th>Activity Title</th>
                                      <th>Activity Descritpion</th>
                                      <th>Activity Address</th>
                                      <th>Activity Date</th>
                                      <th>Customer Name</th>
                                      <th>Customer Address</th>
                                      <th>Customer Contacts</th>
                                  </tr>
                              </thead>
                              <tbody></tbody>
                              <tfoot></tfoot>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
   <script>
        $(document).ready(function() {
            var base_url = '<?php echo base_url();?>';
            var gridLocationLookup = $('#grid-reports-data').DataTable({
        		"bProcessing": true,
    	        "bServerSide": true,
    	        "bLengthChange":false,
    	        "bInfo":false,
    	        "sServerMethod": "POST",
    	        "sAjaxSource": base_url+"report/grid_activity",
    	        "iDisplayLength": 50,
    	        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
    	        "aaSorting": [[7, 'desc']],
                "buttons": [
                    { extend: 'excel', className: 'btn btn-default', text: 'Save as Excel' },
                    { extend: 'pdf', className: 'btn btn-default', text: 'Export to PDF' }
                ]
            });
            
            
            // Date Range Init
            $('#report-date-coverage').datepicker({
                autoclose: true
            });
            
            
            // Get Date Values
            $('[name="btn-generate-date-coverage"]').on('click', function(e){
                e.preventDefault();
                var coverageStartDate = $('#date-start-coverage').datepicker();
                var coverageEndtDate = $('#date-end-coverage').datepicker();
                
                var s = coverageStartDate.val();
                var e = coverageEndtDate.val();  
                alert( s + " - " + e);
                
            });
        });
    </script>
<?php include APPPATH."views/templates/common/footer.php"; ?>
            