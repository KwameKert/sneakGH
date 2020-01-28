<?php
session_start();
unset($_SESSION['app_user']);
header('Location: ../index.php');