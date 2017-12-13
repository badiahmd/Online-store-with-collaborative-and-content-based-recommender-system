<?php
include '../books/details.html.php';
include '../includes/db.inc.php';

$ISBN = $_GET['item'];
$custID = (int)$_GET['id'];
$rating = (int)$_GET['rating'];

if (isset($_GET['item']) && isset($_GET['id']) && isset($_GET['rating'])){
	
		try
		{
			$mysql1 = 'SELECT COUNT(*) As NoRating FROM ratings WHERE custID = :custid AND ISBN = :isbn';
			$a = $pdo->prepare($mysql1);
			$a->bindValue(':custid', $custID);
			$a->bindValue(':isbn', $ISBN);
			$a->execute();
			$row = $a->fetch();
			$number_rating = $row['NoRating'];
			if($number_rating>=1)
			{
				$sql = 'UPDATE ratings SET
				 rating = :rating
				 WHERE custID = :custid AND
				 ISBN = :isbn';

				$s = $pdo->prepare($sql);
				$s->bindValue(':custid', $custID);
				$s->bindValue(':isbn', $ISBN);
				$s->bindValue(':rating', $rating);
				$s->execute();
				header('Location: ../books/details.html.php?ISBN='.$ISBN);
			}
			else
			{
				$sql1 = 'INSERT INTO ratings SET
				custID = :custid,
				ISBN = :isbn,
				rating = :rating';

				$x = $pdo->prepare($sql1);
				$x->bindValue(':custid', $custID);
				$x->bindValue(':isbn', $ISBN);
				$x->bindValue(':rating', $rating);
				$x->execute();
				header('Location: ../books/details.html.php?ISBN='.$ISBN);
			}
		}
		catch (PDOException $e)
		{
			$error = 'Error on rating item';
			$pageTitle = 'Error';
			include 'error.html.php';
			exit();
		}
						
}else{
	$errors = 'nothing to be rated!';
	echo $errors;
	//header('Location: ../books/details.html.php?ISBN='.$ISBN);
}

?>