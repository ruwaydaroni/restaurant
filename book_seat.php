<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

file_put_contents('php://stderr', print_r($data, true));

if (
    isset($data['name'], $data['email'], $data['phone'], $data['date'], 
           $data['time'], $data['guests'], $data['seats']) &&
    is_array($data['seats'])
) {
 
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, date, time, guests, seats) VALUES (?, ?, ?, ?, ?, ?, ?)");


    if ($stmt === false) {
        echo json_encode(["message" => "Database error: " . $conn->error]);
        exit;
    }

    
    $seats = implode(',', $data['seats']); 
   
    $stmt->bind_param("sssssis", 
        $data['name'], 
        $data['email'], 
        $data['phone'], 
        $data['date'], 
        $data['time'], 
        $data['guests'], 
        $seats 
    );

    if ($stmt->execute()) {
        echo json_encode(["message" => "Booking successful!"]);
    } else {
        echo json_encode(["message" => "Database error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "Invalid data. Please provide all required fields."]);
}

$conn->close();
?>
