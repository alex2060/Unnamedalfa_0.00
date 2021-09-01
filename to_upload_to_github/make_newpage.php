<?php 
include("config.php");
include("stiper.php");
#Get user data
$path= "http://alexhaussmann.com/adhaussmann/a_final/";
$usertemplate_name=     the_striper($_GET["usertemplate_name"]);
$uname=                 the_striper($_GET["uname"]);
$hashword=              the_striper($_GET["hashword"]);
$var1=                  the_striper($_GET["var1"]);
$setion=                the_striper($_GET["setion"]);
$setion2=               the_striper($_GET["setion2"]);
#Add setions
if ($setion==""){
  $make=$path."add_post_dev.php?uname=&hashword=&tital=setion&text=&body=&=&iframe=&catagoy=&catagoy_2=";
  $ch1 = curl_init();
  curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch1, CURLOPT_VERBOSE,TRUE);
  curl_setopt($ch1, CURLOPT_URL,    str_replace(' ', '', $make)   );
  $test1 =  curl_exec($ch1);
  $post_id= trim($test1);
  $setion=$post_id;
  $gets="&var1=".$_GET["var1"]."&uname=".$_GET["uname"]."&hashword=".$_GET["hashword"]."&setion=".$setion."&setion2=".$_GET["setion2"];
  header("Location: make_newpage.php?usertemplate_name=".$_GET["usertemplate_name"].$gets);
}
if ($setion2==""){
  $make=$path."add_post_dev.php?uname=&hashword=&tital=setion&text=&body=&=&iframe=&catagoy=&catagoy_2=";
  $ch1 = curl_init();
  curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch1, CURLOPT_VERBOSE,TRUE);
  curl_setopt($ch1, CURLOPT_URL,    str_replace(' ', '', $make)   );
  $test1 =  curl_exec($ch1);
  $post_id= trim($test1);
  $setion2=$post_id;
  $gets="&var1=".$_GET["var1"]."&uname=".$_GET["uname"]."&hashword=".$_GET["hashword"]."&setion=".$setion."&setion2=".$setion2;
  header("Location: make_newpage.php?usertemplate_name=".$_GET["usertemplate_name"].$gets);
}
$sql = "SELECT * FROM `a_final_users_table` WHERE `uname` LIKE '".$uname."' AND `hashword` LIKE '".$hashword."'; ";
$result = $conn->query($sql);
if ($result->num_rows==1) {
  $uname="";
}
#Get leddgure
$sql = "SELECT * FROM a_final_template WHERE `usertemplate_name` LIKE '".$usertemplate_name."'; ";
$result = $conn->query($sql);
if($result->num_rows==1){
  while(  $row = $result->fetch_assoc() ) {
        $template=$row["template"];
}
#Replacement Step
$template = str_replace('(!A???!???A!)' , '"'                   , $template);
$template = str_replace('(!B???!???B!)' , '\''                  , $template);
$template = str_replace('(!C???!???C!)' , '`'                   , $template);
$template = str_replace('(!D???!???D!)' , '\\'                  , $template);
$template = str_replace('(!0???!???0!)' , $var1                 , $template);
$template = str_replace('(!S???!???S!)' , $setion               , $template);
$template = str_replace('(!Z???!???Z!)' , $setion2              , $template);
$template = str_replace('(!U???!???U!)' , $uname                , $template);
$template = str_replace('(!T???!???T!)' , $usertemplate_name    , $template);
$template = str_replace('(!Y???!???Y!)' , '&'                   , $template);
$template = str_replace('(!P???!???P!)' , $path                 , $template);

}
?><?php echo $template ; ?>