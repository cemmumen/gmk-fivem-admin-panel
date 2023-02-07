<?php
include("gmk_dbconn.php");
session_start();
ob_start();
if(!$_SESSION["user"])
{
    header("Location:login.php");
}
if($_SESSION["yetki"]==='1')
{
    header("Location:index.php");exit;
}
if(!$_POST){header("Location:index.php");exit;}


if($_SESSION["login"]==="true")
{
  $loginSorgusu = $baglanti->query("SELECT * FROM paneladmin WHERE id='".$_SESSION["user"]."' AND pw='".$_SESSION["pass"]."' AND yetki='".$_SESSION["yetki"]."'");
if(!mysqli_num_rows($loginSorgusu)){
  header("Location:cikis.php");}
}

$hex = $_POST["id"];
$sorgu = $baglanti->query("SELECT * FROM users WHERE identifier='".$hex."'"); // Makale tablosundaki tüm verileri çekiyoruz.

while ($sonuc = $sorgu->fetch_assoc()) { 

$fn=$sonuc["firstname"];
$ln=$sonuc["lastname"];
$yetki=$sonuc["group"];
$meslek=$sonuc["job"];
$tel=$sonuc["phone_number"];
$grade=$sonuc["job_grade"];
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
   <div class="col text-center pt-2">Karakter Düzenleme </div>
   <div class="col">  </div>
  </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Hex</th>
      <th scope="col">İsim</th>
      <?php
      if($_SESSION["yetki"]==="3")
      {
        echo '<th scope="col">Yetki</th>';
      }
      ?>
      <th scope="col">Meslek</th>
      <th scope="col">Meslek Derecesi</th>
      <th scope="col">Telefon</th>
      <th scope="col">İşlem</th>
    </tr>
  </thead>

<?php
echo '
<form action="index.php" method="post">
<tbody>
<tr>
<input type="hidden" name="gercekHex" value="'.$hex.'">
  <td><input type="text" class="form-control" name="hex" value="'.$hex.'"></td>
  <td><input type="text" class="form-control" name="firstname" value="'.$fn.'"> <input type="text" class="form-control" name="lastname" value="'.$ln.'"></td>

';

if ($_SESSION["yetki"]==='3')
{
    echo '
  <td><select id="yetki" class="form-select" name="yetki">
  <option value="'.$yetki.'" selected>'.$yetki.'</option>
    <option value="user">user</option>
    <option value="admin">admin</option>
  </select></td>';
}

else
{
    echo '<input type="hidden" value="'.$yetki.'" id="yetki" name="yetki">';
}

  

  echo'


  <td><input type="text" class="form-control" name="meslek" value="'.$meslek.'"></td>
  <td><input type="text" class="form-control" name="grade" value="'.$grade.'"></td>
  <td><input type="text" class="form-control" name="telefon" value="'.$tel.'"></td>
  <td>
  <input type="submit" class="btn btn-dark" style="float:left;"value="Kaydet">
</form></td>
</tr>
</tbody>';
?>



</table>
</div>
<?php include("footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
</html>