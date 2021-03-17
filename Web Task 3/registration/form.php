<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
    // define variables and set to empty values

$num_of_degree="";
$nameErr = $emailErr = $genderErr = $dobErr = $degreeErr =$bloodgrpErr=$passErr=$confirmpassErr="";
$name = $email = $gender =$degree =  $dob = $bloodgrp="";
$flag=1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) { 
    $nameErr = "Name is required";
  } else {
      $name = test_input($_POST["name"]);
    
    // check if name only contains letters and whitespace
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
  //email validation :
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
      $email = test_input($_POST["email"]);  
  // check if e-mail address is well-former
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $emailErr = "Invalid email format";
      $email="";
       $flag=0;
    }   
  }
   

   //birthday validation :
   if (empty($_POST["birthday"])) {
    $dobErr = "birthday is required";
  } else {
    $dob = test_input($_POST["birthday"]);   
  } 
  
   //gender validation :
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

    //degree validation :
   if (empty($_POST['deg'])) {
    $degreeErr = "Degree is required";
     $flag=0;
  } else {
    $num_of_degree =count($_POST["deg"]);
    if($num_of_degree==2)
    {       
    	for($i=0;$i<2;$i++)
    	{
    		$degree=test_input($_POST["deg"][$i]);  		
    	}        
    }	
    else
    {
    	$degreeErr = "Must Select Two Degree";
       $flag=0;
    }
  }


  if (empty($_POST["bgrp"])) {
    $genderErr = "Blood Group is required";
     $flag=0;
  } else {
    $bloodgrp = test_input($_POST["bgrp"]);
  }
}




if (empty($_POST["Password"])) {
    $passErr = "Password is required";

    $flag=0;
  } else {
    $password = test_input($_POST["Password"]);
    if (strlen($password)<8) {
      $passErr = "Password must be 8 charecters";
      $password ="";
      $flag=0;
    }
    else if (!preg_match("/[@,#,$,%]/",$password)) {
      $passErr = "Password must contain at least one of the special characters (@, #, $,%)";
      $password ="";
      $flag=0;
    }
  }
  if (empty($_POST["confirmpass"])) {
    $confirmpassErr = "Retype The Current Password";
    $flag=0;
  } else {
    $confirmpass = test_input($_POST["confirmpass"]);
    if (strcmp($password, $confirmpass)==1) {
      $confirmpassErr = "Password & Retyped Password Dosen't Match";
      $confirmpass ="";
      $flag=0;
    }
  } 
 if ($flag==1) {
  if(isset($_POST["submit"]))  
    {
  if(file_exists('Reg.json'))
    {
            $current_data = file_get_contents('Reg.json');  
            $array_data = json_decode($current_data, true);  
            $extra = array(  
                 'name'               =>     $_POST['name'],
                 'email'              =>     $_POST["email"],
                 'username'           =>     $_POST["username"],
                 'password'           =>     $_POST["confirmpass"],  
                 'gender'             =>     $_POST["gender"],  
                 'dateOfBirth'        =>     $_POST["birthday"],
                 'blood group'        =>     $_POST["bgrp"],
                );  
            $array_data[] = $extra;  
            $final_data = json_encode($array_data);  
            if(file_put_contents('Reg.json', $final_data))  
            {  
                 $message = "<label>File Appended Successfully</p>";  
            }  
        }  
        else  
        {  
           $error = 'JSON File not exits';  
        }  
    }
 
}
 

function test_input($data) {
 
 
  return $data;
}
?>




        
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
 <fieldset>
            <legend>REGISTRATION:</legend> 
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br><hr>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br><hr>
  
  Date Of Birth: 
<input type="date" name="birthday" value="<?php echo $dob;?>">
  <span class="error">* <?php echo $dobErr;?></span>
  <br><br><hr>


 Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br><hr>
  
  Degree:
  <input type="checkbox" name="deg[]" value="HSC">HSC
  <input type="checkbox" name="deg[]" value="SSC">SSC
  <input type="checkbox" name="deg[]" value="B.Sc">B.Sc.
  <input type="checkbox" name="deg[]" value="M.Sc">M.Sc.
  <span class="error">* <?php echo $degreeErr;?></span>
  <br><br><hr>
  Blood Group :
  <select  name="bgrp">
  <option value="A+">A+</option>
  <option value="A-">A-</option>
  <option value="B+">B+</option>
  <option value="B-">B-</option>
  <option value="AB+">AB</option>
  <option value="AB-">AB-</option>
  <option value="O+">O+</option>
  <option value="O-">O-</option>
  <span class="error">* <?php echo $bloodgrpErr;?></span>
</select>
<br><br><hr>
            User Name: <input type="text" name="username">
            <span class="error">* <?php echo $nameErr;?></span>
            <br>
            <hr>
            Password: <input type="Password" name="Password">
            <span class="error">* <?php echo $passErr;?></span>
            <br>
            <hr>
            Confirm Password: <input type="Password" name="confirmpass">
            <span class="error">* <?php echo $confirmpassErr;?></span>
            <br>
            <hr>
            </fieldset>
  <input type="submit" name="submit" value="Submit">  
  <input type="reset" value="Reset">
</form>



</body>
</html>