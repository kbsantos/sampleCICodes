<?php include APPPATH."views/templates/common/header.php"; ?>

                <div class="row">
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               Activity Type List
                               <span class="pull-right"><a href="#modal-add-activity-type" data-toggle="modal" id="new_activity_type"><i class="fa fa-plus-circle"></i> Add New Activity Type</a></span>
                            </div>
                            <div class="panel-body">
                                <table id="grid-activity-type" class="display responsive" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>With Approval</th>
                                            <th>Teritorial</th>
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

 <script>
        $(document).ready(function() {
            var base_url = '<?php echo base_url();?>';
            
            var table = $('#grid-activity-type').DataTable({
                    		"bProcessing": true,
                	        "bServerSide": true,
                	        "sServerMethod": "POST",
                	        "sAjaxSource": base_url+"activityType/serverSideGrid",
                	        "iDisplayLength": 5,
                	        "aLengthMenu": [[5, 15, 30, -1], [5, 15, 30, "All"]],
                	        "aaSorting": [[0, 'desc']],
                		    "columnDefs":[
                		        {
                		           "targets":5, 
        		                   "data":"null",
        		                   "className": "dt-center",
        		                   "defaultContent":'&nbsp;<a href="#modal-edit-activity-type" class="dtButtons" id="editActivityType" data-toggle="modal"><i class="fa fa-edit fa-fw" title="Edit Activity Type"></i></a> &nbsp;'
                		        }
                            ],
                            // Displays DataTable Export Feature but removes Show Alll Dropdown
                            //"dom: 'Bfrtip',
                            "buttons": [
                                { extend: 'excel', className: 'btn btn-default', text: 'Save as Excel' },
                                { extend: 'pdf', className: 'btn btn-default', text: 'Export to PDF' }
                            ]
                        });
            
        
            $("#update_edit_at").click(function(){
               var ajax_data = {title :  $('#edit_at_title').val()};
               processAjax(base_url+"activityType/validate",ajax_data,'getValidateEdit');
            });
            
            
            $("#update_add_at").click(function(){
               var ajax_data = {title :  $('#add_at_title').val()};
               processAjax(base_url+"activityType/validate",ajax_data,'getValidateAdd');
            });
            
             
            //Modal Call
            $('#grid-activity-type').on( 'click', 'a.dtButtons', function (e) {
                e.preventDefault();
                var data = table.row( $(this).parents('tr') ).data();
                
                switch($(this).attr('id')){
                    case "viewBisiness":
                           ajax_organization(data[0],data[1]);
                        break;
                    case "editActivityType":
                        var ajax_data = {id : data[0]};
                        processAjax(base_url+"activityType/detail",ajax_data,'getCustomer');
                        break;
                
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
                                            console.log(ret_data);
                                            $('#edit_at_id').val(ret_data.id);
                                            $('#edit_at_title').val(ret_data.title);
                                            $('#edit_at_description').text(ret_data.description);
                                            
                                            $("#edit_at_opt_approval_n").attr('checked', 'checked');
                                            if(ret_data.is_for_approval == 'Y'){
                                                $("#edit_at_opt_approval_y").attr('checked', 'checked');
                                            }
                                            
                                            $("#edit_at_opt_teritory_n").attr('checked', 'checked');
                                            if(ret_data.is_teritorial == 'Y'){
                                                $("#edit_at_opt_teritory_y").attr('checked', 'checked');
                                            }
                                            break;
                                            
                                        case 'getValidateEdit':
                                            if( ret_data.msg == 'success'){
                                                if (confirm('Confirm Update?')) {
                                                    $('#frm_edit_at').submit();}
                                            }else{
                                                console.log(ret_data.msg);
                                            }
                                 
                                            break;
                                        case 'getValidateAdd':
                                            if( ret_data.msg == 'success'){
                                                if (confirm('Confirm Add New Activity Type?')) {
                                                    $('#frm_add_at').submit();
                                                }
                                            }else{
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
    include APPPATH."views/templates/components/modal_activity_type_add.php";
    include APPPATH."views/templates/components/modal_activity_type_edit.php";
    include APPPATH."views/templates/common/footer.php"; 
?>