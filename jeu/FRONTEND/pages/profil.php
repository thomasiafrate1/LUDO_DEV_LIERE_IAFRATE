<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../BACKEND/php/login.php");
    exit();
}

include '../../BACKEND/php/config.php';

$username = $_SESSION['username'];
$sql = "SELECT username, email, created_at FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Erreur : Utilisateur non trouvé.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="../css/profil.css">
    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
    document.querySelector('.navbar .right').classList.toggle('show');
});

    </script>
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

<div class="container">
    <h1>Profil de <?php echo htmlspecialchars($user['username']); ?></h1>
    <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Date de création :</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
</div>
<footer>
  <div class="footer-container">
      <div class="footer-section">
          <h3>Ludo Online</h3>
          <p>&copy; 2024 Ludo Online. Tous droits réservés.</p>
      </div>
      <div class="footer-section">
          <h4>Navigation</h4>
          <ul>
              <li><a href="#">Accueil</a></li>
              <li><a href="#">À propos</a></li>
              <li><a href="#">Contact</a></li>
              <li><a href="#">Conditions d'utilisation</a></li>
          </ul>
      </div>
      <div class="footer-section">
          <h4>Suivez-nous</h4>
          <ul class="social-links">
              <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
              <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
              <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
          </ul>
      </div>
  </div>
</footer>
</body>
</html>
