<?php
// include database connection file
require_once'dbconfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP CRUD Operations using PDO Extension </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    </style>

</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<h3>PHP CRUD Operations using PDO Extension</h3> <hr />
<a href="insert.php"><button class="btn btn-primary"> Insert Record</button></a>


<div class="cards">




<?php
$sql = "SELECT `Image`,CarID,Model,Price,color from cars";
//Prepare the query:
$query = $connectDB->prepare($sql);
//Execute the query:
$query->execute();
//Assign the data which you pulled from the database (in the preceding step) to a variable.
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
//In case that the query returned at least one record, we can echo the records within a foreach loop:
foreach($results as $result)
{
?>
<!-- Display Records -->
<div class="card" style="width: 18rem;">
  <img style="width: 100px; hight: 100px;" class="card-img-top" src="<?php echo htmlentities($result->Image);?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">car #ID :<?php echo htmlentities($result->CarID);?></h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Model: <?php echo htmlentities($result->Model);?></li>
    <li class="list-group-item">Price: <?php echo htmlentities($result->Price);?></li>
    <li class="list-group-item">color: <?php echo htmlentities($result->color);?></li>
  </ul>
  <div class="card-body">
    
<a href="update.php?id=<?php echo htmlentities($result->CarID);?>"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a>
<a href="index.php?del=<?php echo htmlentities($result->CarID);?>"><button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><span class="glyphicon glyphicon-trash"></span></button></a>
  
  </div>
</div>


<?php

}} ?>

</div>
</div>
</div>
</div>
</body>
</html>


<?php
// include database connection file
require_once'dbconfig.php';
// Code for record deletion
if(isset($_REQUEST['del']))
{
//Get row id
$uid=intval($_GET['del']);
//Qyery for deletion
$sql = "delete from cars WHERE  CarID=:id";
// Prepare query for execution
$query = $connectDB->prepare($sql);
// bind the parameters
$query-> bindParam(':id',$uid, PDO::PARAM_STR);
// Query Execution
$query -> execute();
// Mesage after updation
echo "<script>alert('Record Updated successfully');</script>";
// Code for redirection
echo "<script>window.location.href='index.php'</script>";
}
?>