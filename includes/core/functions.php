<?php
function getBalance($username, $conn) {
    $query = "SELECT balance FROM users WHERE username = '$username'";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        return $user['balance'];
    }
    return 0;
}

function updateBalance($username, $amount, $conn) {
    $query = "UPDATE users SET balance = balance + $amount WHERE username = '$username'";
    $conn->query($query);
}

function saveHistoryToDatabase($userNumbers, $lottoNumbers, $conn) {
    $username = $_SESSION['username'];
    
    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $userNumbersStr = implode(',', $userNumbers);
        $lottoNumbersStr = implode(',', $lottoNumbers);
        $query = "INSERT INTO lottery_history (username, user_numbers, lotto_numbers) VALUES ('$username', '$userNumbersStr', '$lottoNumbersStr')";
        $conn->query($query);
    } else {
        die("Błąd: Użytkownik nie istnieje w bazie danych.");
    }
}


function drawLottoNumbers() {
    $numbers = [];
    while (count($numbers) < 6) {
        $randomNumber = rand(1, 49);
        if (!in_array($randomNumber, $numbers)) {
            $numbers[] = $randomNumber;
        }
    }
    sort($numbers);
    return $numbers;
}

function assignReward($userNumbers, $lottoNumbers, $conn, $username) {
    $reward = '';
    $matchingNumbers = count(array_intersect($userNumbers, $lottoNumbers));
    switch ($matchingNumbers) {
        case 6:
            $reward = 'Gratulacje! Wygrałeś główną nagrodę: 1,000,000 PLN!';
            updateBalance($username, 1000000, $conn);
            break;
        case 5:
            $reward = 'Wygrałeś 10,000 PLN za 5 trafionych liczb!';
            updateBalance($username, 10000, $conn);
            break;
        case 4:
            $reward = 'Wygrałeś 500 PLN za 4 trafione liczby!';
            updateBalance($username, 500, $conn);
            break;
        case 3:
            $reward = 'Wygrałeś 50 PLN za 3 trafione liczby!';
            updateBalance($username, 50, $conn);
            break;
        default:
            $reward = 'Niestety, nie trafiłeś żadnej liczby. Spróbuj ponownie!';
            updateBalance($username, -10, $conn);  // Odejmowanie za próbę
            break;
    }
    return $reward;
}


function isLotteryTime() {
    if (isset($_SESSION['last_draw_time'])) {
        $lastDrawTime = $_SESSION['last_draw_time'];
        if (time() - $lastDrawTime > 3600) {
            return true;
        }
    }
    return false;
}

function getLotteryHistory($username, $conn) {
    $query = "SELECT * FROM lottery_history WHERE username = '$username' ORDER BY id DESC";
    return $conn->query($query);
}
?>
