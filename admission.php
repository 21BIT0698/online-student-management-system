<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Ensure no further code is executed after the redirect
} elseif ($_SESSION['usertype'] != 'admin') {
    // If the user is not an admin, redirect them to the login page
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

$sql = "SELECT * FROM admission";
$result = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="admission.css">
   
    <?php  
       include 'admin_css.php';
    ?>
    
</head>
<body>
    <?php  
       include 'admin_sidebar.php';
    ?>

<div class="content">
    <center>
   <h1 class="color"> Applied for Admission</h1>
</center>

   <br>

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

.color{
    color:blue;
    font-size: 20px;
    margin-left:auto;
    text-align: center;
    margin-top:30px;
    
   
}


        
    </style>
    <center>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
        </tr>
        <?php
        while($info = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $info['name'];?></td>
            <td><?php echo $info['email'];?></td>
            <td><?php echo $info['phone'];?></td>
            <td><?php echo $info['message'];?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    </center>
</div>
</body>
</html>

<?php
mysqli_close($connection); // Close the database connection after usage
?>
