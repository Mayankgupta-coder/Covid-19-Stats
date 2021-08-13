<?php
require('header.php');
require('function.php');
$content=file_get_contents('https://api.covid19india.org/state_district_wise.json');
$content_arr=json_decode($content,true);

if(isset($_GET['state']) && $_GET['state']!=NULL)
{
    $state=$_GET['state'];
}
else
{
    ?>
    <script>
        window.location.href="statewise_data.php";
        </script>
    <?php
}

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
<div class="text">DistrictWise Data of <?php echo $state ?></div>

<div class="container mt-4">

    <div class="row d-flex justify-content-center">
        <div class="col-md-9">
            <div class="card p-4 mt-3">
               
                <div class="d-flex justify-content-center px-5">
                    <div class="search" > <input type="text" class="search-input" placeholder="Search District..." name="" id="myInput"></div>
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
      <th scope="col" width="30%">District</th>
      <th scope="col" width="20%">Active</th>
      <th scope="col" width="20%">Confirmed</th>
      <th scope="col" width="20%">Recovered</th>
      <th scope="col" width="20%">Death</th>
    </tr>
  </thead>
  <tbody id="myTable">
  
      <?php 
      $c=0;
      foreach((array_keys($content_arr[$state]['districtData'])) as $values)
      {
          
          ?>
          <?php 
        
          $active = $content_arr[$state]['districtData'][$values]['active'];
          setlocale(LC_MONETARY, 'en_IN');
          $active  = money_format('%!i', $active);

          $confirm = $content_arr[$state]['districtData'][$values]['confirmed'];
          setlocale(LC_MONETARY, 'en_IN');
          $confirm = money_format('%!i', $confirm);


          $recover= $content_arr[$state]['districtData'][$values]['recovered'];
          setlocale(LC_MONETARY, 'en_IN');
          $recover = money_format('%!i', $recover);


          $deceased = $content_arr[$state]['districtData'][$values]['deceased'];
          setlocale(LC_MONETARY, 'en_IN');
          $deceased = money_format('%!i', $deceased);
          ?>
    <tr>
      <td width="30%" id="state"><?php echo $values?></td>
      <td width="20%"><?php echo $active[0]?></td>
      <td width="20%"><?php echo $confirm[0]?></td>
      <td width="20%"><?php echo $recover[0]?></td>
      <td width="20%"><?php echo $deceased[0]?></td>
    </tr>
    <?php
    $c++;
      }
      ?>
   
  </tbody>
</table>
</div>
</body>
<br/><br/>
<?php require('footer.php'); ?>
</html>