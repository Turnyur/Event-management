<?php 
 
/*  * Enable sessions  */ 
session_start(); 
 
/*  * Include necessary files  */ 
include_once '../../../sys/config/db_cred.inc.php'; 
 //echo  $_POST['action'];
/*  * Define constants for config info  */ 
foreach ( $C as $name => $val ) { 
    define($name, $val); 
} 
 
  $dsn='mysql:host='.DB_HOST.';dbname='.DB_NAME;
$dbo=new PDO($dsn,DB_USER,DB_PASS);


$actions = array(         
'event_view' => array(                 
		'object' => 'Calendar',                 
		'method' => 'displayEvent'   ),
/*'create_from_interface' => array(                 
		'object' => 'Calendar',                 
		'method' => 'modifiedCreate' ),*/
'edit_event' => array(                 
	'object' => 'Calendar',                 
	'method' => 'displayForm'        ),
'event_edit' => array(                 
	'object' => 'Calendar',                 
	'method' => 'processForm'        )/*,
'change_time'=>array(  
	'object' =>	 'Calendar',
	'method' =>	'buildCalendar'		)*/,
'delete_event' => array(                 
	'object' => 'Calendar',                 
	'method' => 'confirmDelete'       ) ,
 'confirm_delete' => array(
 	 'object' => 'Calendar',                 
 	 'method' => 'confirmDelete'      )   
); 
 
/*  * Make sure the anti-CSRF token was passed and that the  
* requested action exists in the lookup array  */ 
if ( isset($actions[$_POST['action']]) ) {     
	$use_array = $actions[$_POST['action']];     
	$obj = new $use_array['object']($dbo); 
 
    /*      * Check for an ID and sanitize it if found      */     
    if ( isset($_POST['event_id']) ){         
    	$id = (int) $_POST['event_id'];     
    }else { $id = NULL; } 
 
    echo $obj->$use_array['method']($id); 
} 
 

if(isset($_POST['action']) && $_POST['action']=='change_time'){
	$st=mktime(date("H"),date("i"),date("s"),$_POST['month'],$_POST['day'],$_POST['year']);
    $new_day=date('Y-m-d H:s:i', $st);

    $cal=new Calendar($dbo,$new_day);
    echo $cal->buildCalendar();
}

if(isset($_POST['action']) && $_POST['action']=='create_from_interface'){

$month_of_year=array(
        "January"=>'01',
        "February"=>'02',
        "March"=>'03',
        "April"=>'04',
        "May"=>'05',
        "June"=>'06',
        "July"=>'07',
        "August"=>'08',
        "September"=>'09',
        "October"=>'10',
        "November"=>'11',
        "December"=>'12'

);
	$st=mktime(date("H"),date("i"),date("s"),$month_of_year[$_POST['month']],$_POST['day'],$_POST['year']);
	//echo $month_of_year[$_POST['month']];
    $new_day=date('Y-m-d H:s:i', $st);

    $cal=new Calendar($dbo,$new_day);
    echo $cal->modifiedCreate();
}	



function __autoload($class_name) {     
	$filename = '../../../sys/class/class.'. strtolower($class_name) . '.inc.php';     
	if ( file_exists($filename) ){         
		include_once $filename;     
	} 
} 




 ?>