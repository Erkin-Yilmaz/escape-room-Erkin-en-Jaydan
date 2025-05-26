
<?php
// --- LOGIN CHECK: Redirect to login if not logged in ---
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: user/login.php');
    exit;
}
// --- END LOGIN CHECK ---
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  <h1>Welkom</h1>
  <p>Je probeerde even geleden "gratis" video games te downloaden via websites die je online hebt gevonden.</p>
  <p>Sindst dien doet je computer raar en heb je geen toegang meer tot je bestanden.</p>
  <p>Je hebt een melding gekregen dat je een escape room moet spelen om weer toegang te krijgen tot je bestanden.</p>
  



  <!-- De button hieronder is alleen voor testdoeleinden bij het opstarten van het project.
     Deze pagina is bedoeld voor de uitleg van jullie escape room. -->
  <button><a href="room_1.php">start kamer 1</a></button>

</body>

</html>