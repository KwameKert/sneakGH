<?php
session_start();
if(!isset($_SESSION['app_user'])){
    header("Location: ../index.php");
}
$page = "home";
    require_once('dashboard_header.php');

?>
    <!-- Main charts -->
    <div class="row">
        <div class="col-lg-7">

            <!-- Traffic sources -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Traffic sources</h6>
                    <div class="heading-elements">
                        <form class="heading-form" action="#">
                            <div class="form-group">
                                <label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
                                    <input type="checkbox" class="switch" checked="checked">
                                    Live update:
                                </label>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-plus3"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">New visitors</div>
                                    <div class="text-muted">2,349 avg</div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="new-visitors"></div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-watch2"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">New sessions</div>
                                    <div class="text-muted">08:20 avg</div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="new-sessions"></div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-people"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">Total online</div>
                                    <div class="text-muted"><span class="status-mark border-success position-left"></span> 5,378 avg</div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="total-online"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="position-relative" id="traffic-sources"></div>
            </div>
            <!-- /traffic sources -->

        </div>

        <div class="col-lg-5">

            <!-- Sales stats -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Sales statistics</h6>
                    <div class="heading-elements">
                        <form class="heading-form" action="#">
                            <div class="form-group">
                                <select class="change-date select-sm" id="select_date">
                                    <optgroup label="<i class='icon-watch pull-right'></i> Time period">
                                        <option value="val1">June, 29 - July, 5</option>
                                        <option value="val2">June, 22 - June 28</option>
                                        <option value="val3" selected="selected">June, 15 - June, 21</option>
                                        <option value="val4">June, 8 - June, 14</option>
                                    </optgroup>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="content-group">
                                <h5 class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i> 5,689</h5>
                                <span class="text-muted text-size-small">orders weekly</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="content-group">
                                <h5 class="text-semibold no-margin"><i class="icon-calendar52 position-left text-slate"></i> 32,568</h5>
                                <span class="text-muted text-size-small">orders monthly</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="content-group">
                                <h5 class="text-semibold no-margin"><i class="icon-cash3 position-left text-slate"></i> $23,464</h5>
                                <span class="text-muted text-size-small">average revenue</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-group-sm" id="app_sales"></div>
                <div id="monthly-sales-stats"></div>
            </div>
            <!-- /sales stats -->

        </div>
    </div>
    <!-- /main charts -->


    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-8">

            <!-- Quick stats boxes -->
            <div class="row">
                <div class="col-lg-4">

                    <!-- Members online -->
                    <div class="panel bg-teal-400">
                        <div class="panel-body">
                            <div class="heading-elements">
                                <span class="heading-text badge bg-teal-800">+53,6%</span>
                            </div>

                            <h3 class="no-margin">3,450</h3>
                            Members online
                            <div class="text-muted text-size-small">489 avg</div>
                        </div>

                        <div class="container-fluid">
                            <div id="members-online"></div>
                        </div>
                    </div>
                    <!-- /members online -->

                </div>

                <div class="col-lg-4">

                    <!-- Current server load -->
                    <div class="panel bg-pink-400">
                        <div class="panel-body">
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#"><i class="icon-sync"></i> Update data</a></li>
                                            <li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
                                            <li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
                                            <li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <h3 class="no-margin">49.4%</h3>
                            Current server load
                            <div class="text-muted text-size-small">34.6% avg</div>
                        </div>

                        <div id="server-load"></div>
                    </div>
                    <!-- /current server load -->

                </div>

                <div class="col-lg-4">

                    <!-- Today's revenue -->
                    <div class="panel bg-blue-400">
                        <div class="panel-body">
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="reload"></a></li>
                                </ul>
                            </div>

                            <h3 class="no-margin">$18,390</h3>
                            Today's revenue
                            <div class="text-muted text-size-small">$37,578 avg</div>
                        </div>

                        <div id="today-revenue"></div>
                    </div>
                    <!-- /today's revenue -->

                </div>
            </div>
            <!-- /quick stats boxes -->
        </div>

        <div class="col-lg-4">

            <!-- Daily sales -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Daily sales stats</h6>
                    <div class="heading-elements">
                        <span class="heading-text">Balance: <span class="text-bold text-danger-600 position-right">$4,378</span></span>
                        <ul class="icons-list">
                            <li class="dropdown text-muted">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-sync"></i> Update data</a></li>
                                    <li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
                                    <li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <div id="sales-heatmap"></div>
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th>Application</th>
                            <th>Time</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="media-left media-middle">
                                    <a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>

                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="#" class="letter-icon-title">Sigma application</a>
                                    </div>

                                    <div class="text-muted text-size-small"><i class="icon-checkmark3 text-size-mini position-left"></i> New order</div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted text-size-small">06:28 pm</span>
                            </td>
                            <td>
                                <h6 class="text-semibold no-margin">$49.90</h6>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="media-left media-middle">
                                    <a href="#" class="btn bg-danger-400 btn-rounded btn-icon btn-xs">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>

                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="#" class="letter-icon-title">Alpha application</a>
                                    </div>

                                    <div class="text-muted text-size-small"><i class="icon-spinner11 text-size-mini position-left"></i> Renewal</div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted text-size-small">04:52 pm</span>
                            </td>
                            <td>
                                <h6 class="text-semibold no-margin">$90.50</h6>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="media-left media-middle">
                                    <a href="#" class="btn bg-indigo-400 btn-rounded btn-icon btn-xs">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>

                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="#" class="letter-icon-title">Delta application</a>
                                    </div>

                                    <div class="text-muted text-size-small"><i class="icon-lifebuoy text-size-mini position-left"></i> Support</div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted text-size-small">01:26 pm</span>
                            </td>
                            <td>
                                <h6 class="text-semibold no-margin">$60.00</h6>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="media-left media-middle">
                                    <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>

                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="#" class="letter-icon-title">Omega application</a>
                                    </div>

                                    <div class="text-muted text-size-small"><i class="icon-lifebuoy text-size-mini position-left"></i> Support</div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted text-size-small">11:46 am</span>
                            </td>
                            <td>
                                <h6 class="text-semibold no-margin">$55.00</h6>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="media-left media-middle">
                                    <a href="#" class="btn bg-danger-400 btn-rounded btn-icon btn-xs">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>

                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="#" class="letter-icon-title">Alpha application</a>
                                    </div>

                                    <div class="text-muted text-size-small"><i class="icon-spinner11 text-size-mini position-left"></i> Renewal</div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted text-size-small">10:29 am</span>
                            </td>
                            <td>
                                <h6 class="text-semibold no-margin">$90.50</h6>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /daily sales -->


            <!-- My messages -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">My messages</h6>
                    <div class="heading-elements">
                        <span class="heading-text"><i class="icon-history text-warning position-left"></i> Jul 7, 10:30</span>
                        <span class="label bg-success heading-text">Online</span>
                    </div>
                </div>


               


        </div>
    </div>
    <!-- /dashboard content -->



<?php 
  
  require_once('footer.php');

?>