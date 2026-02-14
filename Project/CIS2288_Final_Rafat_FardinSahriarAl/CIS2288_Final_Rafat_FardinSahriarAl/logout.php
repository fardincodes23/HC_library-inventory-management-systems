<?php
/*
 * Filename: logout.php
 * Author:   Fardin
 * Date:     Dec 11, 2025
 * Purpose:  Log out the user and destroy the session.
 */
session_start();
session_unset();
session_destroy();
header("location: index.php");
exit;
?>