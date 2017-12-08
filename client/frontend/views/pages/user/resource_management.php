<?php include APPPATH."views/templates/common/header.php"; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <i class="fa fa-users"></i> Sales Representative List
               <span class="pull-right"><a href="#modal-add-new-resource" data-toggle="modal" id="add-new-resource"><i class="fa fa-plus-circle"></i> Create Sales Representative</a></span>
            </div>
            <div class="panel-body">
                <table id="grid-resource-management-data" class="display responsive" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
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
        
        var gridResourceManagement = $('#grid-resource-management-data').DataTable({
            //"sScrollY": "400px",
            "bProcessing": true,
            "bServerSide": true,
            "bLengthChange":false,
            "bInfo":false,
            "sServerMethod": "POST",
            "sAjaxSource": base_url+"resourceManagement/serverSideGrid",
            "iDisplayLength": 5,
            "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            "aaSorting": [[1, 'asc']],
            "aoColumns": [{ "bVisible": true, "bSearchable": true, "bSortable": false },
                      { "bVisible": true, "bSearchable": true, "bSortable": false }],
            "columnDefs":[{"targets":6, 
                       "data":"null",
                       "className": "dt-center",
                       render: function(data, type, row){
                            var actBtn = '<a href="#modal-edit-resource" class="dtButtons" id="editResource" data-toggle="modal"><i class="fa fa-edit fa-fw" title="Edit Customer"></i></a> &nbsp;';
                            actBtn +='&nbsp;<a href="#modal-location-assignment" data-value="' + row[0]  + '" class="dtButtons locationAssignmentsUsersId" id="locationAssignment" data-toggle="modal"><i class="fa fa-map-o fa-fw" title="Location Assignment"></i></a> &nbsp;';
                       
                           return actBtn;
                       }
                
            }]
        });
        
        // SETUP PROVINCE

        var gridProvinceLookup = $('#grid-province-data').DataTable({
            //"sScrollY": "400px",
            "bProcessing": true,
            "bServerSide": true,
            "bLengthChange":false,
            "bInfo":false,
            "sServerMethod": "POST",
            "sAjaxSource": base_url+"resourceManagement/serverSideGridProvince",
            "iDisplayLength": 5,
            "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            "aaSorting": [[1, 'asc']],
            "aoColumns": [{ "bVisible": true, "bSearchable": true, "bSortable": false },
                          { "bVisible": true, "bSearchable": true, "bSortable": false }],
            "columnDefs":[{"targets":2, 
                           "data":"null",
                           "className": "dt-center",
                           "defaultContent":'&nbsp;<a href="#" class="dtButtons" id="selected_cities" data-toggle="modal"><i class="fa fa-check fa-fw" title="Select this province"></i></a>'},]
        });
        

        $('#resource_add_province_btn').click(function(){
            $('#province_return').val('add_resource_assigned_province');
        });

        $('#resource_edit_province_btn').click(function(){
            // alert('mo ako');
            $('#province_return').val('edit_resource_assigned_province');
        });

        $('#grid-province-data tbody').on( 'click', 'a.dtButtons', function (e) {
            // alert('mo din ako');
            e.preventDefault();
            var data            = gridProvinceLookup.row( $(this).parents('tr') ).data();
            
            var target_id       = $('#province_return').val()+'_id';
            var target_label    = $('#province_return').val();
            
            $("#"+target_id).val(data[0]);
            $("#"+target_label).val(data[1]);
            
            $('#modal-province-lookup').modal('hide');
            //reset lookup modal here
        });



        //Modal Call
        $('#grid-resource-management-data tbody').on( 'click', 'a.dtButtons', function (e) {
            e.preventDefault();
            
            var data = gridResourceManagement.row( $(this).parents('tr') ).data();
            
            switch($(this).attr('id')){
                case "editResource":
                    var ajax_data = {id : data[0]};
                    processAjax(base_url+"resourceManagement/detail",ajax_data,'getResource');
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
                                    case 'getResource':
                                        retrieveResource(ret_data);
                                        break;
                                    case 'getValidateAdd':
                                        //Process condition
                                        if( ret_data.msg == 'success'){
                                            //Pre better way n diskate mo dito hehehe pinagubra ko lng 
                                            if (confirm('Confirm Adding New Sales Representative?')) 
                                            {
                                                $('#frm_add_resource').submit();
                                            }else 
                                            {
                                                alert("error");    
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
                                                $('#frm_update_resource').submit();
                                            }
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
        
        $("#resource_add").click(function(){
           //List of required fields to be validate before submit
           var ajax_data = {
                    fname       :  $('#add_resource_fname').val(),
                    mname       :  $('#add_resource_mname').val(),
                    lname       :  $('#add_resource_lname').val(),
                    
                    gender      :  $('#add_resource_gender').val(),
                    bday        :  $('#add_resource_bday').val(),
                    
                    email       :  $('#add_resource_email').val(),
                    celno       :  $('#add_resource_celno').val(),
                    telno       :  $('#add_resource_telno').val(),
                    
                    // add_loc     :  $('#resource_add_loc_id').val(),
                    
                };
           
           //Validate the list
           processAjax(base_url+"resourceManagement/validate",ajax_data,'getValidateAdd');
               
        });
        
        $("#resource_update").click(function(){
            //List of required fields to be validate before submit
            var ajax_data = {
                    id          :  $('#edit_resource_id').val(),
                    fname       :  $('#edit_resource_fname').val(),
                    mname       :  $('#edit_resource_mname').val(),
                    lname       :  $('#edit_resource_lname').val(),
                    gender      :  $('#edit_resource_gender').val(),
                    bday        :  $('#edit_resource_bday').val(),
                    email       :  $('#edit_resource_email').val(),
                    celno       :  $('#edit_resource_celno').val(),
                    telno       :  $('#edit_resource_telno').val(),
                    add_loc     :  $('#resource_edit_loc_id').val(),
                    assigned_province     :  $('#edit_resource_assigned_province').val(),
                    assigned_province_id     :  $('#edit_resource_assigned_province_id').val(),
                };
            
            //Validate the list
            processAjax(base_url+"resourceManagement/validate",ajax_data,'getValidateEdit');
        });
        
        // var gridLocationLookup = $('#grid-location-data').DataTable({
        // 		//"sScrollY": "400px",
        // 		"bProcessing": true,
    	   //      "bServerSide": true,
    	   //      "bLengthChange":false,
    	   //      "bInfo":false,
    	   //      "sServerMethod": "POST",
    	   //      "sAjaxSource": base_url+"customer/serverSideGridLocation",
    	   //      "iDisplayLength": 5,
    	   //      "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
    	   //      "aaSorting": [[1, 'asc']],
    	   //      "aoColumns": [{ "bVisible": true, "bSearchable": true, "bSortable": false },
    			 //              { "bVisible": true, "bSearchable": true, "bSortable": false }],
    		  //   "columnDefs":[{"targets":2, 
    		  //                  "data":"null",
    		  //                  "className": "dt-center",
    		  //                  "defaultContent":'&nbsp;<a href="#" class="dtButtons" id="selected_location" data-toggle="modal"><i class="fa fa-check fa-fw" title="Select this location"></i></a>'},]
        //     });
        
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
    
        //Setup Location Return
        $('#resource_add_loc_btn').click(function(){
            $('#location_return').val('resource_add_loc');
        });
        
        //Setup Location Return
        $('#resource_edit_loc_btn').click(function(){
            $('#location_return').val('resource_edit_loc');
        });
        
        

        function retrieveResource(ajaxData)
        {
            $('#edit_resource_id').val(ajaxData.id);
            $('#edit_resource_fname').val(ajaxData.fname);
            $('#edit_resource_mname').val(ajaxData.mname);
            $('#edit_resource_lname').val(ajaxData.lname);
            $('#edit_resource_bday').val(ajaxData.bday);
            $('#edit_resource_email').val(ajaxData.email);
            $('#edit_resource_celno').val(ajaxData.celno);
            $('#edit_resource_telno').val(ajaxData.telno);
            $('#resource_edit_loc_id').val(ajaxData.address_location);
            $('#edit_resource_assigned_province').val(ajaxData.assigned_province);
            $('#edit_resource_assigned_province_id').val(ajaxData.assigned_province_id);
            $('#resource_edit_loc').val(ajaxData.location_label);
            $('#edit_resource_address').val(ajaxData.address);
            
            if (ajaxData.gender != null) {
               $("#edit_resource_gender").val(ajaxData.gender);
            }
        }
        
        var selectArr = [];
        
        $('#grid-resource-location-data').on('change', '.chkSelectedLocationInput', function(){
        
            var dataid = $(this).data('value');
            var idx = $.inArray(dataid, selectArr);
            
            if (idx == -1) {
                selectArr.push(dataid);
            }else{
                
                selectArr.splice(idx, 1);
            }
          
        });
        
        $("#grid-resource-management-data").on('click', '.locationAssignmentsUsersId', function(){
           $("#add_assign_user_id").val($(this).data('value')); 
        });
        
        $("#modal-location-assignment").on('click', '#assign_location_add', function(e){
            e.preventDefault();
            
            if(selectArr.length == 0){
                alert('No Location is Selected');
                return false;
            }
            
            $("#hidden-field-holder").empty();
            
            $.each(selectArr, function(key, value){
                var input= $("<input type='hidden' name='assign_location_id[]'>").val(value);
                $("#hidden-field-holder").append(input);
            });
            
            processAjax(base_url+"resourceManagement/validateAssignedLocation", ajax_data,'submitAssignedLocation');
        });
    });
    
</script>

<?php
  
    include APPPATH."views/templates/components/modal_resource_add.php"; 
    include APPPATH."views/templates/components/modal_resource_edit.php"; 
    include APPPATH."views/templates/components/modal_location_assigment.php";
    include APPPATH."views/templates/components/modal_location_lookup.php";
    include APPPATH."views/templates/components/modal_province_lookup.php";
?>  

<?php include APPPATH."views/templates/common/footer.php"; ?>
            