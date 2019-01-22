<?php
$string=<<<EOD
<div id="id02" class="modal">
  
  <form class="modal-content animate" action="assets/inc/process.inc.php" method="POST">
    <div class="imgcontainer">

      <span class="close-login" title="Close Modal">&times;</span>
      <img src="assets/images/img_avatar2.png" alt="Avatar" class="avatar">
    </div>
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="uname">Username</label> 
      <input type="text" name="uname" id="uname" value="" required />            
      <label for="pword">Password</label>             
      <input type="password" name="pword" id="pword" value="" required/> 
      <label for="confirm_pword">Confirm Password</label>             
      <input type="password" name="confirm_pword" id="confirm_pword" value="" required/>  
      <label for="user_email">Email</label>             
      <input type="text" name="email" id="user_email" value="" required/>   
      <div id="checkbox"><input type="checkbox" name="terms" checked> Accept Terms and Conditions</div>
      <input type="hidden" name="token" value="$_SESSION[token]" />             
      <input type="hidden" name="action" value="user_registration" />            
      <div class="clearfix">
        <button type="button" class="cancelbtn">Cancel</button>
        <button type="submit" name="register_submit" class="signupbtn" id="modal-register-submit" >Sign Up</button>
      </div>
    </div>
  </form>
</div>
EOD;


echo $string;
?>