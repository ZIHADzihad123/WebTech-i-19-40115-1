<!DOCTYPE html>
<html lang="en">



<body>
    <?php 
    
    $nameErr = $passwordErr = $newPasswordErr =  $currentPasswordErr = "" ;
    $password = $name = $newPassword = $currentPassword = "";
    $nc =strlen($name);
    $pc =strlen($password);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) { 
    $nameErr = "Name is required";
  } else {
      $name = test_input($_POST["name"]);
    
    
    if (!preg_match("/^[a-zA-Z- ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      $name="";}

    $num_of_word =str_word_count($_POST["name"]);
    if($num_of_word!=2)
    {           	
    		$nameErr="Required Two Word Name";  
    		$name="";		
        $flag=0 ;  	       
    }	  
       }   

          if (empty($_POST["password"])) {
            $passwordErr = "password is required";
          } else {
            $password = test_input($_POST["password"]);
            if ($pc<8)
             {
              $passwordErr = "must not be less than eight (8) characters and also must contain one of these special characters (@, #, $,
              %)";
              $password ="";
            }
            else if (!preg_match("/[@,#,$,%]/",$password)) {
              $passErr = "Password must contain at least one of the special characters (@, #, $,%)";
              $password ="";
            }

          }
          
          if (empty($_POST["currentPassword"])) {
            $currentPasswordErr = "Current Password is required";
          } else {
            if (!strcmp($currentPassword, $password)==0) {
              $currentPasswordErr="Password is not correct";
            }
            $currentPassword = test_input($_POST["currentPassword"]);
          }
          if (empty($_POST["newPassword"])) {
            $newPasswordErr = "Current Password is not correct";
          } else {
            $newPassword = test_input($_POST["password"]);
            if (!strcmp($Password, $newPassword)==0) {
              $rtnpassErr = "New Password & Retyped Password Dosen't Match";
            }
          }

    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
       <fieldset>
        
           <legend><h1>Login</h1></legend>            
            <div class="name">
                Name: <input type="text" name="name">
                <span class="error">* <?php echo $nameErr;?></span>
                <br><br>
            </div>
            <div class="password">
                password: <input type="password" name="password">
                <span class="error">* <?php echo $passwordErr;?></span>
                <br><br>
            </div>
            
            <input type="checkbox" name="Remember_me"> Remember me <br>
            <input type="submit" name="submit" value="Submit"> <a href="http://">Forgot password?</a>
        </div><hr>
     </form>
         </fieldset>  
     <form>    
     	 <fieldset>
        
           <legend><h1>Change Password </h1></legend>  
            <div class="newPassword">

                Current password: <input type="password" name="currentPassword">
                <br><br>
                <span style="color:Green">New password: </span> <input type="password" name="password">
                <span class="error">* <?php echo $passwordErr;?></span>
                <br><br>
                <span style="color:red">Retype password: </span> <input type="password" name="newPasswordErr">
                <span class="error">* <?php echo $newPasswordErr;?></span>
                <br><br>
            </div>
            
            <input type="submit" name="submit" value="Submit">

        </div>
        </fieldset>
    </form>


</body>

</html>