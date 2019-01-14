<?php 
ob_start();

class photo extends db_object{
	protected static $db_table="photos";
	protected static $db_table_field =array('id','title','caption','description','filename','alternate_text','type','size');
	public $id;
	public $title;
	public $caption;
	public $description;
	public $filename;
	public $alternate_text;
	public $type;
	public $size;


	public $tmp_name;
	public $upload_dir="images";
	public $error=array();
	public $upload_errors_array=array( 
        0=>"There is no error, the file uploaded with success", 
        1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini", 
        2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form" ,
        3=>"The uploaded file was only partially uploaded", 
        4=>"No file was uploaded", 
        6=>"Missing a temporary folder" ,
); 

//This is passing $_FILE['upload_file'] as an argument.($file= $_FILE['upload_file']).
	//upload_file is name of file input.

public function set_file($file){
	if(empty($file) || !$file || !is_array($file) ){
		$this->error[]="There is no file uploaded.";
		return false;
	}elseif($file['error']!=0){
		$the_error=$this->upload_errors_array[$file['error']];
		return false;
	}
	else{
		$this->filename=basename($file['name']);
		$this->tmp_name=$file['tmp_name'];
		$this->type=$file['type'];
		$this->size=$file['size'];
	}
}

public function picture_path(){
	return $this->upload_dir.DS.$this->filename;
}


public function save_photo(){

	if($this->id){
		$this->update();
	}
	if(!empty($this->error)){
		return false;
	}
	if(empty($this->filename)||empty($this->tmp_name)){
		$this->error[]="The file not available";
		return false;
	}
	$target_path=SITE_ROOT.DS.'admin'.DS.$this->upload_dir.DS.$this->filename;
	

	if(file_exists($target_path)){
		$this->error[]="The File {$this->filename} already exists ";
		return false;
	}
	if(move_uploaded_file($this->tmp_name, $target_path)){
		if($this->create()){
			unset($this->tmp_name);
			return false;
		}
		else{
		$this->error[]="The file doesn't have permission to access";
		return false;
		}

	}


}


public function delete_photo(){
	if($this->delete()){
		$target_path=SITE_ROOT.DS.'admin'.DS.$this->picture_path();
		return unlink($target_path)?true:false;
	}else{
		return false;
	}
}

public static function display_sidebar_data($photo_id){
	$photo=photo::find_by_id($photo_id);
	$output="<a class='thumbnails' href='#'><img src='{$photo->picture_path()}'width='100'></a>";
	$output.="<p>{$photo->filename}</p>";
	$output.="<p>{$photo->type}</p>";
	$output.="<p>{$photo->size}</p>";
	echo $output;
}


}



 ?>