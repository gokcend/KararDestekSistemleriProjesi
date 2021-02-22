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
<link href="grafstyle.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js">
  </script>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Hafta', 'Sefirin Kızı', 'Menajerimi Ara', 'Sol Yanım', 'Akrep'],
          ['14-20/12',  6.14,      3.56,         3.42,             4.18],
          ['21-27/12',  6.95,      4.11,        3.37,             3.91],
          ['28-03/12-01',  6.61,      4.25,        null,             4.94],
		  ['04-10/01',  null,      3.68,        3.15,             3.79],
		  ['11-17/01',  4.70,      3.70,        3.30,             3.94],
        ]);

        var options = {
          title : 'Haftalara Göre Star TV Dizileri Total Reytingleri',
          vAxis: {title: 'Total Reyting'},
          hAxis: {title: 'Haftalar'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Hafta', 'Sefirin Kızı', 'Menajerimi Ara', 'Sol Yanım', 'Akrep'],
          ['14-20/12',  6.02,      3.48,         2.36,             4.15],
          ['21-27/12',  5.46,      4.88,        2.16,             3.84],
          ['28-03/12-01',  5.29,      4.52,        null,             3.81],
		  ['04-10/01',  null,      5.42,        2.29,             2.64],
		  ['11-17/01',  3.43,      5.12,        2.71,             3.42],
        ]);

        var options = {
          title : 'Haftalara Göre Star TV Dizileri AB Reytingleri',
          vAxis: {title: 'AB Reyting'},
          hAxis: {title: 'Haftalar'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
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
<div id="chart_div" style="width: 900px; height: 500px; margin-top:5px; margin-left:80px;"></div>
<div id="chart_div2" style="width: 900px; height: 500px; margin-top:20px; margin-left:80px;"></div>
</div>
</body>
</html>