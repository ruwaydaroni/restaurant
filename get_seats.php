<?php
include 'db.php';

// Initialize an array to hold the seat data
$seats = [];

// Query to fetch seat availability
$result = $conn->query("SELECT seat, available FROM seats");

// Check if the query was successful
if ($result) {
    // Fetch all seat records into the array
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }

    // Free the result set
    $result->free();
} else {
    // Handle query error
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    exit;
}

// Encode the seat data as JSON
header('Content-Type: application/json'); // Set the correct content type
echo json_encode($seats);

// Close the database connection
$conn->close();
?>
