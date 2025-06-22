
<!-- Op deze pagina kan alleen de admin een nieuwe vraag toevoegen.
     De admin vult een vraag, antwoord, hint en bijbehorend room ID in.
     Deze gegevens worden opgeslagen in de database. -->

<?php
require_once '../dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'] ?? '';
    $answer = $_POST['answer'] ?? '';
    $hint = $_POST['hint'] ?? '';
    $roomId = $_POST['roomId'] ?? '';

    if ($question && $answer && $roomId) {
        $sql = "INSERT INTO questions (question, answer, hint, roomId) VALUES (?, ?, ?, ?)";
        $stmt = $dbConnection->prepare($sql);
        $stmt->execute([$question, $answer, $hint, $roomId]);
        echo "<p style='color:green;'>Vraag toegevoegd!</p>";
    } else {
        echo "<p style='color:red;'>Vul alle verplichte velden in.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vraag toevoegen</title>
    <link rel="stylesheet" href="../styles.css">
    
</head>
<body>
    <h1>Nieuwe vraag toevoegen</h1>
    <form method="post">
        <label for="question">Vraag:</label><br>
        <textarea name="question" id="question" required></textarea><br><br>

        <label for="answer">Antwoord:</label><br>
        <input type="text" name="answer" id="answer" required><br><br>

        <label for="hint">Hint:</label><br>
        <input type="text" name="hint" id="hint"><br><br>

        <label for="roomId">Room ID:</label><br>
        <input type="number" name="roomId" id="roomId" required><br><br>

        <button type="submit">Toevoegen</button>
    </form>
    <br>
    <a href="show_all_questions.php"><button>Bekijk alle vragen</button></a>
    <a href="dashboard.php"><button>Terug naar dashboard</button></a>

<style>
    button {
        background-color: #05f81e;
        color: black;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 10px;
     }

</style>


</body>
</html>