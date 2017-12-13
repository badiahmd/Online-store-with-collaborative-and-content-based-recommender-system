<?php
include 'includes/db.inc.php';
include 'includes/magicquotes.inc.php';



$pageTitle = 'Adaptive Recommender System';
try
{
	$sql = "SELECT * FROM items WHERE featured = TRUE";
	$result = $pdo->query($sql);
}
catch (PDOException $e)
{
	$error = 'Error fetching featured items from item table!';
	$pageTitle = 'Error';
	include '/Adaptive-Recommender-Web/books/error.html.php';
	exit();
}
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
}

$abcd = $_SESSION['custID'];
$sqlQuery_= "SELECT COUNT(*) As exist FROM itemCF_Recommender where custID = :custid ";
$s_ = $pdo->prepare($sqlQuery_);
$s_->bindValue(':custid', $abc);
$s_->execute();
$rows_ = $s_->fetch();
$recommended_exist = $rows_['exist'];

include 'index.html.php';
?>