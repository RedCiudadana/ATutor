<?php
/****************************************************************/
/* ATutor														*/
/****************************************************************/
/* Copyright (c) 2002-2003 by Greg Gay & Joel Kronenberg        */
/* Adaptive Technology Resource Centre / University of Toronto  */
/* http://atutor.ca												*/
/*                                                              */
/* This program is free software. You can redistribute it and/or*/
/* modify it under the terms of the GNU General Public License  */
/* as published by the Free Software Foundation.				*/
/****************************************************************/

$section = 'users';
$page    = 'about';
$_public	= true;
$_include_path = 'include/';
require($_include_path.'/vitals.inc.php');
require($_include_path.'basic_html/header.php');

unset($_SESSION['member_id']);
unset($_SESSION['valid_user']);
unset($_SESSION['login']);
unset($_SESSION['is_admin']);
unset($_SESSION['course_id']);
unset($_SESSION['is_guest']);

?>
<h2><?php echo SITE_NAME; ?> <?php echo _AT('home'); ?></h2>
<h3><?php echo _AT('welcome_to_atutor'); ?></h3>
<p><?php echo _AT('atutor_is');  ?></p>

<h3><?php echo _AT('acquiring_atutor'); ?></h3>
<p><?php echo _AT('atutor_available'); ?></p>

<h3><?php echo _AT('more_information'); ?></h3>
<p><?php echo _AT('find_latest'); ?></p>

<?php
	require ($_include_path.'basic_html/footer.php'); 
?>