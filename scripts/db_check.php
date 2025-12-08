<?php
$dbFile = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbFile)) {
    echo "DB_MISSING" . PHP_EOL;
    exit(0);
}
try {
    $db = new PDO('sqlite:' . $dbFile);
    $codes = [];
    try {
        $s = $db->query('select code from doctor_codes');
        if ($s) $codes = $s->fetchAll(PDO::FETCH_COLUMN);
    } catch (Exception $e) {
        echo 'ERROR_DOCTOR_CODES: ' . $e->getMessage() . PHP_EOL;
    }
    $users = [];
    try {
        $s2 = $db->query('select id, name, surname, email, role, dikter_id from users limit 20');
        if ($s2) $users = $s2->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo 'ERROR_USERS: ' . $e->getMessage() . PHP_EOL;
    }
    echo json_encode(['doctor_codes' => $codes, 'users' => $users], JSON_PRETTY_PRINT);
} catch (Exception $ex) {
    echo 'ERROR_OPEN_DB: ' . $ex->getMessage() . PHP_EOL;
}

