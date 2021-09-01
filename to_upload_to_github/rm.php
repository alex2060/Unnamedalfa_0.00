<?php




session_start();

include("config.php");
include("web_name.php");


include("stiper.php");

$name=the_striper($_GET["n"]);
$check_key=hash('sha256', $_GET["k"]   );

$message=the_striper($_GET["mgs"]);


$output="false";

#CREATE TABLE `the_example_ledger` ( `name` TEXT NOT NULL , `hash` TEXT NOT NULL , `time_E` TIMESTAMP NOT NULL , `time_I` TIMESTAMP NOT NULL , `key_of_H` TEXT NOT NULL , `sorce` TEXT NOT NULL , `email` TEXT NOT NULL ) ENGINE = MyISAM; 

#CREATE TABLE `treelose_data`.`the_example_ledger` ( `name` TEXT NOT NULL , `hash` TEXT NOT NULL , `time_E` TIMESTAMP NOT NULL , `time_I` TIMESTAMP NOT NULL , `key_of_H` TEXT NOT NULL , `sorce` TEXT NOT NULL , `email` TEXT NOT NULL , UNIQUE (`name`(1000))) ENGINE = MyISAM; 


$sql = "SELECT * FROM `a_final_Ledgur_keys` WHERE `entery_name` LIKE '".$name."' ORDER BY `hash` DESC";

$out="false".$sql;

$result = $conn->query($sql);
if ($result->num_rows>0) {

    while($row = $result->fetch_assoc() ) {
            $mykey=strtolower($row["hash"] );
            $myitem=$row["ledgername"];
            $file_key=$row["solution"];



    }

    if($check_key==$mykey){
    	
    	if ($file_key=="key" ) {
    		
	    $sql="UPDATE `a_final_Ledgur_keys` SET `solution` = '".$_GET["k"]."' WHERE `entery_name` = '".$name."';";
        $result = $conn->query($sql);

        $sql2="SELECT * FROM `a_final_Ledgur` WHERE `Ledgurename` LIKE '".$myitem."';";




        $result = $conn->query($sql2);        
        while($row = $result->fetch_assoc() ) {
            $toemail=$row["email"];
            $test2=  $row["email"];
            $intest="1";
        }

            $bytes = openssl_random_pseudo_bytes(256);




            $rando = base64_encode($bytes);
            $post_id= hash('sha256',$rando );
            
            $sql="INSERT INTO `a_final_posts` (`uname`, `text`, `body`, `tital`, `time`, `photo`, `iframe`, `catagoy`, `catagoy_2`, `postkey`) VALUES ('admin', '".$myitem."', '".$name."', 'tital2', CURRENT_TIMESTAMP, 'photo', '".$message."', 'K', 'K', '".$post_id."');";
            
            $result = $conn->query($sql);
            $out="true ".$myitem." ".$post_id." msg ".$message;

            mail( $test2, $myitem." ".$post_id,"this is a message".$message );


    	}
    	else{
    	   $out="key on file ".$file_key;
    	}
    }
    else{
        $out="wrongkey".$sql;
    }
}
#$out="false".$sql;

echo $out;



?>
