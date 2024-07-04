
<?php
error_reporting(0);
session_start();

 if(!isset($_SESSION['username']))
 {
    header("location:login.php");
 }
 elseif($_SESSION['usertype']=='student')

 $host = "localhost";
$user = "root";
$password = "";  // Use the correct password if there is one
$db = "schoolproject";

$connection = mysqli_connect($host, $user, $password, $db);
$name=$_SESSION['username'];

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM user WHERE username='$name'";
$result = mysqli_query($connection, $sql);
$info = $result->fetch_assoc();
if(isset($_POST['update_profile']))
{

   
    
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    
    $query="UPDATE user SET username='$name',email='$email',phone='$phone',password ='$password' WHERE username='$name'";
    $result2=mysqli_query($connection,$query);
    if($result2)
    {
        echo "<script type='text/javascript'>
        alert('updated Successfully');
        </script";
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
        <a href="" class="admin">Student  Dashboard</a>
    <div class="logout">

        <a href=" logout.php"class="btn btn-primary">Logout</a>
</div>
</header>

    <ul>
    <li>
      <a href="student_profile.php">My profile</a>
   </li>
     <li>
      <a href=" ">My Courses</a>
   </li>
   <li>
      <a href=" ">My Result</a>
   </li>
</ul>
<div class="content">
        <h1 class="color">Update Profile</h1>
    </div>

    <div>
        <center>
            <div class="div_deg">
                <form action="#" method="POST">
                   
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
                            <input class="btn btn-primary" type="submit" id="submit" name="update_profile" value="Update">
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
