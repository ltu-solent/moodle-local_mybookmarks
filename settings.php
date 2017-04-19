<?php

$ADMIN->add('root', new admin_category('bookmarks', 'My Bookmarks'));
$ADMIN->add('bookmarks', new admin_externalpage('addbookmark', 'Bookmark this page',
            $CFG->wwwroot.'/local/mybookmarks/addbookmark.php','local/mybookmarks:viewmybookmarks'));
$ADMIN->add('bookmarks', new admin_externalpage('managebookmarks', 'Manage my bookmarks',
            $CFG->wwwroot.'/local/mybookmarks/manage.php','local/mybookmarks:viewmybookmarks'));			
/*	
global $PAGE;
$bookmarksnode = $PAGE->settingsnav->add('My bookmarks', navigation_node::TYPE_CONTAINER);
$addbookmarks = $bookmarksnode->add('Bookmark this page', new moodle_url($CFG->wwwroot.'/local/mybookmarks/addbookmark.php'));
$managebookmarks = $bookmarksnode->add('Manage my bookmarks', new moodle_url($CFG->wwwroot.'/local/mybookmarks/manage.php'));*/