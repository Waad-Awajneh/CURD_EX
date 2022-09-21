<?php
require_once'dbconfig.php';

// Get the carid
$carid=intval($_GET['id']);

$sql = "SELECT Model,color,Price,`Image`,CarID from cars where CarID=:ide";
//Prepare the query:
$query = $connectDB->prepare($sql);
//Bind the parameters
$query->bindParam(':ide',$carid,PDO::PARAM_STR);
//Execute the query:
$query->execute();
//Assign the data which you pulled from the database (in the preceding step) to a variable.
$results=$query->fetchAll(PDO::FETCH_OBJ);
// For serial number initialization
$cnt=1;
if($query->rowCount() > 0)
{
//In case that the query returned at least one record, we can echo the records within a foreach loop:
foreach($results as $result)
{
?>
<form name="insertrecord" method="post">
<div class="row">
<div class="col-md-4"><b>Model</b>
<input type="text" name="Model" class="form-control" required>
</div>
<div class="col-md-4"><b>Price</b>
<input type="number" name="Price" class="form-control" required>
</div>
</div>
<div class="row">
<div class="col-md-4"><b>color</b>
<input type="text" name="color" class="form-control" required>
</div>
<div class="col-md-4"><b>Select Image File to Upload:</b>
<input type="text" name="Img" class="form-control"></div>
</div>
<div class="row" style="margin-top:1%">
<div class="col-md-8">
<input type="submit" name="update" value="Submit">
</div>
</div>
</form>
<?php }}

// include database connection file
require_once'dbconfig.php';
if(isset($_POST['update']))
{






    // $targetDir = "uploads/";
    // $Image = basename($_FILES["Img"]["name"]);
    // $targetFilePath = $targetDir . $Image;
    // $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    
    //  $allowTypes = array('jpg','png','jpeg','gif','pdf');
    //     if(in_array($fileType, $allowTypes)){
    //         // Upload file to server
    //         if(move_uploaded_file($_FILES["Img"]["tmp_name"], $targetFilePath)){
    















// Get the carid
$carid=intval($_GET['id']);
// Posted Values
$Model=$_POST['Model'];
$color=$_POST['color'];
$Price=$_POST['Price'];
$Image =$_POST['Img'];

// Query for Updation
// $connectDB->query("UPDATE `php` SET `firstname` = 'updatge', `lastname` = 'updated', `email` = 'test@gmail.com' WHERE `id` = 1");

$sql="update cars set :Model,:color,:Price,:Imag where CarID=:uid";
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




        // }}
?>