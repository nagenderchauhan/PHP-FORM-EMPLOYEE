<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetched Data</title>
    <link rel="stylesheet" href="stylesfe.css">
</head>
<body>
    <div class="container">
        <div class="header">
          <div class="button">
               
          <h2 class="center-heading">Fetched Data</h2>  
            
            </div>
            <img src="logo.png" alt=""> 
          
            <form method="post" action="" style="float: right;">   
                    <button type="submit" name="logout" class="signout-button">Sign Out</button>
                </form>
        </div>
        <table>
            <tr>
                <th>Enrollment</th>
                <th>Name</th>
                <th>Class</th>
                <th>Date of Birth</th>
                <th>Phone Number</th>
                <th>Image</th>
                <th>Actions</th>
                <th>Download</th>
            </tr>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "form";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM students";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["enrollment"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["class"] . "</td>";
                    echo "<td>" . $row["dob"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td><img src='uploads/" . $row["image"] . "' alt='" . $row["image"] . "'></td>";
                    echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a>|";
                    echo "<a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
                    echo '<td><a href="download.php?id=' . $row["id"] . '" target="_blank">Download</a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>0 results</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
