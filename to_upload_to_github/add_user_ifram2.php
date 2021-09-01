<?php 

#CREATE TABLE `a_final_users_table` ( `time` TIMESTAMP NOT NULL ,`hashword` TEXT NOT NULL , `uname` TEXT NOT NULL , `email` TEXT NOT NULL ,  UNIQUE (`uname`(256) ) ) ENGINE = MyISAM; 
include("config.php");
include("stiper.php");

$path="http://alexhaussmann.com/adhaussmann/a_final/";

$name     =   user_striper($_POST["uname"]);
$password =   the_striper($_POST["hashword"]);
$email    =   the_striper($_POST["email"]);

$out="no user added";
if ($name!="") {
    #checks if there was a username
    $sql1 = "SELECT * FROM `a_final_users_table` WHERE `uname` LIKE '".$name."'";
    $result = $conn->query($sql1);
    
    if ($result->num_rows==0) {
      #adds user
      $sql="INSERT INTO `a_final_users_table` (`hashword`, `uname`, `email`,`time`) VALUES ('".$password."', '".$name ."', '".$email."',CURRENT_TIMESTAMP);";
      $result = $conn->query($sql);
      $out="user added ".$name;

      #sents up user acount 

    }
    else{
      $out="username taken";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Add</title>
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

</br>
</br>
<body style="background-color: #24222a;">

  <div class="container ">



    <div class=" d-flex justify-content-center">
      <form action="" method="post" class="mt-3">
          <label for="uname" class="text-white"> <?php echo $out;?> </label>
        </br>
        <div class="form-group">
          <label for="uname" class="text-white">User Name</label>
          <input type="text" class="form-control" id="user" name="uname" placeholder="User Name" value="">
        </div>


        <div class="form-group">
          <label for="password" class="text-white">HashWord</label>
          <input type="text" class="form-control" id="password" name="hashword" placeholder="HashWord" value="">
        </div>

        <div class="form-group">
              <label for="uname" class="text-white">Email</label>
              <input type="text" class="form-control" id="hash" name="email" placeholder="Email" value="">
        </div>

        <button type="submit" class="btn btn-primary" value="Submit">Login</button>

      </form>

    </div>
  </div>






