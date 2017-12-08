<?php include APPPATH."views/templates/common/header.php"; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Activity Details : <?php echo $ActivityName;?> 
                </div>
                <div class="panel-body">
                   <div class="row">
                        <div class="col-md-12">
                            <ul class="list-group profile-details">
                             <!-- <li class="list-group-item">
                                <label class="text-success">Activity Template : </label>
                              </li>-->
                              <li class="list-group-item">
                                <div class="row">
                                  <div class="col-md-2"><span>Activity Template</span> </div>
                                  <div class="col-md-1"><span>:</span> </div>
                                  <div class="col-md-9"><span><?php echo $Template;?> </span></div>
                                </div>
                                <div class="row">
                                  <div class="col-md-2"><span>Client Name</span> </div>
                                  <div class="col-md-1"><span>:</span> </div>
                                  <div class="col-md-9"><span><?php echo $Client;?> </span></div>
                                </div>
                                <div class="row">
                                  <div class="col-md-2"><span>Assigned Date</span> </div>
                                  <div class="col-md-1"><span>:</span> </div>
                                  <div class="col-md-9"><span><?php echo $AssignedDate;?> </span></div>
                                </div>
                                <div class="row">
                                  <div class="col-md-2"><span>Progress</span> </div>
                                  <div class="col-md-1"><span>:</span> </div>
                                  <div class="col-md-4 progress"><span>
                                          <div class="progress-bar progress-bar-striped progress-bar-<?php echo $ProgressColor;?>" role="progressbar" aria-valuenow="<?php echo $ProgressInt; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $Progress;?>">
                                                <?php echo $Progress; ?>
                                          </div>
                                  </div>
                                </div>
                              </li>
                              <li class="list-group-item">
                                  <div class="row">
                                    <div class="col-md-3"><span>Activity</span> </div>
                                    <div class="col-md-2"><span>Technician</span> </div>
                                    <div class="col-md-1"><span>Status</span> </div>
                                    <div class="col-md-2"><span>Start Date</span> </div>
                                    <div class="col-md-2"><span>Start End</span> </div>
                                    <div class="col-md-2"><span>Actions</span></div>
                                  </div>
                              </li>
                             
                              <?php 
                                $sTrans = "";
                                if(count($Transactions) > 0){
                                    foreach ($Transactions as $n=>$oTransaction) {
                                        $sStatus = trim($oTransaction->status);
                                        $sEndDate = sys_date_format($oTransaction->end_date);
                                        if(trim($oTransaction->status) == ''){
                                            $sStatus = 'pending';
                                            $sEndDate = '-';
                                        }

                                        $sTrans .= '<form id="form_'.$oTransaction->id.'" name="form_'.$oTransaction->id.'" method="POST" action="">';
                                        $sTrans .= '<input name="aei_id" id="'.$oTransaction->actual_event_id.'" type="hidden" value="'.$oTransaction->actual_event_id.'"/>';
                                        $sTrans .= '<input name="user_id" id="'.$oTransaction->user_id.'" type="hidden" value="'.$oTransaction->user_id.'"/>';
                                        $sTrans .= '<li class="list-group-item">';    
                                        $sTrans .=  '<div class="row">';
                                        $sTrans .=      '<div class="col-md-3"><span>'.$oTransaction->name.'</span> </div>';
                                        $sTrans .=      '<div class="col-md-2"><span>'.$oTransaction->user_fullname.'</span> </div>';
                                        $sTrans .=      '<div class="col-md-1"><span>'.$sStatus.'&nbsp;<i class="fa '.status_icon($sStatus).'"></i></span> </div>';
                                        $sTrans .=      '<div class="col-md-2"><span>'.sys_date_format($oTransaction->start_date).'</span> </div>';
                                        $sTrans .=      '<div class="col-md-2"><span>'.$sEndDate.'</span> </div>';
                                        $sTrans .=      '<div class="col-md-2">';
                                        $sTrans .=      '   <span>';
                                        //$sTrans .=      '       <a href="#" class="dtButtons" id="info_'.$oTransaction->id.'" name="info_details" data-toggle="modal"><i class="fa '.status_icon('info').'" title="Transaction Details"></i></a>&nbsp;';
                                    
                                        if(!in_array(trim($sStatus),array('done','skipped'))){
                                            $sTrans .=      '   <a href="#" class="dtButtons" id="'.$oTransaction->id.'" name="skip_details" data-toggle="modal"><i class="fa '.status_icon('skipped').'" title="Skipped Transaction"></i></a>&nbsp;';
                                            $sTrans .=      '   <a href="#" class="dtButtons" id="'.$oTransaction->id.'" name="done_details" data-toggle="modal"><i class="fa '.status_icon('done').'" title="Done"></i></a>&nbsp;';
                                        }
                                        
                                       if(in_array(trim($sStatus),array('done','skipped'))){
                                            $sTrans .=      '   <a href="#" class="dtButtons" id="'.$oTransaction->id.'" name="open_details" data-toggle="modal"><i class="fa '.status_icon('open').'" title="Reopen Transaction"></i></a>&nbsp;';
                                        }
                                        
                                        
                                        $sTrans .=      '   </span>';
                                        $sTrans .=      '</div>';
                                        $sTrans .=  '</div>';
                                        
                                        $sFormStatus = !in_array(trim($sStatus),array('done','skipped'))?'':'disabled';
                                        
                                        $sTrans .=  '<div class="row">';
                                        $sTrans .=      '<div class="col-md-2"><span</span> </div>';
                                        $sTrans .=      '<div class="col-md-10"><span>Activity Remarks:</span> </div>';
                                        $sTrans .=  '</div>';
                                        $sTrans .=  '<div class="row">';
                                        $sTrans .=      '<div class="col-md-3"><span></span> </div>';
                                        $sTrans .=      '<div class="col-md-5"><textarea '.$sFormStatus.' id="notes_'.$oTransaction->id.'" name="notes" class="form-control" placeholder="Activity Remarks">'.$oTransaction->notes.'</textarea></div>';
                                        $sTrans .=  '</div>';

                                        if(count($oTransaction->fields) > 0){
                                              
                                              $sTrans .=  '<div class="row">';
                                              $sTrans .=      '<div class="col-md-2"><span</span> </div>';
                                              $sTrans .=      '<div class="col-md-10"><span>Custom Forms:</span> </div>';
                                              $sTrans .=  '</div>';
                                            
                                            
                                            foreach($oTransaction->fields as $m=>$oForm){
                                                $sTrans .=  '<div class="row">';
                                                $sTrans .=      '<div class="col-md-3"><span></span> </div>';
                                                $sTrans .=      '<div class="col-md-2"><span>'.$oForm->label.'</span> </div>';
                                                //updates for checkbox and radio
                                                $sTrans .=      '<div class="col-md-3"><span><input name="cform_'.$oForm->form_field_id.'" id="'.$oForm->form_field_id.'" '.$sFormStatus.' type="text" class="form-control" placeholder="'.$oForm->label.'" value="'.$oForm->user_value.'"/></span></div>';
                                                $sTrans .=  '</div>';
                                            }
                                            
                                        }
                                        $sTrans .= '</li>';
                                        $sTrans .=  '</form>';
                                    }
                                }
                                echo $sTrans;
                              ?>
                              
                            </ul>         
                        </div>
                      </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                   Comments
                </div>
                <div class="panel-body">
                   <div class="row">
                        <div class="col-md-12">
                            <?php 
                            if(!empty($Comments))
                            {
                                foreach ($Comments as $comment)
                                {
                                    echo "<p> <strong>$comment->fullname</strong></p>";
                                    echo "<p> $comment->comment</p>";
                                    echo "<hr />";
                                }
                            }else{
                                echo "<p>No comment</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>              
        </div>
    </div>
</div>
<!-- /.container-fluid -->


    <script>
        $(document).ready(function(){ });
        
        
        var base_url = '<?php echo base_url();?>';
        
        $('[name="done_details"]').click(function(e){
           var id = this.id;
           process_me(id,'done');
        });
        
        $('[name="skip_details"]').click(function(e){
           var id = this.id;
           process_me(id,'skipped');
            
        });
        
         $('[name="open_details"]').click(function(e){
           var id = this.id;
           process_me(id,'');
            
        });
        
        
        function process_me(id,status){
            
           var datastring = $("#form_"+id).serializeArray();
           var srch = 'cform_';
           var name = '';
           var data = {
               status : status,
               user_id : '',
               notes : '',
               actual_event_id : '', 
               custom_form : []
           };
           
           jQuery.each(datastring, function(index, item) {
              if(item.name == 'aei_id'){
                  data.actual_event_id = item.value;}
              
              if(item.name == 'user_id'){
                  data.user_id = item.value;}
              
              if(item.name == 'notes'){
                  data.notes = item.value;}
            });
           
           jQuery.each(datastring, function(index, item) {
              name = item.name;
              if(name.search(srch) >= 0 ){
                    data.custom_form.push({"value" : item.value, "form_field_id" : name.replace(srch,''), "actual_event_id" : data.actual_event_id});
               }
            });
            
            $.ajax({
                    url:  base_url+"activity/updateTransaction",
                    type: "POST",
                    data:data,
                    dataType: "json",
                    success: function(data){
                        location.reload();
                        // console.log(data);
                    },
                    error: function(data){
                        location.reload();
                        //console.log(data);
                }
            });
        }
            
    </script>

<?php
    //Insert Modal Component view
    include APPPATH."views/templates/common/footer.php"; 
?>
