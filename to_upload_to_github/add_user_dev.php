<?php 

#CREATE TABLE `a_final_users_table` ( `time` TIMESTAMP NOT NULL ,`hashword` TEXT NOT NULL , `uname` TEXT NOT NULL , `email` TEXT NOT NULL ,  UNIQUE (`uname`(256) ) ) ENGINE = MyISAM; 
include("config.php");
include("stiper.php");
$name     =   user_striper($_GET["uname"]);
$password =   the_striper($_GET["hashword"]);
$email    =   the_striper($_GET["email"]);


$out="add user";
if ($name!="") {
  $sql1 = "SELECT * FROM `a_final_users_table` WHERE `uname` LIKE '".$name."'";
  
  $result = $conn->query($sql1);
  
  if ($result->num_rows==0) {
    $sql="INSERT INTO `a_final_users_table` (`hashword`, `uname`, `email`,`time`) VALUES ('".$password."', '".$name ."', '".$email."',CURRENT_TIMESTAMP);";
    $result = $conn->query($sql);
    $out="user added ";
  }
  else{
    $out="username taken";
  }

  


}

?>


<?php 
echo $out;
?>




