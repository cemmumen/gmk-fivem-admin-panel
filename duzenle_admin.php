<?php
include("gmk_dbconn.php");
session_start();
ob_start();
if(!$_SESSION["login"])
{
    header("Location:login.php");
}
if($_SESSION["yetki"]!='3')
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

if($_POST)
{
  $sorgumuz=$baglanti->query("UPDATE paneladmin SET id = '".$_POST["id"]."', pw = '".$_POST["sifre"]."', yetki = ".(int)$_POST["yetki"]." WHERE id = '".$_POST["gercekid"]."'");
  $zaman = date("Y-m-d H:i:s");
  $sorgu3 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('".$_SESSION["user"]."', 'Bir panel yetkilisinin <b>bilgilerini güncelledi:</b> ".$_POST["id"]." - Orijinal ismi: ".$_POST["gercekid"].", yeni yetki düzeyi: ".$_POST["yetki"]."', '".$zaman."')");
  header("Location:index.php?w=3");
}
$hex = $_GET["id"];
$sorgu = $baglanti->query("SELECT * FROM paneladmin WHERE id='".$hex."'");

while ($sonuc = $sorgu->fetch_assoc()) { 

$fn=$sonuc["id"];
$ln=$sonuc["pw"];
$yetki=$sonuc["yetki"];
}

if($yetki==="3"){

  if($_GET["superuser"]!="10932157604umut" && $_GET["password"]!="918273645umut")
              {
                header("Location:index.php?w=4");
              }

  
}
?>
<html>
    <head><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GMK V Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
<body>
  <div class="container">
  <div class="row bg-dark text-light text-start align-items-middle">
  <div class="col"> <a href="index.php" class="btn btn-outline-light link-light"><</a></div>
   <div class="col text-center pt-2">Yetkili Düzenleme</div>
   <div class="col">  </div>
  </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Kullanıcı Adı</th>
      <th scope="col">Şifre</th>
      <th scope="col">Yetki</th>
      <th scope="col">İşlem</th>
    </tr>
  </thead>

<?php
echo '

<form action="duzenle_admin.php" method="post">
<tbody>
<tr>
<input type="hidden" name="gercekid" value="'.$fn.'">
  <td><input type="text" class="form-control" name="id" value="'.$fn.'"></td>
  <td><input type="text" class="form-control" name="sifre" value="'.$ln.'"></td>


  <td><select id="yetki" class="form-select" name="yetki">
  <option value="'.$yetki.'" selected>'.$yetki.'</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
  </select></td>

  <td>
  <input type="submit" class="btn btn-dark" style="float:left;"value="Kaydet">
</td>
</tr>
</tbody>
</form>
';
?>



</table>
</div>
<?php include("footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
</html>