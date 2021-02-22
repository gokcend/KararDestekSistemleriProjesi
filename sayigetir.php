<?php
$baglanti=mysqli_connect("localhost","root","","2018469023");
mysqli_set_charset($baglanti, "UTF8");

if (mysqli_connect_errno($baglanti)){
	echo "Bağlantı Hatası<br />";
	echo "Hata açıklaması : " .mysqli_connect_error();
	die();
}
$sorgu = mysqli_query($baglanti, "SELECT COUNT(diziler.dizi_id) as dizi_sayısı
FROM kanallar,diziler
WHERE kanallar.kanal_id=diziler.kanal_id
AND kanallar.kanal_ad='Star TV'");
if ($sorgu){
	$diziSayisi=mysqli_num_rows($sorgu);
	if ($diziSayisi>0){
		$sayi = mysqli_fetch_assoc($sorgu);
		
		
		echo " " .$sayi["dizi_sayısı"]. "<br />";
		
	}else{
		echo "Kayıt Yok";
	}

}else{
	echo "Sorgu Hatası";
}
mysqli_close($baglanti);

?>