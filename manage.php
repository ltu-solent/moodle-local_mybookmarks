<?php
require_once(dirname(dirname(__FILE__)).'../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');
global $CFG, $DB, $USER, $PAGE ;
	
$PAGE->requires->js_call_amd('local_mybookmarks/sortme', 'init', array());	
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Manage my bookmarks");
$PAGE->set_heading("Manage my bookmarks");
$PAGE->set_url($CFG->wwwroot.'/local/mybookmarks/manage.php');

echo $OUTPUT->header();

echo "<p>To reorder your bookmarks simply drag and drop them into a new position in the list below.</p><p>To delete a bookmark click the 'x'.</p>";

echo '<b>My bookmarks:</b>';

echo '<div class="boomarklist">';
echo '<ul id="sortme">';

$result = $DB->get_records_sql("SELECT * FROM {mybookmarks} WHERE user= ? ORDER BY sort_order ASC", array($USER->id));

if (count($result) > 0){
	foreach($result as $k=>$v){
		echo '<li id="menu_' . $v->id . '" >';
		echo '<table>';
		echo '<tbody>';
		echo '<tr>';
		echo '<td class="tablebookname">';
		echo '<form name="deletebookmark'.$v->id.'" method="post" action="" id ="deletebookmark'.$v->id.'">';
		echo '<input type="hidden" name="bookmark" value="'.$v->bookmark_name.'">';
		echo $v->bookmark_name;
		echo '</td>';
		echo '<td class="tabledelete">';
		echo' <a href="delete.php?id='.$v->id.'"><img class="iconsmall" src="'.$CFG->wwwroot.'/theme/image.php?theme='.$PAGE->theme->name.'&image=t%2Fdelete" title="Delete" alt="Delete"></a> <span class="delete_text">(Delete bookmark)</span>';
		echo '</form>';
		echo '</td>';
		echo '</tr>';
		echo '</tbody>';
		echo '</table>';
		echo "</li>\n";
	}
}else{
	echo 'You currently have no bookmarks';
}

echo '</ul></div>';

if (preg_match("/mybookmarks\/delete.php/i", $_SERVER['HTTP_REFERER'])){

}else{
	$previouspage = $_SERVER['HTTP_REFERER'];
	$_SESSION['bookmarks_previouspage'] = $previouspage;
}

echo '<input type="button" name="Return to previous page" value=" Return to previous page " onclick="window.location = \''.$_SESSION['bookmarks_previouspage'].'\' " /> ';
echo $OUTPUT->footer();

?>