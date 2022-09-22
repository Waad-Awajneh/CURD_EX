<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">

<?php
require_once'dbconfig.php';

// Get the carid
$carid=intval($_GET['id']);

$sql = "SELECT * from cars where CarID=:ide";
//Prepare the query:
$query = $connectDB->prepare($sql);
//Bind the parameters
$query->bindParam(':ide',$carid,PDO::PARAM_STR);
//Execute the query:
$query->execute();
//Assign the data which you pulled from the database (in the preceding step) to a variable.
$car=$query->fetch(PDO::FETCH_OBJ);
// if($query->rowCount() > 0)
// {
// //In case that the query returned at least one record, we can echo the records within a foreach loop:
// foreach($results as $result)
// {
?>






<div class="container">
<div class="row">
<div class="col-md-12">
<h3>update car info</h3>
<hr />
</div> 
</div>







<form name="insertrecord" method="post">
<div class="row">
<div class="col-md-4"><b>Model</b>
<input type="text" name="Model" class="form-control"required value= <?php echo htmlentities($car->Model); ?> >
</div>
<div class="col-md-4"><b>Price</b>
<input type="number" name="Price" class="form-control" required value= <?php echo htmlentities($car->Price); ?>>
</div>
</div>
<div class="row">
<div class="col-md-4"><b>color</b>
<input type="text" name="color" class="form-control" required  value= <?php echo htmlentities($car->color); ?>>
</div>
<div class="col-md-4"><b>Select Image File to Upload:</b>
<input type="text" name="Img" class="form-control"  value= <?php echo htmlentities($car->Image); ?>></div>
</div>
<div class="row" style="margin-top:1%">
<div class="col-md-8">
<input type="submit" name="update" value="Submit">
</div>
</div>
</form>







</div>
</div>






<?php
// }}

// include database connection file
require_once'dbconfig.php';
if(isset($_POST['update']))
{

// Get the carid
$carid=intval($_GET['id']);
// Posted Values
$Model=$_POST['Model'];
$color=$_POST['color'];
$Price=$_POST['Price'];
$Image =$_POST['Img'];

// Query for Updation

$sql="update cars set Model=:Model,color=:color,Price=:Price,Image=:Imag where CarID=:uid";
//Prepare Query for Execution
$query = $connectDB->prepare($sql);
// Bind the parameters
$query->bindParam(':uid',$carid,PDO::PARAM_STR);

$query->bindParam(':Model',$Model,PDO::PARAM_STR);
$query->bindParam(':color',$color,PDO::PARAM_STR);
$query->bindParam(':Price',$Price,PDO::PARAM_STR);
$query->bindParam(':Imag',$Image,PDO::PARAM_STR);


// Query Execution
$query->execute();
// Mesage after updation
echo "<script>alert('Record Updated successfully');</script>";
// Code for redirection
echo "<script>window.location.href='index.php'</script>";
}





?>