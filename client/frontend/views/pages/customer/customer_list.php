<?php include APPPATH."views/templates/common/header.php"; ?>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               <i class="fa fa-users"></i> Farmers List
                               <span class="pull-right"><a href="#modal-add-new-customer" data-toggle="modal" id="add-new-customer"><i class="fa fa-plus-circle"></i> Add New Farmer</a></span>
                            </div>
                            <div class="panel-body">
                                <table id="grid-customer-data" class="display responsive" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>City</th>
                                            <th>Contacts</th>
                                            <th>Enrolled Date</th>
                                            <th>Status</th>
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
                            "dom" : 'lBfrtip',
                    		"bProcessing": true,
                	        "bServerSide": true,
                	        "sServerMethod": "POST",
                	        "sAjaxSource": base_url+"customer/serverSideGrid",
                	        "iDisplayLength": 5,
                	        "aLengthMenu": [[5, 15, 30, -1], [5, 15, 30, "All"]],
                	        "aaSorting": [[0, 'desc']],
                		    "columnDefs":[
                		        {
                		           "targets":8, 
        		                   "data":"null",
        		                   "className": "dt-center",
        		                   "defaultContent":'&nbsp;<a href="#modal-farmer-customer" class="dtButtons" id="actionFarmer" data-toggle="modal"><i class="fa fa-male fa-fw" title="Farmer"></i></a>'
                                                   +'&nbsp;<a href="#modal-dealer-customer" class="dtButtons" id="actionDealer" data-toggle="modal"><i class="fa fa-truck fa-fw" title="Dealer"></i></a>'
                                                   +'&nbsp;<a href="#modal-blocked-customer" class="dtButtons" id="actionBlocked" data-toggle="modal"><i class="fa fa-lock fa-fw" title="Blocked"></i></a>'
        		                                   +'&nbsp;<a href="#modal-edit-customer" class="dtButtons" id="actionEdit" data-toggle="modal"><i class="fa fa-edit fa-fw" title="Edit"></i></a> &nbsp;'
                		        },
                                {
                                    "targets" : 6,
                                    "render": $.fn.dataTable.render.moment( 'MM/DD/YYYY' )
                                }
                            ],
                            // Displays DataTable Export Feature but removes Show Alll Dropdown
                            //"dom: 'Bfrtip',
                            "buttons": [
                                { extend: 'excel', className: 'btn btn-default', text: 'Save as Excel' },
                                { extend: 'pdf', className: 'btn btn-default', text: 'Export to PDF' }
                            ]
                        });
            
            
                                                                            
          //   var gridLocationLookup = $('#grid-location-data').DataTable({
        		// //"sScrollY": "400px",
        		// "bProcessing": true,
    	     //    "bServerSide": true,
    	     //    "bLengthChange":false,
    	     //    "bInfo":false,
    	     //    "sServerMethod": "POST",
    	     //    "sAjaxSource": base_url+"customer/serverSideGridLocation",
    	     //    "iDisplayLength": 5,
    	     //    "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
    	     //    "aaSorting": [[1, 'asc']],
    	     //    "aoColumns": [{ "bVisible": true, "bSearchable": true, "bSortable": false },
    			   //            { "bVisible": true, "bSearchable": true, "bSortable": false }],
    		    // "columnDefs":[{"targets":2, 
    		    //                "data":"null",
    		    //                "className": "dt-center",
    		    //                "defaultContent":'&nbsp;<a href="#" class="dtButtons" id="selected_location" data-toggle="modal"><i class="fa fa-check fa-fw" title="Select this location"></i></a>'},]
          //   });
            
            var gridCitiesLookup = $('#grid-cities-data').DataTable({
                //"sScrollY": "400px",
                "bProcessing": true,
                "bServerSide": true,
                "bLengthChange":false,
                "bInfo":false,
                "sServerMethod": "POST",
                "sAjaxSource": base_url+"customer/serverSideGridCities",
                "iDisplayLength": 5,
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "aaSorting": [[1, 'asc']],
                "aoColumns": [{ "bVisible": true, "bSearchable": true, "bSortable": false },
                              { "bVisible": true, "bSearchable": true, "bSortable": false }],
                "columnDefs":[{"targets":2, 
                               "data":"null",
                               "className": "dt-center",
                               "defaultContent":'&nbsp;<a href="#" class="dtButtons" id="selected_cities" data-toggle="modal"><i class="fa fa-check fa-fw" title="Select this city"></i></a>'},]
            });

            //Modal Call
            $('#grid-customer-data tbody').on( 'click', 'a.dtButtons', function (e) {
                e.preventDefault();
                var data = table.row( $(this).parents('tr') ).data();
                
                switch($(this).attr('id')){
                    case "viewBisiness":
                           ajax_organization(data[0],data[1]);
                        break;
                    case "editCustomer":
                        var ajax_data = {id : data[0]};
                        processAjax(base_url+"customer/detail",ajax_data,'getCustomer');
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
            // $('#trigger-edit-search-lookup').click(function(){
            //     // $('#location_return').val('customer_edit_loc');
            //     $('#cities_return').val('customer_cities');
            //     //$('#myForm').trigger("reset");
            // });


            //Setup City
            $('#customer_add_cities_btn').click(function(){
                $('#cities_return').val('add_customer_cities');
            });

            $('#customer_edit_cities_btn').click(function(){
                $('#cities_return').val('customer_cities');
            });

             $('#grid-cities-data tbody').on( 'click', 'a.dtButtons', function (e) {
                e.preventDefault();
                var data            = gridCitiesLookup.row( $(this).parents('tr') ).data();
                var target_id       = $('#cities_return').val()+'_id';
                var target_label    = $('#cities_return').val();
                
                $("#"+target_id).val(data[0]);
                $("#"+target_label).val(data[1]);
                $('#modal-cities-lookup').modal('hide');
                
                //reset lookup modal here
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
            
           
            
            $("#customer_add").click(function(){
                console.log();
               //List of required fields to be validate before submit
               var ajax_data = {fname :  $('#add_customer_fname').val(),
                                // lname :  $('#add_customer_lname').val(),
                                // celno :  $('#add_customer_celno').val(),
                                // add_loc :  $('#add_customer_add_loc_id').val(),
                                status :  $('#add_customer_status').val()};
               
               //Validate the list
               processAjax(base_url+"customer/validate",ajax_data,'getValidateAdd');
               
            });
            
            $("#customer_update").click(function(){
               //List of required fields to be validate before submit
               var ajax_data = {fname :  $('#customer_fname').val(),
                                // lname :  $('#customer_lname').val(),
                                // celno :  $('#customer_celno').val(),
                                // add_loc :  $('#customer_edit_loc_id').val(),
                                status :  $('#customer_status').val()};
               
               //Validate the list
               processAjax(base_url+"customer/validate",ajax_data,'getValidateEdit');
            });
            
            
             $("#org_add").click(function(){
               //List of required fields to be validate before submit
               var ajax_data = {org_customer_id : $('#org_customer_id').val(),
                                org_title : $('#org_title').val(),
                                add_org_description : $('#add_org_description').val(),
                                add_org_loc_id : $('#add_org_loc_id').val(),
                                add_org_address : $('#add_org_address').val(),
                                add_org_remarks : $('#add_org_remarks').val(),
                                add_org_status : $('#add_org_status').val()};
                
                if (confirm('Add New Organization?')) {
                   //Validate the list
                   processAjax(base_url+"customer/validate_org",ajax_data,'getValidateOrg');
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
            
            //Load Customer Data
            function retriveCustomer(ajaxData){
                console.log(ajaxData);
                $('#customer_id').val(ajaxData.id);
                $('#customer_fname').val(ajaxData.fname);
                $('#customer_mname').val(ajaxData.mname);
                $('#customer_lname').val(ajaxData.lname);
                $('#customer_bday').val(ajaxData.bday);
                $('#customer_email').val(ajaxData.email);
                $('#customer_celno').val(ajaxData.celno);
                $('#customer_telno').val(ajaxData.telno);
                $('#customer_crop').val(ajaxData.crop);
                $('#customer_edit_loc_id').val(ajaxData.address_location);
                $('#customer_cities_id').val(ajaxData.city_id);
                $('#customer_cities').val(ajaxData.city);
                $('#customer_edit_loc').val(ajaxData.location_label);
                $('#customer_address').val(ajaxData.address);
                
                if (ajaxData.gender != null) {
                   $("#customer_gender").val(ajaxData.gender);
                }
                
                if (ajaxData.status != null) {
                   $("#customer_status").val(ajaxData.status);
                }
                if (ajaxData.fertilizer_program != null) {
                   $("#customer_fertilizer").val(ajaxData.fertilizer_program);
                }
            }
            
            
            

        });
        
        function ajax_organization(vdata1,vdata2){
            
            var base_url = '<?php echo base_url();?>';
            
            $('#customer_business_id').val(vdata1);
            $('#org_customer_id').val(vdata1);
            $('#org_cus_name').text(vdata2);
            $('#org_cus_name_list').text(vdata2);
            $('#grid-customer-business-data').dataTable().fnDestroy();
            $('#grid-customer-business-data').DataTable({
                "paging":false,
                "ordering": false,
                "info":false,
                "bFilter":false,
                "ajax":{
                    "url":base_url+"customer/organization",
                    "type":"POST",
                    "data": {'cus_id':vdata1}
                }
            });
        }
    

    </script>

<?php
    //Insert Modal Component view
    
    include APPPATH."views/templates/components/modal_add_customer.php";
    //include APPPATH."views/templates/components/modal_add_org.php";
    include APPPATH."views/templates/components/modal_edit_customer.php";   
    include APPPATH."views/templates/components/modal_org_customer.php";
    include APPPATH."views/templates/components/modal_location_lookup.php";
    include APPPATH."views/templates/components/modal_cities_lookup.php";
    include APPPATH."views/templates/components/modal_add_organization.php";
    include APPPATH."views/templates/common/footer.php"; 
?>
