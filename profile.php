<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="profile-container">
        <h1 class="profile-header">Üdvözöljük, <?php echo htmlspecialchars($username); ?>!</h1>
        <p class="profile-info">ASd</p>
        <form method="POST">
            <a href="logout.php">Kilépés</a>
        </form>
        </div>
    
</body>
</html>