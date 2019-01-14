
<?php include("includes/init.php"); ?>
<?php 
if(!$session->is_sign_in()){
    redirect("login.php");
}

 ?>
<?php 

if(empty($_GET['id'])){
	redirect("comments.php");
}
$comment=comment::find_by_id($_GET['id']);
if($comment){
	$comment->delete();
	$session->message("The user {$comment->id} has been deleted");
	redirect("comment_photo.php?id={$comment->photo_id}");
}
else{
	redirect("comment_photo.php?id= {$comment->photo_id}");
}



 ?>