<?php
include("config.php");
include("web_name.php");
$name=$_GET["name"];
$output="false";
$sql = "SELECT * FROM `a_final_Ledgur_keys` WHERE `entery_name` LIKE '".$name."' ORDER BY `hash` DESC";
$result = $conn->query($sql);
$out="";
if ($result->num_rows>0) {
        while($row = $result->fetch_assoc() ) {
            $count+=1;
            $mykey=$row["ledgername"];
            $hash=$row["hash"];
            $solution=$row["solution"];
            $time=$row["time"];
        }
}
$output = "ledgername ". $mykey." hash ".$hash." solution ".$solution." time ".$time;
?><?php echo $output; ?>