<?php
$capabilities = array(
    'local/mybookmarks:viewmybookmarks' => array(
        'captype'      => 'view',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes'   => array(
            'student'        => CAP_ALLOW,
            'teacher'        => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager'          => CAP_ALLOW,
			 'user' => CAP_ALLOW,
			)
			
    )
		
);