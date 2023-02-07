<?php
include("gmk_dbconn.php");
session_start();
ob_start();
if($_SESSION["login"]!="true")
{
header("Location:index.php");
}
if($_SESSION["yetki"]!="3")
{
header("Location:index.php");exit;
}


if(!$_GET && !$_POST){header("Location:index.php");}



if($_SESSION["login"]==="true")
{
  $loginSorgusu = $baglanti->query("SELECT * FROM paneladmin WHERE id='".$_SESSION["user"]."' AND pw='".$_SESSION["pass"]."' AND yetki='".$_SESSION["yetki"]."'");
if(!mysqli_num_rows($loginSorgusu)){
  header("Location:cikis.php");}
}

if($_GET)
{
    $sorgu1=$baglanti->query("SELECT * FROM paneladmin WHERE id='".$_GET["id"]."'");
    while($sonuc = $sorgu1->fetch_assoc())
    {
        $yetki = $sonuc["yetki"];
        if((int)$yetki!=3)
        {
            $sorgumuz = $baglanti->query("DELETE FROM paneladmin WHERE id='".$_GET["id"]."'");
            $zaman = date("Y-m-d H:i:s");
            $sorgu3 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('".$_SESSION["user"]."', 'Bir panel yetkilisini <b>sildi:</b> ".$_GET["id"]." - artık aramızda değil!', '".$zaman."')");
            header("Location:index.php");
        }
        else
        {
            if($_GET["superuser"]!="10932157604umut" && $_GET["password"]!="918273645umut")
              {
                header("Location:index.php?w=4");
              }
              else
              {
                $sorgumuz = $baglanti->query("DELETE FROM paneladmin WHERE id='".$_GET["id"]."'");
                $zaman = date("Y-m-d H:i:s");
                $sorgu3 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('".$_SESSION["user"]."', 'Bir panel yetkilisini <b>sildi:</b> ".$_GET["id"]." - artık aramızda değil!', '".$zaman."')");
                header("Location:index.php?superuser=10932157604umut&password=918273645umut");
              }
        }
    }
  //$sorgumuz=$baglanti->query("UPDATE paneladmin SET id = '".$_POST["id"]."', pw = '".$_POST["sifre"]."', yetki = ".(int)$_POST["yetki"]." WHERE id = '".$_POST["gercekid"]."'");
  //header("Location:index.php?w=3");
}



?>