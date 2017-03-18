<?php

    session_start();
    $_SESSION['fullname'] = '';
    $_SESSION['email'] = '';
    $_SESSION['type'] = '';
    session_unset();
    session_destroy();
    header("location: ../login.php");