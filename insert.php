<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP CURD Operation using PDO Extension  </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<h3>Insert Record | PHP CRUD Operations using PDO Extension</h3>
<hr />
</div> 
</div>
<form action="insert.php" name="insertrecord" method="post" enctype="multipart/form-data">
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
<input type="submit" name="insert">
</div>
</div>
</form>
</div>
</div>
</body>
</html>

<?php
// include database connection file
require_once'dbconfig.php';

// echo $_POST['insert'];

$statusMsg = '';


// File upload path
// $targetDir = "./uploads/";
// $Image = basename($_FILES["Img"]["name"]);
// $targetFilePath = $targetDir . $Image;
// $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


if(!empty($_POST['insert']) )
{
// File upload path
// $targetDir = "uploads/";
// $Image = basename($_FILES["Img"]["name"]);
// $targetFilePath = $targetDir . $Image;
// $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

//  $allowTypes = array('jpg','png','jpeg','gif','pdf');
//     if(in_array($fileType, $allowTypes)){
//         // Upload file to server
//         if(move_uploaded_file($_FILES["Img"]["tmp_name"], $targetFilePath)){

  // Insert image file name into database
            // $insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
        

// Posted Values
$Model=$_POST['Model'];
$color=$_POST['color'];
$Price=$_POST['Price'];
$Image =$_POST['Img'];

// Query for Insertion
$sql="INSERT INTO cars(Model,color,Price,`Image`) VALUES(:Model,:color,:Price,:Imag)";
//Prepare Query for Execution
$query = $connectDB->prepare($sql);
// Bind the parameters
$query->bindParam(':Model',$Model,PDO::PARAM_STR);
$query->bindParam(':color',$color,PDO::PARAM_STR);
$query->bindParam(':Price',$Price,PDO::PARAM_STR);
$query->bindParam(':Imag',$Image,PDO::PARAM_STR);

// Query Execution
$query->execute();
// Check that the insertion really worked. If the last inserted id is greater than zero, the insertion worked.
$lastInsertId = $connectDB->lastInsertId();

echo $lastInsertId;
if($lastInsertId)
{
// Message for successfull insertion
echo "<script>alert('Record inserted successfully');</script>";
echo "<script>window.location.href='index.php'</script>";
}
else
{
// Message for unsuccessfull insertion
echo "<script>alert('Something went wrong. Please try again');</script>";
echo "<script>window.location.href='index.php'</script>";
}
}



// }

// }else echo "error  ".$_POST['insert'].$_FILES["Img"]["name"];
?>