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
/////////////////////////////
//Display the g_data bar chart for the member selected
//get the translations to the gdata numbers first

$sql5 = "select * from ".TABLE_PREFIX."g_refs";
$result = mysql_query($sql5);
$refs = array();
while ($row= mysql_fetch_array($result)) {
	$refs[$row['g_id']] = $row['reference'];
}
if($_GET[member_id]){
	$this_member=$_GET[member_id]; 
}else{
	$this_member=$_SESSION[member_id];
	if(!$_SESSION['is_admin']){
		$_GET[member_id]=$_SESSION[member_id];
	}
}

$sql2 = "select
			g, 
			count(*) AS cnt
		from
			".TABLE_PREFIX."g_click_data
		where
			member_id=$this_member
			AND
			course_id='$_SESSION[course_id]'
		group by
			g
		order by
		   	cnt DESC";
if($result7 = mysql_query($sql2)){
	while($row2 = mysql_fetch_array($result7)){
			$nav_total = ($nav_total + $row2["cnt"]);
	}
}

if(($result = mysql_query($sql2)) && $_GET['member_id']){
	echo '<h3>'._AT('nav_tendencies').' '.$this_user[$this_member].'</h3>';
	echo '<table border="0" width="90%" class="bodyline" cellspacing="1" cellpadding="0" align="center">';
	echo '<tr><th scope="col"  width="15%">'._AT('access_method').'</th><th scope="col" width="85%">'._AT('count').'</th></tr>';
	echo '<tr><td height="1" class="row2" colspan="2"></td></tr>';

	while($row = mysql_fetch_array($result)){
		echo '<tr><td class="row1"><small>';
		foreach($refs AS $key => $value){
			if($key==$row["g"]){
				echo _AT($value);
			}
		}
		echo '</small></td><td class="row1"><img src = "images/bar.gif" height="12" width="'.((($row["cnt"]/$nav_total)*100)*3).'" alt="" /> <small>'.$row["cnt"]."</small></td></tr>\n";
		echo '<tr><td height="1" class="row2" colspan="2"></td></tr>';
	}
	echo '</table>';




//}

////////////////////////////
//Show the member's click path
	echo '<a name="access"></a>';
	echo '<h3>'._AT('nav_path').' '.$this_user[$this_member].'</h3>';
	echo '<table border="0" width="90%" class="bodyline" cellspacing="1" cellpadding="0" align="center">';
	echo '<tr><th scope="col">'._AT('access_method').'</th><th scope="col">'._AT('page_viewed').'</th><th scope="col">'._AT('duration').'</th><th>'._AT('date').'</th></tr>';
	echo '<tr><td height="1" class="row2" colspan="4"></td></tr>';
	if($_SESSION['is_admin']){
		$sql	= "SELECT COUNT(*) AS cnt FROM ".TABLE_PREFIX."g_click_data WHERE course_id=$_SESSION[course_id] AND member_id='$_GET[member_id]'";

	}else{
		$sql	= "SELECT COUNT(*) AS cnt FROM ".TABLE_PREFIX."g_click_data WHERE course_id=$_SESSION[course_id] AND member_id='$_SESSION[member_id]'";

	}
	//create the paginator
	if(!$result	= mysql_query($sql, $db)){
		echo _AT('page_error');
	}else{
		$num_rows = mysql_fetch_array($result);
		$num_records = $num_rows['cnt'];
		$num_per_page = 50;
		if (!$_GET['page']) {
			$page = 1;
		} else {
			$page = intval($_GET['page']);
		}
		$start = ($page-1)*$num_per_page;
		$num_pages = ceil($num_records/$num_per_page);
		echo '<tr>';
		echo '<td class="row1" colspan="4" align="right">'._AT('page').': ';

			for ($i=1; $i<=$num_pages; $i++) {
				if ($i == $page) {
					echo ' <strong>'.$i.'</strong> ';
				} else {
					echo '<a href="'.$PHP_SELF.'?coverage=raw'.SEP.'member_id='.$_GET["member_id"].SEP.'page='.$i.'#access">'.$i.'</a>';
				}

				if ($i<$num_pages){
					echo ' <span class="spacer">|</span> ';
				}
			}

		echo '</td>';
		echo '</tr>';
		echo '<tr><td height="1" class="row2" colspan="6"></td></tr>';
	}


$sql3="select 
		content.title,
		content.content_id,
		g_click_data.to_cid,
		g_click_data.g,
		g_click_data.duration,
		g_click_data.timestamp AS t
	from
		".TABLE_PREFIX."content, 
		".TABLE_PREFIX."g_click_data
	where 
		content.content_id=g_click_data.to_cid
		AND
		g_click_data.member_id=$this_member
		AND
		g_click_data.course_id=$_SESSION[course_id]";

$sql4="select
		g_click_data.g,
		g_click_data.member_id, 
		g_click_data.to_cid, 
		g_click_data.duration,
		g_click_data.timestamp AS t
	from 
		".TABLE_PREFIX."g_click_data 
	where 
		g_click_data.to_cid=0 
		AND
		g_click_data.member_id=$this_member
		AND
		g_click_data.course_id=$_SESSION[course_id]
	order by
		t DESC
		LIMIT $start,$num_per_page";

if($result=mysql_query($sql3, $db)){
	while($row=mysql_fetch_array($result)){
		$this_data[$row["t"]]= $row;
	}
}
if($result2 = mysql_query($sql4, $db)){
	while($row=mysql_fetch_array($result2)){
		$row['title'] = $refs[$row['g']];
		$this_data[$row["t"]] = $row;
	}
}


if($this_data){

	ksort($this_data);
	$current = current($this_data);
	$pre_time = $current[t];
	foreach($this_data AS $key => $value){
		
		$diff = $value['duration']; // - $pre_time);
		$that_g = $refs[$value['g']];

		if ($that_g != ''){
			echo '<tr>';
			if($that_g == _AT('g_session_start')){
				echo '<td bgcolor="#CCCCCC"><small>';
			}else{
				echo '<td class="row1"><small>';
			}

			echo _AT($that_g);
			echo '</small></td>';
			if($that_g == _AT('g_session_start')){
				echo '<td bgcolor="#CCCCCC"><small>';
			}else{
				echo '<td class="row1"><small>';
			}
			if(substr($value['title'], 0 ,2) == "g_" ){
				echo _AT($value['title']);
			}else{
				echo $value['title'];
			}
			//echo $value['title'];
			echo '</small></td>';
			if($that_g == _AT('g_session_start')){
				echo '<td bgcolor="#CCCCCC"><small>';
			}else{
				echo '<td class="row1"><small>';
			}

			if ($diff > 60*45) {
				/* time out */
				echo _AT('na');
				$session_time='';
			} else {
				$this_time=date('i:s', $diff);
				echo ' '.$this_time;
				$session_time=($session_time+$diff);
			}
			$remainder = $diff / 60;
			echo '</small></td>';
			if($that_g == _AT('g_session_start')){
				echo '<td bgcolor="#CCCCCC"><small>';
			}else{
				echo '<td class="row1"><small>';
			}
			echo $that_date;
			echo '</small></td>';
			echo '</tr>';
			echo '<tr><td height="1" class="row2" colspan="6"></td></tr>';
		}
		$that_date=date("M-j-y g:i:s:a", $value[t]);
		$that_g=$refs[$value['g']];
		$that_title=$value['title']."&nbsp;";
		$pre_time = $value['t'];
	}
}
	echo '<tr><td colspan="4" bgcolor="#CCCCCC">';
	if($start_date>0 && $start_date!=$pre_time){
		echo _AT('g_session_start').' '.date("F j, Y,  g:i a", $start_date).' '._AT('session_end').' '.date("F j, Y,  g:i a", $pre_time).'     ('._AT('duration').':'.date('i \m\i\n s \s\e\c',($pre_time-$start_date)).')</td></tr>';
	}else{
		//echo _AT('invalid_session');
	}
	echo '</td></tr>';
	echo '</table>';
}

?>

