<?php
require('header.php');
require('function.php');

$content=file_get_contents('https://api.covid19india.org/data.json');
$content_arr=json_decode($content,true);
$len=count($content_arr['cases_time_series']);
?>

<html>
    <head>
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
          <?php for($i=12;$i>=1;$i--)
          {
              $date=$content_arr['cases_time_series'][$len-$i]['date'];
              ?>
          ['<?php echo $date?>',  <?php echo $content_arr['cases_time_series'][$len-$i]['totalconfirmed']?>],
          
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
          <?php for($i=12;$i>=1;$i--)
          {
              $date=$content_arr['cases_time_series'][$len-$i]['date'];
              ?>
          ['<?php echo $date?>',  <?php echo $content_arr['cases_time_series'][$len-$i]['totalrecovered']?>],
          
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
          <?php for($i=12;$i>=1;$i--)
          {
              $date=$content_arr['cases_time_series'][$len-$i]['date'];
              ?>
          ['<?php echo $date?>',  <?php echo $content_arr['cases_time_series'][$len-$i]['totaldeceased']?>],
          
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


      $(window).resize(function(){
     
     drawChart();
     drawChart1();
     drawChart2();
     drawChart3();
     drawChart4();
     drawChart5();
 });

 
</script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Roboto:ital@1&display=swap');
        #div2
        {
            background-image:url('images/recovered_cases.jpg');
        }
        p
        {
            text-align:center;
        }
        .container-fluid
        {
            height:150px;
            width:200px;
            border:1px solid black;
            box-shadow: 1px 1px 2px 2px grey;
            margin-bottom:8px;
            text-align:Center;
            padding:40px 0px;
        }
        #div
        {
            display:flex;
            flex-wrap:wrap;
        }
        .chart {
        width: 100%; 
        min-height: 450px;
        }
        .chart1 {
        width: 100%; 
        min-height: 450px;
        }
      .text
      {
        font-family: 'Roboto', sans-serif;
          text-align:center;
          color:Red;
          font-size:40px;
      }
     .para
     {
        font-family: 'Libre Baskerville', serif;
        font-family: 'Roboto', sans-serif;
     }
        </style>
        
</head>
<body>
    <br/>
    <br/>
    <div class="text">Statistical Analysis</div>
    <div id="curve_chart" class="chart" ></div>
    <p class="para"> Daily Confirmed Cases</P>
    <div id="curve_chart1" class="chart" ></div>
    </div>
    <p class="para"> Daily Recovered Cases</P>
    <div id="curve_chart2"  class="chart"></div>
    </div>
    <p class="para"> Daily Deceased Cases</P>
    <div id="curve_chart3"  class="chart"></div>
    </div>
    <p class="para">  Total Confirmed Cases</P>
    <div id="curve_chart4"  class="chart"></div>
    </div>
    <p class="para">  Total Recovered Cases</P>
    <div id="curve_chart5"  class="chart"></div>
    </div>
    <p class="para">  Total Deceased Cases</P>
</body>
<br/><br/>
<?php require('footer.php'); ?>
</html>