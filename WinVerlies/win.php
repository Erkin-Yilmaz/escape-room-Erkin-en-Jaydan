<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_GET['room2_time'])) {
    $_SESSION['room2_time'] = intval($_GET['room2_time']);
    require_once '../dbcon.php';
    if (isset($_SESSION['userId'])) {
        $stmt = $dbConnection->prepare("UPDATE users SET room2_time = ? WHERE id = ?");
        $stmt->execute([$_SESSION['room2_time'], $_SESSION['userId']]);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room</title>
  <link rel="stylesheet" href="stylewl.css">
</head>

<body>
<section id="win" >
  <h1>you won!</h1>
  <p>Je computer doet het weer goed</p>

<p>Je hebt <?php echo isset($_SESSION['room1_time']) ? floor($_SESSION['room1_time']/60) . " min en " . ($_SESSION['room1_time']%60) . " sec" : "- min en - sec"; ?> gedaan over kamer 1</p>
<p>Je hebt <?php echo isset($_SESSION['room2_time']) ? floor($_SESSION['room2_time']/60) . " min en " . ($_SESSION['room2_time']%60) . " sec" : "- min en - sec"; ?> gedaan over kamer 2</p>

  </section>

  



  <!-- De button hieronder is alleen voor testdoeleinden bij het opstarten van het project.
     Deze pagina is bedoeld voor de uitleg van jullie escape room. -->
  
<button type="button" onclick="window.location.href='../index.php'">Terug naar start</button>
<button type="button" onclick="window.location.href='../user/score.php'">Scorebord</button>
</body>

</html>


<style>
   button {
        background-color: #05f81e;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        margin-bottom: 10px;
        border-radius: 10px;
    }
</style>

