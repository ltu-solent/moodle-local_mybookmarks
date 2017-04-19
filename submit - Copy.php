<?php


// The number of lines in front of config file determine the // hierarchy of files.
require_once(dirname(dirname(__FILE__)).'../../config.php');
global $CFG, $DB, $USER;


$id=$_POST['id'];
echo $id;


// Connect to server and select database.
mysql_connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass)or die("cannot connect");
mysql_select_db($CFG->dbname)or die("cannot select DB");

// update data in mysql database
if (isset($_POST['id'])){
$deletequery='DELETE FROM mdl_mybookmarks WHERE id = '.$id.' ';
}
$result=mysql_query($deletequery);
// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $deletequery;
    die($message);
}

header('Location:manage.php');

?>