<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

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
    <style>
        @font-face {
    font-family: 'JungleFont';
    src: url('Junter-0vWjo.otf') format('opentype');
}
body {
    font-family: JungleFont, sans-serif;
    margin: 0;
    background: linear-gradient(to bottom left, #f7f7f7, #f7f7f7);
    background-size: cover;
}
.navbar {
    background-color: #ffffff;
    margin-top: -50px;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    position: fixed;
    width: 100%;
    z-index: 1;
}
.navbar a {
    color: #000000;
    text-decoration: none;
    padding: 14px 20px;
    display: block;
}
.navbar a:hover {
    text-decoration: underline;
}
.navbar .logo {
    font-size: 24px;
    font-weight: bold;
    padding: 5px;
}
.logoimg {
    width: 50px;
}
.navbar .right {
    display: flex;
    align-items: center;
}
.droite {
    display: flex;
    align-items: center;
    margin-left: 20vw;
}
.navbar .right a {
    display: flex;
    align-items: center;
}
.navbar .right img {
    border-radius: 50%;
    width: 32px;
    height: 32px;
    margin-left: 10px;
}
.menu-toggle {
    display: none;
    flex-direction: column;
    cursor: pointer;
}
.menu-toggle span {
    background: #000;
    display: block;
    height: 2px;
    margin: 4px 0;
    width: 25px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .navbar {
        flex-direction: column;
        align-items: flex-start;
    }
    .navbar .right {
        display: none;
        flex-direction: column;
        width: 100%;
    }
    .navbar .right a {
        width: 100%;
        padding: 10px 20px;
    }
    .droite {
        flex-direction: column;
        margin-left: 0;
    }
    .menu-toggle {
        display: flex;
    }
    .navbar .right.show {
        display: flex;
    }
}
      .container {
          padding: 20px;
          text-align: center;
        margin-top: 50px;
      }
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 90vh;
        }
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        .footer-section {
            flex: 1;
            min-width: 200px;
            padding: 10px;
        }
        .footer-section h4, .footer-section h3 {
            margin-bottom: 10px;
        }
        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-section ul li {
            margin: 0 10px;
        }
        .footer-section ul li a {
            color: #fff;
            text-decoration: none;
        }
        .social-links {
            display: flex;
            justify-content: center;
        }
    </style>
    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
    document.querySelector('.navbar .right').classList.toggle('show');
});

    </script>
</head>
<body>

<div class="navbar">
        <div>
            <a href="#" class="logo"><img src="img/logo.png" alt="" class="logoimg"></a>
        </div>
        <div class="right">
            <a href="description.html">Description</a>
            <a href="chat.html">Chat général</a>
            <a href="jeu.php">Le Jeu</a>
            <a href="classement.php">Classement</a>
            <div class="droite">
                <a href="profil.php">Profil <img src="img/3135715.png" alt="Profil"></a>
                <a href="index.php"><img src="img/53494.png" alt=""></a>
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
