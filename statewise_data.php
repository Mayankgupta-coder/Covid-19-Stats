<?php
require('header.php');
require('function.php');
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
<div class="table-responsive-lg">
<table class="table table-striped">
  <thead>
    <tr>
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
          <?php 
        if($content_arr['statewise'][$i]['state']!="State Unassigned")
        {
          ?>
    <tr>
        <?php
          $active = $content_arr['statewise'][$i]['active'];
          setlocale(LC_MONETARY, 'en_IN');
          $active  = money_format('%!i', $active);

          $confirm = $content_arr['statewise'][$i]['confirmed'];
          setlocale(LC_MONETARY, 'en_IN');
          $confirm = money_format('%!i', $confirm);


          $recover= $content_arr['statewise'][$i]['recovered'];
          setlocale(LC_MONETARY, 'en_IN');
          $recover = money_format('%!i', $recover);


          $deceased = $content_arr['statewise'][$i]['deaths'];
          setlocale(LC_MONETARY, 'en_IN');
          $deceased = money_format('%!i', $deceased);
        ?>
      
      <td width="30%"><?php echo $content_arr['statewise'][$i]['state']?></td>
      <td width="20%"><?php echo $active[0]?></td>
      <td width="20%"><?php echo $confirm[0]?></td>
      <td width="20%"><?php echo $recover[0]?></td>
      <td width="20%"><?php echo $deceased[0]?></td>
    </tr>
    <?php
    $c++;
      }
      ?>
    <?php
    
      }
    ?>
  </tbody>
</table>
</div>
</body>
</html>