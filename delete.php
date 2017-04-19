<?php

// The number of lines in front of config file determine the // hierarchy of files.
require_once(dirname(dirname(__FILE__)).'../../config.php');
	require_once($CFG->libdir.'/adminlib.php');
	require_once('lib.php');
    global $CFG, $DB, $USER, $PAGE ;

$bookmarknode = $PAGE->navbar->add('Delete a Bookmark', navigation_node::NODETYPE_BRANCH);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Delete a bookmark");
$PAGE->set_heading("Delete a bookmark");
$PAGE->set_url($CFG->wwwroot.'/local/mybookmarks/delete.php');
echo '<link rel="stylesheet" type="text/css" href="styles.css">';




echo $OUTPUT->header();
$id=$_GET['id'];

$mysqli = new MySQLi ($CFG->dbhost, $CFG->dbuser, $CFG->dbpass, $CFG->dbname); //CONNECT TO DATABASE

if (mysqli_connect_errno()) {// CHECK FOR ERRORS
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}

$query = "SELECT * FROM mdl_mybookmarks WHERE id = '$id'"; //QUERY
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

if ($result->num_rows > 0){
while($row = $result->fetch_assoc()) {	
echo '
<h2 class="main">Delete Bookmark</h2>
<p class="delete_alert">Are you sure you want to delete this entry? This can not be undone.</p>
<div class="delete_box">
<form name="form1" method="post" action="submit.php">
<table class ="thetable"><tr>
<th><strong>Bookmark</strong></th>
<th><strong>Bookmark link</strong></th>
</tr>
  <tr>
    <td><input name="custom_name" type="text" id="custom_name" value="'.$row['bookmark_name'].'"></td>
	 <td><a href ="'.$row['url'].'" target="_blank" title="'.$row['bookmark_name'].'">'.$row['url'].'</a></td>
  </tr>
</table>
<input name="id" type="hidden" id="id" value="'.$row['id'].'">
<div class="delete_buttons"><input type="submit" name="Submit" value="Confirm">
<a href="manage.php"><input type="button" name="cancel" value="Cancel" /></a>
</div>
</form>
</div>';
}
}else{
	echo '<h2 class="main">Delete Bookmark</h2>
<p class="delete_alert">No bookmark details returned</p>
<div class="delete_box">
<div class="delete_buttons"><input type="submit" name="Submit" value="Confirm">
<a href="manage.php"><input type="button" name="cancel" value="Cancel" /></a>
</div>
</div>';
}



echo $OUTPUT->footer();
?>