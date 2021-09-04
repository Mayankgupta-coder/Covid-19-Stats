<?php
require('header.php');
require('function.php');
$a=array();
$b=array();
$content=file_get_contents('https://api.covid19india.org/data.json');
$content_arr=json_decode($content,true);
$len=count($content_arr['cases_time_series']);
$len2=count($content_arr['statewise']);
$len2=count($content_arr['tested']);

$content1=file_get_contents('https://data.covid19india.org/v4/data.json');
$content_arr1=json_decode($content1,true);

$content2=file_get_contents('http://covid19-nabeel6223.herokuapp.com/state_tests_data');
$content_arr2=json_decode($content2,true);



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

$new_confirm = $content_arr1['TT']['total']['confirmed'];
setlocale(LC_MONETARY, 'en_IN');
$new_confirm = money_format('%!i', $new_confirm);


$recover= $content_arr['statewise'][0]['recovered'];
setlocale(LC_MONETARY, 'en_IN');
$recover = money_format('%!i', $recover);

$new_recover =$content_arr1['TT']['total']['recovered'];
setlocale(LC_MONETARY, 'en_IN');
$new_recover= money_format('%!i', $new_recover);


$deceased = $content_arr['statewise'][0]['deaths'];
setlocale(LC_MONETARY, 'en_IN');
$deceased = money_format('%!i', $deceased);


$new_deceased = $content_arr1['TT']['total']['deceased'];
setlocale(LC_MONETARY, 'en_IN');
$new_deceased = money_format('%!i', $new_deceased);

$active = $content_arr['statewise'][0]['active'];
setlocale(LC_MONETARY, 'en_IN');
$active = money_format('%!i', $active);

$new_active = $content_arr2['state_tests_data'][0]['active'];
setlocale(LC_MONETARY, 'en_IN');
$new_active = money_format('%!i', $new_active);

$report = $content_arr['cases_time_series'][$len-1]['dailyconfirmed'];
setlocale(LC_MONETARY, 'en_IN');
$report  = money_format('%!i', $report );

$recovered = $content_arr['cases_time_series'][$len-1]['dailyrecovered'];
setlocale(LC_MONETARY, 'en_IN');
$recovered = money_format('%!i', $recovered);

$doses = $content_arr['tested'][$len2-1]['totaldosesadministered'];
setlocale(LC_MONETARY, 'en_IN');
$doses = money_format('%!i', $doses);

$new_doses = $content_arr2['state_tests_data'][0]['total_vaccines_administered'];
setlocale(LC_MONETARY, 'en_IN');
$new_doses = money_format('%!i', $new_doses);
// $vaccine= $content_arr['tested'][$len2-1]['totalindividualsvaccinated'];
// setlocale(LC_MONETARY, 'en_IN');
// $vaccine = money_format('%!i', $vaccine);

function get_data()
{

  $file_name='covid_data.json';
$content1=file_get_contents('https://data.covid19india.org/v4/data.json');
$content_arr1=json_decode($content1,true);

$content2=file_get_contents('http://covid19-nabeel6223.herokuapp.com/state_tests_data');
$content_arr2=json_decode($content2,true);

  $new_confirm = $content_arr1['TT']['total']['confirmed'];
  setlocale(LC_MONETARY, 'en_IN');
  $new_confirm = money_format('%!i', $new_confirm);

  
$new_deceased = $content_arr1['TT']['total']['deceased'];
setlocale(LC_MONETARY, 'en_IN');
$new_deceased = money_format('%!i', $new_deceased);


$new_active = $content_arr2['state_tests_data'][0]['active'];
setlocale(LC_MONETARY, 'en_IN');
$new_active = money_format('%!i', $new_active);

$date = $content_arr1['TT']['meta']['date'];

  $current_data=file_get_contents("$file_name");
  $array_data=json_decode($current_data,true);
  $extra=array(
  'confirm_cases' => $new_confirm[0],
  'active_cases' => $new_active[0],
  'deceased_cases' => $new_deceased[0],
  'date' => $date,
                                
  );
  $array_data[]=$extra;
  return json_encode($array_data);
}
$file_name='covid_data.json';
file_put_contents("$file_name",get_data());

$diff_confirm=$content_arr['cases_time_series'][$len-1]['dailyconfirmed']-$content_arr['cases_time_series'][$len-2]['dailyconfirmed'];
$diff_recover=$content_arr['cases_time_series'][$len-1]['dailyrecovered']-$content_arr['cases_time_series'][$len-2]['dailyrecovered'];
$diff_deceased=$content_arr['cases_time_series'][$len-1]['dailydeceased']-$content_arr['cases_time_series'][$len-2]['dailydeceased'];
?>

<br/><br/>
<div class="text">Covid-19 Dashboard</div>
<br/><br/>
<div id="div">

<div class="container-fluid">
<b class="data1"> CONFIRMED </b>
<br/>
<br/>
<b class="data1"><?php echo $new_confirm[0];?></b>

</div>

<div class="container-fluid">
<b class="data4">ACTIVE</b>
<br/>
<br/>
<b class="data4"><?php echo $new_active[0]?></b>
</div>

<div class="container-fluid">
<b class="data2">RECOVERED</b>
<br/>
<br/>
<b class="data2"><?php echo $new_recover[0];?></b>

</div>

<div class="container-fluid">
<b class="data3">DECEASED</b>
<br/>
<br/>
<b class="data3"><?php echo $new_deceased[0];?></b>

</div>

    </div>
  <div class="v_div" id="v_div1"><?php echo $report[0]?> Cases Reported Yesterday</div>
  <div class="v_div" id="v_div2"><?php echo $recovered[0]?> People Recovered Yesterday</div>
  <div class="v_div" id="v_div3"><?php echo $new_doses[0] ?>  Vaccine Doses Administered</div>
  <!-- <div class="v_div" id="v_div4"><?php echo $vaccine[0] ?>  Total Indiviaduals Vaccinated</div > -->
  <br/><br/>
  <?php require('footer.php'); ?>
</body
</html>