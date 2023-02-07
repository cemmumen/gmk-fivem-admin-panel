<?php
include("gmk_dbconn.php");
session_start();
ob_start();
if(!$_SESSION["login"])
{
    header("Location:login.php");
}

$zaman = date("Y-m-d H:i:s");
$sorgu3 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('".$_SESSION["user"]."', 'oturumdan çıkış yaptı.', '".$zaman."')");
$_SESSION["login"]="false";
$_SESSION["user"]="";
$_SESSION["pass"]="";
$_SESSION["yetki"]="";
header("Location:index.php");
?>