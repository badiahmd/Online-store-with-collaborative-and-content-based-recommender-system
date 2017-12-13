<?php
include_once 'db.inc.php';
include_once 'magicquotes.inc.php';



try
{
	$result = $pdo->query('SELECT DISTINCT category FROM item');
}
catch (PDOException $e)
{
	$error = 'Error fetching categories from the database!';
	include '../books/error.html.php';
}

foreach ($result as $row)
{
	$categories[] = $row[0];
}

?>

<div class="title"><span class="title_icon"><img src="/Adaptive-Recommender-Web/images/bullet5.gif" alt="" title="" /></span>Categories</div>
<ul class="list">
<?php foreach ($categories as $category) { ?>
<li><a href="/Adaptive-Recommender-Web/books/?category=<?php htmlout($category); ?>"><?php htmlout($category); ?></a></li>
 <?php } ?>

</ul>
</div>