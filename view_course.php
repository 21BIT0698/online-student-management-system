

<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Ensure no further code is executed after the redirect
} elseif ($_SESSION['usertype'] != 'admin') {
    // If the user is not a student, you might want to redirect them elsewhere
    // For example, redirect to an admin page or login page
    header("Location: login.php");
    exit(); // Ensure no further code is executed after the redirect


}
$host = "localhost";
$user = "root";
$password = "";  // Use the correct password if there is one
$db = "schoolproject";

$connection = mysqli_connect($host, $user, $password, $db);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM  course";
$result = mysqli_query($connection, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header  class="header">
   
</header>

<?php
  include 'admin_sidebar.php';
  ?>
  
<div class="content">
   <h1 class="color">View All Course Data</h1>
   <br>
   <?php 
      if($_SESSION['message'])
      {
        echo $_SESSION['message'];
      }
      unset( $_SESSION['message']);
      ?>
</div>

<style>
    .content{

        margin-left:39%;

        color:blue;
    }
    .color{
        font-size: 30px;
        padding-top:5%;
    }
    

</style>
<style>
        th,td{
            padding: 20px;
            font-size: 15px;
            border: 1px solid black; /* add border to all sides of cells *//*give tha table structure*/
            text-align: center; /* center-align cell content */
            font-weight: bold;
            color:black;
            margin-left:center;

   
}
td{
    background-color:aqua;
}

        
    </style>
    <center>
    <table>
        <tr>
            <th>Course Name</th>
            <th>image</th>
            <th>delete</th>
            <th>update</th>

            
        </tr>

        <?php
        while($info = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $info['name'];?></td>
            <td><img src="<?php echo "{$info['image']}"?>"></td>
            <td><?php echo "<a class='btn btn-danger' onClick=\" javascript:return confirm('Are you Sure to Delete this');\"
            href='delete_course.php?course_id={$info['id']} '>Delete</a>"?></td>

            <td><?php echo "<a class='btn btn-primary' href='update_course.php?course_id={$info['id']}'>Update</a> ";?></td>
            
        </tr>
        <?php
        }
        ?>
    
    </table>
    </center>
</div>
</body>
</html>





