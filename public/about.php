<?php 



include_once '../sys/core/init.inc.php';
/*  Set up the page title and CSS files  */
$page_title = "Meet Our Team"; 
$css_files = array('style.css','admin.css', 'nav.css', 'ajax.css','font-awesome.min.css', 'misc_pages.css'); 


include_once 'assets/common/header.inc'; 
include 'assets/common/hero_image.inc';
include 'assets/common/team_card.inc';
?> 


<p> <?php 
 
    echo isset($_SESSION['user']) ? "Welcome <strong>". $_SESSION['user']['name'].
     "</strong>, to your Event Management System" : "You are not logged in. Please Log in or Register to manage your Calendar"; 
 
?> </p> 

<?php 
/*   Include the footer  */ 
include_once 'assets/common/footer.inc'; 
 




?> 
<!--	Native Javascript to implement active primary link	-->
<script>
document.querySelectorAll('a.active')[0].setAttribute('class','');
document.getElementById('about').setAttribute('class','active');

</script>