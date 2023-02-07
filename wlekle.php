<?php
include("gmk_dbconn.php");
session_start();
ob_start();
if($_SESSION["login"]!="true")
{
    header("Location:login.php");
}



if($_SESSION["login"]==="true")
{
  $loginSorgusu = $baglanti->query("SELECT * FROM paneladmin WHERE id='".$_SESSION["user"]."' AND pw='".$_SESSION["pass"]."' AND yetki='".$_SESSION["yetki"]."'");
if(!mysqli_num_rows($loginSorgusu)){
  header("Location:cikis.php");}
}
if($_POST)
{
    if(!$_POST["hexEklenen"])
    {
        header("Location:index.php?w=1"); 
    }
    if(!$_POST["dcEklenen"])
    {
        header("Location:index.php?w=1"); 
    }
    if($_POST["dcEklenen"] && $_POST["hexEklenen"])
    {
        if(strpos($_POST["dcEklenen"], "'") !== false || strpos($_POST["dcEklenen"], '"') !== false || strpos($_POST["dcEklenen"], "<") !== false || strpos($_POST["dcEklenen"], ">") !== false){
            header("Location:index.php?w=1");exit;
        }
        if(strpos($_POST["hexEklenen"], "'") !== false || strpos($_POST["hexEklenen"], '"') !== false || strpos($_POST["hexEklenen"], "<") !== false || strpos($_POST["hexEklenen"], ">") !== false){
            header("Location:index.php?w=1");exit;
        }
        $dc = $_POST["dcEklenen"];
        $hex = $_POST["hexEklenen"];
        $a= str_replace('steam:', '', $hex);
            $hex = 'steam:'.$a;
        $sorgu1=$baglanti->query("INSERT INTO whitelist (identifier) VALUES ('".$hex."')");
        $sorgu2=$baglanti->query("INSERT INTO discordwlsistemi (steam, discord) VALUES ('".$hex."', '".$dc."')");

    
    $zaman = date("Y-m-d H:i:s");
    $sorgu3 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('".$_SESSION["user"]."', '".$hex." numarasını <b>whiteliste ekledi.</b>', '".$zaman."')");



        header("Location:index.php?w=2"); 
    }
}
else{
    header("Location:index.php");
}



?>