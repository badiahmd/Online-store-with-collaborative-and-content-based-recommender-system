<?php
include '../includes/db.inc.php';
include '../includes/magicquotes.inc.php';
$pageTitle = 'New Customer';

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

require_once "../includes/formvalidator.inc.php";

if (isset($_GET['addcustomer']))
{
	 $firstname = $_POST['fname'];
	$lastName = $_POST['lname'];
	$email = $_POST['email'];
	$passWord = $_POST['password'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$postcode = $_POST['postcode'];
	$state = substr($_POST['state'],0,3);

	 $validator = new FormValidator();
	 $validator->addValidation('fname',"maxlen=20","First Name should not exceed 20 characters");
	 $validator->addValidation('lname',"req","Please fill in Last Name");
	 $validator->addValidation('lname',"maxlen=30","Last Name should not exceed 30 characters");
	 $validator->addValidation('email',"email","Invalid email address!");
	 $validator->addValidation('email',"req","Please fill in Email");
	 $validator->addValidation('email',"maxlen=30","Email should not exceed 30 characters");
	 $validator->addValidation('password',"req","Please fill in Password");
	 $validator->addValidation('password',"maxlen=12","Password should not exceed 12 characters");
	 $validator->addValidation('address1',"maxlen=50","Address Line 1 should not exceed 45 characters");
	 $validator->addValidation('address1',"req","Please fill Address Line 1");
	 $validator->addValidation('address2',"maxlen=50","Address Line 2 should not exceed 45 characters");
	 $validator->addValidation('postcode',"req","Please fill in Postcode");
	 $validator->addValidation('postcode',"maxlen=4","Postcode should not exceed 4 digits");
	 $validator->addValidation('postcode',"num","Invalid Postcode!");


	 $validation_errors="";

	    if($validator->ValidateForm())
	    {
	        try
				{
					$mysql = 'SELECT COUNT(*) As NoRecords FROM customer WHERE email = :email';
					$a = $pdo->prepare($mysql);
					$a->bindValue(':email', $_POST['email']);
					$a->execute();
					$row = $a->fetch();
					$number_records = $row['NoRecords'];
					if($number_records>=1)
					{
						$error = 'Email address already in use!';
						include 'register.html.php';
					}
					else
					{
						$sql = 'INSERT INTO customer SET
						fName = :firstname,
						lName = :lastname,
						email = :email,
						passWord = md5(:password),
						address1 = :address1,
						address2 = :address2,
						state = :state,
						postCode = :postcode,
						dateJoined = CURDATE()';

						$s = $pdo->prepare($sql);
						$s->bindValue(':firstname', $_POST['fname']);
						$s->bindValue(':lastname', $_POST['lname']);
						$s->bindValue(':email', $_POST['email']);
						$s->bindValue(':password', $_POST['password']);
						$s->bindValue(':address1', $_POST['address1']);
						$s->bindValue(':address2', $_POST['address2']);
						$s->bindValue(':state', $state);
						$s->bindValue(':postcode', $_POST['postcode']);
						$s->execute();
					}
				}
				catch (PDOException $e)
				{
					$error = 'Error adding new customer.';
					include 'register.html.php';
				}
				header('Location: ../myaccount');
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
			include 'register.html.php';


    	}

}
else
{

	$error='';
	$fname = '';
	$lname = '';
	$email = '';
	$passWord = '';
	$address1 = '';
	$address2 = '';
	$postcode = '';

	include 'register.html.php';
}

?>