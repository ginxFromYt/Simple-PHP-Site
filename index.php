<?php
// Include config file
require_once 'includes/config.php';

// Now you can use $mysqli variable to execute your database queries
// Example:
$sql = "SELECT * FROM users";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        //  echo "id: " . $row["id"] . " - Name: " . $row["name"] . "<br>";
    }
} else {
    //  echo "0 results";
}
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First PHP Site</title>
    <link href="styles/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<?php include 'includes/navigation.php'; ?>


    <div class="container mt-4">
        <h1>Your Landing page design here.</h1>
        <!-- Your content goes here -->
    </div>


<!-- Add jQuery script for logout confirmation -->
<script>
  $(document).ready(function () {
    $('#logout-link').on('click', function (event) {
      // Ask the user for confirmation
      const userConfirmed = confirm('Are you sure you want to log out?');

      // If the user cancels, prevent the default action (logout)
      if (!userConfirmed) {
        event.preventDefault();
      }
    });
  });
</script>
</body>


</html>