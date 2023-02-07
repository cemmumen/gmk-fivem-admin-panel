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

?>
<html>
    <head>
        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GMK V Panel</title>
    <link rel="icon" href="images/icon.ico" type="image/ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        </head>
    <body>

    
    <?php
    
        if($_POST)
        {
            $user=$_POST["username"];
            $pw=$_POST["password"];
            


        if($_SESSION["login"]==="true")
{
  $loginSorgusu = $baglanti->query("SELECT * FROM paneladmin WHERE id='".$_SESSION["user"]."' AND pw='".$_SESSION["pass"]."' AND yetki='".$_SESSION["yetki"]."'");
if(!mysqli_num_rows($loginSorgusu)){
  header("Location:cikis.php");}
}
        
        $sorgu = $baglanti->query("SELECT * FROM paneladmin WHERE id='".$user."'");
        if(mysqli_num_rows($sorgu)){


    echo '
    <div class="container d-flex align-items-center text-center mx-auto">
    <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
<div>
Aynı isimde bir yetkili var.
</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>

    ';
    
        }
        else{
        
          $sorgumuz=$baglanti->query("INSERT INTO paneladmin (id, pw, yetki) VALUES ('".$_POST["username"]."', '".$_POST["password"]."', ".(int)$_POST["yetki"].")");

    $zaman = date("Y-m-d H:i:s");
    $sorgu3 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('".$_SESSION["user"]."', '<b>Yeni bir panel yetkilisi ekledi:</b> ".$_POST["username"]." - Yetki numarası: ".$_POST["yetki"]."', '".$zaman."')");

          header("Location:index.php?w=5");
          
        
        }
        //ob_end_flush();
        }
        ?>
<div class="container mt-5">
<div class="card mx-auto text-center" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title d-flex align-items-center text-center">
    <span class="mx-auto">Yetkili Kullanıcı Ekle</span>
    </h5>
    <table class="table border border-white">
  <tbody>
      <form action="yetkili_ekle.php" method="post">
    <tr>
      <td>Kullanıcı Adı:</td>
    </tr>
    <tr>
      <td><input type="text" class="form-control" name="username"></td>
    </tr>
    <tr>
      <td>Şifre:</td>
    </tr>
    <tr>
      <td><input type="text" class="form-control" name="password"></td>
    </tr>
    <tr>
      <td>Yetki:</td>
    </tr>
    <tr>
      <td><select id="yetki" class="form-select" name="yetki">
  <option value="1" selected>1</option>
    <option value="2">2</option>
    <option value="3">3</option>
  </select></td>
    </tr>
    <tr>
      <td><input type="submit" class="btn btn-dark w-100" value="Ekle"></td>
    </tr>
</form>
  </tbody>
</table>
  </div>
</div>
</div>

<?php include("footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
</html>