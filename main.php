<?php 
session_start();
 $connect = mysqli_connect("localhost", "root", "", "2018469023");  
 $query = "SELECT round(AVG(reytingler.total_puan),1) as total_ortalama, diziler.dizi_ad
FROM kanallar, diziler, yayin, reytingler
WHERE kanallar.kanal_id=diziler.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND kanallar.kanal_id=3
GROUP BY diziler.dizi_id";  
 $result = mysqli_query($connect, $query);  
 ?>  
<!DOCTYPE html>
<html>
<head>
<title>Dashboard Main</title>
<meta charset="utf-8">
<link href="maiinstyle.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js">
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<style>
#chart{
	display:flex;
}
</style>
<title>Webslesson Tutorial | Make Simple Pie Chart by Google Chart API with PHP Mysql</title>  
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Dizi Adı', 'Total'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["dizi_ad"]."', ".$row["total_ortalama"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Dizilerin Total Ortalaması',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>
<?php 
 $connect = mysqli_connect("localhost", "root", "", "2018469023");  
 $query1 = "SELECT round(AVG(reytingler.ab_puan),1) as ab_ortalama, diziler.dizi_ad
FROM kanallar, diziler, yayin, reytingler
WHERE kanallar.kanal_id=diziler.kanal_id
AND diziler.dizi_id=yayin.dizi_id
AND yayin.reyting_id=reytingler.reyting_id
AND kanallar.kanal_id=3
GROUP BY diziler.dizi_id";  
 $result1 = mysqli_query($connect, $query1);  
 ?>  
<title>Webslesson Tutorial | Make Simple Pie Chart by Google Chart API with PHP Mysql</title>  
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Dizi Adı', 'AB'],  
                          <?php  
                          while($row = mysqli_fetch_array($result1))  
                          {  
                               echo "['".$row["dizi_ad"]."', ".$row["ab_ortalama"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Dizilerin AB Ortalaması',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart1'));  
                chart.draw(data, options);  
           }  
           </script>
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
<div class="boxes">
<div id="box1" class="box">
Total 
</div>
<div id="box2" class="box">
AB
</div>
<div id="box3" class="box">
Toplam Dizi Sayısı
</div>
</div>
<div id="chart">
<br /><br />  
           <div style="width:500px;">  
                <br />  
                <div id="piechart" style="width: 500px; height: 500px; margin-left:30px;"></div>  
           </div> 

<br /><br />  
           <div style="width:500px;">  
                <br />  
                <div id="piechart1" style="width: 500px; height: 500px; margin-left:30px;"></div>  
           </div>  
</div>		   
</div>
</body>
<script>
$(document) .ready(function() {
	$.post ("getir.php",
	function(data,status) {
		$("#box1").html("Ortalama Total Puanı:"+data);
	}) ;
	$.post ("abgetir.php",
	function(data,status) {
		$("#box2").html("Ortalama AB Puanı:"+data);
	}) ;
	$.post ("sayigetir.php",
	function(data,status) {
		$("#box3").html("Toplam Dizi Sayısı:"+data);
	}) ;

}) ;
</script>
</html>
