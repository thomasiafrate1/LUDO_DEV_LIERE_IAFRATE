<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Unity WebGL Player | Ludo</title>
    <link rel="shortcut icon" href="TemplateData/favicon.ico">
    <link rel="stylesheet" href="TemplateData/style.css">
    <script src="Build/UnityLoader.js"></script> <!-- Chemin vers UnityLoader.js de votre build -->
</head>
<body>
    <div class="navbar">
        <div>
            <a href="#" class="logo"><img src="img/logo.png" alt="" class="logoimg"></a>
        </div>
        <div class="right">
            <a href="description.html">Description du jeu</a>
            <a href="chat.html">Chat général</a>
            <a href="jeu.php">Le Jeu</a>
            <div class="droite">
                <a href="profil.php">Profil <img src="img/3135715.png" alt="Profil"></a>
                <a href="index.php"><img src="img/53494.png" alt=""></a>
            </div>
        </div>
    </div>

    <div id="unity-container" class="unity-desktop">
        <canvas id="unity-canvas" width="960" height="600" tabindex="-1"></canvas>
        <div id="unity-loading-bar">
            <div id="unity-logo"></div>
            <div id="unity-progress-bar-empty">
                <div id="unity-progress-bar-full"></div>
            </div>
        </div>
        <div id="unity-warning"></div>
        <div id="unity-footer">
            <div id="unity-webgl-logo"></div>
            <div id="unity-fullscreen-button"></div>
            <div id="unity-build-title">Ludo</div>
        </div>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }
        #unity-container {
            z-index: -1;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            margin-top: -100vh;
            position: fixed;
            width: 98vw;
            z-index: 1;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 14px 20px;
            display: block;
        }
        .navbar a:hover {
            background-color: #575757;
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
            justify-content: space-between;
        }
        .droite {
            display: flex;
            align-items: center;
            margin-left: 380px;
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
        .container {
            padding: 20px;
            text-align: center;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 100vh;
        }
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center
        }
        .footer-section {
            flex: 1;
            min-width: 200px;
            padding: 10px
        }
        .footer-section h4, .footer-section h3 {
            margin-bottom: 10px
        }
        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0.
        }
        .footer-section ul li {
            margin: 0 10px
        }
        .footer-section ul li a {
            color: #fff;
            text-decoration: none
        }
        .social-links {
            display: flex;
            justify-content: center
        }
    </style>

    <script>
        var container = document.querySelector("#unity-container");
        var canvas = document.querySelector("#unity-canvas");
        var loadingBar = document.querySelector("#unity-loading-bar");
        var progressBarFull = document.querySelector("#unity-progress-bar-full");
        var fullscreenButton = document.querySelector("#unity-fullscreen-button");
        var warningBanner = document.querySelector("#unity-warning");

        function unityShowBanner(msg, type) {
            function updateBannerVisibility() {
                warningBanner.style.display = warningBanner.children.length ? 'block' : 'none';
            }
            var div = document.createElement('div');
            div.innerHTML = msg;
            warningBanner.appendChild(div);
            if (type == 'error') div.style = 'background: red; padding: 10px;';
            else {
                if (type == 'warning') div.style = 'background: yellow; padding: 10px;';
                setTimeout(function() {
                    warningBanner.removeChild(div);
                    updateBannerVisibility();
                }, 5000);
            }
            updateBannerVisibility();
        }

        var buildUrl = "Build";
        var loaderUrl = buildUrl + "/43.loader.js";
        var config = {
            //Nouveau dossier (22)
            dataUrl: buildUrl + "/43.data",
            frameworkUrl: buildUrl + "/43.framework.js",
            codeUrl: buildUrl + "/43.wasm",
            streamingAssetsUrl: "StreamingAssets",
            companyName: "DefaultCompany",
            productName: "Ludo",
            productVersion: "1.0",
            showBanner: unityShowBanner,
        };

        if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
            var meta = document.createElement('meta');
            meta.name = 'viewport';
            meta.content = 'width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, shrink-to-fit=yes';
            document.getElementsByTagName('head')[0].appendChild(meta);
            container.className = "unity-mobile";
            canvas.className = "unity-mobile";
        } else {
            canvas.style.width = "960px";
            canvas.style.height = "600px";
        }

        loadingBar.style.display = "block";

        var script = document.createElement("script");
        script.src = loaderUrl;
        script.onload = () => {
            createUnityInstance(canvas, config, (progress) => {
                progressBarFull.style.width = 100 * progress + "%";
            }).then((unityInstance) => {
                loadingBar.style.display = "none";
                fullscreenButton.onclick = () => {
                    unityInstance.SetFullscreen(1);
                };
                var username = "<?php echo $username; ?>";
                console.log("Username:", username); // Pour déboguer
                unityInstance.SendMessage('LobbyMainPanel', 'SetPlayerName', username);
            }).catch((message) => {
                alert(message);
            });
        };

        document.body.appendChild(script);
    </script>

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
