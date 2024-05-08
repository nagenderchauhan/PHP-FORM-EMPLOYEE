<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $enrollment = $row["enrollment"];
        $name = $row["name"];
        $class = $row["class"];
        $dob = $row["dob"];
        $phone = $row["phone"];
    } else {
        echo "Record not found.";
        exit();
    }
} else {
    echo "ID parameter not set.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $enrollment = $_POST["enrollment"];
    $name = $_POST["name"];
    $class = $_POST["class"];
    $dob = $_POST["dob"];
    $phone = $_POST["phone"];
    // Handle image upload similarly

    // Update the record in the database
    $sql = "UPDATE students SET enrollment='$enrollment', name='$name', class='$class', dob='$dob', phone='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Details</title>
    <link rel="stylesheet" href="stylePreview.css">
</head>
<body>
    <div class="container">
    <img src="gkv-logo22.png" alt="">
        <h2>Edit Student Details</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="enrollment">Enrollment:</label>
                <input type="text" id="enrollment" name="enrollment" value="<?php echo $enrollment; ?>" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="class">Class:</label>
                <input type="text" id="class" name="class" value="<?php echo $class; ?>" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" required>
            </div>
            <!-- Include image upload input field here -->
            <input type="file" accept="image/*" onchange="alert(this.files[0].name)" />
            <button type="submit" name="submit">Update</button>
        </form>
        <form action="fetch_data.php" method="get">
                    <button type="submit">Back</button>
                </form>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
