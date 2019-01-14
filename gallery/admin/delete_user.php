
<?php include("includes/init.php"); ?>
<?php 
if(!$session->is_sign_in()){
    redirect("login.php");
}

 ?>
<?php 

if(empty($_GET['id'])){
	redirect("users.php");
}
$user=user::find_by_id($_GET['id']);
if($user){
	$user->delete_photo();
	$session->message("The user {$user->username} has been deleted");
	redirect("users.php");
}
else{
	redirect("users.php");
}



 ?>