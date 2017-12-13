<?php
if(!isset($pageTitle))
{
header('Location: /Adaptive-Recommender-Web/shopping/');
}

$userIDs_ = $_SESSION['custID'];
$sqlQuery_= "SELECT * from items WHERE ISBN IN (SELECT ISBN as Recommended from contentBF_Recommender where custID = :custid)";
$s_ = $pdo->prepare($sqlQuery_);
$s_->bindValue(':custid', $userIDs_);
$s_->execute();


$count_1=0;
while ($row_ = $s_->fetch())
{
$recommended_items_[] = array('ISBN' => $row['ISBN'],
'bookTitle_' => $row['bookTitle'],
'bookAuthor_' => $row['bookAuthor'],
'publicationYear_' => $row['publicationYear'],
'publisher1_' => $row['publisher'],
'qtyOnHand_' => $row['qtyOnHand'],
'unitPrice_' => $row['unitPrice'],
'photo1_' => $row['photo1'],
'thumbNail_' => $row['thumbNail'],
'featured_' => $row['featured']);
$count_1++;
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php htmlout($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php
	if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
		$max=count($_SESSION['cart']);
	}
?>
</head>
<body>
<div id="wrap">

      <?php include_once '../includes/header.inc.php'; ?>

       <div class="center_content">
       	<div class="left_content">
	    <div class="error"><?php echo $error; ?></div>

            <div class="title"><i class="material-icons" style="font-size:45px;color:grey">shopping_cart</i>
			<span class = "title_pos">My Cart</span></div>
       		<?php
       			if($max!=0)
       			{
       		?>
        	<div class="feat_prod_box_details">

			<form method="post" action="?command=update">
            <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:15px; background-color:#E1E1E1" width="100%">
		       	<?php
		   			if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
		               	echo '<tr bgcolor="#FFFFFF" style="font-weight:bold"><td>Cover</td><td>Book Name</td><td>Price</td><td>Qty</td><td>Options</td></tr>';
		   				for($i=0;$i<$max;$i++){
		   					$pid=$_SESSION['cart'][$i]['ISBN'];
		   					$q=$_SESSION['cart'][$i]['qty'];
		   					$pname=get_product_name($pid);
		   					$pcover= get_product_cover($pid);
		   					//if($q==0) continue;
		   			?>
		               		<tr bgcolor="#FFFFFF"><td><a href="../books/details.html.php?ISBN=<?php echo $pid;?>"><img src="../images/<?php echo $pcover?>"</td>
		               		   <td><?php echo $pname?></td>
		                       <td>RM. <?php echo get_price($pid)?></td>
		                       <td><input type="text" name="product<?php echo $pid?>" value="<?php echo $q?>" maxlength="3" size="2" /></td>
		                       <td><a href="index.php?command=delete&ISBN=<?php echo $pid;?>">Remove</a></td></tr>
		               <?php
		   				}
		   			?>
		   				<tr><td colspan="2"><b>Order Total: RM. <?php echo get_order_total()?></b></td><td colspan="3" align="right">

		   				<a href="index.php?command=clear">Clear Cart</a>&nbsp;&nbsp;
		   				<input type="submit" value="Update Cart"></td></tr>
		   			<?php
		               }
		   			else{
		   				echo "<tr bgColor='#FFFFFF'><td>There are no items in your shopping cart!</td>";
		   			}
		   		?>

        	   </table>
        	   </form>

            <a href="/Adaptive-Recommender-Web/books/" class="continue">&lt; <?php echo "&nbsp;&nbsp;&nbsp;"?> Back Shopping</a>

            <?php
            	if(isset($_SESSION['cart']))
            	{
            ?>
            	<a href="index.php?checkout" class="checkout">Checkout <?php echo "&nbsp;&nbsp;&nbsp;"?> &gt;</a>
			<?php
				}
			?>

			<p><br><br><br><br><br><br></p>			

            </div>

			<?php
				}
				else
				{
			?>
				<div class="feat_prod_box_details">You have not added any item to your cart.</div>
			<?php
				}
			?>

			<p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></p>		


        <div class="clear"></div>
        </div><!--end of left content-->

         <div class="right_content">
		<?php 
        if(isset($_SESSION['loggedin'])){
          	if($count_1> 3){
          			        	echo $count_1;
	        	require_once '../includes/content_basedF.php'; 

	     	}
        }
        ?>
		</div><!--end of right content-->


       <div class="clear"></div>
       </div><!--end of center content-->


      <?php include_once '../includes/footer.inc.php'; ?>
</div>

</body>
</html>