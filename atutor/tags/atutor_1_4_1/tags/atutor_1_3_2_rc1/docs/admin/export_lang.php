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
/* The Export tool has not been implemented in ATutor 1.2.      */
/* It may be implemented in a later version. You will find 		*/
/* language packs on the ATutor Translation site, exported from */
/* the main translation database.                               */

if ($_POST['cancel']) {
	header('Location: index.php?f='.AT_FEEDBACK_EXPORT_CANCELLED);
	exit;
}

function quote_csv($line) {
	$line = str_replace('"', '""', $line);

	$line = str_replace("\n", '\n', $line);
	$line = str_replace("\r", '\r', $line);
	$line = str_replace("\x00", '\0', $line);

	return '"'.$line.'"';
}

function save_csv($name, $sql, $fields) {
	global $db;

	$content = '';
	$num_fields = count($fields);

	$result = mysql_query($sql, $db);
	while ($row = mysql_fetch_array($result)) {
		for ($i=0; $i< $num_fields; $i++) {
			if ($fields[$i][1] == NUMBER) {
				$content .= $row[$fields[$i][0]] . ',';
			} else {
				$content .= quote_csv($row[$fields[$i][0]]) . ',';
			}
		}
		$content = substr($content, 0, strlen($content)-1);
		$content .= "\n";
	}
	@mysql_free_result($result); 

	$fp = @fopen('export/'.$name.'.csv', 'w');
	if (!$fp) {
		$errors[]=array(AT_ERROR_CSV_FAILED, $name);
		print_errors($errors);
		exit;
	}
	@fputs($fp, $content); @fclose($fp);
}

if ($_POST['submit']) {
	$row2['lang'] = str_replace(' ',  '_', $row2['title']);

	define('NUMBER',	1);
	define('TEXT',		2);

	/* language.csv */
	$sql	= 'SELECT * FROM '.TABLE_PREFIX.'lang2 WHERE lang='.$_POST['export_lang'].' ORDER BY key ASC';

	$fields = array();
	$fields[0] = array('lang',TEXT);
	$fields[1] = array('variable',TEXT);
	$fields[2] = array('key',TEXT);
	$fields[3] = array('text',TEXT);
	$fields[4] = array('revision_date',NUMBER);

	save_csv('language', $sql, $fields);

	/* copy the content for archiving */
	$exec = 'cd export/';
	$result = system ( $exec );

	$path = 'export/';

	/* create the archive */
	$archive = new PclZip($path.escapeshellcmd($row2['lang']).'.zip');
	$list = $archive->add($path.'language.csv ', PCLZIP_OPT_REMOVE_PATH, $path);

	if ($list == 0) {
		debug($archive);
		die ("Unrecoverable error '".$archive->errorInfo()."'");
	}
	
	@unlink('export/language.csv');


	header('Content-Type: application/x-zip-compressed');
    header('Content-Disposition: inline; filename="'.escapeshellcmd($row2['lang']).'.zip"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');


	@readfile('export/'.escapeshellcmd ($row2['lang']).'.zip');
	@unlink('export/'.escapeshellcmd ($row2['lang']).'.zip');

	exit;
}

$_SESSION['done'] = 0;
session_write_close();

	header('Location: index.php?f='.AT_FEEDBACK_EXPORT_CANCELLED);
	exit;
?>