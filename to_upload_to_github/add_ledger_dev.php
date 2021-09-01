
<?php 

include("config.php");
include("stiper.php");

$password =the_striper($_GET["password"]);
$email    =the_striper($_GET["email"]);
$uname=    user_striper( $_GET["uname"] )  ;
$hashword= the_striper($_GET["hashword"]);
$name     =$uname."_".the_striper($_GET["Ledgure"]);
#CREATE TABLE `a_final_Ledgura` ( `Ledgurename` TEXT NOT NULL , `Ledgurepassword` TEXT NOT NULL , `email` TEXT NOT NULL , `time` TEXT NOT NULL , UNIQUE (`Ledgurename`(248))) ENGINE = MyISAM; 
$sql = "SELECT * FROM a_final_users_table WHERE `uname` LIKE '".$uname."' AND `hashword` LIKE '".$hashword."'; ";

$result = $conn->query($sql);
if ($result->num_rows==1) {
  if ($name!="") {
    $sql = "SELECT * FROM `a_final_Ledgur` WHERE `Ledgurename` LIKE '".$name."' ";
    $result = $conn->query($sql);
    $sql2=$sql;
    $out="used";
    if ($result->num_rows==0) {
        $sql="INSERT INTO `a_final_Ledgur` (`Ledgurename`, `Ledgurepassword`, `email`, `time`) VALUES ('".$name."', '".$password."', '".$email."', CURRENT_TIMESTAMP);";
        $result = $conn->query($sql);
        $out="added ".$name;
    }
  }
}
else{
  $out="wrong user name or password";
}

if ($_GET["uname"]=="") {
  $out="add a ledger";
}
?><?php echo $out;?> 
