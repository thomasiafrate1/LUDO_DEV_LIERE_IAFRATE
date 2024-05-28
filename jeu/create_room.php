<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_name = $_POST['room_name'];
    $max_players = $_POST['max_players'];
    $status = "en cours"; // Status par défaut

    if (empty($room_name) || empty($max_players)) {
        echo "Erreur : Le nom de la room ou le nombre de joueurs est manquant.";
        exit();
    }

    $sql = "INSERT INTO rooms (room_name, max_players, status) VALUES ('$room_name', '$max_players', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Room créée avec succès avec l'ID: " . $conn->insert_id;
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
