<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview of Form</title>
    <link rel="stylesheet" href="stylePreview.css">
</head>
<body>
    <div class="container">
        <img src="gkv-logo22.png" alt="">
        <h2></h2>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "form";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM students WHERE id = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="submit_updated_data.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="enrollment">Enrollment:</label>
                        <input type="text" id="enrollment" name="enrollment" value="<?php echo $row['enrollment']; ?>" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="class">Class:</label>
                        <input type="text" id="class" name="class" value="<?php echo $row['class']; ?>" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <img src="uploads/<?php echo $row['image']; ?>" alt="Image Preview" style="max-width: 200px;">
                    </div>
                </form>
                <button class="print-button" onclick="printPage()">Print</button>

                <form action="fetch_data.php" method="get">
                    <button type="submit">Back</button>
                </form>
                <?php
            } else {
                echo "No data found for the given ID.";
            }

            $conn->close();
        } else {
            echo "Invalid request.";
        }
        ?>
    </div>

    <script>
        function printPage() {
            window.print();
        }
    </script>
</body>
</html>
