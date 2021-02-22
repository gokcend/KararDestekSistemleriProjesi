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
<link href="menajerstyle.css" rel="stylesheet">
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
<div class="menajer">
<div id="columnSütunchart" style="width: 540px; height: 500px; float: right; "></div>
<div id="columnSütunchart1" style="width: 540px; height: 500px; float: right;"></div>
</div>
<div class="total">
<h3>Pazar Günü Total Reytingleri</h3>
<div id="columnSütunchartA" style="width:540px; height: 435px; float: left;"></div>
<div id="columnSütunchartK" style="width:540px; height: 435px; float: left;"></div>
</div>
<div class="ab">
<h3>Pazar Günü AB Reytingleri</h3>
<div id="columnSütunchartAa" style="width:540px; height: 435px; float: left;"></div>
<div id="columnSütunchartKa" style="width:540px; height: 435px; float: left;"></div>
</div>
<div class="total2">
<h3>Pazar Günü Total Reytingleri</h3>
<div id="columnSütunchartT" style="width:540px; height: 435px; float: left;"></div>
<div id="columnSütunchartH" style="width:540px; height: 435px; float: left;"></div>
</div>
<div class="ab2">
<h3>Pazar Günü AB Reytingleri</h3>
<div id="columnSütunchartTa" style="width:540px; height: 435px; float: left;"></div>
<div id="columnSütunchartHa" style="width:540px; height: 435px; float: left;"></div>
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
AND diziler.dizi_ad='Menajerimi Ara'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Menajerimi Ara Total Puanları'
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
AND diziler.dizi_ad='Menajerimi Ara'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Menajerimi Ara AB Puanları'
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
AND diziler.dizi_ad='Arıza'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Show TV Arıza Total Puanları'
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

 ['Bölüm', 'Total Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.total_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Kefaret'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'FOX TV Kefaret Total Puanları'
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

 ['Bölüm', 'Total Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.total_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Tövbeler Olsun'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'TRT1 Tövbeler Olsun Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartT"));
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
AND diziler.dizi_ad='Arıza'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'Show TV Arıza AB Puanları'
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

 ['Bölüm', 'AB Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.ab_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Kefaret'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'FOX TV Kefaret AB Puanları'
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

 ['Bölüm', 'AB Puan'],
 <?php 
 $select_query = "SELECT yayin.bolum, reytingler.ab_puan
FROM diziler,yayin,reytingler
WHERE diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND diziler.dizi_ad='Tövbeler Olsun'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'TRT1 Tövbeler Olsun AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartTa"));
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
AND diziler.dizi_ad='Hercai'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['total_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'ATV Hercai Total Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartH"));
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
AND diziler.dizi_ad='Hercai'
ORDER BY yayin.bolum";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['bolum']."',".$row_val['ab_puan']."],";
 }
 ?>
 
 ]);

 var options_val = {
 title: 'ATV Hercai AB Puanları'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchartHa"));
 chart_val.draw(data_val, options_val);
 }
 </script>
</html>
