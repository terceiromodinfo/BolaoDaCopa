<?php
session_start();

$_SESSION['login']= null;
$_SESSION['senha']= null;

header("location:index.php");

