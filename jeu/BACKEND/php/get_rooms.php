<?php
include 'config.php';

$sql = "SELECT room_name, created_at, max_players, status FROM rooms WHERE status = 'en cours'";
$result = $conn->query($sql);

$rooms = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
}

echo json_encode($rooms);

$conn->close();
?>
