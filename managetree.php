<?php
    require_once(dirname(dirname(__FILE__)).'../../config.php');
	require_once($CFG->libdir.'/adminlib.php');
	require_once('lib.php');
    global $CFG, $DB, $USER, $PAGE ;
	
   // admin_externalpage_setup('mybookmarks', '', null, '', array('pagelayout'=>'admin'));
   

	
    $bookmarknode = $PAGE->navbar->add('Manage my bookmarks', navigation_node::NODETYPE_BRANCH);
    $PAGE->set_context(get_system_context());
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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	 echo '<b>Your bookmark list:</b>';

     echo '<div class="boomarklist">';
     echo '<ul id="sortme">';

	
	$con = mysql_connect($CFG->dbhost ,$CFG->dbuser,$CFG->dbpass);//CONNECT TO THE DATABASE
if (!$con)
{
die('Could not connect: ' . mysql_error());//IF CONNECTION FAILS THROW AN ERROR MESSAGE
}
mysql_select_db("moodle", $con);
////TOP LEVEL////////
     echo '<ul id="sortme">';
$result = mysql_query("SELECT * FROM `mdl_mybookmarks` WHERE user='".$USER->id."' ORDER BY `sort_order` ASC") or die(mysql_error());
while($row = mysql_fetch_array($result)) {
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
 echo' <a href="delete.php?id='.$row['id'].'"><img class="iconsmall" src="'.$CFG->wwwroot.'/theme/image.php?theme='.current_theme().'&image=t%2Fdelete" title="Delete" alt="Delete"></a> <span class="delete_text">(Delete bookmark)</span>';
echo '</form>';
echo '</td>';
echo '</tr>';
echo '</tbody>';
echo '</table>';
echo "</li>\n";

}

	echo '</ul>';
///////END TOP[ LEVEL/////////////////	

$resultfolders = mysql_query("SELECT * FROM `mdl_mybookmarks_folders` WHERE user='".$USER->id."' ORDER BY `sort_order` ASC") or die(mysql_error());
while($row = mysql_fetch_array($resultfolders)) {
	     echo '<ul id="sortme">';
		 echo '<li id="menu_' . $row['id'] . '" >';
echo '<table>';
echo '<tbody>';
echo '<tr>';
echo '<td class="tablebookname">';
echo '<form name="deletebookmark'.$row['id'].'" method="post" action="" id ="deletebookmark'.$row['id'].'">';
echo '<input type="hidden" name="bookmark" value="'.$row['bookmark_folder'].'">';
echo $row['bookmark_folder'];
echo '</td>';
echo '<td class="tabledelete">';
 echo' <a href="delete.php?id='.$row['id'].'"><img class="iconsmall" src="'.$CFG->wwwroot.'/theme/image.php?theme='.current_theme().'&image=t%2Fdelete" title="Delete" alt="Delete"></a> <span class="delete_text">(Delete folder)</span>';
echo '</form>';
echo '</td>';
echo '</tr>';
echo '</tbody>';
echo '</table>';
echo "</li>\n";
echo '</ul>';
	
	
}

	echo '</div>';
//////////////////original code//////////////////
// Getting menu items from DB
/*
$result = mysql_query("SELECT * FROM `mdl_mybookmarks` WHERE user='".$USER->id."' ORDER BY `sort_order` ASC") or die(mysql_error());
while($row = mysql_fetch_array($result)) {
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
 echo' <a href="delete.php?id='.$row['id'].'"><img class="iconsmall" src="'.$CFG->wwwroot.'/theme/image.php?theme='.current_theme().'&image=t%2Fdelete" title="Delete" alt="Delete"></a> <span class="delete_text">(Delete bookmark)</span>';
echo '</form>';
echo '</td>';
echo '</tr>';
echo '</tbody>';
echo '</table>';
echo "</li>\n";

}

	echo '</ul></div>';
	*/
/////////end original code////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
echo '<ol class="sortable">';
$result = mysql_query("SELECT * FROM `mdl_mybookmarks` WHERE user='".$USER->id."' ORDER BY `sort_order` ASC") or die(mysql_error());
while($row = mysql_fetch_array($result)) {
	

	echo'
			<li><div>'.$row['bookmark_name'].'</div></li>';
		

}
echo' </ol>	';
	
//}
	
////////////////////////////////////////////////////////////////////////////////////////	
*/

	if (preg_match("/mybookmarks\/delete.php/i", $_SERVER['HTTP_REFERER'])){

	}else{
     $previouspage = $_SERVER['HTTP_REFERER'];
     $_SESSION['bookmarks_previouspage'] = $previouspage;
	}

   echo '<div class="previouspage">';   
   echo '<input type="button" name="Return to previous page" value=" Return to previous page " onclick="window.location = \''.$_SESSION['bookmarks_previouspage'].'\' " /> ';
   echo '</div>';
   
   
  
  echo '<b>Add a folder:</b>';
  
  echo '<div class="bookmarkfolder">';
  echo '<form name="bookmarkfolder" method="post" action="addafolder.php" >';
  echo '<label for="bookmarkfolder">Folder Name</label>';
  echo '<input type="text" name="bookmarkfolder" />';
  echo '<input type="submit" value="Add a folder">';
  echo '</form>';
  echo '</div>';
  



   echo $OUTPUT->footer();

?>