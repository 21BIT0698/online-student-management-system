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

if(isset($_POST['add_student']))
{
    $username = $_POST['name'];
    $user_email = $_POST['email'];
    $user_phone = $_POST['phone'];
    $user_password = $_POST['password'];
    $user_type = "student";

    // Use prepared statements to prevent SQL injection
    $check="SELECT * FROM user WHERE username='$username'";
    $check_user=mysqli_query($connection,$check);
    $row_count=mysqli_num_rows($check_user);/*count the row no of same name*/
    if($row_count==1)
    {
        echo "<script type='text/javascript'>
        alert('Username Already Exists.Try Another One');
        </script";
        
    }
    else{

    
    $stmt = $connection->prepare("INSERT INTO user (username, email, phone, usertype, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $user_email, $user_phone, $user_type, $user_password);

    if($stmt->execute())
    {
        echo "<script type='text/javascript'>
        alert('Data uploaded Successfully');
        </script";
    }
    else
    {
        echo "Upload failed: " . $stmt->error;
    }



    $stmt->close();
}
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" type="text/css" href="add_student.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
</head>
<body>
    <header class="header"></header>

    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <h1 class="color">Add Student</h1>
    </div>

    <div>
        <center>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>Username</label>
                        <input type="text" name="name" required>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div>
                        <label>Phone</label>
                        <input type="number" name="phone" required>
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <div>
                        <label></label>
                        <center>
                            <input class="btn btn-primary" type="submit" id="submit" name="add_student" value="Add Student">
                        </center>
                    </div>
                </form>
            </div>
        </center>
    </div>
</body>
</html>
