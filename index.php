<?php
require('header.php');

$content=file_get_contents('https://api.covid19india.org/data.json');
$content_arr=json_decode($content,true);
$len=count($content_arr['cases_time_series']);
function money_format($format, $number)
{
    $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'.
              '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
    if (setlocale(LC_MONETARY, 0) == 'C') {
        setlocale(LC_MONETARY, '');
    }
    $locale = localeconv();
    preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
    foreach ($matches as $fmatch) {
        $value = floatval($number);
        $flags = array(
            'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
                           $match[1] : ' ',
            'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
            'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
                           $match[0] : '+',
            'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
            'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
        );
        $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
        $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
        $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
        $conversion = $fmatch[5];

        $positive = true;
        if ($value < 0) {
            $positive = false;
            $value  *= -1;
        }
        $letter = $positive ? 'p' : 'n';

        $prefix = $suffix = $cprefix = $csuffix = $signal = '';

        $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
        switch (true) {
            case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
                $prefix = $signal;
                break;
            case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
                $suffix = $signal;
                break;
            case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
                $cprefix = $signal;
                break;
            case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
                $csuffix = $signal;
                break;
            case $flags['usesignal'] == '(':
            case $locale["{$letter}_sign_posn"] == 0:
                $prefix = '(';
                $suffix = ')';
                break;
        }
        if (!$flags['nosimbol']) {
            $currency = $cprefix .
                        ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
                        $csuffix;
        } else {
            $currency = '';
        }
        $space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';

        $value = number_format($value, $right, $locale['mon_decimal_point'],
                 $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
        $value = @explode($locale['mon_decimal_point'], $value);

        $n = strlen($prefix) + strlen($currency) + strlen($value[0]);
        if ($left > 0 && $left > $n) {
            $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
        }
        $value = implode($locale['mon_decimal_point'], $value);
        if ($locale["{$letter}_cs_precedes"]) {
            $value = $prefix . $currency . $space . $value . $suffix;
        } else {
            $value = $prefix . $value . $space . $currency . $suffix;
        }
        if ($width > 0) {
            $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
                     STR_PAD_RIGHT : STR_PAD_LEFT);
        }

        $format = str_replace($fmatch[0], $value, $format);
    }
    return explode(".",$format);
}
?>

<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
  
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

      $(window).resize(function(){
     
     drawChart();
     drawChart1()
     drawChart2();
 });
</script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
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
            height:200px;
            width:300px;
            border:1px solid black;
            box-shadow: 3px 3px grey;
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
          text-align:center;
          color:Red;
          font-size:40px;
      }
        </style>
        
</head>
<body>
  <?php
$confirm = $content_arr['cases_time_series'][$len-1]['totalconfirmed'];
setlocale(LC_MONETARY, 'en_IN');
$confirm = money_format('%!i', $confirm);


$recover= $content_arr['cases_time_series'][$len-1]['totalrecovered'];
setlocale(LC_MONETARY, 'en_IN');
$recover = money_format('%!i', $recover);


$deceased = $content_arr['cases_time_series'][$len-1]['totaldeceased'];
setlocale(LC_MONETARY, 'en_IN');
$deceased = money_format('%!i', $deceased);

?>
<br/>
<div class="text">Covid-19 Data</div>
<br/>
<div id="div">
<div class="container-fluid">
<b>CONFIRMED CASES</b>
<br/>
<br/>
<b><?php echo $confirm[0] ?></b>
</div>
<div class="container-fluid">
<b>RECOVERED CASES</b>
<br/>
<br/>
<b><?php echo $recover[0] ?></b>
</div>
<div class="container-fluid">
<b>DECEASED CASES</b>
<br/>
<br/>
<b><?php echo $deceased[0]?></b>
</div>
    </div>
    <hr>
    <br/>
    <br/>
    <div class="text">Statistical Analysis</div>
    <div id="curve_chart" class="chart" ></div>
    <p> Daily Confirmed Cases</P>
    <div id="curve_chart1" class="chart1" ></div>
    </div>
    <p> Daily Recovered Cases</P>
    <div id="curve_chart2"  class="chart"></div>
    </div>
    <p> Daily Deceased Cases</P>
</body>
</html>