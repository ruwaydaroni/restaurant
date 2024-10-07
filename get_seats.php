<?php
include 'db.php';

$seats = [];

$result = $conn->query("SELECT seat, available FROM seats");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }

    $result->free();
} else {
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    exit;
}

header('Content-Type: application/json'); 
echo json_encode($seats);

$conn->close();
?>
