<?php
session_start();
include '../includes/services/db.php';
include '../includes/core/functions.php';
include '../includes/auth/register.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $error = registerUser($username, $password, $conn);

    if ($error === null) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja - Loteria</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-4">Zarejestruj się</h2>
        <?php if (isset($error)) {
            echo "<p class='text-red-500'>$error</p>";
        } ?>
        <form action="register.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Nazwa użytkownika</label>
                <input type="text" name="username" id="username" class="w-full p-2 border border-gray-300 rounded"
                    required>
            </div>
            <div class="mb-2">
                <label for="password" class="block text-gray-700">Hasło</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded"
                    required minlength="8"
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                    title="Hasło musi mieć co najmniej 8 znaków, w tym jedną dużą literę, jedną małą literę, cyfrę i znak specjalny.">
            </div>

            <?php if (isset($error)) {
                echo "<p class='text-red-500 mb-6'>$error</p>";
            } ?>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Zarejestruj</button>
        </form>
        <p class="mt-4 text-center">Masz już konto? <a href="login.php" class="text-blue-500">Zaloguj się</a></p>
    </div>
</body>

</html>