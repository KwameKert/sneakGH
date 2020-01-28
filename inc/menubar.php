   <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            
                <?php        if($menu_count > 0){?>



                    <?php foreach($parents as $parent){ ?>



                        <li class=" has-submenu <?php if($page==$parent['page_id']){echo "active";}?>" >

                            <a href="#"><i class="<?php echo $parent['link_image'] ?>"></i><span> <?php echo $parent['link_name']; ?></span>

                                <span class="menu-arrow"></span>

                            </a>

                            <ul class="submenu">

                                <?php foreach($child as $sub){ if($parent['link_id']==$sub['link_parent']){ ?>

                                    <li><a href="<?php echo $sub['link_url'] ?>"><i style="color: #f39c12;" class="<?php echo $sub['link_image'] ?>"></i><?php echo $sub['link_name']; ?></a></li>

                                <?php }}?>

                            </ul>

                        </li>

                    <?php }}?>

                       
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->





<!-- Left Sidebar End -->

