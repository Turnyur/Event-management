<?php 

/** Include necessary files  */ 
include_once '../sys/core/init.inc.php'; 

/** Output the header  */ 
$page_title = "Our Services"; 
$css_files = array('style.css','admin.css', 'nav.css', 'ajax.css', 'font-awesome.min.css', 'misc_pages.css'); 
include_once 'assets/common/header.inc'; 


?>

<div class="hero-image-services">
  <div class="hero-text">
    <h1 style="font-size:50px">Social Event Scheduling Sodtware</h1>
    <p>IGBO CHIMA JOEL</p>
    <button>MOUAU/13/32866</button>
  </div>
</div>

<p>&nbsp;</p>


<p> <?php 
 
    echo isset($_SESSION['user']) ? "Welcome <strong>". $_SESSION['user']['name'].
     "</strong>, to your Event Scheduling Software" : "You are not logged in. Please Log in or Register to manage your Calendar"; 
 
?> </p> 

<?php 
/*   Include the footer  */ 
include_once 'assets/common/footer.inc'; 
if(!isset($_SESSION['user'])){
include 'assets/common/login-modal.inc';
include 'assets/common/register-modal.inc';

}

?> 

<script>
document.querySelectorAll('a.active')[0].setAttribute('class','');
document.getElementById('services').setAttribute('class','active');
console.log('Services');
</script>