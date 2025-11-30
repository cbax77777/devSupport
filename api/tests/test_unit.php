<?php
include __DIR__ . '/../api/db.php';

// Prueba conexión
if ($conn->connect_errno) {
    echo "FAIL: DB connection\n";
    exit(1);
}

// Prueba ejecución INSERT con valores dummy
$stmt = $conn->prepare("INSERT INTO tickets (title, description) VALUES ('test title', 'test desc')");
if (!$stmt->execute()) {
    echo "FAIL: INSERT failed\n";
    exit(1);
}

echo "OK: unit tests\n";
?>
