<?php

// Compatibility with PHP Report Maker
if (!isset($Language)) {
	include_once "ewcfg8.php";
	include_once "ewshared8.php";
	$Language = new cLanguage();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $Language->ProjectPhrase("BodyTitle") ?></title>
<?php if (@$gsExport == "") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo ew_YuiHost() ?>build/container/assets/skins/sam/container.css">
<link rel="stylesheet" type="text/css" href="<?php echo ew_YuiHost() ?>build/resize/assets/skins/sam/resize.css">
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo EW_PROJECT_STYLESHEET_FILENAME ?>">
<link href="css/topmenu.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<script type="text/javascript" src="<?php echo ew_YuiHost() ?>build/utilities/utilities.js"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript" src="<?php echo ew_YuiHost() ?>build/container/container-min.js"></script>
<script type="text/javascript" src="<?php echo ew_YuiHost() ?>build/resize/resize-min.js"></script>
<script type="text/javascript">
<!--
var EW_LANGUAGE_ID = "<?php echo $gsLanguage ?>";
var EW_DATE_SEPARATOR = "/"; 
if (EW_DATE_SEPARATOR == "") EW_DATE_SEPARATOR = "/"; // Default date separator
var EW_UPLOAD_ALLOWED_FILE_EXT = "gif,jpg,jpeg,bmp,png,doc,xls,pdf,zip"; // Allowed upload file extension
var EW_FIELD_SEP = ", "; // Default field separator

// Ajax settings
var EW_RECORD_DELIMITER = "\r";
var EW_FIELD_DELIMITER = "|";
var EW_LOOKUP_FILE_NAME = "ewlookup8.php"; // Lookup file name
var EW_AUTO_SUGGEST_MAX_ENTRIES = <?php echo EW_AUTO_SUGGEST_MAX_ENTRIES ?>; // Auto-Suggest max entries

// Common JavaScript messages
var EW_ADDOPT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("AddBtn"))) ?>";
var EW_EMAIL_EXPORT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("SendEmailBtn"))) ?>";
var EW_BUTTON_CANCEL_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("CancelBtn"))) ?>";
var ewTooltipDiv;
var ew_TooltipTimer = null;

//-->
</script>
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<script type="text/javascript" src="phpjs/ewp8.js"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript" src="phpjs/userfn8.js"></script>
<script type="text/javascript">
<!--
<?php echo $Language->ToJSON() ?>

//-->
</script>
<!--
<script language="javascript" src="js/jquery-1.3.1.min.js" type="text/javascript"></script>
<script language="javascript" src="js/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $.backstretch("images/desktop.gif");
</script>
-->
<?php } ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="generator" content="PHPMaker v8.0.2">
<LINK REL="SHORTCUT ICON" HREF="256.ico">
<script type="text/javascript" src="js/jquery.min.js"></script>
      
<link rel="stylesheet" href="css/expstickybar.css" />

<script src="js/expstickybar.js">

/***********************************************
* Expandable Sticky Bar- (c) Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

</script>

</head>
<body class="yui-skin-sam" >
<?php if (@$gsExport == "") { ?>
<div class="ewLayout">
	<!-- header (begin) --><!-- *** Note: Only licensed users are allowed to change the logo *** -->
  <div class="ewHeaderRow"><img src="phpimages/top_header.png" alt="" border="0"><img src="images/powered.png" width="129" height="67" hspace="40" style="float:right;">
  <div style="float:right; margin-right:50px; margin-top:10px;">
<span id="tick2"></span>
<div style ="clear:both;border-bottom: dotted 0px #CCC;margin-top:5px;"></div>
</div>

  </div>
	<!-- header (end) -->

<div class="topmenu"><?php include_once "ewmenu.php" ?></div>
<?php if (IsLoggedIn()){?><div id="stickybar" class="expstickybar">
<a href="#togglebar"><img src="open.gif" data-closeimage="images/close.gif" data-openimage="images/open.gif" style="border-width:0; float:right;" /></a>
<div style="text-align:right;padding-top:3px"> แถบเครื่องมือ </div>
<br>
<table border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <?php if (function_exists("getRecentPayList")){?><td align="center" bgcolor="#0033FF"><strong>รายการที่รับชำระล่าสุด</strong></td><?php }?>
    <td align="center" bgcolor="#0000CC">เครื่องคิดเลข</td>
    <td align="center" bgcolor="#0033FF">รายการที่รอดำเนินงาน</td>
  </tr>
  <tr>
 <?php if (function_exists("getRecentPayList")){?>   <td bgcolor="#FFFFFF">
<?php if (function_exists("getRecentPayList")){?> <div class="totalHint"><?php getRecentPayList(($_GET["row"] ? $_GET["row"] : 3 ));?></div><?php }?></td><?php }?>
    <td bgcolor="#FFFFFF"><?php include("include/calulator.php")?></td>
    <td width="350" align="center" bgcolor="#FFFF99"><div class="todo"><?php if (function_exists("createToDo")){ echo createToDo();}?></div></td>
  </tr>
  </table>
<br>
</div><?php }?>
	<!-- content (begin) -->
  <table cellspacing="0" class="ewContentTable">
		<tr>	
<!--			<td class="ewMenuColumn"> -->
			<!-- left column (begin) -->
<?php //include_once "ewmenu.php" ?>
			<!-- left column (end) -->
		<!--	</td> -->
	    <td class="ewContentColumn">
			<!-- right column (begin) -->
				<p class="phpmaker ewTitle"><b><?php echo $Language->ProjectPhrase("BodyTitle") ?></b></p>
<?php } ?>
