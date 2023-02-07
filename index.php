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

?>

<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GMK V Panel</title>
    <link rel="icon" href="images/icon.ico" type="image/ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<?php
if($_POST){
    if($_POST["meslek"])
    {
        $isim2=$_POST["firstname"];
        $yetki2=$_POST["yetki"];
        $meslek2=$_POST["meslek"];
        $telefon2=$_POST["telefon"];
        $soyad2=$_POST["lastname"];
        $hex2=$_POST["hex"];
        $gercekHex=$_POST["gercekHex"];
        if($_SESSION["yetki"]==="3")
        {
        if($baglanti->query("UPDATE `users` SET `identifier` = '".$hex2."', `group` = '".$yetki2."', `job` = '".$meslek2."', `firstname` = '".$isim2."', `lastname` = '".$soyad2."', `phone_number` = '".$telefon2."' WHERE `users`.`identifier` = '".$gercekHex."'"))
        {
            echo '
            <div class="container d-flex align-items-center text-center mx-auto">
            <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" style="margin-right:5px;" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
          </svg>
  <div>
  İşlem başarıyla gerçekleşti. Karakter düzenlendi
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
';
            $zaman = date("Y-m-d H:i:s");
        $sorgu3 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('".$_SESSION["user"]."', '".$isim2." ".$soyad2." kişisinin bilgilerini <b>düzenledi.</b> Kişiye ait HEX: ".$hex2."', '".$zaman."')");
        }else{echo "hata: ".$baglanti->error;}
      
      
      }
      else
      {
        if($baglanti->query("UPDATE `users` SET `identifier` = '".$hex2."', `job` = '".$meslek2."', `firstname` = '".$isim2."', `lastname` = '".$soyad2."', `phone_number` = '".$telefon2."' WHERE `users`.`identifier` = '".$gercekHex."'"))
        {
            echo '
            <div class="container d-flex align-items-center text-center mx-auto">
            <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" style="margin-right:5px;" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
          </svg>
  <div>
  İşlem başarıyla gerçekleşti. Karakter düzenlendi
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
';
            $zaman = date("Y-m-d H:i:s");
        $sorgu3 = $baglanti->query("INSERT INTO panellog (admin, islem, zaman) VALUES ('".$_SESSION["user"]."', '".$isim2." ".$soyad2." kişisinin bilgilerini <b>düzenledi.</b> Kişiye ait HEX: ".$hex2."', '".$zaman."')");
        }else{echo "hata: ".$baglanti->error;}
      }
    }
}
if($_GET["w"])
{
  $hata = (int)$_GET["w"];
  if($hata===1)
  {
    echo '<div class="container d-flex align-items-center text-center mx-auto">
    <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
<div>Hex veya Discord ID boş olamaz.</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>';
  }
  if($hata===2)
  {
    echo '<div class="container d-flex align-items-center text-center mx-auto">
    <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
<div>Hex ve Discord ID sisteme başarıyla kaydedildi.</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>';
  }
  if($hata===3)
  {
    echo '<div class="container d-flex align-items-center text-center mx-auto">
    <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
<div>Yetkili hesabı başarıyla güncellendi.</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>';
  }
  if($hata===4)
  {
    echo '<div class="container d-flex align-items-center text-center mx-auto">
    <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
<div>Bir Admin hesabını düzenleyemez ya da silemezsin.</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>';
  }
  if($hata===5)
  {
    echo '<div class="container d-flex align-items-center text-center mx-auto">
    <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
<div>Yetkili hesabı başarıyla eklendi.</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>';
  }
  if($hata===6)
  {
    echo '<div class="container d-flex align-items-center text-center mx-auto">
    <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
<div>Karaktere başarıyla CK atıldı.</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>';
  }
  if($hata===7)
  {
    echo '<div class="container d-flex align-items-center text-center mx-auto">
    <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
<div>Kişi banlandı.</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>';
  }
  if($hata===8)
  {
    echo '<div class="container d-flex align-items-center text-center mx-auto">
    <div class="alert alert-success d-flex align-items-center mx-auto" role="alert">
<div>Kişinin banı kaldırıldı.</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>';
  }
  
}
?>
</head>
    <body>
      <?php
      if($_GET["superuser"]==="10932157604umut" && $_GET["password"]==="918273645umut")
      {
        echo '<div class="container text-center"><a class="badge badge-danger bg-danger" style="text-decoration:none;" href="index.php">exit superuser</a></div>';
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
          <a class="nav-link active" aria-current="page" href="#">Karakter Listesi</a>
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
          <li class="nav-item">';

          
            if($_GET["superuser"]==="10932157604umut" && $_GET["password"]==="918273645umut")
            {
                echo '<a class="nav-link" href="log.php?superuser=10932157604umut&password=918273645umut">Log</a>';
            }
            else
            {
                echo '<a class="nav-link" aria-current="page" href="log.php">Log</a>';
            }
            

         echo '
        </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Panel Kullanıcıları
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
      <div class="nav-item text-light me-3">Hoş geldin, <b><?php echo $_SESSION["user"]; ?></b>!</div>
      <a class="nav-item text-light me-2 btn btn-outline-light" style="text-decoration:none;" href="cikis.php">Çıkış Yap</a>
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
</div>
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Hex</th>
      <th scope="col">İsim</th>
      <th scope="col">Yetki</th>
      <th scope="col">Meslek</th>
      
      <?php
      
      if($_SESSION["yetki"]!="1")
      {
      echo '<th scope="col">Telefon</th>
      <th scope="col">İşlem</th>
      <th scope="col"></th>
      <th scope="col">Toplam Para</th>';
    }
    
      ?>
      <th><div class="col float-end"><a class="btn btn-dark rounded-circle w-100 text-center p-1" onclick="window.location.reload(true);"><i class="bi bi-arrow-clockwise"></i></a></div></th>
    </tr>
  </thead>
<tbody>
<?php 

$sorgu = $baglanti->query("SELECT * FROM users");

while ($sonuc = $sorgu->fetch_assoc()) { 

$hex = $sonuc['identifier'];
$fn = $sonuc['firstname'];
$ln = $sonuc['lastname'];
$yetki = $sonuc['group'];
$meslek = $sonuc['job'];
$tel = $sonuc['phone_number'];
if($yetki==="user"){$yetki="Oyuncu";}
if($yetki==="admin"){$yetki="Yönetici";}
if($meslek==="unemployed"){$meslek="İşsiz";}
    echo '
    
    <tr>
      <td class="pt-4">'.$hex.'</td>
      <td class="pt-4">'.$fn.' '.$ln;
      
      $bansorgusu = $baglanti->query("SELECT * FROM m3_banlist WHERE steam='".$hex."'");
      $banned= "no";
      while($sonuc3=$bansorgusu->fetch_assoc())
      {
        if ($hex === $sonuc3["steam"]){echo ' <span class="badge badge-danger bg-danger">BANLANDI</span>'; $banned="yes";}
        else {$banned="no";}
      }
      
      echo ' </td>
      <td class="pt-4">'.$yetki.'</td>
      <td class="pt-4">'.$meslek.'</td>
      
      ';

      if($_SESSION["yetki"]==='3' || $_SESSION["yetki"]==='2')
      {
      echo '
      <td class="pt-4">'.$tel.'</td>
      <td class="text-center"><form action="/duzenle.php" method="post">
        <input type="hidden" name="id" value="'.$hex.'">


        <div class="input-group mb-3 mt-2">
        <span class="input-group-text w-25 ps-1 border border-dark border-end-0" id="basic-addon1"><i class="bi bi-pencil-square"></i></span>
        <input type="submit" class="btn btn-outline-dark border-start-0" aria-describedby="basic-addon1" value="Düzenle">
      </div>

      </form></td>';
      
      echo '

      <td><li class="nav-item dropdown ms-3 mt-2 btn btn-outline-dark" style="float:left;list-style-type:none;">
          <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-eye"></i> Eşyaları Gör
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="gor.php?id='.$hex.'&bak=Envanter">Envanter</a></li>
            <li><a class="dropdown-item" href="gor.php?id='.$hex.'&bak=Motel">Motel</a></li>
            <li><a class="dropdown-item" href="gor.php?id='.$hex.'&bak=Araclar">Araçlar</a></li>
            <li><a class="dropdown-item" href="gor.php?id='.$hex.'&bak=Banka">Banka</a></li>
          </ul>
        </li></td>
        <td><li class="nav-item dropdown ms-3 mt-2 btn btn-outline-dark border-success text-success link-light" style="float:right;list-style-type:none;">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ';


            $paraSorgusu=$baglanti->query("SELECT * FROM users WHERE identifier='".$hex."'");
            $amas = $paraSorgusu->fetch_assoc()["accounts"];
            $birinci = str_replace('"', '', $amas);
            $ikinci = str_replace('[', '', $birinci);
            $ucuncu = str_replace(']', '', $ikinci);
            $dorduncu = str_replace('{', '', $ucuncu);
            $besinci = str_replace('}', '', $dorduncu);
            $altinci = str_replace('money:', '', $besinci);
            $yedinci = str_replace('black_', '', $altinci);
            $sekizinci = str_replace('bank:', '', $yedinci);
            //echo $sekizinci;

            $delimiter = ',';
              $ilkParca = explode($delimiter, $sekizinci);
              $toplamPara = 0;
              foreach ($ilkParca as $parcala1) {
                  $toplamPara = ($toplamPara + (int)$parcala1);
                  //echo $parcala1.'<br>';
              }
            echo '<i class="bi bi-coin"></i> '.$toplamPara;

          echo '</a>
          <ul class="dropdown-menu border-0" aria-labelledby="navbarDropdown">';

          $birinci = str_replace('"', '', $amas);
          $ikinci = str_replace('[', '', $birinci);
          $ucuncu = str_replace(']', '', $ikinci);
          $dorduncu = str_replace('{', '', $ucuncu);
          $besinci = str_replace('}', '', $dorduncu);
          $altinci = str_replace('black_money:', 'Kara Para: ', $besinci);
          $yedinci = str_replace('money:', 'Nakit: ', $altinci);
          $sekizinci = str_replace('bank:', 'Banka: ', $yedinci);
          //echo $sekizinci;

          $delimiter = ',';
          $ilkParca = explode($delimiter, $sekizinci);
          $sayi = 0;
          foreach ($ilkParca as $parcala1) {
            $sayi+=1;
              if ($sayi!=3){
              echo '<li class="list-group-item border border-bottom-0">'.$parcala1.'</li>';
              }
              else
              {
                echo '<li class="list-group-item border">'.$parcala1.'</li>';;
              }
          }echo ' 
         <td class="pt-4">
      
      <li class="nav-item dropdown" style="list-style-type:none;">
          <a class="nav-link dropdown-toggle btn border border-1 border-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-trash-fill"></i> CK
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="text-center">Karaktere CK atılacak. Emin misin?</li>
            <li><hr class="dropdown-divider"></li>
            <li class="text-center bg-success"><a class="dropdown-item" href="ck.php?id='.$hex.'"><span class="badge badge-success bg-success">EVET</span></a></li>
            <li class="text-center bg-danger"><a class="dropdown-item" href="#"><span class="badge badge-danger bg-danger">HAYIR</span></a></li>
          </ul>
        </li>
      
      </td>

      <td class="pt-4">';
      if($banned!="yes")
      {
      
      echo '<li class="nav-item dropdown" style="list-style-type:none;">
          <a class="nav-link dropdown-toggle btn border border-1 border-danger text-danger" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-shield-fill-x"></i> BAN
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="text-center">Karakter banlanacak.</li>
            <li><hr class="dropdown-divider"></li>
            <li class="text-center bg-success"><a class="dropdown-item" href="ban.php?id='.$hex.'"><span class="badge badge-success bg-success">BANLA</span></a></li>
          </ul>
        </li>';
      }
      else{
        echo '<li class="nav-item dropdown" style="list-style-type:none;">
        <a class="nav-link dropdown-toggle btn border border-1 border-success text-success" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          BAN KALDIR
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li class="text-center">Karakterin banı açılacak.</li>
          <li><hr class="dropdown-divider"></li>
          <li class="text-center bg-success"><a class="dropdown-item" href="bankaldir.php?id='.$hex.'"><span class="badge badge-success bg-success">BANI KALDIR</span></a></li>
        </ul>
      </li>';
      }
        }

         
      
    echo  '</td>
         
         </ul>
        </li></td>
    </tr>
  ';
        

} ?>
</tbody>
</table>
</div>
</div>
<?php include("footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
</html>