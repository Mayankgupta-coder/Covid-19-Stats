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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
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
        font-family: 'Roboto', sans-serif;
          text-align:center;
          color:Red;
          font-size:40px;
      }
      .data1
      {
        font-family: 'Crimson Pro', serif;
        font-family: 'Khand', sans-serif;
        color:red;
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

?>
<br/><br/>
<div class="text">Covid-19 Data</div>
<br/><br/>
<div id="div">

<div class="container-fluid">
<b class="data1"> CONFIRMED </b>
<br/>
<br/>
<b class="data1"><?php echo $confirm[0] ?></b>
</div>

<div class="container-fluid">
<b class="data4">Active</b>
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
  
</body
</html>