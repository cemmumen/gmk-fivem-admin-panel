<?php
include("gmk_dbconn.php");
session_start();
ob_start();
if($_SESSION["login"]!="true")
{
header("Location:index.php");
}
if($_SESSION["yetki"]==="1"){
    header("Location:index.php");exit;
}




if($_SESSION["login"]==="true")
{
  $loginSorgusu = $baglanti->query("SELECT * FROM paneladmin WHERE id='".$_SESSION["user"]."' AND pw='".$_SESSION["pass"]."' AND yetki='".$_SESSION["yetki"]."'");
if(!mysqli_num_rows($loginSorgusu)){
  header("Location:cikis.php");}
}
$hex = $_GET["id"];

$sorgu8 = $baglanti->query("SELECT * FROM users WHERE identifier='".$hex."'");
while($sonucisim = $sorgu8->fetch_assoc())
{
    $ad = $sonucisim["firstname"];
    $soyad = $sonucisim["lastname"];
}
    $zaman = date("Y-m-d H:i:s");
    $sorgu9 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('".$_SESSION["user"]."', '".$ad." ".$soyad." isimli kişiye <b>CK attı.</b> Kişinin HEX numarası: ".$hex."', '".$zaman."')");



$sorgu = $baglanti->query("DELETE FROM users WHERE identifier='".$hex."'");
$sorgu2 = $baglanti->query("DELETE FROM ownedvehicles WHERE owner='".$hex."'");
$sorgu3 = $baglanti->query("DELETE FROM characters WHERE identifier='".$hex."'");
$sorgu4 = $baglanti->query("DELETE FROM crew_phone_bank WHERE identifier='".$hex."'");
$sorgu5 = $baglanti->query("DELETE FROM datastore_data WHERE owner='".$hex."'");
$sorgu6 = $baglanti->query("DELETE FROM disc_ammo WHERE owner='".$hex."'");
$sorgu7 = $baglanti->query("DELETE FROM m3_inv_stashs WHERE owner='".$hex."'");



header("Location:index.php?w=6");


?>