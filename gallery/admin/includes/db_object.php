<?php 

class db_object{
	//protected static $db_table="user";

	public  static function find_all(){
	
	return static::search_this_query("SELECT * FROM " .static::$db_table. "");
	//$the_result_array=static::search_this_query("SELECT * FROM " .static::$db_table. " ");
	//return !empty($the_result_array) ? print_r($the_result_array):false;
	
		}

	public  static function find_by_id($id){
	global $obj;
$the_result_array=static::search_this_query("SELECT * FROM " .static::$db_table. " where id=$id LIMIT 1");
	return !empty($the_result_array) ? array_shift($the_result_array):false;
	//return $get_user;
}
public  static function search_this_query($sql){
	global $obj;
	$result_set=$obj->query($sql);
	$the_object_array=array();
	while($row=mysqli_fetch_array($result_set)){
		$the_object_array[]=static::instantiation($row);
	}
	//return $result_set;
	return $the_object_array;
}

public static function instantiation($the_record){
						$calling_class=get_called_class();
                        $the_object=new $calling_class;
                       foreach($the_record as $the_attribute=>$value ){
                       	if($the_object->has_the_attribute($the_attribute)){
                       		$the_object -> $the_attribute = $value;
                       	}
                       }
                       //print_r($the_object );
                       return $the_object;

}

private function has_the_attribute($the_attribute){
		$obj_properties=get_object_vars($this);
		return array_key_exists($the_attribute, $obj_properties);
}





protected function properties(){
	//return get_object_vars($this);
	$properties=array();

	foreach (static::$db_table_field as  $db_table_value) {
		
		if (property_exists($this, $db_table_value)) {
			
			$properties[$db_table_value]=$this->$db_table_value;
		}
	}
	print_r($properties);
	return $properties;
}

protected function clean_properties(){
	global $obj;
	$properties=$this->properties();
	$clean_properties=array();
	foreach ($properties as $key => $value) {
		$clean_properties[$key]=$obj->escape_string($value);
	}
	return $clean_properties;
}






public static function affected(){
	global $obj;
	return (mysqli_affected_rows($obj->con)==1)?true:false;
}


public function save(){
	return isset($this->id)?$this->update():$this->create();
}

public function create(){
	global $obj;
	$properties=$this->clean_properties();
	
$sql="INSERT INTO ".static::$db_table." (". implode(",", array_keys($properties)).")";
	$sql.="VALUE ('".implode("','", array_values($properties))."')";

	if($obj->query($sql)){
		$this->id=$obj->insert_id();
		return true;
	}else{
		return false;
	}
}

public function update(){
	global $obj;
	$properties=$this->clean_properties();
	$properties_pair=array();
	foreach ($properties as $key => $value) {
		$properties_pair[]="{$key}='{$value}'";
	}
	$sql="UPDATE " .static::$db_table. " SET ";
	/*
	$sql.="username='".$obj->escape_string($this->username)."',";
	$sql.= "password='".$obj->escape_string($this->password)."',";
	$sql.= "first_name='".$obj->escape_string($this->first_name)."',";
	$sql.= "last_name='".$obj->escape_string($this->last_name)."'";
	*/
	$sql.=implode(",", $properties_pair);
	$sql.=" where id=".$obj->escape_string($this->id);
	$obj->query($sql);
	//print_r($properties_pair);
	return static:: affected();
	
}

public function delete(){
	global $obj;
	$sql="DELETE from " .static::$db_table. " ";
	$sql.=" where id=".$obj->escape_string($this->id);
	$sql.=" LIMIT 1";

	$obj->query($sql);
	return static:: affected();
	}

	public static function count_all(){
		global $obj;
		$sql="SELECT count(*) FROM ".static::$db_table;
		$result=$obj->query($sql);
		$row=mysqli_fetch_array($result);
		return array_shift($row);
	}








}







 ?>