<?php
$baglanti=mysqli_connect("localhost","root","","2018469023");
mysqli_set_charset($baglanti, "UTF8");

if (mysqli_connect_errno($baglanti)){
	echo "Bağlantı Hatası<br />";
	echo "Hata açıklaması : " .mysqli_connect_error();
	die();
}
$sorgu = mysqli_query($baglanti, "SELECT round(AVG(reytingler.total_puan),1) AS ortalama
FROM kanallar, diziler, yayin, reytingler
WHERE kanallar.kanal_id=diziler.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND kanallar.kanal_ad='Star TV'");
if ($sorgu){
	$totalOrt=mysqli_num_rows($sorgu);
	if ($totalOrt>0){
		$total = mysqli_fetch_assoc($sorgu);
		
		
		echo " " .$total["ortalama"]. "<br />";
		
	}else{
		echo "Kayıt Yok";
	}

}else{
	echo "Sorgu Hatası";
}
mysqli_close($baglanti);

?>