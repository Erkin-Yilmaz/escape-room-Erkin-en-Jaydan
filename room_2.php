<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_GET['room1_time'])) {
    $_SESSION['room1_time'] = intval($_GET['room1_time']);
    require_once './dbcon.php';
    if (isset($_SESSION['userId'])) {
        $stmt = $dbConnection->prepare("UPDATE users SET room1_time = ? WHERE id = ?");
        $stmt->execute([$_SESSION['room1_time'], $_SESSION['userId']]);
    }
}
?>


<?php
require_once('./dbcon.php');

try {
  $stmt = $dbConnection->query("SELECT * FROM questions WHERE roomId = 2");
  $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Databasefout: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room 2</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <h1>room 2</h1>
  <script>
  let totalQuestions = <?php echo count($questions); ?>;
</script>

<script src="app.js"></script><div class="timer">
  <div class="time">

    <strong>Time left: <span id="time">Loading...</span></strong>
  </div>
</div>

<script>
  startCountdown(5, function () {
    window.location.href = "WinVerlies/lose.php";
  });
</script>
  <div class="container">
    <?php foreach ($questions as $index => $question) : ?>
    <div class="box box<?php echo $index + 1; ?>" onclick="openModal(<?php echo $index; ?>)"
      data-index="<?php echo $index; ?>" data-question="<?php echo htmlspecialchars($question['question']); ?>"
      data-answer="<?php echo htmlspecialchars($question['answer']); ?>">
      Box <?php echo $index + 1; ?>
    </div>
    <?php endforeach; ?>
  </div>

  <section class="overlay" id="overlay" onclick="closeModal()"></section>

  <section class="modal" id="modal">
    <h2>Escape Room Vraag</h2>
    <p id="question"></p>
    <input type="text" id="answer" placeholder="Typ je antwoord">
    <button onclick="checkAnswer()">Verzenden</button>
    <p id="feedback"></p>
  </section>

  <script src="app.js"></script>

</body>

</html>

