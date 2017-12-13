<?php include_once '../includes/helpers.inc.php';



if(!isset($pageTitle))
{
header('Location: /Adaptive-Recommender-Web/about/');
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
               <div class="title"><i class="material-icons" style="font-size:45px;color:grey">subject</i>
               <span class = "title_pos">About This Project</span></div>

				<div class="feat_prod_box_details">
				<p class="details">
				Recommender system is a part of information filtering system to predict the level of tendency of user towards certain of product or services. Recommender system is commonly known and applicable in recent years in a lot of fields, the most popular example are in the fields of news, movie, music, research articles, searching queries, social tags, and many products in general.<br/><br/>
				As most of the research conducted on recommendation system are only concerned of improving the accuracy, whereby few are focusing what recommender system methods are suitable based on the user perspective and application target.<br/><br/> Therefore instead of improving the accuracy, this project identifies what are the methods of recommender system, and find suitable recommender algorithm for online store by conveying research on user’s perspective. The development will be based on web application to simulate an online store and integrate the suitable representation of recommender system.<br><br><br></p>


				</div>

               <div class="clear"></div>
            </div>
 
            <!--end of centre content-->
            <div class="clear"></div>
         </div>
         <!--end of center content-->
         <?php include_once '../includes/footer.inc.php'; ?>
      </div>
    </body>
</html>