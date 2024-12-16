<?php
session_start();

if (isset($_SESSION["pensioner_id"])) {
    session_unset();
    session_destroy();
    header("location:../index.php");
    die();
}
