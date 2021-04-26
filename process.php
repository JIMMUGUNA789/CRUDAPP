<?php 
session_start();
// connecting to database
$mysqli = new mysqli('localhost', 'root', '', 'crudapp' ) or die(mysqli_error($mysqli));
$name = '';
$id = '';
$location = '';
$update = false;

//check if save button has been clicked
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    //insert data to database
    $mysqli->query("INSERT INTO `data` (name,email) VALUES ('$name','$email')") or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";
    
    //redirecting user
    header("location: index.php");
}
//deleting a record
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "Danger";
    
    //redirect user
    header("location: index.php");


}
//editing a record
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update=true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if(count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $email = $row['email'];
    }
}
//updating
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name = $_POST['name'];
   $email = $_POST['email'];
   $mysqli->query("UPDATE data SET name = '$name', location = '$location' WHERE id = $id") or die($mysqli->error);
   $_SESSION['message']= "Record has been updated";
   $_SESSION['msg_type'] = "warning";
   header("location: index.php");
}





?>