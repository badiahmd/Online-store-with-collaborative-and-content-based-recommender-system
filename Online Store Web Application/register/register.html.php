<?php include_once '../includes/helpers.inc.php';

if(!isset($pageTitle))
{
header('Location: /Adaptive-Recommender-Web/register/');
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
               <div class="title"><i class="material-icons" style="font-size:45px;color:grey">person_add</i>
               <span class = "title_pos">Register</span></div>
                 <div class="feat_prod_box_details">
                  <div class="registration_form">
                     <div class="registration_title">The marked (*) are compulsory</div>
                     <form name="register" action="?addcustomer" method="post">
                     	<div class="registration_row">
						<label class="registration"><strong>First Name:</strong></label>
						<input type="text" name="fname" id="fname" class="registration_input" value="<?php echo $firstname;?>" />
					 	</div>
					 	<div class="registration_row">
						<label class="registration"><strong>*Last Name:</strong></label>
						<input type="text" name="lname" id="lname" class="registration_input" maxlength="45" value="<?php echo $lastName;?>"/>
                        </div>
                        <div class="registration_row">
                           <label class="registration"><strong>*Email:</strong></label>
                           <input type="text" name="email" id="email" class="registration_input" maxlength="50" value="<?php echo $email;?>"/>
                        </div>
                        <div class="registration_row">
                           <label class="registration"><strong>*Password:</strong></label>
                           <input type="password" name="password" id="password" class="registration_input" maxlength="12" value="<?php echo $password;?>"/>
                        </div>

                        <div class="registration_row">
                           <label class="registration"><strong>*Address 1:</strong></label>
                           <input type="text" name="address1" id="address1" class="registration_input" maxlength="45" value="<?php echo $address1;?>"/>
                        </div>
                        <div class="registration_row">
                           <label class="registration"><strong>Address 2:</strong></label>
                           <input type="text" name="address2" id="address2" class="registration_input" maxlength="45" value="<?php echo $address2;?>"/>
                        </div>
                        <div class="registration_row">
                           <label class="registration"><strong>*State:</strong></label>
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
                           <label class="registration"><strong>*Postcode:</strong></label>
                           <input type="text" name="postcode" id="postcode" class="state_postcode" maxlength="4" value="<?php echo $postcode;?>"/>
                        </div>

                        <div class="registration_row">
                           <input type="submit" class="register" value="register" />
                        </div>
                     </form>
                  </div>
               </div>
               <div class="clear"></div>
            </div>
            <!--end of mid content-->
            <p><br><br><br><br><br></p>
            <div class="clear"></div>
         </div>
         <!--end of center content-->
         <?php include_once '../includes/footer.inc.php'; ?>
      </div>
    </body>
</html>