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
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@1,300&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@300&family=Khand:wght@300&display=swap');
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
            height:180px;
            width:250px;
            border:1px solid black;
            box-shadow: 1px 1px 2px 2px grey;
            margin-bottom:15px;
            text-align:Center;
            padding:30px 0px;
            border-radius:10px;
        }
        #div
        {
            display:flex;
            flex-wrap:wrap;
        }
        .text
      {
       
          text-align:center;
          color:Red;
          font-size:40px;
          font-family: 'Poppins', sans-serif;
      }
      .data1
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:darkred;
        font-size:30px;
      }
      .data2
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:green;
        font-size:30px;
      }
      .data3
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:Grey;
        font-size:30px;
      }
      .data4
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:blue;
        font-size:30px;
      }
      .container-fluid:hover {
        transform: scale(1.1);
        cursor: pointer;
}
.v_div
{
    border:1px solid black;
    height:50px;
    width:370px;
    margin-top:2%;
    margin-left: auto;
  margin-right: auto;
    color:white;
    text-align:center;
    font-family: 'Fira Sans', sans-serif;
    padding:10px;
    font-size:18px;
}
#v_div1
{
    background-color:#4d4dff;
}
#v_div2
{
    background-color:#ff3333;
}
#v_div3
{
    background-color:#00b300;
}
#v_div4
{
    background-color:#a6a6a6;
}


@media only screen and (min-width: 0px) and (max-width: 200px) {
    .container-fluid
        {
            height:130px;
            width:120px;
            border:1px solid black;
            box-shadow: 1px 1px 2px 2px grey;
            margin-bottom:15px;
            text-align:Center;
            padding:30px 0px;
            border-radius:10px;
        }
        .data1
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:darkred;
        font-size:12px;
      }
      .data2
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:green;
        font-size:12px;
      }
      .data3
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:Grey;
        font-size:12px;
      }
      .data4
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:blue;
        font-size:12px;
      }
}
@media only screen and (min-width: 201px) and (max-width: 415px) {
    .container-fluid
        {
            height:130px;
            width:150px;
            border:1px solid black;
            box-shadow: 1px 1px 2px 2px grey;
            margin-bottom:15px;
            text-align:Center;
            padding:30px 0px;
            border-radius:10px;
        }
        .data1
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:darkred;
        font-size:15px;
      }
      .data2
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:green;
        font-size:15px;
      }
      .data3
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:Grey;
        font-size:15px;
      }
      .data4
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:blue;
        font-size:15px;
      }
}
@media only screen and (min-width: 416px) and (max-width: 517px) {
    .container-fluid
        {
            height:120px;
            width:200px;
            border:1px solid black;
            box-shadow: 1px 1px 2px 2px grey;
            margin-bottom:15px;
            text-align:Center;
            padding:30px 0px;
            border-radius:10px;
        }
        .data1
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:darkred;
        font-size:20px;
      }
      .data2
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:green;
        font-size:20px;
      }
      .data3
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:Grey;
        font-size:20px;
      }
      .data4
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:blue;
        font-size:20px;
      }
}

        </style>
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

$doses = $content_arr['tested'][$len2-1]['totaldosesadministered'];
setlocale(LC_MONETARY, 'en_IN');
$doses = money_format('%!i', $doses);

$vaccine= $content_arr['tested'][$len2-1]['totalindividualsvaccinated'];
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