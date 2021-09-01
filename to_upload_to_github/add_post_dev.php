

<?
#CREATE TABLE `a_final_posts` ( `uname` TEXT NOT NULL , `text` TEXT NOT NULL , `body` TEXT NOT NULL , `tital` TEXT NOT NULL , `time` TIMESTAMP NOT NULL , `photo` TEXT NOT NULL , `iframe` TEXT NOT NULL , `catagoy` TEXT NOT NULL , `catagoy_2` TEXT NOT NULL , `postkey` TEXT NOT NULL , UNIQUE (`postkey`(256))) ENGINE = MyISAM; 
include("config.php");
include("stiper.php");
$uname=       user_striper($_GET["uname"]);
$hashword=    the_striper($_GET["hashword"]);
$tital =      the_striper($_GET["tital"]);
$text=        the_striper($_GET["text"]);
$body=        the_striper($_GET["body"]);
$photo=       the_striper($_GET["photo"]);
$iframe=      the_striper($_GET["iframe"]);
$catagoy=     the_striper($_GET["catagoy"]);
$catagoy1=    the_striper($_GET["catagoy"]);
$catagoy2=    the_striper($_GET["catagoy_2"]);

$bytes = openssl_random_pseudo_bytes(256);


//making randome name
$rando = base64_encode($bytes);
$post_id= hash('sha256',$rando );

$sql = "SELECT * FROM a_final_users_table WHERE `uname` LIKE '".$uname."' AND `hashword` LIKE '".$hashword."'; ";


$result = $conn->query($sql);

$out="false";
if ($result->num_rows==1) {
  $sql="INSERT INTO `a_final_posts` (`uname`, `text`, `body`, `tital`, `time`, `photo`, `iframe`, `catagoy`, `catagoy_2`, `postkey`) VALUES ('".$uname."', '".$text."', '".$body."', '".$tital."', CURRENT_TIMESTAMP, '".$photo."', '".$iframe."', '".$catagoy1."', '".$catagoy2."', '".$post_id."');";
  $result = $conn->query($sql);
  $out=$post_id;
}

if ($uname=="") {
  $sql="INSERT INTO `a_final_posts` (`uname`, `text`, `body`, `tital`, `time`, `photo`, `iframe`, `catagoy`, `catagoy_2`, `postkey`) VALUES ('', '".$text."', '".$body."', '".$tital."', CURRENT_TIMESTAMP, '".$photo."', '".$iframe."', '".$catagoy1."', '".$catagoy2."', '".$post_id."');";
  $result = $conn->query($sql);
  $out=$post_id;
}
?>
<?php echo $out;?>

