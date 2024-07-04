<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Ensure no further code is executed after the redirect
} elseif ($_SESSION['usertype'] != 'admin') {
    // If the user is not an admin, redirect to login page
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

if (isset($_POST['add_teacher'])) {
    $t_name = $_POST['name'];
    $t_description = $_POST['description'];

    // File upload handling
    $file = $_FILES['image']['name'];
    $dst = "./image/" . $file;
    $dst_db = "image/" . $file;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $dst)) {
        // Inserting teacher details into the database
        $sql = "INSERT INTO teacher (name, description, image) VALUES ('$t_name', '$t_description', '$dst_db')";
        $result = mysqli_query($connection, $sql);

        if ($result) {
            echo "<script type='text/javascript'>
            alert('Teacher addedd suceessfully');
            </script";
            
        } else {
            $message = "Error: " . mysqli_error($connection);
        }
    } else {
        $message = "Error uploading file";
    }
}
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
   <h1 class="color">Add Teacher</h1>
</div>
<div>
        <center>
            <div class="div_deg">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div>
                        <label>Teacher Name:</label>
                        <input type="text" name="name" required>
                    </div>
                    <div>
                        <label>Description: </label>
                        <textarea name="description" ></textarea>
                    </div>
                    <div>
                        <label>Image:</label>
                        <input type="file" name="image" required>
                    </div>
                    
                    <div>
                        <label></label>
                        <center>
                            <input class="btn btn-primary" type="submit" id="submit" name="add teacher" value="Add Teacher">
                        </center>
                    </div>
                </form>
            </div>
        </center>
    </div>
    <style type="text/css">
        label {
            width: 100px;
            padding-bottom: 25px;
            padding-top: 10px;
            margin-left: auto;
            padding-left: 15px;
        }
        #submit {
            width: 40%;
        }
        .div_deg {
            background-color: aqua;
            width: 400px;
            padding-bottom: 50px;
            padding-top: 70px;
        }
    </style>
<style>
.content{
    margin-top: 5%;
    margin-left:39%;
}
.color{
    color:blue;
    font-size: 30px;
   
}
</style>




</body>
</html>
