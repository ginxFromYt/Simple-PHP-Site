<?php
// Include the database configuration file
include 'includes/config.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate the form data
    if ($password !== $confirmPassword) {
        echo "Password and confirm password do not match.";
        exit();
    }

    // Check if email already exists in the database
    $checkQuery = "SELECT COUNT(*) FROM users WHERE email = ?";
    $checkStmt = $mysqli->prepare($checkQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        // Email already exists in the database
        echo "Error: An account with this email already exists.";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert data into the database
    $query = "INSERT INTO users (first_name, middle_name, last_name, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssss", $firstName, $middleName, $lastName, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "Sign-up successful!";
        // You can redirect the user to another page or display a success message
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="styles/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Sign Up</h3>
                    </div>
                    <div class="card-body">
                        <div id="alert-container"></div> <!-- Placeholder for alerts -->
                        <form id="signup-form" action="signup.php" method="POST">
                            <!-- Your form fields -->
                            <div class="form-group mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Already registered? <a href="login.php">Log In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom JavaScript for form handling -->
    <script>
        $(document).ready(function () {
            // Handle form submission
            $('#signup-form').submit(function (e) {
                e.preventDefault(); // Prevent form from submitting the default way

                // Get form data
                var formData = $(this).serialize();

                // Send AJAX POST request to signup.php
                $.ajax({
                    url: 'signup.php',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // Check server response and display appropriate alerts
                        if (response === "Sign-up successful!") {
                            // Display success alert
                            $('#alert-container').html(`
                        <div class="alert alert-success" role="alert">
                            Sign-up successful! Redirecting...
                        </div>
                    `);
                            // Redirect to login page after a short delay
                            setTimeout(function () {
                                window.location.href = 'login.php';
                            }, 1500);
                        } else {
                            // Display error alert
                            $('#alert-container').html(`
                        <div class="alert alert-danger" role="alert">
                            ${response}
                        </div>
                    `);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Display error alert
                        $('#alert-container').html(`
                    <div class="alert alert-danger" role="alert">
                        Error: Sign-up failed. Please try again.
                    </div>
                `);
                    }
                });
            });
        });

    </script>
</body>


</html>