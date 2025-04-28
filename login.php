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

session_start(); // Start session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'email' and 'password' fields exist in the POST data
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Get form data
        $email = $_POST['email'];
        $pass = $_POST['password'];

        // Query to check if the email exists in the database
        $check_email_query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($check_email_query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email found, fetch user data
            $user = $result->fetch_assoc();
            
            // Verify the password
            if (password_verify($pass, $user['password'])) {
                // Password is correct, login successful
                $_SESSION['username'] = $user['username']; // Store username in session
                $_SESSION['email'] = $user['email']; // Store email in session

                // Set success message
                $_SESSION['login_success'] = "Login successful! Welcome back, " . $user['username'];

                // Redirect to a protected page (e.g., dashboard)
                header("Location: booking.html");
                exit; // Stop further script execution
            } else {
                // Password is incorrect
                echo "Invalid password.";
            }
        } else {
            // Email not found in database
            echo "No user found with that email address.";
        }
        
        $stmt->close();
    } else {
        // Handle the case where 'email' or 'password' are not set
        echo "Please enter both email and password.";
    }
}

$conn->close();
?>
