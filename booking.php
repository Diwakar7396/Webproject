<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'car_parking'); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and escape form data
$name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
$phone = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');
$vehicle = mysqli_real_escape_string($conn, $_POST['vehicle'] ?? '');
$date = mysqli_real_escape_string($conn, $_POST['date'] ?? '');
$time = mysqli_real_escape_string($conn, $_POST['time'] ?? '');
$end_time = mysqli_real_escape_string($conn, $_POST['end_time'] ?? '');
$place = mysqli_real_escape_string($conn, $_POST['place'] ?? '');
$slot = mysqli_real_escape_string($conn, $_POST['slot'] ?? '');
$exit_gate = mysqli_real_escape_string($conn, $_POST['exit_gate'] ?? '');
$card_name = mysqli_real_escape_string($conn, $_POST['card_name'] ?? '');
$card_number = mysqli_real_escape_string($conn, $_POST['card_number'] ?? '');
$expiry_month = mysqli_real_escape_string($conn, $_POST['expiry_month'] ?? '');
$expiry_year = mysqli_real_escape_string($conn, $_POST['expiry_year'] ?? '');
$cvv = mysqli_real_escape_string($conn, $_POST['cvv'] ?? '');

// Ensure the table name is correct and exists
$query = "INSERT INTO parking_booking (name, phone, vehicle, date, time, end_time, place, slot, exit_gate, card_name, card_number, expiry_month, expiry_year, cvv) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";  // Ensure that 14 placeholders are present

// Prepare statement
$stmt = $conn->prepare($query);

// Bind parameters (14 parameters for 14 placeholders)
$stmt->bind_param("ssssssssssssss", $name, $phone, $vehicle, $date, $time, $end_time, $place, $slot, $exit_gate, $card_name, $card_number, $expiry_month, $expiry_year, $cvv);

// Execute the query
if ($stmt->execute()) {
    echo "Booking successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
