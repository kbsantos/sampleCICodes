<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-location-assignment">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" name="modal-edit-closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Location Assignment</h4>
			
			</div>
			<!--form starts here-->
			<form role="form" id='frm_update_resource' name='frm_edit_resource' method="POST" action="<?php echo current_url();?>/submitAssignedLocation">
			    <input type="hidden" id="add_assign_user_id" name="add_assign_user_id"/>
				<div class="modal-body">
            		<div class="panel panel-default">
                		<div class="panel-body">
                    		<div class="row">
		                        <div class="col-lg-12">
                    				<table id="grid-resource-location-data" class="display responsive" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Display Label</th>
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
                <div id="hidden-field-holder" stye="display:none;">
                    
                </div>
                <div class="modal-footer">
          			<button type="button" class="btn btn-default popover-close" name="modal-add-closer" data-dismiss="modal">Cancel</button>
          			<button id="assign_location_add" name="assign_location_add" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
        		</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    (function($){
        $('[name="modal-edit-closer"]').on('click', function(e){
            e.preventDefault();
            $('#modal-edit-new-customer').modal('hide');
        });
    })(jQuery);
</script>