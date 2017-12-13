<?php
include_once '../includes/helpers.inc.php';
if(!isset($pageTitle))
{
header('Location: /Adaptive-Recommender-Web/myaccount/');
}
@session_start();
if(isset($_SESSION['loggedin']))
{
	header('Location: /Adaptive-Recommender-Web/myaccount/');
	exit();
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
		<?php
			if(isset($_GET['logout']))
			{
				$error="You have been logged out successfully";
			}
		?>
       <?php include_once '../includes/header.inc.php'; ?>

       <div class="center_mid_content">
       	<div class="middle_content">
       	<div class="error"><?php echo $error; ?></div>
            <div class="title"><i class="material-icons" style="font-size:45px;color:grey">person</i>
            <span class = "title_pos"> Login</span></div>
        	<div class="feat_prod_box_details">

              	<div class="login_form">
                <div class="login_title">Login into your account</div>
                 <form name="login" action="?logincustomer" method="post">
                    <div class="login_row">
                    <label class="contact"><strong>Email:</strong></label>
                    <input type="text" name="email" id="email" class="contact_input" maxlength="50"/>
                    </div>


                    <div class="login_row">
                    <label class="contact"><strong>Password:</strong></label>
                    <input type="password" name="password" id="password" class="contact_input" maxlength="12" />
                    </div>

                    <div class="login_row">
                    <input type="submit" class="register" value="login" />
                    </div>

                  </form>
                  <br/>
                </div>

            </div>

        <div class="clear"></div>
        <p><br><br><br><br><br></p>
        </div><!--end of mid content-->

       <div class="clear"></div>
       </div><!--end of center content-->


      <?php include_once '../includes/footer.inc.php'; ?>

</div>

</body>
</html>