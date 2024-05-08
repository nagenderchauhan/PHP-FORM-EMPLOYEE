<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['id'])) {
   
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "DELETE FROM students WHERE id='$id'";
 
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        // Redirect to fetch_data.php
        header("Location: fetch_data.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "ID parameter is missing";
}

$conn->close();
?>
