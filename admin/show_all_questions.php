<?php
// Op deze pagina zie je alle vragen in een tabel.
// Je ziet per vraag: de vraagtekst, het antwoord, de hint en bij welke room die hoort (roomID).
// Bij elke vraag staan knoppen om deze te bewerken of te verwijderen. 
// Deze pagina is alleen zichtbaar voor de admin.

require_once '../dbcon.php';

// Handle deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $db_connection->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->execute([$id]);
    echo "<p style='color:green;'>Vraag verwijderd.</p>";
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = intval($_POST['edit_id']);
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $hint = $_POST['hint'];
    $roomId = $_POST['roomId'];
    $stmt = $db_connection->prepare("UPDATE questions SET question=?, answer=?, hint=?, roomId=? WHERE id=?");
    $stmt->execute([$question, $answer, $hint, $roomId, $id]);
    echo "<p style='color:green;'>Vraag bijgewerkt.</p>";
}

// Fetch all questions
$stmt = $db_connection->query("SELECT * FROM questions ORDER BY roomId, id");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Alle vragen</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        table { margin: 0 auto; border-collapse: collapse; }
        th, td { border: 1px solid #05f81e; padding: 8px; }
        form { display: inline; }
    </style>
</head>
<body>
    <h1>Alle vragen</h1>
    <table>
        <tr>
            <th>Vraag</th>
            <th>Antwoord</th>
            <th>Hint</th>
            <th>Room ID</th>
            <th>Acties</th>
        </tr>
        <?php foreach ($questions as $q): ?>
            <tr>
                <?php if (isset($_GET['edit']) && $_GET['edit'] == $q['id']): ?>
                    <form method="post">
                        <td><input type="text" name="question" value="<?= htmlspecialchars($q['question']) ?>" required></td>
                        <td><input type="text" name="answer" value="<?= htmlspecialchars($q['answer']) ?>" required></td>
                        <td><input type="text" name="hint" value="<?= htmlspecialchars($q['hint']) ?>"></td>
                        <td><input type="number" name="roomId" value="<?= htmlspecialchars($q['roomId']) ?>" required></td>
                        <td>
                            <input type="hidden" name="edit_id" value="<?= $q['id'] ?>">
                            <button type="submit">Opslaan</button>
                            <a href="show_all_questions.php">Annuleer</a>
                        </td>
                    </form>
                <?php else: ?>
                    <td><?= htmlspecialchars($q['question']) ?></td>
                    <td><?= htmlspecialchars($q['answer']) ?></td>
                    <td><?= htmlspecialchars($q['hint']) ?></td>
                    <td><?= htmlspecialchars($q['roomId']) ?></td>
                    <td>
                        <a href="show_all_questions.php?edit=<?= $q['id'] ?>">Bewerk</a>
                        <a href="show_all_questions.php?delete=<?= $q['id'] ?>" onclick="return confirm('Weet je zeker dat je deze vraag wilt verwijderen?');">Verwijder</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table> 
    <br>
<button type="button" onclick="window.history.back();">Ga terug</button>

</body>

<style>
     a {
        color: #05f81e;
        text-decoration: none;
     }

     button {
        background-color: #05f81e;
        color: black;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 10px;
     }
</style>
</html>