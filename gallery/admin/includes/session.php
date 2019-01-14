<?php 

class session{
	public $sign_in=false;
	public $user_id;
	public  $message;
	public $count;
	 function __construct(){
		session_start();
		$this->check_login();
		$this->check_message();
		$this->visitors_count();

	}
	public function visitors_count(){
		if(isset($_SESSION['count'])){
			$this->count=$_SESSION['count']++;
			
		}else{
			return $_SESSION['count']=1;
		}
	}
	public function is_sign_in(){
		return $this->sign_in;
	}
	public function login($user){
		if($user){
			$this->user_id=$_SESSION['user_id']=$user->id;
			$this->sign_in=true;
		}

	}
	public function logout(){
			unset($_SESSION['user_id']);
			unset($this->user_id);
			$this->sign_in=false;
	}
	public function check_login(){
		if(isset($_SESSION['user_id'])){
			$this->user_id=$_SESSION['user_id'];
			$this->sign_in=true;
		}
		else{
			unset($this->user_id);
			$this->sign_in=false;
		}
	}
	public function message($msg=""){
		if(!empty($msg)){
			$_SESSION['message']=$msg;
			//unset($_SESSION['message']);
		}else{
			return $this->message="";
		}
	}
	public function check_message(){
		if(isset($_SESSION['message'])){
			$this->message=$_SESSION['message'];
			unset($this->message);
			
		}else{
			$this->message="";
		}
	}
}
$session=new session();
$message=$session->message();

 ?>