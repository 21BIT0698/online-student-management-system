
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$host = "localhost";
$user = "root";
$password = "";  
$db = "schoolproject";

$connection = mysqli_connect($host, $user, $password, $db);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['course_id'])) {
    $t_id = $_GET['course_id'];
    $sql = "DELETE FROM course WHERE id='$t_id'"; 
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $_SESSION['message'] = 'Delete course is Successful';
        header("Location: view_course.php");
        exit(); 
    } else {
        $_SESSION['message'] = 'Error deleting course: ' . mysqli_error($connection);
        header("Location: view_course.php");
        exit();
    }
} else {
    $_SESSION['message'] = 'Invalid course ID';
    header("Location: view_course.php");
    exit();
}
?>
