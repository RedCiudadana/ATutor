<?php

define('AT_INCLUDE_PATH', '../../include/');
	$_section = 'Home';

	require(AT_INCLUDE_PATH.'vitals.inc.php');
	require(AT_INCLUDE_PATH.'header.inc.php');

?>


<pre>
<?php
print_r($_POST);

?>
</pre>
<P align=center><FONT color=#aa0000><STRONG>Welcome To Typetool-Quickbuild-Script</STRONG> </FONT></P>
<P align=left><FONT color=#aa0000><STRONG><U>History:</U></STRONG></P>
<OL>
<LI>Jscript for Text-Formating with RightMouseButton (R1.0 2002/04/23)
<LI>WYSIWYG-Text-Formating for any Textarea (R2.0 2002/05/23) 
<LI>with Security Check (R3.0 2002/06/12) 
<LI>with Div-Tools for Online-Designing (R4.0 2002/07/08)
<LI>Editor-Options, Open/Save-Local Files, Content Recover, Chipcard-Data Insert, Find (R5.0 2002/09/26)
<LI>Simpler And Flexibler Integration (R5.5 2002/10/20)
<LI>Highlight-Hotkeys, Return/Shift+Return, Security Uploads (R6.0 2002/11/02)
<LI>Link with target, The Simplest Integration (R6.5 2002/12/12)
<LI>Working also With Mozilla 1.3 (R7.0 2003/03/16)
<LI>Table and Layer Tools for Mozilla 1.3 Version (R7.5 2003/05/25)
<LI>Stylesheet CSS , Languages, InsertImage from Uploaddir and Editor-destroy-function (R8.0 2004/01/07)
</OL>


<P><STRONG><U><FONT color=red>Actual Version:</FONT></U></STRONG></P></FONT>
<CENTER>
<H3><FONT color=#ff0000>* NEW * Release 9.0 - Mozilla 1.3+, Netscape 7.1 (2004/03/15)* NEW *</FONT></H3>
<H4><FONT color=#ff0000>Editable Font-List and Textstyle-Set (in language.js)</FONT></H4>
<FORM action=<?php echo $_SERVER['PHP_SELF']; ?> method=post>
<TABLE cellSpacing=0 cellPadding=2 width="80%">
<TBODY>
<TR>
<TD align=right>Textarea 1: </TD>
<TD><TEXTAREA name=body_text rows=10 cols=50><?php echo $_POST['body_text']; ?>.
</TEXTAREA><input type="submit" name="submit"></TD></TR>
<TR>
<TD align=right>Textarea 2: </TD>
<TD><TEXTAREA name=textarea2 rows=10 cols=50>Please click and then "CANCEL" and then "right mousebutton".</TEXTAREA>

</TD></TR>
<TR>
<TD align=middle colSpan=2><INPUT onclick=alert(this.form.textarea1.value) type=button value="Value TA1"> <INPUT onclick=alert(this.form.textarea2.value) type=button value="Value TA2"> </TD></TR></TBODY></TABLE></CENTER></FORM>
<H3>Very easy integration:</H3>
<P>You need to add below lines at bottom of your HTML-Pages (e.g. direct before &lt;/BODY&gt; or between &lt;/BODY&gt; and &lt;/HTML&gt; or after &lt;/HTML&gt;) .<BR>That's all.<BR>Then you can input HTML-Codes (or something else) fast and correctly into any text-input element (input text, textarea).<BR>By Textarea can user format their Text visually with right mousebutton.<BR><BR>
<TABLE align=center border=1>
<TBODY>
<TR>
<TD><STRONG><FONT color=#ff0000>&lt;script src='http://......./jscript/quickbuild.js'&gt;&lt;/script&gt;<BR><BR></FONT><FONT color=#ff00ff>UPLOAD-feature needs also editing the file "upload.html" and server scripts: "upload.pl, show.pl", "upload.php, show.php", "upload.asp, show.asp" and "index.html" in your upload directory (see there).<br>You can now (R8.0) change layout of the editor by editing the file "vdev.css".
<br>And using your language by translating the file "language.js"
</FONT></STRONG></TD></TR></TBODY></TABLE><BR><BR>
<TABLE align=center border=1>
<TBODY>
<TR>
<TD>
<P><STRONG><FONT color=#ff0000>If you don't like default configuation, you can modify it with 3 methods.</FONT></STRONG></P>
<OL>
<LI><STRONG>Once for whole site: Change global Variables, which you need, &nbsp;<FONT color=red>in</FONT> file QUICKBUILD.JS.</STRONG></LI>
<LI><STRONG>Flexible for a specific page: Set global variales, which you need,&nbsp;<FONT color=red>before those line</FONT>.<BR>e.g: &lt;script&gt;VISUAL=0; SECURE=0; USEFORM=1;&lt;/script&gt;</STRONG></LI>
<LI><STRONG>Combine between both showed methods.</STRONG></LI></OL>
<P><BR><BR><BR>
<TABLE border=1>
<TBODY>
<TR>
<TD colSpan=3>
<P align=center><STRONG>LIST OF GLOBAL VARIABLES</STRONG></P></TD></TR>
<TR>
<TD>
<P align=center>Default</P></TD>
<TD>
<P align=center>Posible Values</P></TD>
<TD>
<P align=center>Description</P></TD></TR>
<TR>
<TD>SECURE=1;</TD>
<TD>0,1;&nbsp; </TD>
<TD>all tags &lt;script&gt;, &lt;meta&gt;, on-events.... turn to normal text.</TD></TR>
<TR>
<TD>VISUAL=1;&nbsp;</TD>
<TD>0,1,2,3,4,..</TD>
<TD>see under</TD></TR>
<TR>
<TD>POPWIN=1;&nbsp;</TD>
<TD>1,0</TD>
<TD>Enable Right-click Popup dialog</TD></TR>
<TR>
<TD>DFFACE='';</TD>
<TD>'times new roman';</TD>
<TD>Default fontFamily of Editor</TD></TR>
<TR>
<TD>DFSIZE='';&nbsp;&nbsp;&nbsp;</TD>
<TD>'14px';</TD>
<TD>Default fontSize </TD></TR>
<TR>
<TD>DCOLOR='';&nbsp;</TD>
<TD>'blue';</TD>
<TD>Default color</TD></TR>
<TR>
<TD>DBGCOL='';&nbsp;</TD>
<TD>'green';</TD>
<TD>Default backgroundColor</TD></TR>
<TR>
<TD>DBGIMG='';&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>Default URL-backgroundImage&nbsp;</TD></TR>
<TR>
<TD>DCSS='';&nbsp;&nbsp;&nbsp;</TD>
<TD>'test.css';</TD>
<TD>Default External Stylesheet-URL- content's layout</TD></TR>
<TR>
<TD>SYMBOLE='&lt;QBFBR&gt;' ;&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>Symbole for end-of-field in clipboard-chipcard.</TD></TR>
<TR>
<TD>USETABLE=1;&nbsp;</TD>
<TD>0,1</TD>
<TD>Support table editor</TD></TR>
<TR>
<TD>USEFORM=0;</TD>
<TD>0,1</TD>
<TD>Support inputing forms and their elements</TD></TR>
<TR>
<TD>RETURNNL=1;</TD>
<TD>0,1</TD>
<TD>1=Newline by pressing RETURN-Button and New paragraph by SHIFT+RETURN</TD></TR>
<TR>
<TD>FULLCTRL=0;</TD>
<TD>0,1</TD>
<TD>0=fast loading; 1=display all control buttons</TD></TR>


<TR>
<TD>VDEVCSS='vdev.css';</TD>
<TD>filename</TD>
<TD>editor's layout</TD></TR>

<TR>
<TD>LANGUAGE='language.js';</TD>
<TD>filename</TD>
<TD>editor's language, predefined font and textstyle</TD></TR>



</TBODY></TABLE><BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR><FONT color=#ff0000>VISUAL=0</FONT> : Textarea turn to Editor after confirmation<BR><FONT color=orangered>VISUAL=1</FONT> : all Textareas turn to Editors<BR><FONT color=#ff0000>VISUAL=2</FONT> : spezific textareas turn to Editors<BR><FONT color=#ff0000>VISUAL=3</FONT> : all Iframes turn to Editors<BR><FONT color=#ff0000>VISUAL=4</FONT> : spezific Iframes turn to Editors<BR><FONT color=#ff0000>VISUAL=other</FONT> : no Visual-Editor</TD></TR></TBODY></TABLE><BR>
<TABLE align=center border=1>
<TBODY>
<TR>
<TD>
<P>If you want to turn on <B>only one</B> specific textarea, then :<BR><BR><STRONG>&lt;scrip>VISUAL=<FONT color=magenta>-1</FONT>;&lt;/script&gt;<BR>&lt;script src='http://......./jscript/quickbuild.js'&gt;&lt;/script&gt;</STRONG><BR><STRONG><FONT color=magenta>&lt;script&gt;changetoIframeEditor(<FONT color=red>document.forms[xxx].yyy</FONT>);&lt;/script&gt;</FONT></STRONG></P>
<P>with:<BR><FONT color=red>xxx</FONT>= form index&nbsp; (=0....n)<BR><FONT color=red>yyy</FONT>= textarea name</P></TD></TR></TBODY></TABLE>

<P><BR><BR>Release by <A href="http://vietdev.sourceforge.net/">VIETDEV</A>, welcome 
<BR><B>GPL-Copyright</B>


<?php
	require (AT_INCLUDE_PATH.'footer.inc.php');
?>
