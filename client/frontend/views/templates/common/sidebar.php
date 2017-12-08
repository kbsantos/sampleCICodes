<div class="navbar-default-sidebar sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <div class="user-panel">
                    <div class="user-image">
                        <!--$this->user->picture;-->
                        <a href=""><img src="http://lorempixel.com/48/48/animals/" alt="user pic"></a>
                    </div>
                    <div class="user-info"  >
                        <h5><?php echo $this->user->username;?></h5>
                        <p><small><a href=""><i class="fa fa-circle text-success"></i>Online</a></small></p>
                    </div>
                </div>
            </li>
        
            <?php
                $sMenu = "";
                if(isset($this->menu)){
                    foreach ($this->menu as $nKey=>$aMenu) {
                        $sMenu .= '<li>';
                        $sMenu .= '<a href='.$aMenu['link'].'><i class="fa '.$aMenu['icon'].' fa-fw"></i> '.$aMenu['label'].' <span class="fa arrow"></span></a>';
                        if(isset($aMenu['sub'])){
                            $sMenu .= '<ul class="nav nav-second-level">';
                            foreach ($aMenu['sub'] as $n=>$aSub){
                                $sMenu .= '<li>';
                                $sMenu .= '<a href='.$aSub['link'].'><i class="fa '.$aSub['icon'].' fa-fw"></i> '.$aSub['label'].' <!--<span class="fa arrow"></span>--></a>';
                                $sMenu .= '</li>';
                            }
                            $sMenu .= '</ul>';
                        }
                        $sMenu .= '</li>';
                    }
                } 
                echo $sMenu;
            ?>
           <!--<li>-->
           <!--     <a href="#"><i class="fa fa-home fa-fw"></i> Home<span class="fa arrow"></span></a>-->
           <!--     <ul class="nav nav-second-level">-->
           <!--         <li>-->
           <!--             <a href="/nexen"><i class="fa fa-dashboard"></i> Dashboard</a>-->
           <!--         </li>-->
           <!--     </ul>-->
           <!-- </li>-->
           <!-- <li>-->
           <!--     <a href="tables.html"><i class="fa fa-tasks fa-fw"></i> Activities<span class="fa arrow"></span></a>-->
           <!--     <ul class="nav nav-second-level">-->
           <!--         <li>-->
           <!--             <a href="/nexen"><i class="fa fa-check-square-o"></i> Approval</a>-->
           <!--         </li>-->
           <!--     </ul>-->
           <!-- </li>-->
           <!-- <li>-->
           <!--     <a href="/nexen"><i class="fa fa-users fa-fw"></i> Customers</a>-->
           <!-- </li>-->
           <!-- <li>-->
           <!--     <a href="/nexen"><i class="fa fa-file-text"></i> Reports</a>-->
           <!-- </li>-->
           <!-- <li>-->
           <!--     <a href="/nexen"><i class="fa fa-cog"></i> Settings</a>-->
           <!-- </li>-->

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->