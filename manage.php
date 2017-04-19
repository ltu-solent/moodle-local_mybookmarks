<?php
    require_once(dirname(dirname(__FILE__)).'../../config.php');
	require_once($CFG->libdir.'/adminlib.php');
	require_once('lib.php');
    global $CFG, $DB, $USER, $PAGE ;
	
   // admin_externalpage_setup('mybookmarks', '', null, '', array('pagelayout'=>'admin'));


	
    $bookmarknode = $PAGE->navbar->add('Manage my bookmarks', navigation_node::NODETYPE_BRANCH);
    $jsurl = new moodle_url($CFG->wwwroot.'/local/mybookmarks/scripts/jquery-1.10.2.js');
    $PAGE->requires->js($jsurl,true);	
    $jsurl = new moodle_url($CFG->wwwroot.'/local/mybookmarks/scripts/jquery-ui.1.10.4.min.js');
    $PAGE->requires->js($jsurl,true);
    $jsurl = new moodle_url($CFG->wwwroot.'/local/mybookmarks/scripts/sortme.js');
    $PAGE->requires->js($jsurl,true);	
    $PAGE->set_context(context_system::instance());
    $PAGE->set_pagelayout('admin');
    $PAGE->set_title("Edit My Bookmarks");
    $PAGE->set_heading("Edit My Bookmarks");
    $PAGE->set_url($CFG->wwwroot.'/local/mybookmarks/manage.php');

	

     
	 $browser = get_user_browser();
     if($browser == "ie"){
     echo '<meta http-equiv="x-ua-compatible" content="IE=8">';
     }

   
	
    echo $OUTPUT->header();
echo '<link rel="stylesheet" type="text/css" href="styles.css">';//PICK UP THE STYLE SHEET

    echo'<h1>Manage my bookmarks</h1>';
	echo 'Some bookmark links are automatically populated whilst others you can create yourself. If you have added your own bookmarks, this is the order in which they are listed.<br><br>';
	echo 'To reorder you own bookmarks simply drag and drop the listed items and click on the "Return to previous page" button...<br><br>';
	
	 echo '<b>Your bookmark list:</b>';

     echo '<div class="boomarklist">';
     echo '<ul id="sortme">';
	 
	 $mysqli = new MySQLi ($CFG->dbhost, $CFG->dbuser, $CFG->dbpass, $CFG->dbname);//CONNECT TO THE DATABASE
	 
	 if (mysqli_connect_errno()){//CHECK FOR ERROR
		 printf("Connect failed: %s\n", mysqli_connect_error());
		 exit();
	 }
	 
	 $query = ("SELECT * FROM `mdl_mybookmarks` WHERE user='".$USER->id."' ORDER BY `sort_order` ASC");//QUERY
	 $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	 
	 if ($result->num_rows > 0){
		 while ($row = $result->fetch_assoc()){
			 echo '<li id="menu_' . $row['id'] . '" >';
             echo '<table>';
             echo '<tbody>';
             echo '<tr>';
             echo '<td class="tablebookname">';
             echo '<form name="deletebookmark'.$row['id'].'" method="post" action="" id ="deletebookmark'.$row['id'].'">';
             echo '<input type="hidden" name="bookmark" value="'.$row['bookmark_name'].'">';
             echo $row['bookmark_name'];
             echo '</td>';
             echo '<td class="tabledelete">';
             echo' <a href="delete.php?id='.$row['id'].'"><img class="iconsmall" src="'.$CFG->wwwroot.'/theme/image.php?theme='.$PAGE->theme->name.'&image=t%2Fdelete" title="Delete" alt="Delete"></a> <span class="delete_text">(Delete bookmark)</span>';
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
	 
	 mysqli_close($mysqli);//CLOSE CONNECTION
		 
		

	echo '</ul></div>';


	if (preg_match("/mybookmarks\/delete.php/i", $_SERVER['HTTP_REFERER'])){

	}else{
     $previouspage = $_SERVER['HTTP_REFERER'];
     $_SESSION['bookmarks_previouspage'] = $previouspage;
	}

   
   echo '<input type="button" name="Return to previous page" value=" Return to previous page " onclick="window.location = \''.$_SESSION['bookmarks_previouspage'].'\' " /> ';

   echo $OUTPUT->footer();

?>