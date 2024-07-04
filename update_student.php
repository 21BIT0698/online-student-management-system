<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Ensure no further code is executed after the redirect
} elseif ($_SESSION['usertype'] != 'admin') {
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

$id = $_GET['student_id'];
$sql = "SELECT * FROM user WHERE id='$id'";
$result = mysqli_query($connection, $sql);
$info = $result->fetch_assoc();

if(isset($_POST['update']))
{

   
    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    
    $query="UPDATE user SET username='$name',email='$email',phone='$phone',password ='$password' WHERE id='$id'";
    $result2=mysqli_query($connection,$query);
    if($result2)
    {
        header("location:view_student.php");
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
    <header class="header"></header>

    <?php include 'admin_sidebar.php'; ?>
    
    <div class="content">
        <h1 class="color">Update Student</h1>
    </div>

    <div>
        <center>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo $info['username']; ?>" required>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $info['email']; ?>" required>
                    </div>
                    <div>
                        <label>Phone</label>
                        <input type="number" name="phone" value="<?php echo $info['phone']; ?>" required>
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" value="<?php echo $info['password']; ?>" required>
                    </div>
                    <div>
                        <label></label>
                        <center>
                            <input class="btn btn-primary" type="submit" id="submit" name="update" value="Update">
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
        .content {
            margin-left: 40%;
            color: blue;
        }
        .color {
            font-size: 30px;
            padding-top: 5%;
        }
    </style>
</body>
</html>
