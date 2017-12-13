<?php
include '../includes/db.inc.php';
session_start();
session_destroy();
$sql2 = 'DELETE FROM Temp';
$y = $pdo->prepare($sql2);
$y->execute();

unset($_SESSION['cart']);
header('Location: index.php?logout=true');
exit();
?>

