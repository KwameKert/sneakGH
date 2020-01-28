<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="sneakers">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="../assets/images/favicon_1.ico">

    <title>SneakGH</title>

    <!--Morris Chart CSS -->

        <!-- App css -->
   

   <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="../assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

            <link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/plugins/custombox/css/custombox.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />

    <script src="../assets/js/modernizr.min.js"></script>


    <link href="../assets/js/plugins/toast-master/css/jquery.toast.css" rel="stylesheet" type="text/css">

   <!--  <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
 -->

</head>


<body >

<!-- Begin page -->

    <?php
    @session_start();


    require_once("../classes/mysql.class.php");


    if (isset($_SESSION['app_user'])) {
        $colname_links = $_SESSION['app_user']['user_cat'];
    }

    //var_dump($_SESSION[app_user]);

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

    $fullname = $_SESSION['app_user']['first_name']." ".$_SESSION['app_user']['last_name'];

    $mycat = $_SESSION['app_user']['user_cat'];

    $getCat = new MySQL();

    $getCat->Query("SELECT cat_name FROM user_cat WHERE cat_id = $mycat");

    $mycr = $getCat->Row();

    ?>
    <header id="topnav">
          
   <?php 
   
   include('../inc/topbar.php') ?>
   <?php include('../inc/menubar.php') ?>

</header>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
 <div class="wrapper">
            <div class="container-fluid">