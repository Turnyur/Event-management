
<?php 



include_once '../sys/core/init.inc.php';
/*  Set up the page title and CSS files  */
$page_title = "Events Calendar"; 
$css_files = array('style.css','admin.css', 'nav.css', 'ajax.css', 'font-awesome.min.css'); 

if (isset($_GET['month'])) {
	$st=mktime(date("H"),date("i"),date("s"),(int)$_GET['month'],1,(int)$_GET['year']);
    $start_day=date('Y-m-d H:s:i', $st);
    
}else {
	$start_day=date('Y-m-d H:s:i');
}

$cal = new Calendar($dbo, $start_day); //"2010-01-31 00:00:00"
/*  Include the header  */ 
include_once 'assets/common/header.inc'; 
?> 

<?php include 'assets/common/slideshow.inc';?>
<div id="content"> 

<?php

/*
if ( is_object ($cal) ) {   
	echo "<pre>", var_dump($cal), "</pre>";
} 
*/
//echo'<hr>',date('l jS \of F Y H:i:s A');
//$result=$cal->_loadEventData();
//echo var_dump($result);

//$result=$cal->_createEventObj();
//echo var_dump($result);
if(isset($_SESSION['user'])){
	echo $cal->buildCalendar();

}else{
	echo '<a href="login.php?action=log-in"><strong>Log in</strong></a>'. 
         ' | <a href="login.php?action=register"><strong>Register</strong></a>'.
         ' to Manage your Calender and Events';
}

//echo date('w', strtotime('2018-1-20 20:00:00'));
//echo  32%7!=1 ;

?>



</div>	<!-- end #content --> 

<p> <?php 
 
    echo isset($_SESSION['user']) ? "Welcome <strong>". $_SESSION['user']['name'].
     "</strong>, to your Event Management System" : "You are not logged in. Please Log in or Register to manage your Calendar"; 
 
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
document.getElementById('home').setAttribute('class','active');

</script>