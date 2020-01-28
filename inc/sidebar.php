<?php



$c_id = $_SESSION['app_user']['user_cat'];

$nObj = new MySQL();

$nObj->Query("SELECT name FROM user_cat WHERE cat_id=$c_id");

$row=$nObj->Row();



?>


            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="has-submenu">
                                <a href="#"><i class="md md-dashboard"></i>Dashboard</a>
                                <ul class="submenu">
                                    <li>
                                        <a href="index.html">Dashboard 01</a>
                                    </li>
                                    <li>
                                        <a href="dashboard_2.html">Dashboard 02</a>
                                    </li>
                                    <li>
                                        <a href="dashboard_3.html">Dashboard 03</a>
                                    </li>
                                    <li>
                                        <a href="dashboard_4.html">Dashboard 04</a>
                                    </li>
                                </ul>
                            </li>

                       
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->


<!-- end of new sidemenu -->




              <div class="sidebar sidebar-main">

				<div class="sidebar-content">



					<div class="sidebar-user-material">

						<div class="category-content">

							<div class="sidebar-user-material-content">

								<a href="#"><img src="../assets/images/placeholder.jpg" class="img-circle img-responsive" alt=""></a>

								<h5><?php echo $row->name; ?></h5>

								<span class="text-size-small"><?php echo $_SESSION['app_user']['email']; ?></span>

							</div>

														

							<div class="sidebar-user-material-menu">

								<a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>

							</div>

						</div>

						

						<div class="navigation-wrapper collapse" id="user-nav">

							<ul class="navigation">

								<li><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>

								<li><a href="#"><i class="icon-coins"></i> <span>My balance</span></a></li>

								<li><a href="#"><i class="icon-comment-discussion"></i> <span><span class="badge bg-teal-400 pull-right">58</span> Messages</span></a></li>

								<li class="divider"></li>

								<li><a href="#"><i class="icon-cog5"></i> <span>Account settings</span></a></li>

								<li><a href="../auth/logout.php"><i class="icon-switch2"></i> <span>Logout</span></a></li>

							</ul>

						</div>

					</div>



					<div class="sidebar-category sidebar-category-visible">

						<div class="category-content no-padding">

							<ul class="navigation navigation-main navigation-accordion">



								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>

                                <li class="<?php if($page == "home"){echo "active";}?>"><a href="../inc/dashboard.php"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

                                <?php        if($menu_count > 0){?>



                                    <?php foreach($parents as $parent){ ?>



                                        <li class="<?php if($page==$parent['page_id']){echo "active";}?>" >

                                            <a href="#">

                                                <i class="<?php echo $parent['link_image'] ?>"></i><span> <?php echo $parent['link_name']; ?></span>

                                                <span class="pull-right-container">

                                          <i class="fa fa-angle-left pull-right"></i>

                                        </span>

                                            </a>

                                            <ul class="treeview-menu">

                                                <?php foreach($child as $sub){ if($parent['link_id']==$sub['link_parent']){ ?>

                                                    <li><a href="<?php echo $sub['link_url'] ?>"><i style="color: #f39c12;" class="<?php echo $sub['link_image'] ?>"></i><?php echo $sub['link_name']; ?></a></li>

                                                <?php }}?>

                                            </ul>

                                        </li>

                                    <?php }}?>









							</ul>

						</div>

					</div>



				</div>

			</div>

