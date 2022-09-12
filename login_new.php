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
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label>Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
 }
 if(empty($_POST["phone"]))
 {
  $error .= '<p><label>Please Enter your Phone number</label></p>';
 }else{
  $phone = clean_text($_POST["phone"]);
 }
 
 $file_data = [];
 if($error == '')
 {
  $file_open = fopen("user_data.csv", "r");
  while(!feof($file_open))
  {
	$row = fgetcsv($file_open);
	$file_data[] = $row;
  }
  //echo $name;
  //print_r($file_data);
  //print json_encode($file_data);

  function multi_array_search($search_for, $search_in){
	foreach($search_in as $element){
		if(($element == $search_for) || (is_array($element) && multi_array_search($search_for, $element))){
			return true;
		}
	}
	return false;
  }

  if(multi_array_search($name, $file_data) && multi_array_search($email, $file_data) && multi_array_search($phone, $file_data))
  {
	header("Location: newpage.php");
    //<a href="newpage.php" target="new"></a>;
  }
  else{
	print "Not found";
  }

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
     <h3 align="center">Login Form</h3>
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
