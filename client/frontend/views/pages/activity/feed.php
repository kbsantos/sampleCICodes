<?php include APPPATH."views/templates/common/header.php"; ?>

    
<!-- Page Content -->

<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span><i class="fa fa-feed"></i></span> Feed Activity
            </div>
            <div class="panel-body">
        <?php 
            if(!empty($feeds))
            {
                foreach($feeds as $feed)
                {
                  $activity_owner = ucfirst($feed->technician_name);                
                ?>
                
                <section class="post-heading">
                    <div class="row-fluid">
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object photo-profile" src="http://lorempixel.com/48/48/people/" width="40" height="40" alt="...">
                            </a>
                          </div>
                          <div class="media-body">
                            <a href="#" class="anchor-username"><h4 class="media-heading"><?php echo $activity_owner; ?></h4></a> 
                            <a href="#" class="anchor-time">51 mins</a>
                          </div>
                        </div>
                    </div>
                </section>
                
                
                <section class="post-body">
                    <p><?php echo $feed->description; ?></p>
                </section>
                
                
                <?php
                    
                    
  
                    // echo "<div class=\"media\">
                    //         <div class=\"media-left\">
                    //             <a href=\"#\">
                    //                 <img class=\"media-object\" src=\"//lorempixel.com/48/48/nature/\" alt=\"Generic placeholder image\">
                    //             </a>
                    //         </div>";
                    // echo "<div class=\"media-body\">";
                    // echo "<h4 class=\"media-heading\">$activity_owner</h4>";
                    // echo "<p>$feed->description</p>";
                    // echo "<p><a href=\"#\">Comment</a></p>";
                    
                    if(!empty($feed->comments))
                    {
                        foreach($feed->comments as $comment) 
                        {
                        $comment_owner = ucfirst($comment->fullname);
                        $time = strtotime($comment->commented_date);
                        $comment_date = date('Y-m-d',$time);
                        
                        
                        ?>
                        
                        <section class="post-footer">
                           <hr>
                           <div class="post-footer-option container-fluid">
                                <ul class="list-unstyled">
                                    <li><a href="#"><i class="fa fa-thumbs-up"></i> Like</a></li>
                                    <li><a href="#"><i class="fa fa-comment"></i> Comment</a></li>
                                    <li><a href="#"><i class="fa fa-share"></i> Share</a></li>
                                </ul>
                           </div>
                           <div class="post-footer-comment-wrapper">
                               <div class="container-fluid">
                                   <div class="row-fluid">
                                       <div class="comment-form">
                                           
                                       </div>
                                       <div class="comment">
                                            <div class="media">
                                              <div class="media-left">
                                                <a href="#">
                                                  <img class="media-object photo-profile" src="http://lorempixel.com/48/48/city/" alt="Profile">
                                                </a>
                                              </div>
                                              <div class="media-body">
                                                <a href="#" class="anchor-username"><h4 class="media-heading"><?php echo $comment_owner; ?></h4></a> 
                                                <a href="#" class="anchor-time"><?php echo $comment_date; ?></a>
                                                <p><?php echo $comment->comment; ?></p>
                                              </div>
                                            </div>
                                       </div>
                                   </div>
                               </div>
                           </div>                      
                        </section>
                        
                        <?php
                        
                        // echo "<div class=\"media\">
                        //         <div class=\"media-left\">
                        //             <a href=\"#\">
                        //                 <img class=\"media-object\" src=\"//lorempixel.com/48/48/people/\" alt=\"Generic placeholder image\">
                        //             </a>
                        //         </div>
                        //         <div class=\"media-body\">
                        //             <h4 class=\"media-heading\">$comment_owner</h4>
                        //             <p>$comment_date</p>
                        //             <p>$comment->comment</p>
                        //         </div>
                        //     </div>";
                        }
                    }

                    //echo "</div>";
                    //echo "</div>";
                    echo "<hr \>";
                }
            } 
        ?>        

            </div>
            <!--end /.panel-body -->
        </div>
        <!--end ./panel -->
    </div>
    <!-- end /.col-lg-12 -->
</div>
<!--end /.row -->
</div>

<?php include APPPATH."views/templates/common/footer.php"; ?>