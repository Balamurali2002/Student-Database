<?php
$servername = 'localhost';
$username = 'root'; // username
$password = ''; // password
$dbname = "admindb"; // database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn) {
   echo "Database Connected Successfully";
} else {
   die('Could not connect to MySQL: ' . mysqli_error($conn));
}

// If connection is successful, continue your operations here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the form
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Prepare a SQL statement to check the credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $inputUsername, $inputPassword);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the credentials match
    if ($result->num_rows > 0) {
        echo "Login successful!";
         header("Location: main page.html");
        exit();
        // You can redirect to another page or start a session here
    } else {
        echo "Invalid username or password.";
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
