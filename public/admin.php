
<?php

include_once '../sys/core/init.inc.php';
//Allow Access only for Registered and Logged In users
if ( !isset($_SESSION['user']) ) {     

	header("Location: ./");    
	 exit; 
	} 

$page_title='Add/Edit Event';
$css_files =array('style.css','admin.css', 'nav.css');

include_once 'assets/common/header.inc';

$cal=new Calendar($dbo);

?>

<p><?php echo 'Welcome <strong>',$_SESSION['user']['name'],'</strong>, Manage Your Account' ; ?></p>
<div id="admin_content">
<?php	

echo $cal->displayForm();
?>

</div>

<?php 
include_once 'assets/common/footer.inc';
?>