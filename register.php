<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "car_parking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    // Hash the password
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Check if email already exists
    $check_email_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Email already registered
        echo "Email already in use.";
    } else {
        // Insert new user into database
        $insert_query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sss", $user, $email, $hashed_password);

        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header("Location: login.html");
            exit; // Make sure to call exit after header to stop further script execution
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    
    $stmt->close();
}

$conn->close();
?>
