<?php
require('header.php');
require('function.php');

$content=file_get_contents('https://api.covid19india.org/data.json');
$content_arr=json_decode($content,true);
$len=count($content_arr['cases_time_series']);
$len2=count($content_arr['statewise']);
$len2=count($content_arr['tested']);
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="styling/index.css">
</head>
<body>
<?php
$confirm = $content_arr['statewise'][0]['confirmed'];
setlocale(LC_MONETARY, 'en_IN');
$confirm = money_format('%!i', $confirm);


$recover= $content_arr['statewise'][0]['recovered'];
setlocale(LC_MONETARY, 'en_IN');
$recover = money_format('%!i', $recover);


$deceased = $content_arr['statewise'][0]['deaths'];
setlocale(LC_MONETARY, 'en_IN');
$deceased = money_format('%!i', $deceased);


$active = $content_arr['statewise'][0]['active'];
setlocale(LC_MONETARY, 'en_IN');
$active = money_format('%!i', $active);

$report = $content_arr['cases_time_series'][$len-1]['dailyconfirmed'];
setlocale(LC_MONETARY, 'en_IN');
$report  = money_format('%!i', $report );

$recovered = $content_arr['cases_time_series'][$len-1]['dailyrecovered'];
setlocale(LC_MONETARY, 'en_IN');
$recovered = money_format('%!i', $recovered);

$doses = $content_arr['tested'][$len2-2]['totaldosesadministered'];
setlocale(LC_MONETARY, 'en_IN');
$doses = money_format('%!i', $doses);

$vaccine= $content_arr['tested'][$len2-2]['totalindividualsvaccinated'];
setlocale(LC_MONETARY, 'en_IN');
$vaccine = money_format('%!i', $vaccine);
 
?>

<br/><br/>
<div class="text">Covid-19 Dashboard</div>
<br/><br/>
<div id="div">

<div class="container-fluid">
<b class="data1"> CONFIRMED </b>
<br/>
<br/>
<b class="data1"><?php echo $confirm[0] ?></b>
</div>

<div class="container-fluid">
<b class="data4">ACTIVE</b>
<br/>
<br/>
<b class="data4"><?php echo $active[0]?></b>
</div>

<div class="container-fluid">
<b class="data2">RECOVERED</b>
<br/>
<br/>
<b class="data2"><?php echo $recover[0] ?></b>
</div>

<div class="container-fluid">
<b class="data3">DECEASED</b>
<br/>
<br/>
<b class="data3"><?php echo $deceased[0]?></b>
</div>

    </div>
  <div class="v_div" id="v_div1"><?php echo $report[0]?> Cases Reported Yesterday</div>
  <div class="v_div" id="v_div2"><?php echo $recovered[0]?> People Recovered Yesterday</div>
  <div class="v_div" id="v_div3"><?php echo $doses[0] ?>  Vaccine Doses Administered</div>
  <div class="v_div" id="v_div4"><?php echo $vaccine[0] ?>  Total Indiviaduals Vaccinated</div >
  <br/><br/>
  <?php require('footer.php'); ?>
</body
</html>