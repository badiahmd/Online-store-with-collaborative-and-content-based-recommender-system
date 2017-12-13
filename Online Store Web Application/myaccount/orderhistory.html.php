<?php
include_once '../includes/helpers.inc.php';
@session_start();
if(!isset($_SESSION['loggedin']))
{
	header('Location: /Adaptive-Recommender-Web/myaccount/');
	exit();
}

if(!isset($pageTitle))
{
header('Location: /Adaptive-Recommender-Web/myaccount/');
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
       	    <div class="title"><i class="material-icons" style="font-size:45px;color:grey">assignment</i>
            <span class = "title_pos">Order History</span></div>

		<?php
			if(count($orders)==0)
			{
				echo "You haven't made any orders yet";
			}
			else
			{
		?>
		<p><br><br></p>
		<!-- Now display the order history here -->
		<div class="order_history">
		   <table class="cart_table">
			  <tr class="cart_title">
				 <td>Order#</td>
				 <td>Order Date</td>
				 <td>Net Value</td>
				 <td>Payment Type</td>
			  </tr>
			  <?php if (isset($orders)): ?>
			  <?php foreach ($orders as $order): ?>
			  <tr>
				 <td><?php echo $order['orderID'];?></td>
				 <td><?php echo $order['orderDate'];?></td>
				 <td><?php echo $order['orderNet'];?></td>
				 <td><?php echo $order['paymentType'];?></td>
			  </tr>
			  <?php endforeach; ?>
			  <?php endif; ?>
		   </table>
		</div>

		<?php
			}
		?>

		<div class="order_history">
		    <a href="?updateprofile">Update Profile / Change Password</a>
		</div>
		<p><br><br><br><br><br><br><br><br><br><br><br><br></p>
        <div class="clear"></div>
        </div><!--end of middle content-->

       <div class="clear"></div>
       </div><!--end of center content-->


      <?php include_once '../includes/footer.inc.php'; ?>

</div>

</body>
</html>