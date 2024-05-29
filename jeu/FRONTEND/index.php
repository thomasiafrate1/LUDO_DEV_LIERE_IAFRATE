<?php
session_start();
include '../BACKEND/php/config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $username = $_POST['login-username'];
        $password = $_POST['login-password'];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                header("Location: pages/jeu.php");
                exit();
            } else {
                $message = "Mot de passe incorrect.";
            }
        } else {
            $message = "Nom d'utilisateur incorrect.";
        }
    } elseif (isset($_POST['register'])) {
        $username = $_POST['register-username'];
        $email = $_POST['register-email'];
        $password = password_hash($_POST['register-password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            $message = "Inscription réussie. Vous pouvez vous connecter.";
        } else {
            $message = "Erreur : " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion / Inscription</title>
    <style>
        @font-face {
            font-family: 'JungleFont';
            src: url('font/Junter-0vWjo.otf') format('opentype');
        }
        body {
            font-family: JungleFont, sans-serif;
            background: linear-gradient(to bottom left, #000000, #393736);
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            display: flex;
            box-shadow: 0 0 400px rgba(0, 0, 0, 0.1);
            width: 800px;
            max-width: 90%;
            border-radius: 10px;
            overflow: hidden;
        }
        .image-section {
            margin-top: 25px;
            margin-bottom: 25px;
            margin-right: 70px;
            margin-left: 20px;
            background: url('img/login.png') no-repeat center center/cover;
            width: 70%;
        }

        .image-section-register {
            
            margin-top: 50px;
            margin-bottom: 50px;
            margin-right: 00px;
            margin-left: 20px;
            background-size: cover;
            width: 100%;
        }
        .image-section {
            background: url('img/login.png') no-repeat center center/cover;
        }
        .image-section-register {
            background: url('img/register.jpg') no-repeat center center/cover;
            display: none;
        }
        .form-section {
            padding: 40px;
            width: 50%;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #473ed1;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #3b32b3;
        }
        .toggle-btn {
            background-color: #fff;
            color: #473ed1;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        .toggle-btn:hover {
            background-color: transparent;
            color: #473ed1;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        .message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="image-section" id="image-login"></div>
    <div class="image-section-register" id="image-register"></div>
    <div class="form-section">
        <h2 id="form-title">Connexion</h2>
        <div class="message"><?php echo $message; ?></div>
        <form id="login-form" method="POST" action="">
            <input type="text" name="login-username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="login-password" placeholder="Mot de passe" required>
            <button type="submit" name="login">Connexion</button>
            <button type="button" class="toggle-btn" onclick="toggleForms()">Créer un compte</button>
        </form>
        <form id="register-form" method="POST" action="" style="display: none;">
            <input type="text" name="register-username" placeholder="Nom d'utilisateur" required>
            <input type="email" name="register-email" placeholder="Email" required>
            <input type="password" name="register-password" placeholder="Mot de passe" required>
            <input type="password" name="register-password-confirm" placeholder="Confirmer le mot de passe" required>
            <button type="submit" name="register">Inscription</button>
            <button type="button" class="toggle-btn" onclick="toggleForms()">Déjà un compte ? Connectez-vous</button>
        </form>
    </div>
</div>

<script>
    function toggleForms() {
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const formTitle = document.getElementById('form-title');
        const loginImage = document.getElementById('image-login');
        const registerImage = document.getElementById('image-register');

        if (loginForm.style.display === 'none') {
            loginForm.style.display = 'block';
            registerForm.style.display = 'none';
            formTitle.textContent = 'Connexion';
            loginImage.style.display = 'block';
            registerImage.style.display = 'none';
        } else {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
            formTitle.textContent = 'Inscription';
            loginImage.style.display = 'none';
            registerImage.style.display = 'block';
        }
    }
</script>

</body>
</html>
