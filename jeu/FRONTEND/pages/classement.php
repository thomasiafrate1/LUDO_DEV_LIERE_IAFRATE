<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement</title>
    <link rel="stylesheet" href="../css/classement.css">
</head>
<body>
<div class="navbar">
        <div>
            <a href="#" class="logo"><img src="../img/logo.png" alt="" class="logoimg"></a>
        </div>
        <div class="right">
            <a href="description.html">Description</a>
            <a href="chat.html">Chat général</a>
            <a href="jeu.php">Le Jeu</a>
            <a href="classement.php">Classement</a>
            <div class="droite">
                <a href="profil.php">Profil <img src="../img/3135715.png" alt="Profil"></a>
                <a href="../index.php"><img src="../img/53494.png" alt=""></a>
            </div>
        </div>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
<div class="classement-container">
    <h1>Classement des Joueurs</h1>

    <?php
    include '../../BACKEND/php/config.php';
    $sql = "SELECT username, partie_gagne FROM users ORDER BY partie_gagne DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='joueur'>
                    <span>" . $row['username'] . "</span>
                    <span>" . $row['partie_gagne'] . " Parties Gagnées</span>
                  </div>";
        }
    } else {
        echo "<p>Aucun joueur trouvé</p>";
    }

    $conn->close();
    ?>

</div>

</body>
</html>
