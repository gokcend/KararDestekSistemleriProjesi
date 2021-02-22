<?php 
session_start();
$baglanti=mysqli_connect("localhost","root","","2018469023");
mysqli_set_charset($baglanti, "UTF8");
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard Main</title>
<meta charset="utf-8">
<link href="akrepstyle.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js">
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="sidebar"> 
<div class="sidebarTop">Yönetici Paneli</div>
<div class="info">
		<img class="avatar" src="<?php echo $_SESSION ["resim"] ?>">
		<span class="infoName"><?php echo $_SESSION ['ad']," ".$_SESSION['soyad'] ?></span>
</div>
<div class="mainNav">KATEGORİLER</div>
    <div class="dash">
	<a href="main.php" style="color:black; text-decoration: none;">
	<i class="fas fa-th"></i>
	<span>Dashboard</span>
      <i class="fas fa-angle-right"></i>
    </div></a>
	<div class="dropdown">
  <button class="diziler"><i class="fas fa-tv"></i>Diziler</button>
  <div class="dropdown-child">
    <a href="sefir.php">Sefirin Kızı</a>
    <a href="menajer.php">Menajerimi Ara</a>
    <a href="solyanim.php">Sol Yanım</a>
    <a href="akrep.php">Akrep</a>
	<h5>-Yakında-</h5>
	<a href="#">Seni Çok Bekledim</a>
  </div>
</div>
<div class="graf">
	<a href="grafik.php" style="color:black; text-decoration: none;">
	<i class="fas fa-chart-area"></i>
	<span>Grafikler</span>
      <i class="fas fa-angle-right"></i>
    </div></a>
</div>
<div class="content">
<div class="header"></div>
<div class="akrep">
<div id="columnSütunchart" style="width: 538px; height: 370px; float: right; "></div>
<div id="columnSütunchart1" style="width: 538px; height: 370px; float: right;"></div>
</div>
<div class="ramo">
<h3>Cuma Günü Ramo Dizisi Reytingleri</h3>
<div id="columnSütunchartR" style="width: 538px; height: 350px; float: right; "></div>
<div id="columnSütunchartRa" style="width: 538px; height: 350px; float: right;"></div>
</div>
<div class="arka">
<h3>Cuma Günü Arka Sokaklar Dizisi Reytingleri</h3>
<div id="columnSütunchartA" style="width: 538px; height: 350px; float: right; "></div>
<div id="columnSütunchartAa" style="width: 538px; height: 350px; float: right;"></div>
</div>
<div class="payitaht">
<h3>Cuma Günü Payitaht "Abdülhamid" Dizisi Reytingleri</h3>
<div id="columnSütunchartP" style="width: 538px; height: 350px; float: right; "></div>
<div id="columnSütunchartPa" style="width: 538px; height: 350px; float: right;"></div>
</div>
<div class="kirmizi">
<h3>Cuma Günü Kırmızı Oda Dizisi Reytingleri</h3>
<div id="columnSütunchartK" style="width: 538px; height: 350px; float: right; "></div>
<div id="columnSütunchartKa" style="width: 538px; height: 350px; float: right;"></div>
</div>
<div class="son">
<h3>Cuma Günü Son Yaz ve Akıncı Dizileri Reytingleri</h3>
<div id="columnSütunchartS" style="width: 269px; height: 350px; float: right; "></div>
<div id="columnSütunchartSa" style="width: 269px; height: 350px; float: right;"></div>
<div id="columnSütunchartAk" style="width: 269px; height: 350px; float: right; "></div>
<div id="columnSütunchartAkA" style="width: 269px; height: 350px; float: right;"></div>
</div>
</div>
</body>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'Total Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.total_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Akrep'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Akrep Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchart"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'AB Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.ab_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Akrep'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Akrep AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchart1"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'Total Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.total_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Ramo'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Show TV Ramo Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartR"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'AB Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.ab_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Ramo'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Show TV Ramo AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartRa"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'Total Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.total_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Arka Sokaklar'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Kanal D Arka Sokaklar Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartA"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'AB Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.ab_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Arka Sokaklar'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Kanal D Arka Sokaklar AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartAa"));
 chart_val.draw(data_val, options_val);
 }
 </script>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'Total Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.total_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Payitaht Abdülhamid'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'TRT1 Payitaht "Abdülhamid" Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartP"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'AB Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.ab_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Payitaht Abdülhamid'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'TRT1 Payitaht "Abdülhamid" AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartPa"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'Total Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.total_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Kırmızı Oda'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'TV8 Kırmızı Oda Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartK"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'AB Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.ab_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Kırmızı Oda'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'TV8 Kırmızı Oda AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartKa"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'Total Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.total_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Son Yaz'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'FOX TV Son Yaz Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartS"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'AB Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.ab_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Son Yaz'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'FOX TV Son Yaz AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartSa"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'Total Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.total_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Akıncı'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'ATV Akıncı Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartAk"));
 chart_val.draw(data_val, options_val);
 }
 </script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Bölüm', 'AB Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.ab_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Akıncı'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'ATV Akıncı AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartAkA"));
 chart_val.draw(data_val, options_val);
 }
 </script>
</html>
