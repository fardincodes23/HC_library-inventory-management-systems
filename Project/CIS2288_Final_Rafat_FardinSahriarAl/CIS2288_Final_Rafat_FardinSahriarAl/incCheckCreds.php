<?php

/*
 * Filename: incCheckCreds.php
 * Author:   Fardin
 * Date:     Dec 11, 2025
 * Purpose:  Making sure admin logged in before accessing the news database.
 */


if (!isset($_SESSION['valid_user'])) {
    header("location: login.php");
    exit();
}
?>