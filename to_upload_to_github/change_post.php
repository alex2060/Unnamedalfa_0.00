<?php
include("config.php");
include("stiper.php");
$uname=		user_striper($_GET["uname"]);
$hashword=	the_striper($_GET["hashword"]);
$post=		the_striper($_GET["post"]);
$text=		the_striper($_GET["change_text"]);
$sql = "SELECT * FROM a_final_users_table WHERE `uname` LIKE '".$uname."' AND `hashword` LIKE '".$hashword."'; ";
$result = $conn->query($sql);
$out="no post made";
if ($result->num_rows==1) {
	$sql="SELECT * FROM `a_final_posts` WHERE `uname` LIKE '".$uname."' AND `postkey` LIKE '".$post."'";
	$result = $conn->query($sql);
	if ($result->num_rows==1) {
		$sql="UPDATE `a_final_posts` SET `text` = '".$text."' WHERE `postkey` = '".$post."';";
		$result = $conn->query($sql);
		$out="made post";
	}
}
if ($_GET["uname"]=="") {
	$sql="SELECT * FROM `a_final_posts` WHERE `uname` LIKE '".$uname."' AND `postkey` LIKE '".$post."'";
	$result = $conn->query($sql);
	if ($result->num_rows==1) {
		$sql="UPDATE `a_final_posts` SET `text` = '".$text."' WHERE `a_final_posts`.`postkey` = '".$post."';";
		$result = $conn->query($sql);
		$out="made post";
	}
}
?><?php echo $out; ?> 