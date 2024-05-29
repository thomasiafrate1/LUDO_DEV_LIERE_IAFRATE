<?php
include 'config.php';

// Vider la table classement avant de la mettre à jour
$conn->query("TRUNCATE TABLE classement");

// Copier les données de la table users vers la table classement
$sql = "INSERT INTO classement (id, username, partie_gagne)
        SELECT id, username, partie_gagne FROM users";
if ($conn->query($sql) === TRUE) {
    echo "Table classement mise à jour avec succès.";
} else {
    echo "Erreur lors de la mise à jour de la table classement: " . $conn->error;
}

$conn->close();
?>
