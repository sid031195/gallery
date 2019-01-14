<?php
                        
                       
                     $get=user::find_all_user();
                    //echo $get;
                       


                         echo"<hr>";
                         /*
                        $gets_user=user::find_user(3);
                        $useri=user::instantiation($gets_user);
                        $user=new user();
                        $user->id=$gets_user['id'];
                        $user->username=$gets_user['username'];
                        $user->password=$gets_user['password'];
                        $user->first_name=$gets_user['first_name'];
                        $user->last_name=$gets_user['last_name'];
                        //echo $gets_user['username']."<br>";
                        echo $useri->id."<br>";
                        echo $useri->username."<br>";
                        echo $useri->password."<br>";
                        echo $useri->first_name."<br>";
                        echo $useri->last_name."<br>";

                        $all_users=user::find_all_user();
                        foreach ( $all_users as $user) {
                            # code...
                            echo $user->id." | ";
                            echo $user->username."<br>";
                        }*/
                        $gets_user=user::find_user(3);
                        echo $gets_user->username;

                        echo"<hr>";


                        ?>







public function create(){
    global $obj;
    $sql="INSERT INTO user (username, password, first_name, last_name)";
    $sql.="VALUE('";
    $sql.=$obj->escape_string($this->username)."','";
    $sql.=$obj->escape_string($this->password)."','";
    $sql.=$obj->escape_string($this->first_name)."','";
    $sql.=$obj->escape_string($this->last_name)."')";

    if($obj->query($sql)){
        $this->id=$obj->insert_id();
        return true;
    }else{
        return false;
    }
}














print_r($properties);
    $arr=implode(",", array_keys($properties));
    print_r($arr);