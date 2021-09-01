


<?php
#alexhaussmann.com/adhaussmann/a_final/get_post_dev.php?key=key&type=uname

#http://alexhaussmann.com/adhaussmann/a_final/get_post_dev.php?key=key&type=uname

#http://alexhaussmann.com/adhaussmann/a_final/get_post_dev.php?key=key&type=all

#http://alexhaussmann.com/adhaussmann/a_final/get_post_dev.php?type=basic&cat1=%%





include("stiper.php");


$user=			user_striper($_GET["user"  ])	;
$key=			the_striper($_GET["key"    ])	;
$seach1= 		the_striper($_GET["seach1" ])	;
$seach1= 		the_striper($_GET["seach2" ])	;
$catagory_1=	the_striper($_GET["cat1"   ])	;
$catagory_2=	the_striper($_GET["cat2"   ])	;
$type=			the_striper($_GET["type"   ])	;
$usekey=		the_striper($_GET["usekkey"])   ;


include("config.php");

if ($key!="") {

	$sql="SELECT * FROM `a_final_posts` WHERE `postkey` LIKE '".$key."';";
	$out="no_key";
	$result = $conn->query($sql);

	if ($result->num_rows==1) {
		while($row = $result->fetch_assoc() ) {

			if ($type=="uname") {
				$out=$row["uname"];
			}

			if ($type=="text") {
				$out=$row["text"];
			}

			if ($type=="body") {
				$out=$row["body"];
			}

			if ($type=="tital") {
				$out=$row["tital"];
			}
			if ($type=="time") {
				$out=$row["time"];
			}

			if ($type=="photo") {
				$out=$row["photo"];
			}

			if ($type=="iframe") {
				$out=$row["iframe"];
			}

			if ($type=="catagoy") {
				$out=$row["catagoy"];
			}

			if ($type=="catagoy_2") {
				$out=$row["catagoy_2"];
			}

			if ($type=="all") {
				$out=$row["uname"]."(???)".$row["text"]."(???)".$row["body"]."(???)".$row["tital"]."(???)".$row["time"]."(???)".$row["photo"]."(???)".$row["iframe"]."(???)".$row["catagoy"]."(???)".$row["catagoy_2"];
				$private_checker=$row["catagoy_2"];
			}
			if ($type=="Red") {
				$out=$row["text"];
			}

			if ($type=="Red2") {
				$out=$row["text"];
			}
			$private_checker=$row["catagoy_2"];

		}
	}


}

else{

	if ($type=="basic")	{


	    $sql="SELECT * FROM `a_final_posts` WHERE  `catagoy` LIKE '".$catagory_1."'  ORDER BY `time` DESC;";
		$result = $conn->query($sql);
		$out="";

		if ($result->num_rows>0) {
		    $count=0;
		    while($row = $result->fetch_assoc() ) {
		            $count+=1;
		            $out=$out.$row["postkey"]."?";


		        }
		}


	}




	if ($type=="user_catagoy") {

		if ($catagory_1=="") {
			$catagory_1="notseach";
		}
		$sql="SELECT * FROM `a_final_posts` WHERE  `catagoy` LIKE '".$catagory_1."' AND `uname` LIKE '".$user."'  ORDER BY `time` DESC;";
		$result = $conn->query($sql);
		$out2=$sql;
		$out="";

		if ($result->num_rows>0) {
		    $count=0;
		    while($row = $result->fetch_assoc() ) {
		            $count+=1;
					$out=$out.$row["postkey"]."?";
		        }


		}


	}

}


if ($private_checker!="") {
	$vale=explode(' ',$private_checker);
	if ($vale[0]=="P"){
		$check=$vale[1];
		$sql="SELECT * FROM `a_final_posts` WHERE `uname` LIKE 'admin' AND `text` LIKE '".$check."' AND `postkey` LIKE '".$usekey."'";
		$result = $conn->query($sql);
		if ($result->num_rows==0) {

			$out="fail wrong key";
		}


	}

}


if ($type=="Red") {

	header("Location: ".$out);

	$out=$out." Red";

}
if ($type=="Red2") {

	header("Location: ".$out);

	$out=$out." Red2";

}
?>

<?//php echo replacer($out); ?>
<?php echo replacer($out); ?>





