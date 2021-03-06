
<?php 
 	session_start();

/*  * Make sure the event ID was passed and also that a user is Logged In */ 
if ( isset($_POST['event_id'])   && isset($_SESSION['user']) ) {     
	/*      * Collect the event ID from the URL string      */     
	$id = (int) $_POST['event_id']; 
} else {     /*      * Send the user to the main page if no ID is supplied      */     
	header("Location: ./");     
	exit; 
} 
 
/*  * Include necessary files  */ 
include_once '../sys/core/init.inc.php'; 
 
/*  * Load the calendar  */ 
$cal = new Calendar($dbo); 
$markup = $cal->confirmDelete($id); 
 
/*  * Output the header  */ 
$page_title = "View Event"; 
$css_files = array('style.css', 'admin.css', 'nav.css'); 
include_once 'assets/common/header.inc'; 
 
?> 
 
<div id="content"> <?php echo $markup; ?> 
 
</div><!-- end #content --> 
 
<?php 
 
/*  * Output the footer  */ 
include_once 'assets/common/footer.inc'; 
 
?> 