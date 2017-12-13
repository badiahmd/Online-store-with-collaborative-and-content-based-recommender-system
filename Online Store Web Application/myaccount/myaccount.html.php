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
            <div class="title"><i class="material-icons" style="font-size:45px;color:grey">account_box</i>
            <span class = "title_pos">My account</span></div>

        		<div class="account_details">
                 <div class="myaccount_form">
                <div class="myaccount_title">Hello, <?php htmlout($_SESSION['name']) ?></div>
                  <p><br/><br/></p>
                  <a href="/Adaptive-Recommender-Web/books/" class="shopnow_btn">Shop Now</a><p><br/><br/></p>
                  <a href="/Adaptive-Recommender-Web/shopping/" class="carts_btn">My Cart</a><p><br/><br/></p>
              		<a href="?orderhistory" class="history_btn">Order History</a><p><br/><br/></p>
              		<a href="?updateprofile" class="updateprof_btn">Update Profile / Change Password</a><p><br/><br/></p>
              		<a href="/Adaptive-Recommender-Web/myaccount/logout.php" class="logouts_btn">Logout</a>
                  </div>
            </div>
        </div>
        
        <div class="clear"></div>
      <p><br><br><br><br></p>
       <div class="clear"></div>
       </div><!--end of center content-->

      <?php include_once '../includes/footer.inc.php'; ?>

</div>

</body>
</html>