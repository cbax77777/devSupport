<?php
# validar conexión a la base de datos y ejecución de un insert simple
include '../db.php';

// Prueba conexión
if ($conn->connect_errno) {
    echo "FAIL: DB connection\n";
    exit(1);
}

$stmt = $conn->prepare("INSERT INTO tickets (title, description) VALUES ('test title', 'test desc')");
if (!$stmt->execute()) {
    echo "FAIL: INSERT failed\n";
    exit(1);
}

echo "OK: unit tests\n";
?>
