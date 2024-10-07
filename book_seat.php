<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection
include 'db.php';

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Log the incoming data for debugging
file_put_contents('php://stderr', print_r($data, true));

// Check if the required data is present
if (
    isset($data['name'], $data['email'], $data['phone'], $data['date'], 
           $data['time'], $data['guests'], $data['seats']) &&
    is_array($data['seats']) // Ensure seats is an array
) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, date, time, guests, seats) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Error handling for statement preparation
    if ($stmt === false) {
        echo json_encode(["message" => "Database error: " . $conn->error]);
        exit;
    }

    // Convert seats array to string
    $seats = implode(',', $data['seats']); // Make sure this converts the array to a comma-separated string

    // Bind parameters: ensure types match your database schema
    $stmt->bind_param("sssssis", 
        $data['name'], 
        $data['email'], 
        $data['phone'], 
        $data['date'], 
        $data['time'], 
        $data['guests'], 
        $seats // This should be the comma-separated seat string
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["message" => "Booking successful!"]);
    } else {
        echo json_encode(["message" => "Database error: " . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(["message" => "Invalid data. Please provide all required fields."]);
}

// Close the database connection
$conn->close();
?>
