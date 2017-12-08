<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="modal-template-forms">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" name="modal-add-closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Workflow Template</h4>
      </div>
      <form role="form" id='frm_add_customer' name='frm_add_customer' method="POST" action="<?php echo current_url();?>/add">
        <div class="modal-body">
            <div class="row">
                <div id="carousel-edit-template" 
                    class="carousel slide carousel-fade" 
                    data-ride="carousel"
                    data-wrap="false"
                    data-interval="false"
                    data-pause="true"
                >
                
                
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Dynamic Form List</h4>
                                </div>
                                <div class="panel-body">
                                    <table id="grid-froms-data" class="display responsive" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Activity Name</th>
                                                <th>Description</th>
                                                <th>Created Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-default btn-sm" type="button" data-target="#carousel-edit-template" data-slide="next"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.item -->
                    <div class="item">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Dynamic Forms</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Form Title</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <input type="text" id="new_form_title" name="new_form_title" class="form-control" placeholder="Title" />
                                            </div>
                                        </div>
                                                                  
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="">From Description</label>
                                                <textarea class="form-control resize-vertical" rows="4" id="new_form_description" name="Description" placeholder="Enter some description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label for="">Form Type</label>
                                                <select id="new_form_type" name="new_form_type" class="form-control">
                                                  <option value='0'>Select</option>
                                                  <option value='Text'>Text</option>
                                                  <option value='Radio'>Radio</option>
                                                  <option value='Checkbox'>Checkbox</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Checkbox/Radio Form Values</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12" id="form-field-container">
                                            <div class="row" id="form-values-label">
                                                <div class="col-lg-5">
                                                    <label for="">Title</label>
                                                </div>
                                                <div class="col-lg-5">
                                                    <label for="">Value</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5"><input type="text" id="new_form_title[]" name="new_form_title[]" class="form-control" placeholder="Title" /></div>
                                                <div class="col-lg-5"><input type="text" id="new_form_title[]" name="new_form_title[]" class="form-control" placeholder="Title" /></div>
                                                <div class="col-lg-2"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button id="btn-add-new-field" class="btn btn-default btn-noskin"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Field</button>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-success btn-sm" type="button" data-target="#carousel-edit-template" data-slide="prev"><i class="fa fa-thumbs-up"></i> Done</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- end /.item -->
                  </div>
                  <!-- end /.carousel-inner -->

                </div>
                <!-- end /.carousel -->
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default popover-close" name="modal-add-closer" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          <button id="customer_add" name="customer_add" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    (function($){
        // Modal closer
        $('[name="modal-add-closer"]').on('click', function(e){
            e.preventDefault();
            $('#modal-add-new-customer').modal('hide');
        });
        
        // Cloning
        $('#btn-add-new-field').on('click', function(){
            $('#form-field-container').append('<div class="row"><div class="col-lg-5"><input type="text" id="new_form_title[]" name="new_form_title[]" class="form-control" placeholder="Title" /></div><div class="col-lg-5"><input type="text" id="new_form_title[]" name="new_form_title[]" class="form-control" placeholder="Title" /></div><div class="col-lg-2"><button class="btn-remove-clone-field btn btn-danger btn-noskin btn-lg"><i class="fa fa-times-circle text-danger"></i> </button></div></div>');
            return false;
        });
        
        // Remove Clone field
        $('#form-field-container').on('click','.btn-remove-clone-field', function(){
           $(this).closest('.row').remove(); 
        });

    })(window.jQuery);

</script>