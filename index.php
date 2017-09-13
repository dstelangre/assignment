<html>
    <head>
        <title>Assignment</title>
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
    </head>
<body>
    <div class="page-header">
  <h1 align="center">CODAEMON TEST</h1>
</div>
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">Search</div>
    <div class="panel-body">
        <form action="index.php" method="post">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <div class="form-group">
    <label for="name">Name</label>
    <input class="form-control" id="name" type="text" placeholder="Enter name" name="name">
  </div>        
        </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
   <div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" id="email" type="text" placeholder="Enter Email" name="email">
  </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="form-group">
      <label>Select Age</label>
      <select name="age" class="form-control">
  <option> select </option>
  <option value="LT25"> less than 25 </option>
  <option value="GT25"> gretter than 25 </option>
</select>
      </div>
      </div>
      <div class="col-lg-1 col-md-3 col-sm-12 col-xs-12 top-margin-20">
          <button type="submit" class="btn btn-success" name="submit" value="submit">Search</button>
     </form>   
    </div>
  </div>
  </div>
  <?php

  $name=$_POST['name'];
  $email=$_POST['email'];
  $age=$_POST['age'];
include('config.php');    //include of db config file
include ('paginate.php'); //include of paginat page
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Error on database connection");
$per_page = 5;     
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
$result = mysql_query("SELECT * FROM customer where c_name='$name' OR c_email='$email'");
if($age=="LT25")
{
    $result = mysql_query("SELECT * from customer where DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), c_dob)), '%Y')+0<25") ;
   
}
if($age=="GT25")
{
    $result = mysql_query("SELECT * from customer where DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), c_dob)), '%Y')+0>25") ;
   
}
}
else
{
$result = mysql_query("SELECT * FROM customer");
}
$total_results = mysql_num_rows($result);
$total_pages = ceil($total_results / $per_page);
if (isset($_GET['page'])) {
    $show_page = $_GET['page'];         
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        $start = 0;
        $end = $per_page;
    }
} else {
    $start = 0;
    $end = $per_page;
}
$page = intval($_GET['page']);
$tpages=$total_pages;
if ($page <= 0)
    $page = 1;
?>
    <div class="panel panel-danger">
    <div class="panel-heading">Customer Data</div>
    <div class="panel-body">
        <?php
                    $reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;
                    echo '<div class="pagination"><ul>';
                    if ($total_pages > 1) {
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";
                    echo "<table class='table table-bordered'>";
                    echo "<thead><tr><th>Id</th><th>Name</th><th>Email</th><th>Address</th><th>ZIP</th><th>Telephone</th><th>DOB</th></tr></thead>";
                    for ($i = $start; $i < $end; $i++) {
                        if ($i == $total_results) {
                            break;
                        }
                        
                        echo "<tr " . $cls . ">";
                        echo '<td>' . mysql_result($result, $i, 'c_id') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'c_name') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'c_email') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'c_address') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'c_zip') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'c_telephone') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'c_dob') . '</td>';
                        echo "</tr>";
                    }
                echo "</table>";
            ?>
    </div>
  </div>
</body>
</html>