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
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Benne&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Benne&family=Crimson+Text&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Roboto:ital@1&display=swap');
#tableHolder
{
width: 95%;
height: 850px;
overflow: scroll;
margin-left:2%;
margin-bottom:2%;
}
th{
  color:blue;
  font-family: 'Benne', serif;
}
.text
      {
        
          text-align:center;
          color:#9900cc;
          font-size:40px;
          font-family: 'Poppins', sans-serif;
      }
#state
{
  color:red;
  font-family: 'Benne', serif;
font-family: 'Crimson Text', serif;
}

.card {
    border: none;
    background: #eee
}

.search {
    width: 100%;
    margin-bottom: auto;
    margin-top: 20px;
    height: 50px;
    background-color: #fff;
    padding: 10px;
    border-radius: 5px
}

.search-input {
    color: white;
    border: 0;
    outline: 0;
    background: none;
    width: 0;
    margin-top: 5px;
    caret-color: transparent;
    line-height: 20px;
    transition: width 0.4s linear
}

.search .search-input {
    padding: 0 10px;
    width: 100%;
    caret-color: #536bf6;
    font-size: 19px;
    font-weight: 300;
    color: black;
    transition: width 0.4s linear
}

.search-icon {
    height: 34px;
    width: 34px;
    float: right;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    background-color: #536bf6;
    font-size: 10px;
    bottom: 30px;
    position: relative;
    border-radius: 5px
}

.search-icon:hover {
    color: #fff !important
}

a:link {
    text-decoration: none
}

.card-inner {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
    border: none;
    cursor: pointer;
    transition: all 2s
}

.card-inner:hover {
    transform: scale(1.1)
}

.mg-text span {
    font-size: 12px
}

.mg-text {
    line-height: 14px
}
</style>

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
      <th scope="col" width="20%">Death</th>
      <th scope="col" width="20%">Recovered</th>
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