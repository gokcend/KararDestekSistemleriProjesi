<?php
session_start();
$baglanti=mysqli_connect("localhost","root","","2018469023");
if($baglanti){
if($_POST){
if(strip_tags(trim(isset($_POST["eposta"])))){
$eposta=$_POST["eposta"];
}
if(strip_tags(trim(isset($_POST["sifre"])))){
$sifre=$_POST["sifre"];
}
$sorgu=mysqli_query($baglanti,"SELECT * FROM kullanici WHERE eposta='".$eposta."' AND sifre='".$sifre."'");

if(mysqli_num_rows($sorgu)>0){
$row=mysqli_fetch_assoc($sorgu);
session_regenerate_id();
$_SESSION['loggedin'] = FALSE;
$_SESSION['gelenid'] = $row["kullanici_id"];
$_SESSION['ad'] = $row["ad"];
$_SESSION['soyad'] = $row["soyad"];
$_SESSION['resim'] = $row["avatar"];
echo 1;
}else{
echo 0;
}
mysqli_close($baglanti);
}else{
echo "Veriler Gelmedi";
}

}else {
die("Bağlantı Sağlanamadı");
};

?>