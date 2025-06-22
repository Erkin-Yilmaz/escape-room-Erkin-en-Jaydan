<?php
session_start();
require_once '../dbcon.php';

if (isset($_SESSION['userId'])) {
    if ($_SESSION['userRole'] === 'admin') {
        header('Location: ../admin/dashboard.php');
    } else {
        header('Location: ../index.php');
    }
    exit;
}

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $email && $password) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $dbConnection->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['userId'] = $user['id'];
        $_SESSION['userName'] = $user['name'];
        $_SESSION['userRole'] = $user['role'];

        if ($user['role'] === 'admin') {
            header('Location: ../admin/dashboard.php');
        } else {
            header('Location: ../index.php');
        }
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br>
        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Inloggen</button>
    </form>
    <a href="register.php"><button>Registreren</button></a>
</body>
</html>
