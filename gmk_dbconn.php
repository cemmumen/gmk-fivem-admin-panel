<?php
//DÜZENLENECEK BÖLGE BAŞLANGICI
$sunucu = 'localhost';
$mysql_kullanici_adi = 'root';
$mysql_sifre = '12345678';
$veritabani = 'essentialmode';
//DÜZENLENECEK BÖLGE SONU



@$baglanti = new mysqli($sunucu, $mysql_kullanici_adi, $mysql_sifre, $veritabani);
if(mysqli_connect_error())
{
    echo mysqli_connect_error();
    exit;
}

$baglanti->set_charset("utf8");
?>