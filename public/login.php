
<?php 

/*  * Include necessary files  */ 
include_once '../sys/core/init.inc.php'; 

/*  * Output the header  */ 
$page_title = "Please Log In Or Sign Up"; 
$css_files = array('style.css','admin.css', 'nav.css', 'ajax.css', 'font-awesome.min.css'); 
include_once 'assets/common/header.inc'; 
?>
<?php
if (isset($_SESSION['user'])) {
	header("location: ./");
}
	

if($_GET['action']=='register'){
	
	$string=<<<EOD
<div id="content"> 
	<h2>Register To Have Full Access and Manage Your Events</h2>
	<form action="assets/inc/process.inc.php" method="post">         
		<fieldset><legend>Enter Details Below</legend>             
			<label for="uname">Username</label> 
			<input type="text" name="uname" id="uname" value="" />            
			<label for="pword">Password</label>             
			<input type="password" name="pword" id="pword" value="" /> 
			<label for="confirm_pword">Confirm Password</label>             
			<input type="password" name="confirm_pword" id="confirm_pword" value="" />  
			<label for="user_email">Email</label>             
			<input type="text" name="email" id="user_email" value="" />   
			<div id="checkbox"><input type="checkbox" name="terms" checked> Accept Terms and Conditions</div>
			<input type="hidden" name="token" value="$_SESSION[token]" />             
			<input type="hidden" name="action" value="user_registration" />          
			<input style="margin-top:4px;" type="submit" name="register_submit" value="Register" />             
			or <a href="./">cancel</a>         
		</fieldset>     
	</form> 
</div>
EOD;


echo $string;


}else{


	
$string=<<<EOD
<div id="content"> 
	<h2>Please Log In To Explore Full Features</h2>
	<form action="assets/inc/process.inc.php" method="post">         
		<fieldset><legend>Please Log In</legend>             
			<label for="uname">Username</label> 
			<input type="text" name="uname" id="uname" value="" />            
			<label for="pword">Password</label>             
			<input type="password" name="pword" id="pword" value="" />             
			<input type="hidden" name="token" value="$_SESSION[token]" />             
			<input type="hidden" name="action" value="user_login" />            
			<input style="margin-top:4px;" type="submit" name="login_submit" value="Log In" />             
			or <a href="./">cancel</a>         
		</fieldset>     
	</form> 
</div>
EOD;


echo $string;

}
?>
<?php 

/*  * Output the footer  */ 
include_once 'assets/common/footer.inc'; 



?> 