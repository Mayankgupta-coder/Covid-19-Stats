<?php
require('header.php');
$content=file_get_contents('https://api.covid19india.org/data.json');
$content_arr=json_decode($content,true);
$len=count($content_arr['statewise']);
?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<br/><br/>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col" width="5%">#</th>
      <th scope="col" width="30%">State/UT</th>
      <th scope="col" width="20%">Active</th>
      <th scope="col" width="20%">Confirmed</th>
      <th scope="col" width="20%">Death</th>
      <th scope="col" width="20%">Recovered</th>
    </tr>
  </thead>
  <tbody>
  
      <?php 
      $c=0;
      for($i=1;$i<$len;$i++)
      {
          
          ?>
    <tr>
        <?php 
        if($content_arr['statewise'][$i]['state']!="State Unassigned")
        {
        ?>
      <td scope="row"><?php echo $c+1?></td>
      <td width="30%"><?php echo $content_arr['statewise'][$i]['state']?></td>
      <td width="20%"><?php echo $content_arr['statewise'][$i]['active']?></td>
      <td width="20%"><?php echo $content_arr['statewise'][$i]['confirmed']?></td>
      <td width="20%"><?php echo $content_arr['statewise'][$i]['deaths']?></td>
      <td width="20%"><?php echo $content_arr['statewise'][$i]['recovered']?></td>
      <?php
      }
      ?>
    </tr>
    <?php
    $c++;
      }
    ?>
  </tbody>
</table>
</body>
</html>