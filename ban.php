<?php
include("gmk_dbconn.php");
session_start();
ob_start();
if($_SESSION["login"]!="true")
{
header("Location:index.php");
}
if($_SESSION["yetki"]==="1"){header("Location:index.php");exit;}


if(!$_GET && !$_POST){header("Location:index.php");}



if($_SESSION["login"]==="true")
{
  $loginSorgusu = $baglanti->query("SELECT * FROM paneladmin WHERE id='".$_SESSION["user"]."' AND pw='".$_SESSION["pass"]."' AND yetki='".$_SESSION["yetki"]."'");
if(!mysqli_num_rows($loginSorgusu)){
  header("Location:cikis.php");}
}

$hex = $_GET["id"];
$sorgu = $baglanti->query("SELECT * FROM discordwlsistemi WHERE steam='".$hex."'");
$sonuc = $sorgu->fetch_assoc();
$discord = $sonuc["discord"];
$sorgu2 = $baglanti->query("INSERT INTO m3_banlist (admin, steam, discord, reason, time) VALUES ('".$_SESSION["user"]."', '".$hex."', 'discord:".$discord."', 'Panel', 2147483647)");

$sorgu4 = $baglanti->query("SELECT * FROM users WHERE identifier='".$hex."'");
while($sonucisim = $sorgu4->fetch_assoc())
{
    $ad = $sonucisim["firstname"];
    $soyad = $sonucisim["lastname"];
}
$zaman = date("Y-m-d H:i:s");
$sorgu3 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('".$_SESSION["user"]."', '".$ad." ".$soyad." kişisine <b>ban attı.</b> Kişiye ait HEX: ".$hex."', '".$zaman."')");
header("Location:index.php?w=7");


?>