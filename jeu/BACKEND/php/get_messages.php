<?php
include 'config.php';

header('Content-Type: application/json');

// Récupérer les messages dans l'ordre croissant des timestamps
$sql = "SELECT username, message, timestamp FROM messages ORDER BY timestamp ASC";
$result = $conn->query($sql);

$messages = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

echo json_encode($messages);

$conn->close();
?>
