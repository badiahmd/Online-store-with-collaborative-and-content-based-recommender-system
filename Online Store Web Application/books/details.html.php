<?php
include_once '../includes/helpers.inc.php';
include '../includes/db.inc.php';
include '../includes/magicquotes.inc.php';
// include_once '../includes/cart.inc.php';



//if (!isset($_GET['itemCode']))
//{
//$error = 'Could not find requested item!';
//$pageTitle = 'Error';
//include 'error.html.php';
//exit();
//}

$ISBN = $_GET['ISBN'];
try
{
	$sql = "SELECT * FROM items WHERE ISBN = '$ISBN'";
	$result = $pdo->query($sql);
}
catch (PDOException $e)
{
	$error = 'Error fetching item from item table!';
	$pageTitle = 'Error';
	include 'error.html.php';
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
$pageTitle = $row['bookTitle'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php htmlout($pageTitle); ?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/lightbox.js"></script>
<link rel="stylesheet" href="../css/lightbox.css" type="text/css" media="screen" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div id="wrap">

        <?php include_once '../includes/header.inc.php'; ?>


       <div class="center_mid_content">
       	<div class="middle_content">


			<?php if (isset($items)): ?>
        	<?php foreach ($items as $item): ?>
            <div class="title"><i class="material-icons" style="font-size:45px;color:grey"> description</i>
            <span class = "title_pos"><?php echo $item['bookTitle'];?></span></div>

        	<div class="feat_prod_box_details1">

            	<div class="prod_img"><a href="smallimage.php?imagename=<?php echo $item['photo1'];?>" rel="lightbox[booksimages]"><img src="../images/<?php echo $item['thumbNail'];?>" alt="" title="" border="0" width="66" height="100" /></a>
                <br /><br />
                
                <?php
                	if(isset($item['photo2']) && $item['photo2']!='')
                	{
                ?>
                <a href="smallimage.php?imagename=<?php echo $item['photo2'];?>" rel="lightbox[booksimages]"></a>
                <?php
                	}
                ?>
                <?php
                	if(isset($item['photo3']) && $item['photo3']!='')
                	{
                ?>
                <a href="smallimage.php?imagename=<?php echo $item['photo3'];?>" rel="lightbox[booksimages]"></a>
                <?php
                	}
                ?>


                </div>

                <div class="prod_det_box">
                	<div class="box_top"></div>
                    <div class="box_center">
                    <div class="prod_title"><strong>Descriptions</strong></div>
                    <p class="details"><strong>ISBN</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?> : <?php echo $item['ISBN'];?><br><br>
                        <strong>Book Author</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>: <?php echo $item['bookAuthor'];?><br><br>
                        <strong>Publication Year</strong><?php echo "&nbsp;&nbsp;"?>: <?php echo $item['publicationYear'];?><br><br>
                        <strong>Book Publisher</strong><?php echo "&nbsp;&nbsp;&nbsp;"?>: <?php echo $item['publisher']; ?><br><br>
                        <strong>Book Price</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"?> :<span class="red"> <?php echo $item['unitPrice']; ?> .RM</span>

                    <?php
                        if(isset($_SESSION['loggedin']))
                        {
                            $user = $_SESSION['custID'];
                    ?>
                     <div class= "ratings"><strong>RATE ITEM: </strong>

                     <?php 
                        try {
                            $sql2 = 'SELECT rating from ratings WHERE custID = :custid AND ISBN= :isbn';
                            $a2 = $pdo->prepare($sql2);
                            $a2->bindValue(':custid', $user);
                            $a2->bindValue(':isbn', $ISBN);
                            $a2->execute();
                            $row2 = $a2->fetch();
                            $current_rating = $row2['rating'];
                        if($current_rating == '1'){
                        ?>
                            <form action="#" method="post">
                            <span class="star-rating">
                              <input type="radio" name="rating" value="1" checked="checked" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=1'"><i></i>
                              <input type="radio" name="rating" value="2" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=2'"><i></i>
                              <input type="radio" name="rating" value="3" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=3'"><i></i>
                              <input type="radio" name="rating" value="4" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=4'"><i></i>
                              <input type="radio" name="rating" value="5" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=5'"><i></i>
                            </span>

                            </form>
                            <div id="display-area"></div>
                        <?php
                        }
                        elseif ($current_rating == '2'){
                        ?>
                            <form action="#" method="post">
                            <span class="star-rating">
                              <input type="radio" name="rating" value="1" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=1'"><i></i>
                              <input type="radio" name="rating" value="2" checked="checked" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=2'"><i></i>
                              <input type="radio" name="rating" value="3" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=3'"><i></i>
                              <input type="radio" name="rating" value="4" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=4'"><i></i>
                              <input type="radio" name="rating" value="5" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=5'"><i></i>
                            </span>

                            </form>
                            <div id="display-area"></div>
                        <?php
                        }
                         elseif ($current_rating == '3'){
                        ?>
                            <form action="#" method="post">
                            <span class="star-rating">
                              <input type="radio" name="rating" value="1" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=1'"><i></i>
                              <input type="radio" name="rating" value="2" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=2'"><i></i>
                              <input type="radio" name="rating" value="3" checked="checked" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=3'"><i></i>
                              <input type="radio" name="rating" value="4" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=4'"><i></i>
                              <input type="radio" name="rating" value="5" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=5'"><i></i>
                            </span>

                            </form>
                            <div id="display-area"></div>                        
                        <?php
                        }

                         elseif ($current_rating == '4'){
                        ?>
                            <form action="#" method="post">
                            <span class="star-rating">
                              <input type="radio" name="rating" value="1" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=1'"><i></i>
                              <input type="radio" name="rating" value="2" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=2'"><i></i>
                              <input type="radio" name="rating" value="3" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=3'"><i></i>
                              <input type="radio" name="rating" value="4" checked="checked" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=4'"><i></i>
                              <input type="radio" name="rating" value="5" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=5'"><i></i>
                            </span>

                            </form>
                            <div id="display-area"></div>
                        <?php
                        }

                        elseif ($current_rating == 5){
                        ?>
                            <form action="#" method="post">
                            <span class="star-rating">
                              <input type="radio" name="rating" value="1" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=1'"><i></i>
                              <input type="radio" name="rating" value="2" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=2'"><i></i>
                              <input type="radio" name="rating" value="3" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=3'"><i></i>
                              <input type="radio" name="rating" value="4" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=4'"><i></i>
                              <input type="radio" name="rating" value="5" checked="checked" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=5'"><i></i>
                            </span>

                            </form>
                            <div id="display-area"></div>
                        <?php
                        }
                        else{
                        ?>
                            <form action="#" method="post">
                            <span class="star-rating">
                              <input type="radio" name="rating" value="1" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=1'"><i></i>
                              <input type="radio" name="rating" value="2" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=2'"><i></i>
                              <input type="radio" name="rating" value="3" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=3'"><i></i>
                              <input type="radio" name="rating" value="4" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=4'"><i></i>
                              <input type="radio" name="rating" value="5" data-id="1" onclick="window.location='rate.php?item=<?php echo $ISBN;?>&id=<?php echo $_SESSION['custID'];?>&rating=5'"><i></i>
                            </span>

                            </form>

                            <div id="display-area"></div>
                        <?php
                        }

                        }
                        catch (PDOException $e)
                        {
                            $error = 'Error on rating itemsss';
                            echo $error;
                        }
                     ?>
                    
                    </div>
                    </p>
                    <?php
                    }
                    ?>

                    <?php 
                        if(isset($_SESSION['loggedin']))
                        {
                    ?>
					           <a href="index.php?addtocart=yes&ISBN=<?php echo $item['ISBN']?>" class="order_btn">
                     <img src="../images/cart.gif" class="cart_logo" alt="" title="" border="0" />
                     <span class = "cart_det">Add to Cart</span></a>
                    <?php 
                        }
                        else
                        {
                    ?>
                      <a href="../myaccount/index.php" class="order_btn">
                      <img src="../images/cart.gif" class="cart_logo" alt="" title="" border="0" />
                      <span class = "cart_det">Add to Cart</span></a>
                    <?php 
                        }
                    ?>

                    <div class="clear"></div>
                    </div>

                    <div class="box_bottom"></div>
                </div>
            <div class="clear"></div>
            </div>

			<?php endforeach; ?>

			<?php endif; ?>



        <div class="clear"></div>
        </div><!--end of middle content-->

       <div class="clear"></div>
       </div><!--end of center content-->


      <?php include_once '../includes/footer.inc.php'; ?>


</div>

</body>
<script type="text/javascript">

var tabber1 = new Yetii({
id: 'demo'
});

</script>
</html>