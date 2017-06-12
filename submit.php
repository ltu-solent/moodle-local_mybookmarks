<?php
// The number of lines in front of config file determine the // hierarchy of files.
require_once(dirname(dirname(__FILE__)).'../../config.php');
global $CFG, $DB, $USER;

$id=$_POST['id'];

$DB->delete_records('mybookmarks', array('id'=>$id));

header('Location:manage.php');

?>