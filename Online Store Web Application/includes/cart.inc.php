<?php


	@mysql_connect("localhost","root","mysql") or die("Unable to make a connection with the store database! sorry :(");
	@mysql_select_db("Adaptive_Rec_System") or die("Unable to make a connection with the store database! sorry :(");
	@session_start();

	function get_product_name($ISBN_code){
		$result=mysql_query("select bookTitle from items where ISBN ='$ISBN_code'") or die("select bookTitle from items where ISBN=$ISBN_code"."<br/><br/>".mysql_error());
		$row=mysql_fetch_array($result);
		return $row['bookTitle'];
	}

	function get_product_cover($ISBN_code){
		$result=mysql_query("select thumbNail from items where ISBN ='$ISBN_code'") or die("select thumbNail from items where ISBN=$ISBN_code"."<br/><br/>".mysql_error());
		$row=mysql_fetch_array($result);
		return $row['thumbNail'];
	}

	function get_price($ISBN_code){
		$result=mysql_query("select unitPrice from items where ISBN='$ISBN_code'") or die("select itemName from items where ISBN=$ISBN_code"."<br/><br/>".mysql_error());
		$row=mysql_fetch_array($result);
		return $row['unitPrice'];
	}
	function remove_product($ISBN_code){
		include '../includes/db.inc.php';
		$sql1 = "DELETE FROM cart WHERE custID = :custid AND ISBN = :isbn";
		$currentUser = $_SESSION['custID'];
		$x = $pdo->prepare($sql1);
		$x->bindValue(':custid', $currentUser);
		$x->bindValue(':isbn', $ISBN_code);
		$x->execute();


		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($ISBN_code==$_SESSION['cart'][$i]['ISBN']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}

	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['ISBN'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			$sum+=$price*$q;
		}
		return number_format($sum,2);
	}

	function addtocart($ISBN_code,$q){
			include '../includes/db.inc.php';
			$currentUser = $_SESSION['custID'];
			$quantity = 1;
			$mysql1 = 'SELECT COUNT(*) As exist FROM cart where custID = :custid AND ISBN = :isbn' ;
			$a = $pdo->prepare($mysql1);
			$a->bindValue(':custid', $currentUser);
			$a->bindValue(':isbn', $ISBN_code);
			$a->execute();
			$rows = $a->fetch();
			$cart_exist = $rows['exist'];
			
			if($cart_exist > 0){
				$mysql2 = 'SELECT qtyItem FROM cart where custID = :custid AND ISBN = :isbn' ;
				$x = $pdo->prepare($mysql2);
				$x->bindValue(':custid', $currentUser);
				$x->bindValue(':isbn', $ISBN_code);
				$x->execute();
				$row = $x->fetch();
				$currentQty = 1 + $row['qtyItem'];

				$sql1 = 'UPDATE cart SET qtyItem = :itemQuantity WHERE custID = :custid AND ISBN = :isbn';
				$z = $pdo->prepare($sql1);
				$z->bindValue(':custid', $currentUser);
				$z->bindValue(':isbn', $ISBN_code);
				$z->bindValue(':itemQuantity', $currentQty );
				$z->execute();
			}else{
				$sql2 = 'INSERT INTO cart SET custID = :custid, ISBN = :isbn, qtyItem = :itemQuantity';
				$y = $pdo->prepare($sql2);
				$y->bindValue(':custid', $currentUser);
				$y->bindValue(':isbn', $ISBN_code);
				$y->bindValue(':itemQuantity', $q);
				$y->execute();
			}


		if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
			//if(product_exists($item_code)) return;
			$max=count($_SESSION['cart']);

			$index=-1;
			$found=false;
			//find the index where the product is
			for($i=0;$i<$max;$i++){
				$pid=$_SESSION['cart'][$i]['ISBN'];
				if($pid==$ISBN_code) {
					$index=$i;
					$found=true;
					break;
				}
			}

			// if no index found then insert at the last location
			if($found==false)
			{
				$index=$max;
			}

			if($found==true)
			{
				$_SESSION['cart'][$index]['qty']=$_SESSION['cart'][$index]['qty']+$q;
			}
			else
			{
				$_SESSION['cart'][$index]['ISBN']=$ISBN_code;
				$_SESSION['cart'][$index]['qty']=1;
			}
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['ISBN']=$ISBN_code;
			$_SESSION['cart'][0]['qty']=$q;
		}
	}

	function addtocartArray($ISBN_code,$q){
		if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
			//if(product_exists($item_code)) return;
			$max=count($_SESSION['cart']);

			$index=-1;
			$found=false;
			//find the index where the product is
			for($i=0;$i<$max;$i++){
				$pid=$_SESSION['cart'][$i]['ISBN'];
				if($pid==$ISBN_code) {
					$index=$i;
					$found=true;
					break;
				}
			}

			// if no index found then insert at the last location
			if($found==false)
			{
				$index=$max;
			}

			if($found==true)
			{
				$_SESSION['cart'][$index]['qty']=$_SESSION['cart'][$index]['qty']+$q;
			}
			else
			{
				$_SESSION['cart'][$index]['ISBN']=$ISBN_code;
				$_SESSION['cart'][$index]['qty']=$q;
			}
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['ISBN']=$ISBN_code;
			$_SESSION['cart'][0]['qty']=$q;
		}
	}




	function product_exists($ISBN_code){
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($ISBN_code==$_SESSION['cart'][$i]['ISBN']){
				$flag=1;
				break;
			}
		}
		return $flag;
	}

?>