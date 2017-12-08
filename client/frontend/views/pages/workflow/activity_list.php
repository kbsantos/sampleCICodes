<?php include APPPATH."views/templates/common/header.php"; ?>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               Activities
                               <span class="pull-right"><a href="#modal-activity-add" data-toggle="modal" id="add-activity"><i class="fa fa-plus-circle"></i>&nbsp;New Activity</a></span>
                            </div>
                            <div class="panel-body">
                                <table id="grid-customer-data" class="display responsive" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Activity Name</th>
                                            <th>Technician</th>
                                            <th>Client</th>
                                            <th>Workflow</th>
                                            <th>Assigned Date</th>
                                            <th>Progress</th>
                                            <th>Actions</th>
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
            
            var table = $('#grid-customer-data').DataTable({
                            
                    		"bProcessing": true,
                	        "bServerSide": true,
                	        "sServerMethod": "POST",
                	        "sAjaxSource": base_url+"Activity/activity_grid",
                	        "iDisplayLength": 15,
                	        "aLengthMenu": [[15, 25, 30, -1], [15, 25, 30, "All"]],
                	        "aaSorting": [[0, 'desc']],
                		    "columnDefs":[
                            		       {
                            		           "targets":7, 
                    		                   "data":"null",
                    		                   "className": "dt-center",
                    		                   "defaultContent":'&nbsp;<a href="#" class="dtButtons" id="viewBisiness" data-toggle="modal"><i class="fa fa-refresh text-success" title="Refresh"></i></a>'
                    		                                   +'&nbsp;<a href="#" class="dtButtons" id="viewActivityDetails" data-toggle="modal"><i class="fa fa-search" title="Activity Details"></i></a>'
                    		                                   +'&nbsp;<a href="#" class="dtButtons" id="editCustomer" data-toggle="modal"><i class="fa fa-stop-circle text-danger" title="Edit Customer"></i></a> &nbsp;'
                            		        }
                                        ]
                        });
            
            //Modal Call
            $('#grid-customer-data tbody').on( 'click', 'a.dtButtons', function (e) {
                e.preventDefault();
                var data = table.row( $(this).parents('tr') ).data();
                switch($(this).attr('id')){
                    case "viewActivityDetails":
                          $(location).attr('href', base_url+"activity/details/"+data[0]);
                        break;
                }
            });
            
            
            //Setup Location Return
            $('#customer_add_loc_btn').click(function(){
                $('#location_return').val('customer_add_loc');
            });
            
            //Setup Location Return
            $('#add_org_loc_btn').click(function(){
                $('#location_return').val('add_org_loc');
            });
            
            
            //Setup Location Return
            $('#trigger-edit-search-lookup').click(function(){
                $('#location_return').val('customer_edit_loc');
                //$('#myForm').trigger("reset");
            });
            
            
            //Modal Call Lookup
            $('#grid-location-data tbody').on( 'click', 'a.dtButtons', function (e) {
                e.preventDefault();
                var data            = gridLocationLookup.row( $(this).parents('tr') ).data();
                var target_id       = $('#location_return').val()+'_id';
                var target_label    = $('#location_return').val();
                
                $("#"+target_id).val(data[0]);
                $("#"+target_label).val(data[1]);
                $('#modal-location-lookup').modal('hide');
                
                //reset lookup modal here
            });
            
            
            $("#customer_add").click(function(e){
                if (confirm('Confirm Add?')) {
                    $('#frm_activity_add').submit();
//                console.log($("#frm_activity_add").attr('action'));
                }


            });
            

            
            //Ajax
            function processAjax(pass_url,pass_data,pass_process){
                $.ajax({url: pass_url,
                        type: "POST",
                        data: pass_data,
                        dataType: "json",
                        success: function(ret_data){
                                    switch(pass_process){
                                        case 'getCustomer':
                                            retriveCustomer(ret_data);
                                            break;
                                        case 'getValidateAdd':
                                            //Process condition
                                            if( ret_data.msg == 'success'){
                                                //Pre better way n diskate mo dito hehehe pinagubra ko lng 
                                                if (confirm('Confirm Adding New Farmer?')) {
                                                    $('#frm_add_customer').submit();
                                                }
                                            }else{
                                                //Validation Display ret_data.msg
                                                console.log(ret_data.msg);
                                            }
                                            break;
                                        case 'getValidateEdit':
                                            //Process condition
                                            if( ret_data.msg == 'success'){
                                                //Pre better way n diskate mo dito hehehe pinagubra ko lng 
                                                if (confirm('Confirm Update?')) {
                                                    $('#frm_update_customer').submit();
                                                }
                                            }else{
                                                //Validation Display ret_data.msg
                                                console.log(ret_data.msg);
                                            }
                                            break;
                                        case 'getValidateOrg':
                                            if( ret_data.msg == 'success'){
                                                $('#model-add-organization').modal('hide');
                                                ajax_organization($('#org_customer_id').val(),$('#org_cus_name').text());
                                                
                                                $('#org_title').val('');
                                                $('#add_org_description').val('');
                                                $('#add_org_loc_id').val('');
                                                $('#add_org_address').val('');
                                                $('#add_org_remarks').val('');
                                                $('#add_org_status').val('');
                                            
                                            }else{
                                                //Validation Display ret_data.msg
                                                console.log(ret_data.msg);
                                            }
                                        break;
                                    }
                                 },
                        error: function(ret_data){
                                console.log(ret_data);
                               }
                });
            }
        });

    </script>

<?php
    //Insert Modal Component view
    
    include APPPATH."views/templates/components/modal_activity_add.php";
    include APPPATH."views/templates/common/footer.php"; 
?>
