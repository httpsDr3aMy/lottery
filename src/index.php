<?php
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    session_destroy();
    setcookie("username", "", time() - 3600, "/"); 

    header('Location: login.php');
    exit;
}
include('../includes/services/db.php');
include('../includes/core/functions.php');

session_start();
$reward = "";
$balance = getBalance($_SESSION["username"], $conn);
$historyResult = getLotteryHistory($_SESSION["username"], $conn);

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numbers'])) {
    $userNumbers = array_map('intval', $_POST['numbers']);
    sort($userNumbers);

    if (count($userNumbers) === 6) {
        $lottoNumbers = drawLottoNumbers();
        $reward = assignReward($userNumbers, $lottoNumbers, $conn, $_SESSION['username']);
        saveHistoryToDatabase($userNumbers, $lottoNumbers, $conn);
        $_SESSION['last_draw_time'] = time();
        $_SESSION['lotto_numbers'] = $lottoNumbers;
    } else {
        $reward = 'Musisz wybrać dokładnie 6 liczb!';
    }

    $_SESSION['reward'] = $reward;
    $_SESSION['user_numbers'] = $userNumbers;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_SESSION['lotto_numbers'])) {
    $lottoNumbers = $_SESSION['lotto_numbers'];
    unset($_SESSION['lotto_numbers']);
}

if (isset($_SESSION['user_numbers'])) {
    $userNumbers = $_SESSION['user_numbers'];
    unset($_SESSION['user_numbers']);
}

?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loteria - Witaj <?php echo htmlspecialchars($_SESSION['username']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Modal  -->
    <div id="maxNumbersModal" class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-75 hidden">
        <div class="bg-white p-6 rounded shadow-md text-center max-w-sm mx-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Osiągnięto limit!</h2>
            <p class="text-lg">Możesz zaznaczyć maksymalnie 6 liczb.</p>
            <button id="closeModalButton" class="mt-4 bg-red-500 text-white py-2 px-4 rounded">Zamknij</button>
        </div>
    </div>

    <div class="max-w-xl mx-auto p-8">
        <div class="bg-white p-6 rounded shadow-md text-center">
            <h1 class="text-2xl font-bold mb-4">Witaj w Loterii, <?php echo htmlspecialchars($_SESSION['username']); ?>!
            </h1>
            <p class="text-lg mb-4">Wybierz 6 liczb z zakresu od 1 do 49:</p>

            <form action="" method="POST">
                <div class="grid grid-cols-3 gap-2 mb-4">
                    <?php for ($i = 1; $i <= 49; $i++): ?>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="numbers[]" value="<?php echo $i; ?>"
                                class="form-checkbox text-blue-500">
                            <span class="ml-2"><?php echo $i; ?></span>
                        </label>
                    <?php endfor; ?>
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded mt-4">Zatwierdź wybór</button>
            </form>

            <?php if ($reward): ?>
                <div class="mt-4">
                    <span class="text-xl font-semibold text-green-500"><?php echo htmlspecialchars($reward); ?></span>
                </div>
            <?php endif; ?>

            <div class="mt-6 bg-gray-200 p-4 rounded">
                <h2 class="text-lg font-bold">Podsumowanie Twojego losowania:</h2>
                <?php if (isset($userNumbers) && isset($lottoNumbers)): ?>
                    <p class="text-sm mt-2">Twoje liczby:
                        <span class="font-semibold text-blue-600"><?php echo implode(', ', $userNumbers); ?></span>
                    </p>
                    <p class="text-sm mt-2">Wylosowane liczby:
                        <span class="font-semibold text-green-600"><?php echo implode(', ', $lottoNumbers); ?></span>
                    </p>
                <?php else: ?>
                    <p class="text-sm text-gray-600">Brak losowania do wyświetlenia.</p>
                <?php endif; ?>
            </div>


            <h2 class="text-lg font-semibold mt-6">Twoje saldo:</h2>
            <p class="text-xl font-bold text-blue-500 mb-4">
                <?php echo number_format($balance, 2); ?> PLN
            </p>

            <h2 class="text-lg font-semibold mt-6">Historia Twoich losowań:</h2>
            <ul class="list-disc list-inside mt-2">
                <?php if ($historyResult->num_rows > 0): ?>
                    <?php while ($history = $historyResult->fetch_assoc()): ?>
                        <li class="text-sm">Twoje liczby: <?php echo htmlspecialchars($history['user_numbers']); ?> | Wylosowane
                            liczby: <?php echo htmlspecialchars($history['lotto_numbers']); ?></li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li class="text-sm">Brak historii losowań.</li>
                <?php endif; ?>
            </ul>

            <a href="?logout=true" class="bg-red-500 text-white py-2 px-4 rounded mt-4 inline-block">Wyloguj się</a>

        </div>
    </div>

    <script src="app.js"></script>
</body>

</html>