

<?

#CREATE TABLE `a_final_posts` ( `uname` TEXT NOT NULL , `text` TEXT NOT NULL , `body` TEXT NOT NULL , `tital` TEXT NOT NULL , `time` TIMESTAMP NOT NULL , `photo` TEXT NOT NULL , `iframe` TEXT NOT NULL , `catagoy` TEXT NOT NULL , `catagoy_2` TEXT NOT NULL , `postkey` TEXT NOT NULL , UNIQUE (`postkey`(256))) ENGINE = MyISAM; 
include("config.php");
include("stiper.php");
#Gets the nessisarty information form the user 
$uname=           user_striper($_POST["uname"])       ;
$hashword=        the_striper($_POST["hashword"])     ;
$template_name=   the_striper($_POST["template_name"]);
$template =       $_POST["template"]                  ;

$usertemplate_name =$uname."_".$template_name;

#converts away " ' and `
$template = str_replace('"'  ,  '(!A???!???A!)' , $template);
$template = str_replace('\'' ,  '(!B???!???B!)' , $template);
$template = str_replace('`'  ,  '(!C???!???A!)' , $template);

$bytes = openssl_random_pseudo_bytes(256);
$rando = base64_encode($bytes);
#creats randome hash id could use hash template name
$post_id= hash('sha256',$rando );
#checks user name and password
$sql = "SELECT * FROM a_final_users_table WHERE `uname` LIKE '".$uname."' AND `hashword` LIKE '".$hashword."'; ";

$result = $conn->query($sql);
if ($result->num_rows==1) {
    #checks to see if template name is in use
    $sql = "SELECT * FROM a_final_template WHERE `usertemplate_name` LIKE '".$usertemplate_name."'; ";
    $result = $conn->query($sql);
    if ($result->num_rows==0) {
        #adds templare if name is unussed
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


?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>first_page</title>
  <!-- bootstrap link start -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- bootstrap link end -->
  <style>

    .themainbutton{
      min-width: 220px;
    }

  </style>
</head>

<body style="background-color: #24222a;">
       </br>
  <div class="container ">

    <div class=" d-flex justify-content-center">

        <label for="uname" class="text-white"> <?php echo $out;?> </label>0

    </div>

        </br>
    <div class=" d-flex justify-content-center">

      <form action=""  method="post" class="mt-3">

        <div class="form-group">
              <label for="uname" class="text-white">user name</label>
              <input type="text" class="form-control" id="user" name="uname" placeholder="user name" value="">
        </div>

        <div class="form-group">
              <label for="password" class="text-white">Hashword</label>
              <input type="text" class="form-control" id="password" name="hashword" placeholder="Hashword"
            value="">
        </div>

        <div class="form-group">
              <label for="uname" class="text-white">Template_name</label>
              <input type="text" class="form-control" id="hash" name="template_name" placeholder="Template_name" value="">
        </div>

        <div class="form-group">
              <label for="uname" class="text-white">Template</label>
              <input type="text" class="form-control" id="hash" name="Template" placeholder="Template" value="">
        </div>
        <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
      </form>


    </div>
</div>
</br>
</br>
<button class="btn btn-info themainbutton" onclick="window.location.href='examples.zip';">Template Example</button>


