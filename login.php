<?php
session_start();

$hibak = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));
    $emlekezzram = isset($_POST['emlekezzram']) ? true : false;

    if (strlen($username) < 5 || !preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $hibak[] = "A felhasznalonevnek 5ww karakter hosszusagunak kell lennie es csak alfanumerikus betuket es szamokat tartalmazhat es kell benne lennie egy nagybetunek es szamnak";
    }

    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/\d/', $password)) {
        $hibak[] = "A jelszonak 8 karakter hosszusagunak kell lennie es csak alfanumerikus betuket es szamokat tartalmazhat es kell benne lennie egy nagybetunek es szamnak";
    }

    if (empty($hibak)) {
        $_SESSION['username'] = $username;

        if ($emlekezzram) {
            setcookie('username', $username, time() + (7 * 24 * 60 * 60));
        }
        header('Location: profile.php');
        exit();
    }
} else {
    $mentett = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login.php" method="POST">
        <h2>Bejelentkezés</h2>
        <?php
            if (!empty($hibak)) {
                echo '<div style="color: red;">';
                foreach ($hibak as $error) {
                    echo "<p>$error</p>";
                }
                echo '</div>';
            }
        ?>
        <label for="username">Felhasználónév:</label>
        <input type="text" name="username" id="username" value="<?= isset($mentett) ? $mentett : '' ?>" required><br><br>

        <label for="password">Jelszó:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="emlekezzram">Emlékezz rám:</label>
        <input type="checkbox" name="emlekezzram" id="emlekezzram"><br><br>

        <input type="submit" value="Bejelentkezés">
    </form>
</body>
</html>