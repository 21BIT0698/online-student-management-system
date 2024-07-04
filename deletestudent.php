
<?php
error_reporting(0);
session_start();
$host = "localhost";
$user = "root";
$password = "";  // Use the correct password if there is one
$db = "schoolproject";

$connection = mysqli_connect($host, $user, $password, $db);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if($_GET['student_id'])
{
    $user_id=$_GET['student_id'];
    $sql="DELETE FROM user WHERE id='$user_id' ";
    $result=mysqli_query($connection,$sql);
    if($result)

    {

        $_SESSION['message']='Delete Student is Successful';
        header("location:view_student.php");
    }
    
}
?>