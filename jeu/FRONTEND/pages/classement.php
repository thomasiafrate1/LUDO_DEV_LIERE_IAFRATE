<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement</title>
    <style>
         @font-face {
            font-family: 'JungleFont';
            src: url('../font/Junter-0vWjo.otf') format('opentype');
        }
        body {
    font-family: JungleFont, sans-serif;
    margin: 0;
    background: linear-gradient(to bottom left, #f7f7f7, #f7f7f7);
    background-size: cover;
}
.navbar {
    background-color: #ffffff;
    margin-top: -100px;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    position: fixed;
    width: 99%;
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
        .classement-container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 100px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .classement-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .joueur {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .joueur:nth-child(odd) {
            background-color: #f9f9f9;
        }
        .joueur:last-child {
            border-bottom: none;
        }
    </style>
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
