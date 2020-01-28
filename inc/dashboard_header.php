<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pharmacy App</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="../assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="../assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/pickers/daterangepicker.js"></script>

    <script type="text/javascript" src="../assets/js/core/app.js"></script>
    <script type="text/javascript" src="../assets/js/pages/dashboard.js"></script>

    <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>
    <?php
    require_once("../classes/mysql.class.php");


    if (isset($_SESSION['app_user'])) {
        $colname_links = $_SESSION['app_user']['user_cat'];
    }

    $menu = new MySQL();

    $sql = sprintf("SELECT
user_links.link_id,
user_links.page_id,
user_links.page_id_sub,
user_links.link_url,
user_links.link_name,
user_links.link_image,
user_links.link_parent,
user_cat.`name`
FROM
user_cat_links
INNER JOIN user_links ON user_cat_links.link_id = user_links.link_id
INNER JOIN user_cat ON user_cat.cat_id = user_cat_links.cat_id
WHERE user_cat_links.cat_id = %s
ORDER BY user_links.link_name ASC", MySQL::SQLValue($colname_links, MySQL::SQLVALUE_NUMBER));

    $links = $menu->QueryArray($sql, MYSQLI_ASSOC);

    $menu_count = $menu->RowCount();

    if($menu_count > 0) {
        $parents = array();
        $child = array();

        foreach ($links as $row_links) {
            if ($row_links['link_parent'] == 0) {
                $parents[] = $row_links;
            } else {
                $child[] = $row_links;
            }
        }

    }

    $fullname = $_SESSION['app_user']['full_name'];

    $mycat = $_SESSION['app_user']['user_cat'];

    $getCat = new MySQL();

    $getCat->Query("SELECT cat_name FROM user_cat WHERE cat_id = $mycat");

    $mycr = $getCat->Row();


    include('menubar.php');

    ?>

    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <?php include('sidebar.php') ?>

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">

