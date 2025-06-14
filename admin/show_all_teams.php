<?php
// Op deze pagina zie je een overzicht van alle teams in een tabel.
// Bij elk team staan de teamnaam en de teamleden.
// Er staan knoppen bij om een team te bewerken of te verwijderen. 
// Deze pagina is alleen zichtbaar voor de admin.

require_once '../dbcon.php';

// Handle deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $db_connection->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    echo "<p style='color:green;'>Gebruiker verwijderd.</p>";
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = intval($_POST['edit_id']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $stmt = $db_connection->prepare("UPDATE users SET name=?, email=?, role=? WHERE id=?");
    $stmt->execute([$name, $email, $role, $id]);
    echo "<p style='color:green;'>Gebruiker bijgewerkt.</p>";
}

// Fetch all users
$stmt = $db_connection->query("SELECT * FROM users ORDER BY role, name");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Alle spelers</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        table { margin: 0 auto; border-collapse: collapse; }
        th, td { border: 1px solid #05f81e; padding: 8px; }
        form { display: inline; }
    </style>
</head>
<body>
    <h1>Alle spelers</h1>
    <table>
        <tr>
            <th>Naam</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acties</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <?php if (isset($_GET['edit']) && $_GET['edit'] == $user['id']): ?>
                    <form method="post">
                        <td><input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required></td>
                        <td><input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required></td>
                        <td>
                            <select name="role" required>
                                <option value="player" <?= $user['role'] === 'player' ? 'selected' : '' ?>>player</option>
                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>admin</option>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="edit_id" value="<?= $user['id'] ?>">
                            <button type="submit">Opslaan</button>
                            <a href="show_all_teams.php">Annuleer</a>
                        </td>
                    </form>
                <?php else: ?>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="show_all_teams.php?edit=<?= $user['id'] ?>">Bewerk</a>
                        <a href="show_all_teams.php?delete=<?= $user['id'] ?>" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">Verwijder</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <style>
     a {
        color: #05f81e;
        text-decoration: none;
     }
    </style>
</body>
</html>