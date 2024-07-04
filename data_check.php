

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

if(isset($_POST['apply']))
{
    $data_name = $_POST['name'];
    $data_email = $_POST['email'];
    $data_phone = $_POST['phone'];
    $data_message = $_POST['message'];

    // Assuming $connection is your database connection
    if ($connection) {
        // Prepare the SQL statement
        $stmt = $connection->prepare("INSERT INTO admission (name, email, phone, message) VALUES (?, ?, ?, ?)");
        
        // Bind parameters
        $stmt->bind_param("ssss", $data_name, $data_email, $data_phone, $data_message);
        
        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['message']="your application sent successful";
            header("location:index.php");
        } else {
            echo "Apply failed: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Database connection failed: " . $connection->connect_error;
    }
}
?>



