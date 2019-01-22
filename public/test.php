
<?php

include_once '../sys/core/init.inc.php';

$admin=new Admin($dbo);


/*
echo $admin->testSaltedHash('test'),'<br>';

sleep(1);

$hold=$admin->testSaltedHash('test');
echo $hold;

sleep(1);


echo '<br>', $admin->testSaltedHash('test',$hold);
*/


$obj = new Admin($dbo); 
 
// Load a hash of the word test and output it 
$hash1 = $obj->testSaltedHash("test"); 
echo "Hash 1 without a salt:<br />", $hash1, "<br /><br />"; 
 
// Pause execution for a second to get a different timestamp 
sleep(1); 
 
// Load a second hash of the word test 
$hash2 = $obj->testSaltedHash("test"); 
echo "Hash 2 without a salt:<br />", $hash2, "<br /><br />"; 
 
// Pause execution for a second to get a different timestamp 
sleep(1); 
 
// Rehash the word test with the existing salt 
$hash3 = $obj->testSaltedHash("test", $hash2); 
echo "Hash 3 with the salt from hash 2:<br />", $hash3;

// Generate a salted hash of "admin" 
$pass = $obj->testSaltedHash("admin"); 
echo '<br> Hash of "admin":<br />', $pass, "<br /><br />"; 


?>