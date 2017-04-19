<?php
	///WHAT BROWSER IS THE USER ON?
function get_user_browser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $ub = '';
    if(preg_match('/MSIE/i',$u_agent))
    {
        $ub = "ie";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $ub = "firefox";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $ub = "safari";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $ub = "chrome";
    }
    elseif(preg_match('/Flock/i',$u_agent))
    {
        $ub = "flock";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $ub = "opera";
    }

    return $ub;
}
/*
global $PAGE;
$bookmarksnode = $PAGE->settingsnav->add('My bookmarks', navigation_node::TYPE_CONTAINER);
$addbookmarks = $bookmarksnode->add('Bookmark this page', new moodle_url($CFG->wwwroot.'/local/mybookmarks/addbookmark.php'));
$managebookmarks = $bookmarksnode->add('Manage my bookmarks', new moodle_url($CFG->wwwroot.'/local/mybookmarks/manage.php'));
//$bookmarksnode->force_open();
*/
?>