<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-edit-activity-type">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" name="modal-edit-closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Activity Type</h4>
			</div>
			<!--form starts here-->
			<form role="form" id='frm_edit_at' name='frm_edit_at' method="POST" action="<?php echo current_url();?>/update">
				<div class="modal-body">
            		<div class="panel panel-default">
                		<div class="panel-body">
                    		<div class="row">
		                        <div class="col-lg-10">
		                            <div class="form-group">
		                                <label for="">Activity Title</label>
		                                 <input type="hidden" id="edit_at_id" name="edit_at_id" />
		                                 <input type="hidden" id="edit_at_type" name="edit_at_type" value = 'Activity' />
		                                 <input type="text" id="edit_at_title" name="edit_at_title" class="form-control" placeholder="Title" />
		                            </div>
		                        </div>
		                        <div class="col-lg-10">
		                            <div class="form-group">
		                                <label for="">Description</label>
		                                <textarea class="form-control resize-vertical" rows="4" id="edit_at_description" name="edit_at_description"></textarea>
		                            </div>
		                        </div>
		                        <div class="col-lg-10">
		                            <div class="form-group">
		                                <label for="">Required Approval?</label>
		                                <br>
									    <label class="radio-inline">
									      <input type="radio" value='Y' id="edit_at_opt_approval_y" name="edit_at_opt_approval">Yes
									    </label>
									    <label class="radio-inline">
									      <input type="radio" value='N' id="edit_at_opt_approval_n" name="edit_at_opt_approval">No
									    </label>
		                            </div>
		                        </div>
		                        <div class="col-lg-10">
		                            <div class="form-group">
		                                <label for="">Activity Based Teritory?</label>
		                                <br>
									    <label class="radio-inline">
									      <input type="radio" value='Y' id="edit_at_opt_teritory_y" name="edit_at_opt_teritory">Yes
									    </label>
									    <label class="radio-inline">
									      <input type="radio" value='N' id="edit_at_opt_teritory_n" name="edit_at_opt_teritory">No
									    </label>
		                            </div>
		                        </div>
                    		</div>
                    	</div>
                    </div>
                </div>
                <div class="modal-footer">
          			<button type="button" class="btn btn-default popover-close" name="modal-edit-closer" data-dismiss="modal">Cancel</button>
          			<button id="update_edit_at" name="update_edit_at" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Edit</button>
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
        })
    })(jQuery);
</script>