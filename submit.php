<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "form";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Gather form data
    $enrollment = $_POST['enrollment'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];

    // Check if file was uploaded without errors
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $temp_file = $_FILES['image']['tmp_name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);

        // Move uploaded file to desired directory
        if (move_uploaded_file($temp_file, $target_file)) {
            // Insert data into database
            $sql = "INSERT INTO students (enrollment, name, class, dob, phone, image) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("ssssss", $enrollment, $name, $class, $dob, $phone, $image);

            // Execute the statement
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Error uploading file. Please try again.";
    }

    // Close connection
    $conn->close();
}
?>
