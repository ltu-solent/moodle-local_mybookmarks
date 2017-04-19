<?php
    require_once(dirname(dirname(__FILE__)).'../../config.php');
	require_once($CFG->libdir.'/adminlib.php');
	require_once('lib.php');
    global $CFG, $DB, $USER;
		$con = mysql_connect($CFG->dbhost ,$CFG->dbuser,$CFG->dbpass);//CONNECT TO THE DATABASE
if (!$con)
{
die('Could not connect: ' . mysql_error());//IF CONNECTION FAILS THROW AN ERROR MESSAGE
}
mysql_select_db("moodle", $con);

$menu = $_POST['menu'];
for ($i = 0; $i < count($menu); $i++) {
mysql_query("UPDATE `mdl_mybookmarks` SET `sort_order`=" . $i . " WHERE `id`='" . $menu[$i] . "'") or die(mysql_error());
}
?>