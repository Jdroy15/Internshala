<?php

$error = '';
$name = '';
$email = '';
$phone = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label>Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label>Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label>Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label>Invalid email format</label></p>';
  }
 }
 if(empty($_POST["phone"]))
 {
  $error .= '<p><label>Please Enter your Phone number</label></p>';
 }else{
  $phone = clean_text($_POST["phone"]);
  if(strlen($phone)>10){
	$error .= '<p><label>Enter correct length Phone number.</label></p>';
  }
 }
 

 if($error == '')
 {
  $file_open = fopen("user_data.csv", "a");
  
  $form_data = array(
   'name'  => $name,
   'email'  => $email,
   'phone' => $phone
  );
  fputcsv($file_open, $form_data);
  $error = '';
  $name = '';
  $email = '';
  $phone = '';
 }
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Sign-up page</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <br />
   <div class="col-md-6" style="margin:0 auto; float:none;">
    <form method="post">
     <h3 align="center">Sign-up Form</h3>
	 <p align="center">Already a customer? <a href="login_new.php">Login</a></p>
     <br />
     <?php echo $error; ?>
     <div class="form-group">
      <label>Enter Name</label>
      <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
     </div>

     <div class="form-group">
      <label>Enter Email</label>
      <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
     </div>
     
	 <div class="form-group">
	  <label>Enter Phone Number</label>
	  <input type="text" name="phone" class="form-control" placeholder="Enter Phone number" value="<?php echo $phone; ?>" /> 
	</div>
     <div class="form-group" align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Submit" />
     </div>
    </form>
   </div>
  </div>
 </body>
</html>
