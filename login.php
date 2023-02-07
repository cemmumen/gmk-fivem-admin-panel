<?php
include("gmk_dbconn.php");
$kurulumSorgusu = $baglanti->query("SELECT * FROM paneladmin");
if(!mysqli_num_rows($kurulumSorgusu))
{
  header("Location:install.php");
}
else
{
  unlink('install.php');
}
session_start();
    ob_start();
if($_SESSION["login"]==="true")
{
    header("Location:index.php");
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
    
      if($_GET["w"]==="1"){
        echo '<div class="container d-flex align-items-center text-center mx-auto">
        <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
    <div>İlk kurulum başarıyla gerçekleşti. Oluşturduğun hesapla giriş yapabilirsin. Install.php dosyası otomatik olarak silindi.</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    </div>';
    }
    
        if($_POST)
        {
            $user=$_POST["username"];
            $pw=$_POST["password"];
            
        
        $sorgu = $baglanti->query("SELECT * FROM paneladmin WHERE id='".$user."' AND pw='".$pw."'");
        if(mysqli_num_rows($sorgu)){
            $_SESSION["login"] = "true";
    $_SESSION["user"] = $user;
    $_SESSION["pass"] = $pw;
    $_SESSION["yetki"] = $sorgu->fetch_assoc()["yetki"];
    $zaman = date("Y-m-d H:i:s");
    $sorgu3 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('".$user."', 'sistemde oturum açtı.', '".$zaman."')");
    header("Location:index.php");
        }
        else{
        
            echo '
            <div class="container d-flex align-items-center text-center mx-auto">
            <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
  <div>
  Kullanıcı adı veya şifre yanlış.
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
        
            ';
        
        }
        //ob_end_flush();
        }
        ?>
<div class="container mt-5">
<div class="card mx-auto text-center" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title d-flex align-items-center text-center">
    <img src="images/logo_dark.png" class="rounded float-start d-flex mx-auto" style="height:auto;width:50px;" alt="...">
    </h5>
    <table class="table border border-white">
  <tbody>
      <form action="login.php" method="post">
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
      <td><input type="password" class="form-control" name="password"></td>
    </tr>
    <tr>
      <td><input type="submit" class="btn btn-dark w-100" value="Giriş"></td>
    </tr>
</form>
  </tbody>
</table>
  </div>
</div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
</html>