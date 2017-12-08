<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-activity-add">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" name="modal-add-closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New Activity</h4>
      </div>
      <form role="form" id='frm_activity_add' name='frm_add_customer' method="POST" action="<?php echo current_url();?>/create">
        <div class="modal-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Title</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" id="title" name="title" class="form-control" placeholder="Title" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Assign to Technician</label>
                                <select id="technician_id" name="technician_id" class="form-control">
                                    <?php
                                    if(!empty($technicians)){
                                        foreach($technicians as $technician){
                                            echo "<option value='$technician->id'>$technician->fullname</option> \n";
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Manager</label>
                                <select id="manager_id" name="manager_id" class="form-control">
                                    <?php
                                    if(!empty($managers)){
                                        foreach($managers as $manager){
                                            echo "<option value='$manager->id'>$manager->fullname</option> \n";
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Client</label>
                                <select id="customer_id" name="customer_id" class="form-control">
                                    <?php
                                    if(!empty($customers)){
                                        foreach($customers as $customer){
                                            echo "<option value='$customer->id'>$customer->fullname</option> \n";
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Workflow Template</label>
                                <select id="event_id" name="event_id" class="form-control">
                                    <option>(Select Template)</option>
                                    <?php
                                    if(!empty($events)){
                                        foreach($events as $event){
                                            echo "<option value='$event->id'>$event->name</option> \n";
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default popover-close" name="modal-add-closer" data-dismiss="modal">Cancel</button>
          <button id="customer_add" name="customer_add" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    (function($){
        $('[name="modal-add-closer"]').on('click', function(e){
            e.preventDefault();
            $('#modal-add-new-customer').modal('hide');
        })
    })(jQuery);
</script>