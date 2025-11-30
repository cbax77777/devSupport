<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $stmt = $conn->prepare("INSERT INTO tickets (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);
    
    if ($stmt->execute()) {
        echo "Ticket added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>
