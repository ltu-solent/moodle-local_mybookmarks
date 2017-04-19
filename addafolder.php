<?php
    require_once(dirname(dirname(__FILE__)).'../../config.php');
	require_once($CFG->libdir.'/adminlib.php');
	require_once('lib.php');
    global $CFG, $DB, $USER;
	
	$folder = $_POST['bookmarkfolder'];
	
	
		$con = mysql_connect($CFG->dbhost ,$CFG->dbuser,$CFG->dbpass);//CONNECT TO THE DATABASE
if (!$con)
{
die('Could not connect: ' . mysql_error());//IF CONNECTION FAILS THROW AN ERROR MESSAGE
}
mysql_select_db("moodle", $con);

           $sql="INSERT mdl_mybookmarks_folders SET  user='".$USER->id."', bookmark_folder='$folder'";
		   $result=mysql_query($sql);
        // Check result
        // This shows the actual query sent to MySQL, and the error. Useful for debugging.
        if (!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $sql;
            die($message);
            }
	

header('Location:managetree.php');
?>