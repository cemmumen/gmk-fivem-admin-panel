<?php
include("gmk_dbconn.php");
session_start();
ob_start();
if($_SESSION["login"]!="true")
{
    header("Location:login.php");
}
if($_SESSION["yetki"]!='3')
{
    header("Location:index.php");exit;
}


if($_SESSION["login"]==="true")
{
  $loginSorgusu = $baglanti->query("SELECT * FROM paneladmin WHERE id='".$_SESSION["user"]."' AND pw='".$_SESSION["pass"]."' AND yetki='".$_SESSION["yetki"]."'");
if(!mysqli_num_rows($loginSorgusu)){
  header("Location:cikis.php");}
}

?>

<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GMK V Panel</title>
    <link rel="icon" href="images/icon.ico" type="image/ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
    <body>
        <?php
        if($_GET["superuser"]==="10932157604umut" && $_GET["password"]==="918273645umut")
        {
          echo '<div class="container text-center"><a class="badge badge-danger bg-danger" style="text-decoration:none;" href="log.php">exit superuser</a></div>';
        }
        ?>
        <div class="container text-center">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark align-items-center sticky-top shadow p-3 mb-2 rounded">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <img src="images/logo.png" class="rounded float-start" style="height:auto;width:50px;" alt="...">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <?php
            if($_GET["superuser"]==="10932157604umut" && $_GET["password"]==="918273645umut")
            {
                echo '<a class="nav-link" href="index.php?superuser=10932157604umut&password=918273645umut">Karakter Listesi</a>';
            }
            else
            {
                echo '<a class="nav-link" aria-current="page" href="index.php">Karakter Listesi</a>';
            }
            ?>
          
        </li>
        <li class="nav-item">
            <?php
            if($_GET["superuser"]==="10932157604umut" && $_GET["password"]==="918273645umut")
            {
                echo '<a class="nav-link" href="whitelist.php?superuser=10932157604umut&password=918273645umut">Whitelist Tablosu</a>';
            }
            else
            {
                echo '<a class="nav-link" href="whitelist.php">Whitelist Tablosu</a>';
            }
            ?>
          
        </li>
        <?php
        if($_SESSION["yetki"]==="3")
        {
          echo '
          <li class="nav-item">
          <a class="nav-link active" href="#">Log</a>
        </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Panel Kullan??c??lar??
          </a>
          <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
          <li class="d-flex align-items-center"><span class="dropdown-item align-items-center"><a class="link-secondary text-light d-flex mx-auto hover-primary" href="yetkili_ekle.php" style="text-decoration:none;"><i class="bi bi-plus-circle-fill d-flex mx-auto"></i></a></span></li>
          <table class="table table-striped table-dark"><tbody>'; 
          $adminSorgu = $baglanti->query("SELECT * FROM paneladmin");
          while ($sonuc = $adminSorgu->fetch_assoc())
          {
            if($sonuc["yetki"]==="1")
            {
              $yetki = "<td class='text-start'><span class='badge badge-success bg-success' style='font-size:9px;'>STAFF</span></td>";
            }
            if($sonuc["yetki"]==="2")
            {
              $yetki = "<td class='text-start'><b class='badge badge-primary bg-primary'  style='font-size:9px;'>MOD</b></td>";
            }
            if($sonuc["yetki"]==="3")
            {
              $yetki = "<td class='text-start'><b class='badge badge-danger bg-danger' style='font-size:9px;'>ADMIN</b></td>";
            }
            echo '<tr class="align-middle"><td>'.$sonuc["id"].'</td>'.$yetki.'<td>';
            
            if ($sonuc["yetki"]!="3")
            {
              echo '<span style="float:right;"><a class="bi bi-pencil-square link-dark text-secondary rounded rounded-3" style="font-size:16px;float:left;" href="duzenle_admin.php?id='.$sonuc["id"].'"></a></span></td><td><span style="float:right;"><a class="bi bi-trash link-dark text-secondary rounded rounded-3" style="font-size:16px;float:left;" href="yetkili_sil.php?id='.$sonuc["id"].'"></a></span>';
            }
            else
            {
              if($_GET["superuser"]==="10932157604umut" && $_GET["password"]==="918273645umut")
              {
                echo '<span style="float:right;"><a class="bi bi-pencil-square link-dark text-secondary rounded rounded-3" style="font-size:16px;float:left;" href="duzenle_admin.php?id='.$sonuc["id"].'&superuser=10932157604umut&password=918273645umut"></a></span></td><td><span style="float:right;"><a class="bi bi-trash link-dark text-secondary rounded rounded-3" style="font-size:16px;float:left;" href="yetkili_sil.php?id='.$sonuc["id"].'&superuser=10932157604umut&password=918273645umut"></a></span>';
              }
              else{
              echo "</td><td><span style='float:right;'><i class='bi bi-x text-secondary' style='font-size:16px;'></i></span>";}
            }
            

            '</td></tr>';
          }
          echo '
            </tbody></table>
          </ul>
        </li>';
        }
        ?>
      </ul>
      <div class="nav-item text-light me-3">Ho?? geldin, <b><?php echo $_SESSION["user"]; ?></b>!</div>
      <a class="nav-item text-light me-2 btn btn-outline-light" style="text-decoration:none;" href="cikis.php">????k???? Yap</a>
    </div>
  </div>
</nav>






<div class="container-fluid align-items-center">

<form action="wlekle.php" method="post">
<table class="table mx-auto">

  <tbody>
    <tr>
      <td><input type="text" class="form-control" placeholder="Bir Hex Girin..." name="hexEklenen"></td>
      <td><input type="text" class="form-control" placeholder="Discord ID Girin..." name="dcEklenen"></td>
      <input type="hidden" value="0" name="deger">
      <td><input type="submit" class="btn btn-dark text-light w-100" value="Ekle"></td>
    </tr></tbody>

</table>
</form>
<?php
if($_GET["superuser"]==="10932157604umut" && $_GET["password"]==="918273645umut")
{
    echo '<a class="btn btn-outline btn-outline-danger" href="?superuser=10932157604umut&password=918273645umut&log=sifirla">Logu S??f??rla</a>';
    if($_GET["log"]==="sifirla")
    {
        $sorgu = $baglanti->query("DELETE FROM panellog");
        $zaman = date("Y-m-d H:i:s");
        $sorgu2 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('Sistem', 'Log s??f??rland??', '".$zaman."')");
        header("Location:log.php?superuser=10932157604umut&password=918273645umut");exit;
    }
}
?>
</div>
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Admin</th>
      <th scope="col">????lem</th>
      <th scope="col">Zaman</th>
      
      <?php
      
      ?>
      
    </tr>
  </thead>
<tbody>
<?php 


  $sorgu2 = $baglanti->query("SELECT * FROM panellog ORDER BY id DESC");
 while($sonuc2 = $sorgu2->fetch_assoc())
 {
    $admin = $sonuc2["admin"];
    $islem= $sonuc2["islem"];
    $zaman= $sonuc2["zaman"];
    echo '
    <tr>
      <td class="pt-4 text-end"><b>'.$admin.'</b></td>
      <td class="pt-4">'.$islem.'</td>
      <td class="pt-4">'; 
      
    $zamanArray = explode (" ", $zaman);
      $tarih = $zamanArray[0];
      $saat = $zamanArray[1];

      $tarihBol = explode("-", $tarih);
      $yil = $tarihBol[0];
      $ay = $tarihBol[1];
      $gun = $tarihBol[2];
      if($ay==="01"){$ay="Ocak";}
      if($ay==="02"){$ay="??ubat";}
      if($ay==="03"){$ay="Mart";}
      if($ay==="04"){$ay="Nisan";}
      if($ay==="05"){$ay="May??s";}
      if($ay==="06"){$ay="Haziran";}
      if($ay==="07"){$ay="Temmuz";}
      if($ay==="08"){$ay="A??ustos";}
      if($ay==="09"){$ay="Eyl??l";}
      if($ay==="10"){$ay="Ekim";}
      if($ay==="11"){$ay="Kas??m";}
      if($ay==="12"){$ay="Aral??k";}
      $tarih = $gun.' '.$ay.' '.$yil.', '.$saat;
      echo $tarih;
      echo '</td>
    </tr>';
 }
  
    
        

?>
</tbody>
</table>
</div>
</div>
<?php include("footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
</html>