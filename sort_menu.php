<?php
require_once(dirname(dirname(__FILE__)).'../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');
global $CFG, $DB, $USER;

$menu = $_POST['menu'];
for ($i = 0; $i < count($menu); $i++) {
	$record = new stdClass();
	$record->id = $menu[$i];;
	$record->sort_order = $i;
	$DB->update_record('mybookmarks', $record);
}
?>