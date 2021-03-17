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
$nameErr = $emailErr = $genderErr = $dobErr = $degreeErr =$bloodgrpErr="";
$name = $email = $gender =$degree =  $dob = $bloodgrp="";

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
    }
  }


  if (empty($_POST["bgrp"])) {
    $genderErr = "Blood Group is required";
  } else {
    $bloodgrp = test_input($_POST["bgrp"]);
  }
}


 

function test_input($data) {
 
 
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  
  Date Of Birth: 
<input type="date" name="birthday" value="<?php echo $dob;?>">
  <span class="error">* <?php echo $dobErr;?></span>
  <br><br>


 Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  
  Degree:
  <input type="checkbox" name="deg[]" value="HSC">HSC
  <input type="checkbox" name="deg[]" value="SSC">SSC
  <input type="checkbox" name="deg[]" value="B.Sc">B.Sc.
  <input type="checkbox" name="deg[]" value="M.Sc">M.Sc.
  <span class="error">* <?php echo $degreeErr;?></span>
  <br><br>
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
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo "Name :".$name;
echo "<br>";
echo "Email :".$email;
echo "<br>";
echo "Date Of Birth :".date("$dob");
echo "<br>";
echo "Selected :";
echo $num_of_degree;
echo "<br>";
echo "Degree's Are :";
for($i=0;$i<2;$i++)
    	{
       		echo $degree." ";
    	}
echo "<br>";
echo "Gender :".$gender;
echo "<br>";
echo "Blood Group :";
echo $bloodgrp;
?>

</body>
</html>