<?php
session_start();

$_SESSION['login']= null;
$_SESSION['senha']= null;
//$_SESSION["nomesDosApagados"] = null;

header("location:index.php");

