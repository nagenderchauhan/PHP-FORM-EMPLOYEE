<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylePreview.css">
    <script>
        function validateName() {
            var nameInput = document.getElementById("name");
            var name = nameInput.value.trim();
            var regex = /^[a-zA-Z ]*$/;
            if (!regex.test(name)) {
                alert("Invalid name format. Only letters and white space allowed.");
                nameInput.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <img src="gkv-logo22.png" alt="Logo">
        <h2>Registration Form</h2>
        <form action="submit.php" method="POST" enctype="multipart/form-data" onsubmit="return validateName()">
            <div class="form-group">
                <label for="enrollment">Enrollment:</label>
                <input type="text" class="form-control" id="enrollment" name="enrollment" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="class">Class:</label>
                <input type="text" class="form-control" id="class" name="class" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" required accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
