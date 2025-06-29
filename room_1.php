<?php
require_once('./dbcon.php');

try {
  $stmt = $dbConnection->query("SELECT * FROM questions WHERE roomId = 1");
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
  <title>Escape Room 1</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <h1>room 1</h1>
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
      <!-- de php code in de class zorgt ervoor dat elke box uniek is zodat je deze apart kunt stylen. Zo krijg je dus box1, box2 en box3 -->
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

  

</body>

</html>