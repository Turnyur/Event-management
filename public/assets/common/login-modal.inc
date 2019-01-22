<?php
$string=<<<EOD
<div id="id01" class="modal" >
  
  <form class="modal-content animate" action="assets/inc/process.inc.php" method="POST">

    <div class="imgcontainer">

      <span  class="close-login" title="Close Modal">&times;</span>
      <img src="assets/images/img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" id="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pword" id="pword" required>
      
      <input type="hidden" name="token" value="$_SESSION[token]" />             
      <input type="hidden" name="action" value="user_login" />     

      <button type="submit" id="modal-login-submit" >Login</button>
     <!--  <input style="margin-top:4px;" type="submit" name="login_submit" value="Log In" id="modal-login-submit"/> -->
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>
EOD;
echo $string;
?>