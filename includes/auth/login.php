<?php
function loginUser($username, $password, $conn) {
    $user = getUserByUsername($username, $conn);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        return "Błędna nazwa użytkownika lub hasło.";
    }
}

function getUserByUsername($username, $conn) {
    $username = mysqli_real_escape_string($conn, $username); // Ochrona przed SQL Injection
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return null;
}
?>
