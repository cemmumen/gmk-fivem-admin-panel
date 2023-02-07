<?php
include("gmk_dbconn.php");
session_start();
ob_start();
$hex=$_GET["id"];
$bak=$_GET["bak"];

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
    </head>
    <body><div class="container">
    <div class="card d-flex mx-auto mt-3" style="width: 18rem;">
    <div class="card-header">
    <a href="index.php" class="btn btn-dark link-light" style="float:left;">< Geri</a>
    <div class="mt-2" style="float:right;">

    <?php
    $adSorgusu=$baglanti->query("SELECT * FROM users WHERE identifier='".$hex."'");
    $sonucumuz = $adSorgusu->fetch_assoc();
    echo $sonucumuz["firstname"].' '.$sonucumuz["lastname"];
    ?>

    </div>
  </div>
  <ul class="list-group list-group-flush">
<?php
if ($bak==="Envanter"){
    $sorgu=$baglanti->query("SELECT inventory FROM users WHERE identifier='".$hex."'");
    $sonuc=$sorgu->fetch_assoc();
$delimiter = '{';
$ilkParca = explode($delimiter, $sonuc["inventory"]);
 
foreach ($ilkParca as $parcala1) {
    $delimiter2='}';
    $ikinciParca = explode($delimiter2, $parcala1);
    foreach($ikinciParca as $parcala2){

        $delimiter3 = ',';
        $ucuncuParca= explode($delimiter3,$parcala2);
        foreach($ucuncuParca as $parcala3){
            $delimiter4 = '"';
        $dorduncuParca= explode($delimiter4,$parcala3);
        foreach($dorduncuParca as $parcala4){
            $delimiter5 = ':';
        $besinciParca= explode($delimiter5,$parcala4);
        foreach($besinciParca as $parcala5){

            if($parcala5!=""){

            
            if (!(int)$parcala5){
                echo '<li class="list-group-item">';
                echo ucfirst($parcala5).' : ';
            }
            
            if ((int)$parcala5){
                echo $parcala5."</li>";
            }
        }
            
        }
        }
        }

    }
}


    //echo '<li class="list-group-item">'.$sonuc["inventory"].'</li>';
}
if ($bak==="Motel"){
    $sorgu=$baglanti->query("SELECT data FROM m3_inv_stashs WHERE owner='".$hex."'");
    $sonuc=$sorgu->fetch_assoc();


    $delimiter = '},';
        $ilkParca = explode($delimiter, $sonuc["data"]);
         
        foreach ($ilkParca as $parcala1) {
           

            $birinci = str_replace('"', '', $parcala1);
            $ikinci = str_replace('[', '', $birinci);
            $ucuncu = str_replace(']', '', $ikinci);
            $dorduncu = str_replace('{', '', $ucuncu);
            $besinci = str_replace('}', '', $dorduncu);
            $altinci = str_replace(',', '<br>', $besinci);
            $bolMotel = explode ("<br>", $altinci); 
            $veriMotel = "";
            for($i=0; $i<=count($bolMotel); $i++)
            {
                //echo $bolMotel[$i].'<br>';
                if(strpos($bolMotel[$i], "type:") !== false || strpos($bolMotel[$i], "weight:") !== false){
                    $veriMotel=$veriMotel;
                } else{
                    if(strpos($bolMotel[$i], "name:") !== false){
                    $nameReplace = str_replace('name:', '(', $bolMotel[$i]);
                    $veriMotel = $veriMotel.'<span style="font-size:12px;">'.$nameReplace.')</span><br>';
                }
                else{
                    if ($bolMotel[$i]!=""){
                        $veriMotel=$veriMotel.' '.$bolMotel[$i].'<br>';
                    }
                    
                }
                }

                

            



            }
            $countSil = str_replace('count:', '', $veriMotel);
            $labelSil = str_replace('label:', '', $countSil);
            $sonBolum = explode("<br>", $labelSil);
            for ($i=0; $i<=count($sonBolum); $i++)
            {
                
            if(strpos($sonBolum[$i], "(") !== false)
            {
                $name = $sonBolum[$i];
            }
            else if((int)$sonBolum[$i])
            {
                $count = $sonBolum[$i];
            }
            else if((string)$sonBolum[$i])
            {
                $baslik = $sonBolum[$i];
            }
            }


            echo '<li class="list-group-item">'.$name.'<br>'.$baslik.':'.$count.'</li>';
            
        }



    //echo $sonuc["data"];
}
if ($bak==="Araclar"){
    $sorgu=$baglanti->query("SELECT plate FROM owned_vehicles WHERE owner='".$hex."'");
    while($sonuc=$sorgu->fetch_assoc()){
        echo '<div class="list-group-item" style="float:left;display:inline;">'.$sonuc["plate"].'
        
        <div class="nav-item dropdown" style="list-style-type:none;float:right;display:inline;">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Torpido
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="card-header">Torpido</li>
            <li>';
            
            $sorgu2=$baglanti->query("SELECT data FROM m3_inv_gloveboxs WHERE plate LIKE'%".$sonuc["plate"]."%'");
            $sonuc2=$sorgu2->fetch_assoc();
            //echo $sonuc2["data"];
            $delimiter = '{';
                $ilkParca = explode($delimiter, $sonuc2["data"]);
                 
                foreach ($ilkParca as $parcala1) {
                    $birinci = str_replace('"', '', $parcala1);
            $ikinci = str_replace('[', '', $birinci);
            $ucuncu = str_replace(']', '', $ikinci);
            $dorduncu = str_replace('{', '', $ucuncu);
            $besinci = str_replace('}', '', $dorduncu);
            $altinci = str_replace(',', '<br>', $besinci);
            echo '<li class="list-group-item">'.$altinci.'</li>';
                }
            if (!$sonuc2["data"]){echo "Torpido boş.";}
            echo'</li>


          </ul>
        </div>
        <div class="nav-item dropdown me-2" style="list-style-type:none;float:right;display:inline;">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Bagaj
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="card-header">Bagaj</li>
            <li>';
            $sorgu3=$baglanti->query("SELECT data FROM m3_inv_trunks WHERE plate LIKE'%".$sonuc["plate"]."%'");
            $sonuc3=$sorgu3->fetch_assoc();
            //echo $sonuc3["data"];
            $delimiter = '{';
                $ilkParca = explode($delimiter, $sonuc3["data"]);
                 
                foreach ($ilkParca as $parcala1) {
                    $birinci = str_replace('"', '', $parcala1);
            $ikinci = str_replace('[', '', $birinci);
            $ucuncu = str_replace(']', '', $ikinci);
            $dorduncu = str_replace('{', '', $ucuncu);
            $besinci = str_replace('}', '', $dorduncu);
            $altinci = str_replace(',', '<br>', $besinci);
            echo '<li class="list-group-item">'.$altinci.'</li>';
                }
            if (!$sonuc3["data"]){echo "Bagaj boş.";}
            echo '
            </li>
          </ul>
        </div>
        
        </div>
        
        
        ';
    }
}
if ($bak==="Banka"){
    $sorgu=$baglanti->query("SELECT accounts FROM users WHERE identifier='".$hex."'");
    $sonuc=$sorgu->fetch_assoc();
    $birinci = str_replace('"', '', $sonuc["accounts"]);
            $ikinci = str_replace('[', '', $birinci);
            $ucuncu = str_replace(']', '', $ikinci);
            $dorduncu = str_replace('{', '', $ucuncu);
            $besinci = str_replace('}', '', $dorduncu);
            $altinci = str_replace(',', '<br>', $besinci);
            echo '<li class="list-group-item">'.$altinci.'</li>';
}
?>
</ul></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>