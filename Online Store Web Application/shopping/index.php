<?php
$pageTitle = "My Cart";


include_once '../includes/helpers.inc.php';
include '../includes/db.inc.php';
include '../includes/magicquotes.inc.php';
include_once '../includes/cart.inc.php';
require_once "../includes/formvalidator.inc.php";

try
{
	$result = $pdo->query('SELECT delState FROM delivery');
}
catch (PDOException $e)
{
	$error = 'Error fetching states from the database!';
	include 'register.html.php';
	exit();
}

foreach ($result as $row)
{
	$states[] = $row[0];
}

// check if the final order has been submitted
if(isset($_GET['submitorder']))
{
	 $fName = $_POST['fName'];
	 $lName = $_POST['lName'];
	 $address1 = $_POST['address1'];
	 $address2 = $_POST['address2'];
	 $postcode = $_POST['postcode'];
	 $state = $_POST['state'];
	 $paymentType = $_POST['paymentType'];
	 $delInstructions = $_POST['delInstructions'];
	 $delRate=$_POST['delRate'];

	 $validator = new FormValidator();
	 $validator->addValidation('fName',"maxlen=20","First Name should not exceed 20 characters");
	 $validator->addValidation('lName',"req","Please fill in Last Name");
	 $validator->addValidation('lName',"maxlen=45","Last Name should not exceed 45 characters");
	 $validator->addValidation('address1',"maxlen=45","Address Line 1 should not exceed 45 characters");
	 $validator->addValidation('address1',"req","Please fill Address Line 1");
	 $validator->addValidation('address2',"maxlen=45","Address Line 2 should not exceed 45 characters");
	 $validator->addValidation('postcode',"req","Please fill in Postcode");
	 $validator->addValidation('postcode',"maxlen=4","Postcode should not exceed 4 digits");
	 $validator->addValidation('postcode',"num","Invalid Postcode!");

	 $validation_errors="";

	    if($validator->ValidateForm())
	    {

	        	try
				{

					$sql = 'INSERT INTO orders SET
					custID = :customer_id,
					orderDate = CURDATE(),
					dispatchDate = CURDATE(),
					delDate =  DATE_ADD(CURDATE(),INTERVAL 2 DAY),
					orderNet = :order_net_value,
					delTo = :deliver_to,
					delAddress1 = :address1,
					delAddress2 = :address2,
					delState = :delivery_state,
					delPostCode = :delivery_post_code,
					delInstructions = :delivery_instructions,
					delValue = :delivery_value,
					paymentType = :payment_type';

					$s = $pdo->prepare($sql);
					$s->bindValue(':customer_id', $_SESSION['custID']);
					$s->bindValue(':order_net_value', $_POST['delRate'] + get_order_total());
					$s->bindValue(':deliver_to', $fName . ' ' . $lName);
					$s->bindValue(':address1', $address1);
					$s->bindValue(':address2', $address2);
					$s->bindValue(':delivery_state', $state);
					$s->bindValue(':delivery_post_code', $postcode);
					$s->bindValue(':delivery_instructions', $delInstructions);
					$s->bindValue(':delivery_value', $delRate);
					$s->bindValue(':payment_type', $paymentType);
					$s->execute();
 					$order_id = $pdo->lastInsertId();

					// now insert all the items from the shopping cart
					if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
						$max=count($_SESSION['cart']);
		   				for($i=0;$i<$max;$i++){
		   				$sql = 'INSERT INTO ordereditem SET
								orderID = :order_id,
								custID = :custid,
								ISBN = :isbn,
								orderedQty = :qty_ordered,
								sellingPrice = :selling_price';

								$s = $pdo->prepare($sql);
								$s->bindValue(':order_id', $order_id);
								$s->bindValue(':custid', $_SESSION['custID']);
								$s->bindValue(':isbn', $_SESSION['cart'][$i]['ISBN']);
								$s->bindValue(':qty_ordered', $_SESSION['cart'][$i]['qty']);
								$s->bindValue(':selling_price', get_price($_SESSION['cart'][$i]['ISBN']));

								$s->execute();
		   				}
		   			}

					// the shopping cart is done now
					unset($_SESSION['cart']);

					$currentUser = $_SESSION['custID'];
					$sql2 = "DELETE FROM cart WHERE custID = :custid";
					$r = $pdo->prepare($sql2);
					$r->bindValue(':custid', $currentUser);
					$r->execute();

		   			header('Location: ../myaccount/?orderhistory');
		   			exit();
				}
				catch (PDOException $e)
				{
				echo $e;

					exit();
				}
				echo "Fatal error creating order";
				exit();
	    }
	    else
	    {
	        //Validations failed. Display Errors.
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err)
			{
			   $error .= "$inp_err<br/>";
			}
			include 'deliverydisplay.html.php';
			exit();
    	}
}
else if(isset($_GET['checkout']))
{
	$fName = "";
	$lName = "";
	$address1 = "";
	$address2 = "";
	$postcode = "";

	if (isset($_GET['checkout']))
	{
		    // get the values from the registration table
		    try
		    {
		    		$sql = 'SELECT * FROM customer WHERE custID = :customer_id';
		    		$s = $pdo->prepare($sql);
		    		$s->bindValue(':customer_id', $_SESSION['custID']);
		    		$s->execute();
		    		$row = $s->fetch();

		    		// assign data into the variables so that they can populate onto the delivery form

					$fName = $row['fName'];
					$lName = $row['lName'];
					$address1 = $row['address1'];
					$address2 = $row['address2'];
					$postcode = $row['postCode'];
					$state = $row['state'];
		    }
		    catch (PDOException $e)
		 	{
		 		$error = 'Login Failed';
		 		$pageTitle = 'Login';
		 		include 'loginform.html.php';
		 		exit();
			}
	}

	// if user is not logged in, then send the user to login page
	if(!isset($_SESSION['loggedin'])) {
		header('Location: ../myaccount/');
		exit();
	}

	$pageTitle='Checkout';
	include 'checkout.html.php';
	exit();
}
else if (isset($_GET['calculatedelivery']))
{
		 $fName = $_POST['fName'];
		 $lName = $_POST['lName'];
		 $address1 = $_POST['address1'];
		 $address2 = $_POST['address2'];
		 $postcode = $_POST['postcode'];
		 $state = $_POST['state'];

		 $validator = new FormValidator();
		 $validator->addValidation('fName',"maxlen=20","First Name should not exceed 20 characters");
		 $validator->addValidation('lName',"req","Please fill in Last Name");
		 $validator->addValidation('lName',"maxlen=45","Last Name should not exceed 45 characters");
		 $validator->addValidation('address1',"maxlen=45","Address Line 1 should not exceed 45 characters");
		 $validator->addValidation('address1',"req","Please fill Address Line 1");
		 $validator->addValidation('address2',"maxlen=45","Address Line 2 should not exceed 45 characters");
		 $validator->addValidation('postcode',"req","Please fill in Postcode");
		 $validator->addValidation('postcode',"maxlen=4","Postcode should not exceed 4 digits");
		 $validator->addValidation('postcode',"num","Invalid Postcode!");

		 $validation_errors="";

		 // if all validations are successful
		 if($validator->ValidateForm())
		 {
			// calculate the delivery price
			// first get the delivery rate
			// get the values from the registration table
			try
			{
					$sql = 'SELECT * FROM delivery WHERE delState = :delivery_state';
					$s = $pdo->prepare($sql);
					$s->bindValue(':delivery_state', $state);
					$s->execute();
					$row = $s->fetch();

					// get delivery rate
					$delRate = $row['delRate'];
			}
			catch (PDOException $e)
			{
				exit();
			}

			// and display the delivery calculation page
			$pageTitle="Delivery Display";
			include 'deliverydisplay.html.php';
			exit();
		 }
		else
		{
			//Validations failed. Display Errors.
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err)
			{
			   $error .= "$inp_err<br/>";
			}
			include 'checkout.html.php';
			exit();
		}
}
else if(isset($_GET['command']) && $_GET['command']=='delete' && isset($_GET['ISBN'])){
	remove_product($_GET['ISBN']);
}
else if(isset($_GET['command']) && $_GET['command']=='clear'){
	$currentUser = $_SESSION['custID'];
	$sql1 = "DELETE FROM cart WHERE custID = :custid";
	$currentUser = $_SESSION['custID'];
	$x = $pdo->prepare($sql1);
	$x->bindValue(':custid', $currentUser);
	$x->execute();

	unset($_SESSION['cart']);
	header('Location: /Adaptive-Recommender-Web/books');
	exit();
}
else if(isset($_GET['command']) && $_GET['command']=='update'){
	$max=count($_SESSION['cart']);

	// check that all quantities are numeric
	$error='';
	for($i=0;$i<$max;$i++){
		$pid=$_SESSION['cart'][$i]['ISBN'];
		$q=$_POST['product'.$pid];
		if(!is_numeric($q))
		{
			$error.="Quantity not numeric for one or more proudcts";
			break;
		}elseif ($q > 10) {
			$error.="Quantity cannot be more than 10 items of each item";
			break;
		}elseif ($q == 0) {
			$error.="Quantity 0 is not allowed ! ";
		}

	}

	if($error=='')
	{
		for($i=0;$i<$max;$i++){


			$pid=$_SESSION['cart'][$i]['ISBN'];
			$q=$_POST['product'.$pid];
			$_SESSION['cart'][$i]['qty']=$q;

			$curUser = $_SESSION['custID'];
			$sql1 = 'UPDATE cart SET qtyItem = :itemQuantity WHERE custID = :custid AND ISBN = :isbn';
			$z = $pdo->prepare($sql1);
			$z->bindValue(':custid', $curUser);
			$z->bindValue(':isbn', $pid);
			$z->bindValue(':itemQuantity', $q );
			$z->execute();
		}
	}
}

include 'cart.html.php';
?>
