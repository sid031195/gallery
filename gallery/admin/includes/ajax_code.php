<?php require_once("init.php");
$user=new user();
if(isset($_POST['image_name'])){
	 $user->save_ajax_user_image($_POST['image_name'],$_POST['user_id']);
}
if(isset($_POST['photo_id'])){
	photo::display_sidebar_data($_POST['photo_id']);
}




 ?>