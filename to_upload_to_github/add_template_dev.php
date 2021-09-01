

<?
#CREATE TABLE `a_final_posts` ( `uname` TEXT NOT NULL , `text` TEXT NOT NULL , `body` TEXT NOT NULL , `tital` TEXT NOT NULL , `time` TIMESTAMP NOT NULL , `photo` TEXT NOT NULL , `iframe` TEXT NOT NULL , `catagoy` TEXT NOT NULL , `catagoy_2` TEXT NOT NULL , `postkey` TEXT NOT NULL , UNIQUE (`postkey`(256))) ENGINE = MyISAM; 

include("config.php");

include("stiper.php");

$uname=           user_striper($_POST["uname"])       ;
$hashword=        the_striper($_POST["hashword"])     ;
$template_name=   the_striper($_POST["template_name"]);
$template =       $_POST["template"]     ;

$usertemplate_name =$uname."_".$template_name;

$template = str_replace('"'  ,  '(!A???!???A!)' , $template);
$template = str_replace('\'' ,  '(!B???!???B!)' , $template);
$template = str_replace('`'  ,  '(!C???!???A!)' , $template);


$bytes = openssl_random_pseudo_bytes(256);

$rando = base64_encode($bytes);
$post_id= hash('sha256',$rando );

$sql = "SELECT * FROM a_final_users_table WHERE `uname` LIKE '".$uname."' AND `hashword` LIKE '".$hashword."'; ";

$out="wrong_username_password";
$result = $conn->query($sql);
if ($result->num_rows==1) {
    $sql = "SELECT * FROM a_final_template WHERE `usertemplate_name` LIKE '".$usertemplate_name."'; ";
    $result = $conn->query($sql);
    if ($result->num_rows==0) {
      $sql=  "INSERT INTO `a_final_template` (`username`, `usertemplate_name`, `template`, `time`) VALUES ('".$uname."', '".$usertemplate_name."', '".$template."', CURRENT_TIMESTAMP);";
        $result = $conn->query($sql);
        $out="template_made ".$usertemplate_name;
      }
      else{
      $out="You already have used that template";
      }
}
else{
  $out="user name or password incorrect";
}
if ($_POST["uname"]=="")
{
  $out="Add Template";
}


?><?php echo $out; ?>