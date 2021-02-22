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
<link href="sefiirstyle.css" rel="stylesheet">
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
<div class="sefir">
<div id="columnSütunchart" style="width: 540px; height: 500px; float: right; "></div>
<div id="columnSütunchart1" style="width: 540px; height: 500px; float: right;"></div>
</div>
<div class="total">
<h3>Pazartesi Günü Total Reytingleri</h3>
<div id="columnSütunchartC" style="width:360px; height: 435px; float: left;"></div>
<div id="columnSütunchartY" style="width:360px; height: 435px; float: left;"></div>
<div id="columnSütunchartU" style="width:360px; height: 435px; float: left;"></div>
</div>
<div class="ab">
<h3>Pazartesi Günü AB Reytingleri</h3>
<div id="columnSütunchartCa" style="width:360px; height: 435px; float: left;"></div>
<div id="columnSütunchartYa" style="width:360px; height: 435px; float: left;"></div>
<div id="columnSütunchartUa" style="width:360px; height: 435px; float: left;"></div>
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
AND diziler.dizi_ad='Sefirin Kizi'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Sefirin Kızı Total Puanları'
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
AND diziler.dizi_ad='Sefirin Kizi'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Sefirin Kızı AB Puanları'
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
AND diziler.dizi_ad='Çukur'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Show TV Çukur Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartC"));
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
AND diziler.dizi_ad='Yasak Elma'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'FOX TV Yasak Elma Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartY"));
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
AND diziler.dizi_ad='Uyanış: Büyük Selçuklu'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'TRT1 Uyanış: Büyük Selçuklu Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartU"));
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
AND diziler.dizi_ad='Çukur'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Show TV Çukur AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartCa"));
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
AND diziler.dizi_ad='Yasak Elma'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'FOX TV Yasak Elma AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartYa"));
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
AND diziler.dizi_ad='Uyanış: Büyük Selçuklu'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'TRT1 Uyanış: Büyük Selçuklu AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartUa"));
 chart_val.draw(data_val, options_val);
 }
 </script>
</html>
