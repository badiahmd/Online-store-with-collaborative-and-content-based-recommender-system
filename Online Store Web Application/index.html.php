<?php include_once 'includes/helpers.inc.php';


            
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php htmlout($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div id="wrap">

     <?php include_once 'includes/header.inc.php'; ?>

       <div class="center_content">
       	<div class="left_content">
            <div class="title"><i class="material-icons" style="font-size:45px;color:grey">class</i>
            <span class = "title_pos">Featured Books</span></div>
			<?php if (isset($items)): ?>
        	<?php foreach ($items as $item): ?>

        	<div class="feat_prod_box">

            	<div class="prod_img"><a href="books/details.html.php?ISBN=<?php echo $item['ISBN'];?>"><img src="images/<?php echo $item['thumbNail'];?>" alt="" title="" border="0" width="66" height="100"/></a></div>

                <div class="prod_det_box">
                	<div class="box_top"></div>
                    <div class="box_center">
                    <div class="prod_title"><strong><?php echo $item['bookTitle'];?></strong></div>
                    <p class="details"><strong>Book Author</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?> : <?php echo $item['bookAuthor'];?><br><br>
                        <strong>Publication Year</strong><?php echo "&nbsp;&nbsp;"?>  : <?php echo $item['publicationYear'];?><br><br>
                        <strong>Book Publisher</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;"?>: <?php echo $item['publisher']; ?><br><br>
                        <strong>Book Price</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?> : <?php echo $item['unitPrice']; ?> .RM<br><br>
                    <a href="books/details.html.php?ISBN=<?php echo $item['ISBN'];?>" class="details_btn">View Details</a>
                    <div class="clear"></div>
                    <?php 
                        if(isset($_SESSION['loggedin']))
                        {
                    ?>
                     <a href="books/index.php?addtocart=yes&ISBN=<?php echo $item['ISBN']?>" class="cart_btn">
                     <img src="images/cart.gif" class="cart_logo" alt="" title="" border="0" />
                     <span class = "cart_det">Add to Cart </span></a>
                    <?php 
                        }
                        else
                        {
                    ?>
                      <a href="myaccount/index.php" class="cart_btn">
                      <img src="images/cart.gif" class="cart_logo" alt="" title="" border="0" />
                      <span class = "cart_det">Add to Cart</span></a>
                    <?php 
                        }
                    ?>
                    <div class="clear"></div>
                    </p>        
                    </div>

                    <div class="box_bottom"></div>
                </div>
            <div class="clear"></div>
            </div>
			<?php endforeach; ?>

			<?php endif; ?>






        </div><!--end of left content-->
         <div class="right_content">
         <div class="right_box">
        <?php 
        if(isset($_SESSION['loggedin'])){
            $user = $_SESSION['custID'];
            $sqlQuery_= "SELECT COUNT(*) As exist FROM itemCF_Recommender where custID = :custid ";
            $s_ = $pdo->prepare($sqlQuery_);
            $s_->bindValue(':custid', $user);
            $s_->execute();
            $rows_ = $s_->fetch();
            $recommended_exist = $rows_['exist'];

            if($recommended_exist> 0){
            require_once '/includes/item_basedCBF.php'; 
            }
        }
        ?>
            </div>
		</div><!--end of right content-->

       <div class="clear"></div>
       </div><!--end of center content-->


      <?php include_once 'includes/footer.inc.php'; ?>


</div>

</body>
</html>