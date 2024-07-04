<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";  // Use the correct password if there is one
$db = "schoolproject";

$connection = mysqli_connect($host, $user, $password, $db);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['course_id'];
$sql = "SELECT * FROM course WHERE id='$id'";
$result = mysqli_query($connection, $sql);
$info = $result->fetch_assoc();

if(isset($_POST['update_course'])) {
    $t_name = $_POST['name'];

    // File upload handling
    $file = $_FILES['image']['name'];
    $dst = "./image/" . $file;
    $dst_db = "image/" . $file;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $dst)) {
        // Inserting teacher details into the database
        $sql = "UPDATE course SET name='$t_name', image='$dst_db' WHERE id='$id'";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $_SESSION['message'] = 'Updated Course is Successful';
            header("Location: view_course.php");
            exit();
        } else {
            $_SESSION['message'] = 'Error updating course: ' . mysqli_error($connection);
            header("Location: view_course.php");
            exit();
        }
    } else {
        $_SESSION['message'] = 'Error uploading image';
        header("Location: view_course.php");
        exit();
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
        <h1 class="color">Update teacher data</h1>
    </div>

    <div>
        <center>
            <div class="div_deg">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div>
                        <label>Course Name</label>
                        <input type="text" name="name" value="<?php echo $info['name']; ?>" required>
                    </div>
                   
                    <div>
                        <label>course old image</label>
                        <img width="100px" height="100px" src="<?php echo $info['image']; ?>">
                    </div>
                    <div>
                        <label>Choose course new image</label>
                        <input type="file" name="image">
                    </div>
                    <div>
                        <label></label>
                        <center>
                            <input class="btn btn-primary" type="submit" id="submit" name="update_course" value="Update">
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
