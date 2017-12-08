<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-change-password">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" name="modal-edit-profile-closer" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <form role="form" id='frm_change_password' name='frm_change_password' method="POST" action="<?php echo site_url('user/change_password'); ?>">
        <div class="modal-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Old Password</label>
                                <input type="text" id="old_password" name="old_password" class="form-control" placeholder="Old Password" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="text" id="new_password" name="new_password" class="form-control" placeholder="New Password" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Re-type New Password</label>
                                <input type="text" id="confirm_password" name="confirm_password" class="form-control" placeholder="Re-type New Password" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" name="modal-edit-profile-closer"><i class="fa fa-times"></i> Cancel</button>
          <button id="change_password" name="change_password" type="button" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    (function($){
        $('[name="modal-edit-profile-closer"]').on('click', function(e){
            e.preventDefault();
            $('#modal-change-password').modal('hide');
        })
    })(jQuery);
</script>