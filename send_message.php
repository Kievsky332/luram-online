<?php 
// Включение отображения ошибок


$message = $_POST['message'] ?? '';
$username = $_COOKIE['username'] ?? 'Anonymous'; // Добавлен дефолт на случай отсутствия куки
$dsn = "mysql:host=localhost;dbname=bd;charset=utf8mb4";
    
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
    PDO::ATTR_EMULATE_PREPARES   => false,                  
];

try {
    $pdo = new PDO($dsn, "", "", $options);

    if ($message === 'clearest') {
        // Очистка таблицы
        $pdo->query("TRUNCATE TABLE `message`");
    } 
    // Если отправлен файл И есть текст сообщения
    elseif (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK && $message !== '') {
        $file = $_FILES['file'];
        $uploadDir = 'photo/'; 
        $uploadFile = $uploadDir . basename($file['name']);
        $filename = rawurlencode(basename($file['name']));

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $dir = "<img src=\"https://luram.sorav.ru/photo/$filename\" id=\"photo\">";
            $stmt = $pdo->prepare("INSERT INTO `message` (`name`, `message`, `image`) VALUES (:name, :message, :img)");
            $stmt->execute([
                'name'    => $username,
                'message' => $message,
                'img'     => $dir
            ]);
        } else { 
            echo "Ошибка при загрузке файла.";
        } 
    } 
    // Если отправлен ТОЛЬКО файл (текст пустой)
    elseif (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];
        $uploadDir = 'photo/'; 
        $uploadFile = $uploadDir . basename($file['name']);
        $filename = rawurlencode(basename($file['name']));

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $dir = "<img src=\"https://luram.sorav.ru/photo/$filename\" id=\"photo\">";
            $stmt = $pdo->prepare("INSERT INTO `message` (`name`, `image`) VALUES (:name, :img)");
            $stmt->execute([
                'name' => $username,
                'img'  => $dir
            ]);
        } else { 
            echo "Ошибка при загрузке файла.";
        }
    } 
    // Если отправлен ТОЛЬКО текст (файла нет)
    elseif ($message !== '') {
        $stmt = $pdo->prepare("INSERT INTO `message` (`name`, `message`) VALUES (:name, :message)");
        $stmt->execute([
            'name'    => $username,
            'message' => $message
        ]);
    }

} catch (\PDOException $e) {
    // Выводим ошибку базы данных на экран для отладки
    exit("Ошибка БД: " . $e->getMessage());
}

// Закрываем соединение
$stmt = null; 
$pdo = null;

// Перенаправление
header("Location: chat.php");
exit; // Обязательный exit после редиректа
?>
