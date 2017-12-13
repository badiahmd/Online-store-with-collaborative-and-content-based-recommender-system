<?php
@session_start();
	if(isset($_SESSION['cart']))
	{
		$max=count($_SESSION['cart']);
		$totalcartvalue=0;
		$totalqty=0;

		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$totalqty=$totalqty+$q;
			$totalcartvalue=$totalcartvalue+$amount;
		}
	}
	else
	{

		$amount=0;
		$totalqty=0;
		$totalcartvalue=0;
	}
	

?>
<div class="header">
		<div class="logo"><a href="/Adaptive-Recommender-Web/"><img src="/Adaptive-Recommender-Web/images/logo.gif" class="logo-container" alt="" title="" border="0" /></a>
	</div>
	</div>
	<div id="menu">
	   <ul>
		  <li><a href="/Adaptive-Recommender-Web/index.php">Home</a></li>
		  <li><a href="/Adaptive-Recommender-Web/about/">About us</a></li>
		  <li><a href="/Adaptive-Recommender-Web/books/">Books</a></li>
		  <li><a href="/Adaptive-Recommender-Web/myaccount/">My Account</a></li>


		  <?php
		  if(isset($_SESSION['loggedin'])&& ($_SESSION['name']!= NULL)) { ?>
		  <li><a href="/Adaptive-Recommender-Web/myaccount/logout.php">Logout</a></li>
		  <li><a href="/Adaptive-Recommender-Web/shopping/"><img src="/Adaptive-Recommender-Web/images/cart.gif" alt="" title="" /><?php echo $totalqty;?></a></li>
		  </ul>

		  <p><div id= "header-name">Welcome, <?php htmlout($_SESSION['name']) ?> </div></p>
		  <?php } else{?>
		  <li><a href="/Adaptive-Recommender-Web/register/">Register</a></li>
		  </ul>
		  <?php }
		  ?>
	
	
 </div>