<?php
require('header.php');
require('function.php');
$content=file_get_contents('https://api.covid19india.org/data.json');
$content_arr=json_decode($content,true);
$len=count($content_arr['statewise']);
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="styling/statewise_data.css">
<script>
// filter
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>
</head>
<body>
<br/>
<div class="text">Statewise Data</div>

<div class="container mt-4">

    <div class="row d-flex justify-content-center">
        <div class="col-md-9">
            <div class="card p-4 mt-3">
               
                <div class="d-flex justify-content-center px-5">
                    <div class="search" > <input type="text" class="search-input" placeholder="Search State/UT..." name="" id="myInput"></div>
                </div>
               
            </div>
        </div>
    </div>
</div>
<br/>
<div  id="tableHolder" class="table-responsive-md">
<table class="table table-striped"  width="1300">
  <thead>
    <tr>
      <th scope="col" width="30%">State/UT</th>
      <th scope="col" width="20%">Active</th>
      <th scope="col" width="20%">Confirmed</th>
      <th scope="col" width="20%">Recovered</th>
      <th scope="col" width="20%">Death</th>
    </tr>
  </thead>
  <tbody id="myTable">
  
      <?php 
      $c=0;
      for($i=1;$i<$len;$i++)
      {
          
          ?>
          <?php 
        if($content_arr['statewise'][$i]['state']!="State Unassigned")
        {
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
    <tr>
      <td width="30%" id="state"><?php echo $content_arr['statewise'][$i]['state']?></td>
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
<br/><br/>
<?php require('footer.php'); ?>
</html>