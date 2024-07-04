<?php
$host = "localhost";
$user = "root";
$password = "";  // Use the correct password if there is one
$db = "schoolproject";

$connection = mysqli_connect($host, $user, $password, $db);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start(); // Start the session at the beginning

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $pass = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $name, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if ($row["usertype"] == "student") {
            

            $_SESSION['username']=$name;
            $_SESSION['usertype']="student";

            header("Location: studenthome.php");
            exit(); // Ensure no further code is executed
        } elseif ($row["usertype"] == "admin") {
            $_SESSION['username']=$name;
            $_SESSION['usertype']="admin";
            header("Location: adminhome.php");
            exit(); // Ensure no further code is executed
        } else {
            $_SESSION['loginMessage'] = "Username or password do not match";
            header("Location: login.php");
            exit(); // Ensure no further code is executed
        }
    } else {
        $_SESSION['loginMessage'] = "Username or password do not match";
        header("Location: login.php");
        exit(); // Ensure no further code is executed
    }

    $stmt->close();
}

mysqli_close($connection);
?>
