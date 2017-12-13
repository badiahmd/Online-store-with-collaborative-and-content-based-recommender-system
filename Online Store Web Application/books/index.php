<?php
@session_start();



include '../includes/db.inc.php';
include '../includes/magicquotes.inc.php';
include '../includes/cart.inc.php';
$pageTitle = 'Books';
if (isset($_GET['addtocart']) && isset($_GET['ISBN']))
{
	$ISBN=$_GET['ISBN'];
	addtocart($ISBN,1);
	header('Location: ../shopping/');
}
else{
	try
	{
		$sql = 'SELECT * FROM items';
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching data from item table!';
		$pageTitle = 'Error';
		include 'error.html.php';
		exit();
	}
}



$count=0;
while ($row = $result->fetch())
{
$items[] = array('ISBN' => $row['ISBN'],
'bookTitle' => $row['bookTitle'],
'bookAuthor' => $row['bookAuthor'],
'publicationYear' => $row['publicationYear'],
'publisher' => $row['publisher'],
'qtyOnHand' => $row['qtyOnHand'],
'unitPrice' => $row['unitPrice'],
'photo1' => $row['photo1'],
'thumbNail' => $row['thumbNail'],
'featured' => $row['featured']);
$count++;
}
if($count>=1)
	{
	include 'books.html.php';
	exit();
	}
else{
	$error = 'No Books Available to display!';
	$pageTitle = 'Error';
	include 'error.html.php';
	exit();
}
?>