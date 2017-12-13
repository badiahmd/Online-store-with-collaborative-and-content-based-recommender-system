<?php
include_once 'db.inc.php';
include_once 'magicquotes.inc.php';


$userIDs = $_SESSION['custID'];
$sqlQuery= "SELECT * from items WHERE ISBN IN (SELECT ISBN as Recommended from userCF_Recommender where custID = :custid)";
$s = $pdo->prepare($sqlQuery);
$s->bindValue(':custid', $userIDs);
$s->execute();


$count=0;
while ($row = $s->fetch())
{
$recommended_items[] = array('ISBN' => $row['ISBN'],
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

?>
<div class="title"><i class="material-icons" style="font-size:45px;color:grey">notifications_active</i>
<span class = "title_pos">Recommended Books</span></div>
<?php 
if($count>=1){
        if (isset($recommended_items)): ?>
        	<?php foreach ($recommended_items as $item): ?>

        	<div class="reco_prod_box">

            	<div class="reco_img"><a href="details.html.php?ISBN=<?php echo $item['ISBN'];?>"><img src="../images/<?php echo $item['thumbNail'];?>" alt="" title="" border="0" width="66" height="100" /></a></div>

                <div class="reco_det_box">
                	<div class="reco_box_top"></div>
                    <div class="reco_box_center">
                    <div class="reco_prod_title"><strong><?php echo $item['bookTitle'];?></strong></div>
                    <p class="details">
                    <strong>ISBN</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>  : <?php echo $item['ISBN']; ?><br><br>
                    <strong>Book Price</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>        : <?php echo $item['unitPrice']; ?> .RM<br><br>
                    <a href="details.html.php?ISBN=<?php echo $item['ISBN'];?>" class="details_btn">View Details</a>
                    <div class="clear"></div>
                    <?php 
                        if(isset($_SESSION['loggedin']))
                        {
                    ?>
                     <a href="index.php?addtocart=yes&ISBN=<?php echo $item['ISBN']?>" class="cart_btn">
                     <img src="../images/cart.gif" class="cart_logo" alt="" title="" border="0" />
                     <span class = "cart_det">Add to Cart </span></a>
                    <?php 
                        }
                        else
                        {
                    ?>
                      <a href="../myaccount/index.php" class="cart_btn">
                      <img src="../images/cart.gif" class="cart_logo" alt="" title="" border="0" />
                      <span class = "cart_det">Add to Cart</span></a>
                    <?php 
                        }
                    ?>
                    <br>
                    <br>
                    </p>       
                    </div>

                    <div class="reco_box_bottom"></div>
                </div>
            <div class="reco_clear"></div>
            </div>
			<?php endforeach; ?>

        <?php endif; 
}
else{

    include 'books.html.php';
    exit();
}
?>