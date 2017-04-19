<?php
    require_once(dirname(dirname(__FILE__)).'../../config.php');
	require_once($CFG->libdir.'/adminlib.php');
	require_once('lib.php');
    global $CFG, $DB, $USER, $PAGE ;
	
   // admin_externalpage_setup('mybookmarks', '', null, '', array('pagelayout'=>'admin'));
   

	
    $bookmarknode = $PAGE->navbar->add('Bookmark name', navigation_node::NODETYPE_BRANCH);
    $PAGE->set_context(get_system_context());
    $PAGE->set_pagelayout('admin');
    $PAGE->set_title("Edit My Bookmarks");
    $PAGE->set_heading("Edit My Bookmarks");
    $PAGE->set_url($CFG->wwwroot.'/local/mybookmarks/edit.php');
    
	$isaddingbookmark = $_POST['submitalert'];
	if (isset($_POST['submitalert'])){
		if ($_POST['bookmarkname'] == ''){
			echo'<script type="text/javascript">
window.alert("You must give your bookmark a name!")
</script>';

		}else{

       $pagetobookmark = $_SESSION ['pagetobookmark'];

	
        
		$bookmarkname = $_POST['bookmarkname'];
		$con = mysql_connect($CFG->dbhost ,$CFG->dbuser,$CFG->dbpass);//CONNECT TO THE DATABASE
if (!$con)
{
die('Could not connect: ' . mysql_error());//IF CONNECTION FAILS THROW AN ERROR MESSAGE
}
mysql_select_db("moodle", $con);

           $sql="INSERT mdl_mybookmarks SET  user='".$USER->id."', url='$pagetobookmark', bookmark_name='$bookmarkname '";
		   $result=mysql_query($sql);
        // Check result
        // This shows the actual query sent to MySQL, and the error. Useful for debugging.
        if (!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $sql;
            die($message);
            }
			header('Location:'.$pagetobookmark);
	}
	}

   




    echo $OUTPUT->header();
	echo '<link rel="stylesheet" type="text/css" href="styles.css">';//PICK UP THE STYLE SHEET

	
	if ($_SERVER['HTTP_REFERER'] != $CFG->wwwroot.'/local/mybookmarks/addbookmark.php'){
	$_SESSION ['pagetobookmark'] = $_SERVER['HTTP_REFERER'];
	$pagetobookmark = $_SESSION ['pagetobookmark'];
	}

	//$addbookmark = $_GET['addbookmark'];

	
		echo '<h3>Bookmark page</h3>';
		echo '<form name="addnewbookmark" method="post" action="" id ="bookmark_form">';//START FORM TO ADD NEW BOOKMARK
		echo '<fieldset>';
		echo '<legend>Adding a bookmark</legend>';
		echo '<label for "bookmarkname"> Enter a name for your book mark: </label>';
		echo '<input name="bookmarkname" type="text" id="bookmarkname" value="">';
		echo '<input name="bookuser" type="hidden"  value="'.$USER->id.'">';
		echo '<input name="bookurl" type="hidden"  value="'.$pagetobookmark.'">';
		echo '<input name="submitalert" type="hidden"  value="yes">';
		echo '<input type="submit" value="Save"  id="submitbookmark"/>';
		echo '</fieldset>';
		echo '</form>';



   echo $OUTPUT->footer();
?>