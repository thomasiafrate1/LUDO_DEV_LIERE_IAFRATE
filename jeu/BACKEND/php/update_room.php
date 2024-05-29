<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_name = $_POST['room_name'];
    $status = $_POST['status'];

    $sql = "UPDATE rooms SET status='$status' WHERE room_name='$room_name'";

    if ($conn->query($sql) === TRUE) {
        echo "État de la room mis à jour avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
