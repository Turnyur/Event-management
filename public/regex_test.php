<!DOCTYPE html>
<head>     
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />     
	<title>Regular Expression Demo</title>     
	<style type="text/css">         
	em {             
	background-color: #FF0;             
	border-top: 1px solid #000;             
	border-bottom: 1px solid #000;         
}     
</style> 
</head> 
 
<body> 
<?php 
 
/*  
* Store the sample set of text to use for the examples of regex  
*/ 
// $string=/*<<<TEST_DATA*/ 
// "<h2>Regular Expression Testing</h2>
// <p> In this document, there is a lot of text90 2018-02-05 10:14:35 that i John 6 Doe can be matched using regex. The b56enefit of using a regular expression is much more flexible &mdash; albeit complex &mdash; syntax 33 for text pattern matching. </p> 
// <p> After you get the hang of regular 863 expressions, 2018-02-14 10:50:35 John also called regexes, they will become a powerful tool for pattern matchingz. </p> <hr/>";
// /*TEST_DATA; */

// //$check1= str_replace("regular",'<em>regular</em>', $string);
// //echo str_replace("Regular",'<em>Regular</em>', $check1);
// echo preg_replace("/regular/i",'<em>regular</em>', $string);

$date[] = '2010-01-14 12:00:00'; 
$date[] = '2010-01-214 12:00:00'; 
$date[] = '352010-01-14 12:00:00'; 
$date[] = '2010-0s-14 12:00:00'; 
$date[] = 'Saturday, May 14th at 7pm'; 
$date[] = '02/03/10 10:00pm'; 
$date[] =		'@4ll====';
$date[] = '2010-01-14 102:00:00'; 
$date[]	= 'chukunah@gmail.com';
$date[]	= 'chu.kun_ah@gmail.ng';
 
/*  * Date validation pattern  */ 
//$pattern = "/^(\d{4}(-\d{2}){2} ((\d{2}:){2})(\d{2}))$/"; //Date regex format pattern i.e YYYY-MM-DD HH:MM:SS 
$pattern="/^([a-zA-Z0-9_.+]{2,}@[a-zA-Z0-9]{2,63}.[a-zA-Z0-9]{2,10})$/"; 
//Email regex format i.e chukunah_degre.tman@gmail.com

foreach ( $date as $d ) {     
	echo "<p>", preg_replace($pattern, "<em>$1</em>", $d), "</p>"; 
} 

//echo preg_replace($pattern,"<em>$1</em>", $string);
echo  "\n<p>Pattern used: <strong>$pattern</strong></p>";


?> 
 
</body> 
 
</html> 