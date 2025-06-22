<?php
require_once '../dbcon.php';

// Fetch all users and their scores
$stmt = $dbConnection->query("SELECT name, room1_time, room2_time FROM users ORDER BY name");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Scorebord</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        table { margin: 0 auto; border-collapse: collapse; border-radius: 12px; }
        th, td { border: 1px solid #05f81e; padding: 8px; border-radius: 10px; }
        form { display: inline; }
    </style>
</head>
<body>
    <h1>Scorebord</h1>
    <table>
        <tr>
            <th>Naam</th>
            <th>Score kamer 1</th>
            <th>Score kamer 2</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td>
                    <?= isset($user['room1_time']) && $user['room1_time'] !== null
                        ? floor($user['room1_time']/60) . "m " . ($user['room1_time']%60) . "s"
                        : "-" ?>
                </td>
                <td>
                    <?= isset($user['room2_time']) && $user['room2_time'] !== null
                        ? floor($user['room2_time']/60) . "m " . ($user['room2_time']%60) . "s"
                        : "-" ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="../index.php"><button>Probeer opniew</button></a>
</body>
</html>

<style>
    
    a{
        color: black;
    }

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