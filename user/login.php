<?php
// Op deze pagina logt een gebruiker of admin in.
// Na het inloggen kom je op de pagina waar je een team kunt aanmaken.

session_start();
require_once '../dbcon.php';

// --- LOGIN CHECK: Redirect if already logged in ---
if (isset($_SESSION['userId'])) {
    if ($_SESSION['userRole'] === 'admin') {
        header('Location: ../admin/dashboard.php');
    } else {
        header('Location: ../index.php');
    }
    exit;
}
// --- END LOGIN CHECK ---

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $email && $password) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $db_connection->prepare($sql);
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
        echo "Invalid credentials.";
        // --- REGISTER BUTTON: Show button to go to register page ---
        echo '<br><a href="register.php"><button>Registreren</button></a>';
        // --- END REGISTER BUTTON ---
    }
} else {
    // --- LOGIN FORM: Show login form if not submitted ---
    ?>
    <form method="post">
        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br>
        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Inloggen</button>
    </form>
    <!-- REGISTER BUTTON: Show button to go to register page -->
    <a href="register.php"><button>Registreren</button></a>
    <!-- END REGISTER BUTTON -->
    <?php
    // --- END LOGIN FORM ---
    
} 
?>