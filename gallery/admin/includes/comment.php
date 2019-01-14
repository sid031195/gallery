<?php //include("db_object.php");?>
<?php 
class comment extends db_object{
	protected static $db_table="comments";
	protected static $db_table_field =array('id','photo_id','author','body');
	public $id;
	public $photo_id;
	public $author;
	public $body;
	
	
	public static function create_comment($photo_id,$author="john",$body=""){
		if(!empty($photo_id) && !empty($author) && !empty($body) ){
			$comment=new comment();
			$comment->photo_id=(int)$photo_id;
			$comment->author=$author;
			$comment->body=$body;

			return $comment;
		}else{
			return false;
		}
	}

	public static function find_the_comment($photo_id=0){
		global $obj;
		$sql="SELECT * FROM ".self::$db_table;
		$sql.=" WHERE photo_id= ".$obj->escape_string($photo_id);
		$sql.=" ORDER BY photo_id ASC";

		return self::search_this_query($sql);
	}


}//End of class User


 ?>