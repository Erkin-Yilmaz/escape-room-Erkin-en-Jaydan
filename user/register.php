
<?php
// Op deze pagina kan een gebruiker een account aanmaken.
// Na het registreren kom je automatisch op de inlogpagina terecht.

require_once '../dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($name && $email && $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = 'player'; // always enforced

        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $db_connection->prepare($sql);
        $stmt->execute([$name, $email, $hashedPassword, $role]);

        header('Location: login.php');
        exit;
    } else {
        echo "Vul alle velden in.";
    }
} 
?>
<link rel="stylesheet" href="../styles.css">
<!-- REGISTRATION FORM: Show registration form if not submitted -->
<form method="post">
    <label for="name">Naam:</label>
    <input type="text" name="name" required><br>
    <label for="email">E-mail:</label>
    <input type="email" name="email" required><br>
    <label for="password">Wachtwoord:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Registreren</button>
</form>
<!-- END REGISTRATION FORM -->