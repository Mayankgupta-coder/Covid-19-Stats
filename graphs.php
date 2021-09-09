<?php
require('header.php');
require('function.php');

$content=file_get_contents('https://api.covid19india.org/data.json');
$content_arr=json_decode($content,true);
$len=count($content_arr['cases_time_series']);
$len1=count($content_arr['tested']);


$content1=file_get_contents('https://indiancovid-19.herokuapp.com/covid_data.json');
$content_arr1=json_decode($content1,true);

$l= count($content_arr1);

?>

<html>
    <head>
    <link rel="stylesheet" href="styling/graph.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    

//   Daily Confirmed
google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Cases', ''],
          <?php for($i=12;$i>=1;$i--)
          {
              $date=$content_arr['cases_time_series'][$len-$i]['date'];
              ?>
          ['<?php echo $date?>',  <?php echo $content_arr['cases_time_series'][$len-$i]['dailyconfirmed']?>],
          
          <?php
          }
          ?>
        ]);

        var options = {
          
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
        
      }

    //   Daily recoverd

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart1);

      function drawChart1() {
        var data1 = google.visualization.arrayToDataTable([
          ['Cases', ''],
          <?php for($i=12;$i>=1;$i--)
          {
              $date=$content_arr['cases_time_series'][$len-$i]['date'];
              ?>
          ['<?php echo $date?>',  <?php echo $content_arr['cases_time_series'][$len-$i]['dailyrecovered']?>],
          
          <?php
          }
          ?>
        ]);

        var options1 = {
          
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart1'));

        chart1.draw(data1, options1);
        
      }

    //   Daily Deceased
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {
        var data2 = google.visualization.arrayToDataTable([
          ['Cases', ''],
          <?php for($i=12;$i>=1;$i--)
          {
              $date=$content_arr['cases_time_series'][$len-$i]['date'];
              ?>
          ['<?php echo $date?>',  <?php echo $content_arr['cases_time_series'][$len-$i]['dailydeceased']?>],
          
          <?php
          }
          ?>
        ]);

        var options2= {
          
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart2 = new google.visualization.LineChart(document.getElementById('curve_chart2'));

        chart2.draw(data2, options2);
        
      }


    //   Total Confirmed
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {
        var data3 = google.visualization.arrayToDataTable([
          ['Cases', ''],
          <?php for($i=4;$i>=1;$i--)
          {
              $date=$content_arr1[$l-$i]['date'];
              ?>
          ['<?php echo $date?>',  <?php echo $content_arr1[$l-$i]['temp_confirm']?>],
          
          <?php
          }
          ?>
        ]);

        var options3 = {
          
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart3 = new google.visualization.LineChart(document.getElementById('curve_chart3'));

        chart3.draw(data3, options3);
        
      }
      
        // Total Recovered
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart4);

      function drawChart4() {
        var data4 = google.visualization.arrayToDataTable([
          ['Cases', ''],
          <?php for($i=4;$i>=1;$i--)
          {
              $date=$content_arr1[$l-$i]['date'];
              ?>
          ['<?php echo $date?>',  <?php echo $content_arr1[$l-$i]['temp_recover']?>],
          
          <?php
          }
          ?>
        ]);

        var options4= {
          
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart4 = new google.visualization.LineChart(document.getElementById('curve_chart4'));

        chart4.draw(data4, options4);
        
      }


    //   Total Deceased

    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart5);

      function drawChart5() {
        var data5 = google.visualization.arrayToDataTable([
          ['Cases', ''],
          <?php for($i=4;$i>=1;$i--)
          {
              $date=$content_arr1[$l-$i]['date'];
              ?>
          ['<?php echo $date?>',  <?php echo $content_arr1[$l-$i]['temp_deceased']?>],
          
          <?php
          }
          ?>
        ]);

        var options5= {
          
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart5 = new google.visualization.LineChart(document.getElementById('curve_chart5'));

        chart5.draw(data5, options5);
        
      }


 //   Total Registration

 google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart6);

      function drawChart6() {
        var data6 = google.visualization.arrayToDataTable([
          ['registration', ''],
          <?php for($i=12;$i>=1;$i--)
          {
              $date=$content_arr['tested'][$len1-$i]['testedasof'];
              ?>
          ['<?php echo $date?>',  <?php echo $content_arr['tested'][$len1-$i]['totalindividualsregistered']?>],
          
          <?php
          }
          ?>
        ]);

        var options6= {
          
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart6 = new google.visualization.LineChart(document.getElementById('curve_chart6'));

        chart6.draw(data6, options6);
        
      }

      //   Total vaccination

 google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart7);

      function drawChart7() {
        var data7 = google.visualization.arrayToDataTable([
          ['registration', ''],
          <?php for($i=12;$i>=1;$i--)
          {
              $date=$content_arr['tested'][$len1-$i]['testedasof'];
              ?>
          ['<?php echo $date?>',  <?php echo $content_arr['tested'][$len1-$i]['totalindividualsvaccinated']?>],
          
          <?php
          }
          ?>
        ]);

        var options7= {
          
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart7 = new google.visualization.LineChart(document.getElementById('curve_chart7'));

        chart7.draw(data7, options7);
        
      }

      $(window).resize(function(){
     
     drawChart();
     drawChart1();
     drawChart2();
     drawChart3();
     drawChart4();
     drawChart5();
     drawChart6();
     drawChart7();
 });

 
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">      
</head>
<body>
    <br/>
    <br/>
    <div class="text">Statistical Analysis</div>
     <div class="chart_div">
     
      <!-- <div class="chart_div_class">
      <div id="curve_chart" class="chart" ></div>
      <p class="para"> Daily Confirmed Cases</P>
      </div>

      <div class="chart_div_class">
      <div id="curve_chart1" class="chart" ></div>
      <p class="para"> Daily Recovered Cases</P>
      </div> -->
     </div>

     <div class="chart_div">
    <div class="chart_div_class">
    <div id="curve_chart2"  class="chart"></div>
    <p class="para"> Daily Deceased Cases</P>
    </div>

    <div class="chart_div_class">
    <div id="curve_chart3"  class="chart"></div>
    <p class="para">  Total Confirmed Cases</P>
    </div>
</div>

<div class="chart_div">
  <div class="chart_div_class">
      <div id="curve_chart4"  class="chart"></div>
      <p class="para">  Total Recovered Cases</P>
      </div>

      <div class="chart_div_class">
      <div id="curve_chart5"  class="chart"></div>
      <p class="para">  Total Deceased Cases</P>
  </div>
</div>
  </div>

  <div class="chart_div">
  <!-- <div class="chart_div_class">
      <div id="curve_chart6"  class="chart"></div>
      <p class="para">  Total Individuals Registered For Vaccination</P>
      </div> -->

      <!-- <div class="chart_div_class">
      <div id="curve_chart7"  class="chart"></div>
      <p class="para">  Total Individuals Vaccinated</P>
      </div> -->
  </div>
</div>
</body>
<br/><br/>
<?php require('footer.php'); ?>
</html>