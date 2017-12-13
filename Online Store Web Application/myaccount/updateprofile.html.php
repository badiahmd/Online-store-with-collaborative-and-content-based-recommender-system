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
         <div class="error">
            <!-- Display error or success as applicable -->
            <?php
               if(isset($error)) {
               	echo $error; }
               else if(isset($success)) {
               	echo $success; }
               ?>
         </div>
         <div class="title"><i class="material-icons" style="font-size:45px;color:grey">settings</i>
            <span class = "title_pos">Update Profile</span></div>

         <div class="feat_prod_box_details">
         <div class="registration_form">
                     <div class="registration_title">Edit your Credentials</div>
         <!-- the update profile form goes here -->
         <form method="post" action="?updateprofilesubmit">
            <div class="registration_row">
               <div class="registration_row">
                  <label class="contact"><strong>Passwords:</strong></label>
                  <input type="password" name="password" id="password" class="contact_input" value="<?php echo $password;?>" />
               </div>
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
               <div class="form_row">
                  <label class="contact"><strong>*Postcode:</strong></label>
                  <input type="text" name="postcode" id="postcode" class="state_postcode" maxlength="4" value="<?php echo $postcode;?>"/>
               </div>
               <br/>
               <input type="submit" class="update_profile" value="Update Profile">
         </form>
         </div>
         </div>
         <!-- the update profile form ends here -->
         <div class="clear"></div>
         </div>
         </div><!--end of left content-->
         <div class="right_content">

            </div>
            <!--end of right content-->
            <div class="clear"></div>
         </div>
         <!--end of center content-->
         <?php include_once '../includes/footer.inc.php'; ?>
      </div>
   </body>
</html>