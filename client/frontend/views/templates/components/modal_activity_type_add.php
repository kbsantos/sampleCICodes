<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-add-activity-type">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" name="modal-add-closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">New Activity Type</h4>
			</div>
			<!--form starts here-->
			<form role="form" id='frm_add_at' name='frm_add_at' method="POST" action="<?php echo current_url();?>/add">
				<div class="modal-body">
            		<div class="panel panel-default">
                		<div class="panel-body">
                    		<div class="row">
		                        <div class="col-lg-10">
		                            <div class="form-group">
		                                <label for="">Activity Title</label>
		                                 <input type="hidden" id="add_at_id" name="add_at_id" />
		                                 <input type="hidden" id="add_at_type" name="add_at_type" value = 'Activity' />
		                                 <input type="text" id="add_at_title" name="add_at_title" class="form-control" placeholder="Title" />
		                            </div>
		                        </div>
		                        <div class="col-lg-10">
		                            <div class="form-group">
		                                <label for="">Description</label>
		                                <textarea class="form-control resize-vertical" rows="4" id="add_at_description" name="add_at_description"></textarea>
		                            </div>
		                        </div>
		                        <div class="col-lg-10">
		                            <div class="form-group">
		                                <label for="">Required Approval?</label>
		                                <br>
									    <label class="radio-inline">
									      <input type="radio" value='Y' id="add_at_opt_approval_y" name="add_at_opt_approval">Yes
									    </label>
									    <label class="radio-inline">
									      <input type="radio" value='N' id="add_at_opt_approval_n" name="add_at_opt_approval">No
									    </label>
		                            </div>
		                        </div>
		                        <div class="col-lg-10">
		                            <div class="form-group">
		                                <label for="">Activity Based Teritory?</label>
		                                <br>
									    <label class="radio-inline">
									      <input type="radio" value='Y' id="add_at_opt_teritory_y" name="add_at_opt_teritory">Yes
									    </label>
									    <label class="radio-inline">
									      <input type="radio" value='N' id="add_at_opt_teritory_n" name="add_at_opt_teritory">No
									    </label>
		                            </div>
		                        </div>
                    		</div>
                    	</div>
                    </div>
                </div>
                <div class="modal-footer">
          			<button type="button" class="btn btn-default popover-close" name="modal-add-closer" data-dismiss="modal">Cancel</button>
          			<button id="update_add_at" name="update_add_at" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> add</button>
        		</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    (function($){
        $('[name="modal-add-closer"]').on('click', function(e){
            e.preventDefault();
            $('#modal-add-new-customer').modal('hide');
        })
    })(jQuery);
</script>