<?php
/************************************************************************/
/* ATutor																*/
/************************************************************************/
/* Copyright (c) 2002-2003 by Greg Gay, Joel Kronenberg, Heidi Hazelton	*/
/* http://atutor.ca														*/
/*																		*/
/* This program is free software. You can redistribute it and/or		*/
/* modify it under the terms of the GNU General Public License			*/
/* as published by the Free Software Foundation.						*/
/************************************************************************/


if(isset($_POST['submit']) && $_POST['action']=="process") {	

	print_progress($step);
	echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post" name="form">
	<input type="hidden" name="step" value="6" />';

	require('include/config_template.php');
	//write_config_file('../include/config.inc.php');
	write_config_file('fake_config.inc.php');
	@chmod('../include/config.inc.php', 1444);

	$progress[] =  'Data has been saved successfully.';
	print_feedback($progress);		

	echo '<p align="center"><input type="submit" class="button" value=" Next � " name="submit" /></p></form>';
	return;
	
}	

print_progress($step);

if (isset($errors)) {
	print_errors($errors);
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form">
<input type="hidden" name="action" value="process" />
<input type="hidden" name="step" value="5" />
<?php
	print_hidden(4);
?>
<center><table width="65%" class="tableborder" cellspacing="0" cellpadding="1">

<tr>
	<td class="row1"><small><b>Allow for Backwards Compatibility:</b><br />
	Revise ATutor 1.0 content to be compatible with this version. Default: <code>No</code></small></td>
	<td class="row1"><input type="radio" name="allow_backwards_compatibility" value="TRUE" id="abc_y" <?php if($_POST['allow_backwards_compatibility']=='TRUE') { echo "checked"; }?>/><label for="abc_y">Yes</label>, <input type="radio" name="allow_backwards_compatibility" value="FALSE" id="abc_n" <?php if($_POST['allow_backwards_compatibility']=='FALSE' || empty($_POST['allow_backwards_compatibility'])) { echo "checked"; }?>/><label for="abc_n">No</label></td>
</tr>

</table></center>
</center>

<br /><br /><p align="center"><input type="submit" class="button" value=" Next �" name="submit" /></p>
</form>