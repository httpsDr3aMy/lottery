<?php

function registerUser($username, $password, $conn) {
    $username = mysqli_real_escape_string($conn, $username); // Ochrona przed SQL Injection
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return "Nazwa użytkownika już istnieje.";
    }

    // Dodanie użytkownika do bazy
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$passwordHash')";

    if (mysqli_query($conn, $sql)) {
        return null;
    } else {
        return "Błąd podczas rejestracji. Spróbuj ponownie.";
    }
}
?>
