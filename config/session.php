<?php
/**
 * Created by PhpStorm.
 * User: KaMa
 * Date: 15/03/2017
 * Time: 07:54
 */
session_start();
if(empty($_SESSION) ||
    !isset($_SESSION['fullname']) ||
    $_SESSION['fullname']=='' ||
    !isset($_SESSION['email']) ||
    $_SESSION['email']=='' ||
    !isset($_SESSION['type']) ||
    $_SESSION['type']==''){
    session_destroy();
    header("location: ../login.php");
}