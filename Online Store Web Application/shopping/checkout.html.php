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

       		<div class="title"><i class="material-icons" style="font-size:45px;color:grey">edit_location</i>
            <span class = "title_pos">Checkout</span></div>


			<!-- Beginning of the checkout form -->
			<form method="post" action="?calculatedelivery">
			<br>
			 <div class="checkout_form">
             <div class="checkout_title">Delivery Details</div>
					<div class="registration_row">
						<label class="contact"><strong>First Name:</strong></label>
						<input type="text" name="fName" id="fName" class="contact_input" value="<?php echo $fName;?>" />
						</div>
						<div class="registration_row">
						<label class="contact"><strong>*Last Name:</strong></label>
						<input type="text" name="lName" id="lName" class="contact_input" maxlength="45" value="<?php echo $lName;?>"/>
						</div>
						<div class="registration_row">
						   <label class="contact"><strong>*Address 1:</strong></label>
						   <input type="text" name="address1" id="address1" class="contact_input" maxlength="45" value="<?php echo $address1;?>"/>
						</div>
						<div class="registration_row">
						   <label class="contact"><strong>Address 2:</strong></label>
						   <input type="text" name="address2" id="address2" class="contact_input" maxlength="45" value="<?php echo $address2;?>"/>
						</div>
						<div class="registration_row">
						   <label class="contact"><strong>*State:</strong></label>
      						<select name="state" id="state" >
	   					    <?php foreach ($states as $state1) {
		  						if($state==$state1)
		  						{
									$option="selected='selected'";
		 						}
		  						else {
									$option="";
								}
	  							?>				
								<option value="<?php echo $state1;?>" <?php echo $option;?>><?php htmlout($state1); ?></option>
        						<?php } ?>
     						 </select>
						</div>
						<div class="registration_row">
						   <label class="contact"><strong>*Postcode:</strong></label>
 						   <input type="text" name="postcode" id="postcode" class="state_postcode" maxlength="4" value="<?php echo $postcode;?>"/>
						</div>
			</div>						
			<!-- End of the checkout form -->


        	<div class="feat_prod_box_details">
			<p><br><br></p>
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
		   				<tr><td colspan="2"><b>Order Total: RM. <?php echo get_order_total()?></b></td><td colspan="3" align="right">



		   				<input type="submit" class="register" value="Calculate Delivery"></td></tr>
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
            <p><br><br><br></p>
        </div><!--end of middle content-->
       <div class="clear"></div>
       </div><!--end of center content-->


      <?php include_once '../includes/footer.inc.php'; ?>
</div>

</body>
</html>