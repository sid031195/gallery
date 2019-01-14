<?php //include("db_object.php");?>
<?php 
class user extends db_object{
	protected static $db_table="user";
	protected static $db_table_field =array('username','password','first_name','last_name','user_image');
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $user_image;
	public $tmp_name;
	public $upload_dir="images";
	public $image_placeholder="http://placehold.it/400x400&text=image";
	
public function image_path_placeholder(){
return empty($this->user_image)? $this->image_placeholder : $this->upload_dir.DS.$this->user_image;
}
public function delete_user(){
	if($this->delete()){
		$target_path=SITE_ROOT.DS.'admin'.DS.$this->image_path_placeholder();
		return unlink($target_path)?true:false;
	}else{
		return false;
	}
	}



public static function verify_user($username,$password){
	global $obj;
	$username=$obj->escape_string($username);
	$password=$obj->escape_string($password);
	$sql="SELECT * FROM " .self::$db_table. " WHERE ";
	$sql.="username='{$username}'";
	$sql.=" AND password='{$password}'";
	$sql.="LIMIT 1";

	$the_result_array=self::search_this_query($sql);
	return !empty($the_result_array) ? array_shift($the_result_array):false;
} 

public $upload_errors_array=array( 
        0=>"There is no error, the file uploaded with success", 
        1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini", 
        2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form" ,
        3=>"The uploaded file was only partially uploaded", 
        4=>"No file was uploaded", 
        6=>"Missing a temporary folder" ,
); 




public function set_file($file){
	if(empty($file) || !$file || !is_array($file) ){
		$this->error[]="There is no file uploaded.";
		return false;
	}elseif($file['error']!=0){
		$the_error=$this->upload_errors_array[$file['error']];
		return false;
	}
	else{
		$this->user_image=basename($file['name']);
		$this->tmp_name=$file['tmp_name'];
		$this->type=$file['type'];
		$this->size=$file['size'];
	}
}

public function picture_path(){
	return $this->upload_dir.DS.$this->user_image;
}


public function save_user_image(){

	if($this->id){
		$this->update();
	}
	if(!empty($this->error)){
		return false;
	}
	if(empty($this->user_image)||empty($this->tmp_name)){
		$this->error[]="The file not available";
		return false;
	}
	$target_path=SITE_ROOT.DS.'admin'.DS.$this->upload_dir.DS.$this->user_image;
	

	if(file_exists($target_path)){
		$this->error[]="The File {$this->user_image} already exists ";
		return false;
	}
	if(move_uploaded_file($this->tmp_name, $target_path)){
		
			
			unset($this->tmp_name);
			return false;
		
	}
		else{
		$this->error[]="The file doesn't have permission to access";
		return false;
		}

	


}
public function save_ajax_user_image($user_image,$user_id){

	global $obj;
	$user_image=$obj->escape_string($user_image);
	$user_id=$obj->escape_string($user_id);
	$this->id=$user_id;
	$this->user_image=$user_image;
	$sql="UPDATE ".self::$db_table." SET user_image='{$this->user_image}'";
	$sql .=" WHERE id={$this->id} ";
	$update_image=$obj->query($sql);
	echo $this->image_path_placeholder();

}

public function delete_photo(){
	if($this->delete()){
		$target_path=SITE_ROOT.DS.'admin'.DS.$this->upload_dir.DS.$this->user_image;
		return unlink($target_path)?true:false;
	}else{
		return false;
	}
}




}//End of class User


 ?>