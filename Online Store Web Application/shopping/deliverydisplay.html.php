<?php
@session_start();

if(!isset($pageTitle))
{
header('Location: /Adaptive-Recommender-Web/shopping/');
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php htmlout($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div id="wrap">

      <?php include_once '../includes/header.inc.php'; ?>

       <div class="center_mid_content">
       	<div class="middle_content">
       		<div class="error"><?php echo $error; ?></div>


       		<div class="title"><i class="material-icons" style="font-size:45px;color:grey">credit_card</i>
            <span class = "title_pos">Checkout</span></div>



			<!-- Beginning of the checkout form -->
			<form method="post" action="?submitorder">

			<div class="final_form">
			<div class="checkout_title">Finalized Delivery Details</div>
			<p class="reco_details">
                    <strong>Name</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>  : 
                    <?php echo $fName; ?>
                    <?php if(isset($lName)) { ?>
					<?php echo " ".$lName; ?>
                     <?php } ?>
                    <br><br>
                    <strong>Address 1</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?> : 
                    <?php echo $address1; ?><br><br>
                    <?php if(isset($address2)) { ?>
                    <strong>Address 2</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?> : 
                    <?php echo $address2; ?><br><br>
					<?php } ?>
                    <strong>State</strong><?php echo 
                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?> : 
                    <?php echo $state; ?><br><br>
                    <strong>Postcode</strong><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?> : 
                    <?php echo $postcode; ?><br><br>
                    <strong>Delivery Charges</strong><?php echo "&nbsp;&nbsp;"?> : 
                    <?php echo $delRate; ?><br><br>
            </p>
			</div>

			<input type="hidden" name="fName" id="fName" class="contact_input" value="<?php echo $fName;?>" />
			<input type="hidden" name="lName" id="lName" class="contact_input" maxlength="45" value="<?php echo $lName;?>"/>
			<input type="hidden" name="address1" id="address1" class="contact_input" maxlength="45" value="<?php echo $address1;?>"/>
			<input type="hidden" name="address2" id="address2" class="contact_input" maxlength="45" value="<?php echo $address2;?>"/>
			<input type="hidden" name="state" id="state" class="contact_input" maxlength="45" value="<?php echo $state;?>"/>
			<input type="hidden" name="postcode" id="postcode" class="contact_input" maxlength="4" value="<?php echo $postcode;?>"/>
			<input type="hidden" name="delRate" id="delRate" class="contact_input" maxlength="4" value="<?php echo $delRate;?>"/>

			<div class="instruction_row">
			   <label class="contact1"><strong>Delivery Instructions:</strong></label>
			   <textarea rows="5" cols="50" name="delInstructions" class="contact_input"><?php echo $delinstructions;?></textarea>
			</div>
			<div class="payment_row">
			   <label class="contact"><strong>Payment type:</strong></label>
			   <select name="paymentType" id="paymentType" >
					<option value="MC">MasterCard</option>
					<option value="VS">Visa</option>
					<option value="MB">Maybank 2 U</option>
					<option value="PP">Paypal</option>
			   </select>
			</div>
			<p><br><br></p>
			<!-- End of the checkout form -->


        	<div class="feat_prod_box_details">

            <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:15px; background-color:#E1E1E1" width="100%">
		       	<?php
		   			if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
		               	echo '<tr bgcolor="#FFFFFF" style="font-weight:bold"><td>Name</td><td>Price</td><td>Qty</td><td>Item Total</td></tr>';
		   				$max=count($_SESSION['cart']);
		   				for($i=0;$i<$max;$i++){
		   					$pid=$_SESSION['cart'][$i]['ISBN'];
		   					$q=$_SESSION['cart'][$i]['qty'];
		   					$pname=get_product_name($pid);
		   					//if($q==0) continue;
		   			?>
		               		<tr bgcolor="#FFFFFF"><td><?php echo $pname?></td>
		                       <td>RM. <?php echo get_price($pid)?></td>
		                       <td><?php echo $q?></td>
		                       <td>RM. <?php echo number_format(get_price($pid)*$q,2)?></td>
		                       </tr>
		               <?php
		   				}
		   			?>
		   				<tr><td colspan="2"><b>Order Total: RM. <?php $totalOrder = get_order_total();
		   				$finalPrice = $totalOrder + $delRate;
		   				echo number_format($finalPrice,2)?></b></td><td colspan="3" align="right">



		   				<input type="submit" class="register" value="Submit Order"></td></tr>
		   			<?php
		               }
		   			else{
		   				echo "<tr bgColor='#FFFFFF'><td>There are no items in your shopping cart!</td>";
		   			}
		   		?>

        	   </table>
        	   </form>



            <?php
            	if(isset($_SESSION['cart']))
            	{
            ?>

			<?php
				}
			?>


            </div>


        <div class="clear"></div>
        </div><!--end of left content-->
         <div class="right_content">

		</div><!--end of right content-->



       <div class="clear"></div>
       </div><!--end of center content-->


      <?php include_once '../includes/footer.inc.php'; ?>
</div>

</body>
</html>