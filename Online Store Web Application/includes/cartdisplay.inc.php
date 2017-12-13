<?php

	include_once 'cart.inc.php';


	if(isset($_SESSION['cart']))
	{
		$max=count($_SESSION['cart']);
		$totalcartvalue=0;
		$totalqty=0;

		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['ISBN'];
			$q=$_SESSION['cart'][$i]['qty'];
			$amount=get_price($pid)*$q;
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

<div class="cart">
	<div class="title"><span class="title_icon"><img src="/Adaptive-Recommender-Web/images/cart.gif" alt="" title="" /></span>My cart</div>
	<div class="home_cart_content">
		<?php echo $totalqty;?> x items | <span class="red">TOTAL: <?php echo $totalcartvalue;?>$</span>
	</div>
	<a href="/Adaptive-Recommender-Web/shopping/" class="view_cart">view cart</a>
</div>