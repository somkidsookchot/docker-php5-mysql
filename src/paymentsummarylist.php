<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "paymentsummaryinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "villageinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$paymentsummary_list = new cpaymentsummary_list();
$Page =& $paymentsummary_list;

// Page init
$paymentsummary_list->Page_Init();

// Page main
$paymentsummary_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($paymentsummary->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var paymentsummary_list = new ew_Page("paymentsummary_list");

// page properties
paymentsummary_list.PageID = "list"; // page ID
paymentsummary_list.FormID = "fpaymentsummarylist"; // form ID
var EW_PAGE_ID = paymentsummary_list.PageID; // for backward compatibility

// extend page with validate function for search
paymentsummary_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
paymentsummary_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
paymentsummary_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
paymentsummary_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
paymentsummary_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
paymentsummary_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
paymentsummary_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($paymentsummary->Export == "") || (EW_EXPORT_MASTER_RECORD && $paymentsummary->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "villagelist.php";
if ($paymentsummary_list->DbMasterFilter <> "" && $paymentsummary->getCurrentMasterTable() == "village") {
	if ($paymentsummary_list->MasterRecordExists) {
		if ($paymentsummary->getCurrentMasterTable() == $paymentsummary->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<div class="phpmaker ewTitle"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("MasterRecord") ?><?php echo $village->TableCaption() ?> 
<?php switch($_GET["x_pay_sum_type"]){
	
	case 1 : echo 'เงินสงเคราะห์ศพ';
		break;
	case 2 : echo 'เงินสงเคราะห์ล่วงหน้า';
		break;
	case 3 : echo 'ค่าบำรุงประจำปี';
		break;
	case 4 : echo 'ค่าสมัครสมาชิก';
		break;
	case 5 : echo 'ค่าอื่นๆ';
		break;
} ?>
</div><div class="clear"></div>
<?php if ($paymentsummary->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "villagemaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$paymentsummary_list->TotalRecs = $paymentsummary->SelectRecordCount();
	} else {
		if ($paymentsummary_list->Recordset = $paymentsummary_list->LoadRecordset())
			$paymentsummary_list->TotalRecs = $paymentsummary_list->Recordset->RecordCount();
	}
	$paymentsummary_list->StartRec = 1;
	if ($paymentsummary_list->DisplayRecs <= 0 || ($paymentsummary->Export <> "" && $paymentsummary->ExportAll)) // Display all records
		$paymentsummary_list->DisplayRecs = $paymentsummary_list->TotalRecs;
	if (!($paymentsummary->Export <> "" && $paymentsummary->ExportAll))
		$paymentsummary_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$paymentsummary_list->Recordset = $paymentsummary_list->LoadRecordset($paymentsummary_list->StartRec-1, $paymentsummary_list->DisplayRecs);
?>
<div class="phpmaker ewTitle" style="white-space: nowrap;"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $paymentsummary->TableCaption() ?>
  <?php if ($paymentsummary->getCurrentMasterTable() == "") { ?>
  <?php } ?>
  <?php switch($_GET["x_pay_sum_type"]){
	
	case 1 : echo 'เงินสงเคราะห์ศพ';
		break;
	case 2 : echo 'เงินสงเคราะห์ล่วงหน้า';
		break;
	case 3 : echo 'ค่าบำรุงประจำปี';
		break;
	case 4 : echo 'ค่าสมัครสมาชิก';
		break;
	case 5 : echo 'ค่าอื่นๆ';
		break;
} ?>
</div>
<div class="clear"></div>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($paymentsummary->Export == "" && $paymentsummary->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(paymentsummary_list);" style="text-decoration: none;"><img id="paymentsummary_list_SearchImage" src="phpimages/collapse.png" alt=""  border="0" /></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="paymentsummary_list_SearchPanel" class="listSearch">
<form name="fpaymentsummarylistsrch" id="fpaymentsummarylistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return paymentsummary_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="paymentsummary">
<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$paymentsummary_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$paymentsummary->RowType = EW_ROWTYPE_SEARCH;

// Render row
$paymentsummary->ResetAttrs();
$paymentsummary_list->RenderRow();
?>
<span id="xsc_t_code" class="ewCssTableCell">
	  <span class="ewSearchCaption"><?php echo $paymentsummary->t_code->FldCaption() ?></span>
	  <span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_t_code" id="z_t_code" value="LIKE"></span>
	  <span class="ewSearchField">
<?php if ($paymentsummary->t_code->getSessionValue() <> "") { ?>
<div<?php echo $paymentsummary->t_code->ViewAttributes() ?>><?php echo $paymentsummary->t_code->ListViewValue() ?></div>
<input type="hidden" id="x_t_code" name="x_t_code" value="<?php echo ew_HtmlEncode($paymentsummary->t_code->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<?php $paymentsummary->t_code->EditAttrs["onchange"] = "ew_UpdateOpt('x_village_id','x_t_code',true); " . @$paymentsummary->t_code->EditAttrs["onchange"]; ?>
<select id="x_t_code" name="x_t_code"<?php echo $paymentsummary->t_code->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->t_code->EditValue)) {
	$arwrk = $paymentsummary->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->t_code->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$paymentsummary->t_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php
$sSqlWrk = "SELECT `t_code`, `t_code` AS `DispFld`, `t_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tambon`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `t_code`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_t_code" id="s_x_t_code" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_t_code" id="lft_x_t_code" value="">
<?php } ?>
</span>
	</span>
<span id="xsc_village_id" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $paymentsummary->village_id->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_village_id" id="z_village_id" value="="></span>
		<span class="ewSearchField">
<?php if ($paymentsummary->village_id->getSessionValue() <> "") { ?>
<?php echo $paymentsummary->village_id->ListViewValue() ?>
<input type="hidden" id="x_village_id" name="x_village_id" value="<?php echo ew_HtmlEncode($paymentsummary->village_id->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<select id="x_village_id" name="x_village_id"<?php echo $paymentsummary->village_id->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->village_id->EditValue)) {
	$arwrk = $paymentsummary->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->village_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$paymentsummary->village_id) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php
$sSqlWrk = "SELECT `village_id`, `v_code` AS `DispFld`, `v_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `village`";
$sWhereWrk = "`t_code` IN ({filter_value})";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `v_code`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_village_id" id="s_x_village_id" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_village_id" id="lft_x_village_id" value="3">
<?php } ?>
</span>
	</span>
<div class="clear"></div>
<span id="xsc_pay_sum_type" class="ewCssTableCell">
	  <span class="ewSearchCaption"><?php echo $paymentsummary->pay_sum_type->FldCaption() ?></span>
	  <span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_pay_sum_type" id="z_pay_sum_type" value="="></span>
	  <span class="ewSearchField">
<select id="x_pay_sum_type" name="x_pay_sum_type"<?php echo $paymentsummary->pay_sum_type->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_sum_type->EditValue)) {
	$arwrk = $paymentsummary->pay_sum_type->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_sum_type->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php
$sSqlWrk = "SELECT `pt_id`, `pt_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `paymenttype`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `pt_order`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_pay_sum_type" id="s_x_pay_sum_type" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_pay_sum_type" id="lft_x_pay_sum_type" value="">
</span>
	</span>
<span id="xsc_pay_death_begin" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $paymentsummary->pay_death_begin->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_pay_death_begin" id="z_pay_death_begin" value="="></span>
		<span class="ewSearchField">
<select id="x_pay_death_begin" name="x_pay_death_begin"<?php echo $paymentsummary->pay_death_begin->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_death_begin->EditValue)) {
	$arwrk = $paymentsummary->pay_death_begin->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_death_begin->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$paymentsummary->pay_death_begin) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
<?php if ($arwrk[$rowcntwrk][3] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,2,$paymentsummary->pay_death_begin) ?><?php echo $arwrk[$rowcntwrk][3] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php
$sSqlWrk = "SELECT `dead_id`, `dead_id` AS `DispFld`, `fname` AS `Disp2Fld`, `lname` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `members`";
$sWhereWrk = "";
$lookuptblfilter = "`member_status` = 'เสียชีวิต' ";
if (strval($lookuptblfilter) <> "") {
	if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
	$sWhereWrk .= "(" . $lookuptblfilter . ")";
}
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `dead_id` Desc";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_pay_death_begin" id="s_x_pay_death_begin" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_pay_death_begin" id="lft_x_pay_death_begin" value="">
</span>
	</span>

<div id="xsr_5" class="ewCssTableRow">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $paymentsummary_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
	<?php if ($paymentsummary_list->SearchWhere <> "" && $paymentsummary_list->TotalRecs > 0) { ?>
	<a href="javascript:void(0);" onclick="ew_ToggleHighlight(paymentsummary_list, this, '<?php echo $paymentsummary->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
	<?php } ?>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $paymentsummary_list->ShowPageHeader(); ?>
<?php
$paymentsummary_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($paymentsummary->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($paymentsummary->CurrentAction <> "gridadd" && $paymentsummary->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($paymentsummary_list->Pager)) $paymentsummary_list->Pager = new cPrevNextPager($paymentsummary_list->StartRec, $paymentsummary_list->DisplayRecs, $paymentsummary_list->TotalRecs) ?>
<?php if ($paymentsummary_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($paymentsummary_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $paymentsummary_list->PageUrl() ?>start=<?php echo $paymentsummary_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($paymentsummary_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $paymentsummary_list->PageUrl() ?>start=<?php echo $paymentsummary_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $paymentsummary_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($paymentsummary_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $paymentsummary_list->PageUrl() ?>start=<?php echo $paymentsummary_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($paymentsummary_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $paymentsummary_list->PageUrl() ?>start=<?php echo $paymentsummary_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $paymentsummary_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $paymentsummary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $paymentsummary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $paymentsummary_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($paymentsummary_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($paymentsummary_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="paymentsummary">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($paymentsummary_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($paymentsummary_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($paymentsummary_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($paymentsummary_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($paymentsummary_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($paymentsummary_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($paymentsummary_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($paymentsummary_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($paymentsummary_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($paymentsummary->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($paymentsummary_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fpaymentsummarylist, '<?php echo $paymentsummary_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a><a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fpaymentsummarylist, 'sliptview.php?xprint=0');return false;"> <img src="images/ico_create_slipt.png" width="109" height="37" border="0" align="absmiddle" /></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fpaymentsummarylist" id="fpaymentsummarylist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="paymentsummary">
<div id="gmp_paymentsummary" class="ewGridMiddlePanel">
<?php if ($paymentsummary_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $paymentsummary->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$paymentsummary_list->RenderListOptions();

// Render list options (header, left)
$paymentsummary_list->ListOptions->Render("header", "left");
?>
<?php if ($paymentsummary->t_code->Visible) { // t_code ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->t_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentsummary->t_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentsummary->SortUrl($paymentsummary->t_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentsummary->t_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->t_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->t_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->village_id->Visible) { // village_id ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->village_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentsummary->village_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentsummary->SortUrl($paymentsummary->village_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentsummary->village_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->village_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->village_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->member_code->Visible) { // member_code ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->member_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentsummary->member_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentsummary->SortUrl($paymentsummary->member_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentsummary->member_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->member_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->member_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_date->Visible) { // pay_sum_date ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_date) == "") { ?>
		<td><?php echo $paymentsummary->pay_sum_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentsummary->SortUrl($paymentsummary->pay_sum_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_sum_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_type->Visible) { // pay_sum_type ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_type) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentsummary->pay_sum_type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentsummary->SortUrl($paymentsummary->pay_sum_type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentsummary->pay_sum_type->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_type->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_type->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_death_begin->Visible) { // pay_death_begin ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_death_begin) == "") { ?>
		<td><?php echo $paymentsummary->pay_death_begin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentsummary->SortUrl($paymentsummary->pay_death_begin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_death_begin->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_death_begin->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_death_begin->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_adv_num->Visible) { // pay_sum_adv_num ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_adv_num) == "") { ?>
		<td><?php echo $paymentsummary->pay_sum_adv_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentsummary->SortUrl($paymentsummary->pay_sum_adv_num) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_sum_adv_num->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_adv_num->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_adv_num->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_annual_year->Visible) { // pay_annual_year ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_annual_year) == "") { ?>
		<td><?php echo $paymentsummary->pay_annual_year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentsummary->SortUrl($paymentsummary->pay_annual_year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_annual_year->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_annual_year->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_annual_year->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_detail->Visible) { // pay_sum_detail ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_detail) == "") { ?>
		<td><?php echo $paymentsummary->pay_sum_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentsummary->SortUrl($paymentsummary->pay_sum_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_sum_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_total->Visible) { // pay_sum_total ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentsummary->pay_sum_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentsummary->SortUrl($paymentsummary->pay_sum_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentsummary->pay_sum_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_note->Visible) { // pay_sum_note ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_note) == "") { ?>
		<td><?php echo $paymentsummary->pay_sum_note->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentsummary->SortUrl($paymentsummary->pay_sum_note) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_sum_note->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_note->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_note->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$paymentsummary_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($paymentsummary->ExportAll && $paymentsummary->Export <> "") {
	$paymentsummary_list->StopRec = $paymentsummary_list->TotalRecs;
} else {

	// Set the last record to display
	if ($paymentsummary_list->TotalRecs > $paymentsummary_list->StartRec + $paymentsummary_list->DisplayRecs - 1)
		$paymentsummary_list->StopRec = $paymentsummary_list->StartRec + $paymentsummary_list->DisplayRecs - 1;
	else
		$paymentsummary_list->StopRec = $paymentsummary_list->TotalRecs;
}
$paymentsummary_list->RecCnt = $paymentsummary_list->StartRec - 1;
if ($paymentsummary_list->Recordset && !$paymentsummary_list->Recordset->EOF) {
	$paymentsummary_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $paymentsummary_list->StartRec > 1)
		$paymentsummary_list->Recordset->Move($paymentsummary_list->StartRec - 1);
} elseif (!$paymentsummary->AllowAddDeleteRow && $paymentsummary_list->StopRec == 0) {
	$paymentsummary_list->StopRec = $paymentsummary->GridAddRowCount;
}

// Initialize aggregate
$paymentsummary->RowType = EW_ROWTYPE_AGGREGATEINIT;
$paymentsummary->ResetAttrs();
$paymentsummary_list->RenderRow();
$paymentsummary_list->RowCnt = 0;
while ($paymentsummary_list->RecCnt < $paymentsummary_list->StopRec) {
	$paymentsummary_list->RecCnt++;
	if (intval($paymentsummary_list->RecCnt) >= intval($paymentsummary_list->StartRec)) {
		$paymentsummary_list->RowCnt++;

		// Set up key count
		$paymentsummary_list->KeyCount = $paymentsummary_list->RowIndex;

		// Init row class and style
		$paymentsummary->ResetAttrs();
		$paymentsummary->CssClass = "";
		if ($paymentsummary->CurrentAction == "gridadd") {
		} else {
			$paymentsummary_list->LoadRowValues($paymentsummary_list->Recordset); // Load row values
		}
		$paymentsummary->RowType = EW_ROWTYPE_VIEW; // Render view
		$paymentsummary->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$paymentsummary_list->RenderRow();

		// Render list options
		$paymentsummary_list->RenderListOptions();
?>
	<tr<?php echo $paymentsummary->RowAttributes() ?>>
<?php

// Render list options (body, left)
$paymentsummary_list->ListOptions->Render("body", "left");
?>
	<?php if ($paymentsummary->t_code->Visible) { // t_code ?>
		<td<?php echo $paymentsummary->t_code->CellAttributes() ?>>
<div<?php echo $paymentsummary->t_code->ViewAttributes() ?>><?php echo $paymentsummary->t_code->ListViewValue() ?></div>
<a name="<?php echo $paymentsummary_list->PageObjName . "_row_" . $paymentsummary_list->RowCnt ?>" id="<?php echo $paymentsummary_list->PageObjName . "_row_" . $paymentsummary_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($paymentsummary->village_id->Visible) { // village_id ?>
		<td<?php echo $paymentsummary->village_id->CellAttributes() ?>>
<div<?php echo $paymentsummary->village_id->ViewAttributes() ?>><?php echo $paymentsummary->village_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentsummary->member_code->Visible) { // member_code ?>
		<td<?php echo $paymentsummary->member_code->CellAttributes() ?>>
<div<?php echo $paymentsummary->member_code->ViewAttributes() ?>><?php echo $paymentsummary->member_code->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_date->Visible) { // pay_sum_date ?>
		<td<?php echo $paymentsummary->pay_sum_date->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_date->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_type->Visible) { // pay_sum_type ?>
		<td<?php echo $paymentsummary->pay_sum_type->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_type->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_death_begin->Visible) { // pay_death_begin ?>
		<td<?php echo $paymentsummary->pay_death_begin->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_death_begin->ViewAttributes() ?>><?php echo $paymentsummary->pay_death_begin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_adv_num->Visible) { // pay_sum_adv_num ?>
		<td<?php echo $paymentsummary->pay_sum_adv_num->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_adv_num->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_adv_num->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_annual_year->Visible) { // pay_annual_year ?>
		<td<?php echo $paymentsummary->pay_annual_year->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_annual_year->ViewAttributes() ?>><?php echo $paymentsummary->pay_annual_year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_detail->Visible) { // pay_sum_detail ?>
		<td<?php echo $paymentsummary->pay_sum_detail->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_detail->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_total->Visible) { // pay_sum_total ?>
		<td<?php echo $paymentsummary->pay_sum_total->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_total->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_note->Visible) { // pay_sum_note ?>
		<td<?php echo $paymentsummary->pay_sum_note->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_note->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_note->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paymentsummary_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($paymentsummary->CurrentAction <> "gridadd")
		$paymentsummary_list->Recordset->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$paymentsummary->RowType = EW_ROWTYPE_AGGREGATE;
$paymentsummary->ResetAttrs();
$paymentsummary_list->RenderRow();
?>
<?php if ($paymentsummary_list->TotalRecs > 0 && ($paymentsummary->CurrentAction <> "gridadd" && $paymentsummary->CurrentAction <> "gridedit")) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$paymentsummary_list->RenderListOptions();

// Render list options (footer, left)
$paymentsummary_list->ListOptions->Render("footer", "left");
?>
	<?php if ($paymentsummary->t_code->Visible) { // t_code ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($paymentsummary->village_id->Visible) { // village_id ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($paymentsummary->member_code->Visible) { // member_code ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_date->Visible) { // pay_sum_date ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_type->Visible) { // pay_sum_type ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_death_begin->Visible) { // pay_death_begin ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_adv_num->Visible) { // pay_sum_adv_num ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_annual_year->Visible) { // pay_annual_year ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_detail->Visible) { // pay_sum_detail ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_total->Visible) { // pay_sum_total ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $paymentsummary->pay_sum_total->ViewAttributes() ?>><?php echo number_format($paymentsummary->pay_sum_total->ViewValue) ?></span> 
		</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_note->Visible) { // pay_sum_note ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$paymentsummary_list->ListOptions->Render("footer", "right");
?>
	</tr>
</tfoot>	
<?php } ?>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($paymentsummary_list->Recordset)
	$paymentsummary_list->Recordset->Close();
?>
<?php if ($paymentsummary_list->TotalRecs > 0) { ?>
<?php if ($paymentsummary->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($paymentsummary->CurrentAction <> "gridadd" && $paymentsummary->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($paymentsummary_list->Pager)) $paymentsummary_list->Pager = new cPrevNextPager($paymentsummary_list->StartRec, $paymentsummary_list->DisplayRecs, $paymentsummary_list->TotalRecs) ?>
<?php if ($paymentsummary_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($paymentsummary_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $paymentsummary_list->PageUrl() ?>start=<?php echo $paymentsummary_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($paymentsummary_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $paymentsummary_list->PageUrl() ?>start=<?php echo $paymentsummary_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $paymentsummary_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($paymentsummary_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $paymentsummary_list->PageUrl() ?>start=<?php echo $paymentsummary_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($paymentsummary_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $paymentsummary_list->PageUrl() ?>start=<?php echo $paymentsummary_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $paymentsummary_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $paymentsummary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $paymentsummary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $paymentsummary_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($paymentsummary_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($paymentsummary_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="paymentsummary">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($paymentsummary_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($paymentsummary_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($paymentsummary_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($paymentsummary_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($paymentsummary_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($paymentsummary_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($paymentsummary_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($paymentsummary_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($paymentsummary_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($paymentsummary->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($paymentsummary_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fpaymentsummarylist, '<?php echo $paymentsummary_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a><a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fpaymentsummarylist, 'sliptview.php?xprint=0');return false;"> <img src="images/ico_create_slipt.png" alt="" width="109" height="37" border="0" align="absmiddle" /></a>
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($paymentsummary->Export == "" && $paymentsummary->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(paymentsummary_list); // Init search panel as collapsed

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_village_id','x_t_code',false],
['x_t_code','x_t_code',false],
['x_pay_sum_type','x_pay_sum_type',false],
['x_pay_death_begin','x_pay_death_begin',false]]);

//-->
</script>
<?php } ?>
<?php
$paymentsummary_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($paymentsummary->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$paymentsummary_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpaymentsummary_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'paymentsummary';

	// Page object name
	var $PageObjName = 'paymentsummary_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $paymentsummary;
		if ($paymentsummary->UseTokenInUrl) $PageUrl .= "t=" . $paymentsummary->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $paymentsummary;
		if ($paymentsummary->UseTokenInUrl) {
			if ($objForm)
				return ($paymentsummary->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($paymentsummary->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpaymentsummary_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (paymentsummary)
		if (!isset($GLOBALS["paymentsummary"])) {
			$GLOBALS["paymentsummary"] = new cpaymentsummary();
			$GLOBALS["Table"] =& $GLOBALS["paymentsummary"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "paymentsummaryadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "paymentsummarydelete.php";
		$this->MultiUpdateUrl = "paymentsummaryupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (village)
		if (!isset($GLOBALS['village'])) $GLOBALS['village'] = new cvillage();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'paymentsummary', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $paymentsummary;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$paymentsummary->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$paymentsummary->Export = $_POST["exporttype"];
		} else {
			$paymentsummary->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $paymentsummary->Export; // Get export parameter, used in header
		$gsExportFile = $paymentsummary->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($paymentsummary->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($paymentsummary->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$paymentsummary->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 100;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $paymentsummary;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterParms();

			// Hide all options
			if ($paymentsummary->Export <> "" ||
				$paymentsummary->CurrentAction == "gridadd" ||
				$paymentsummary->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$paymentsummary->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($paymentsummary->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $paymentsummary->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$paymentsummary->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$paymentsummary->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$paymentsummary->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $paymentsummary->getSearchWhere();
		}

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $paymentsummary->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $paymentsummary->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($paymentsummary->getMasterFilter() <> "" && $paymentsummary->getCurrentMasterTable() == "village") {
			global $village;
			$rsmaster = $village->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($paymentsummary->getReturnUrl()); // Return to caller
			} else {
				$village->LoadListRowValues($rsmaster);
				$village->RowType = EW_ROWTYPE_MASTER; // Master row
				$village->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$paymentsummary->setSessionWhere($sFilter);
		$paymentsummary->CurrentFilter = "";

		// Export data only
		if (in_array($paymentsummary->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($paymentsummary->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $paymentsummary;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 100; // Non-numeric, load default
				}
			}
			$paymentsummary->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$paymentsummary->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $paymentsummary;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $paymentsummary->pay_sum_id, FALSE); // pay_sum_id
		$this->BuildSearchSql($sWhere, $paymentsummary->t_code, FALSE); // t_code
		$this->BuildSearchSql($sWhere, $paymentsummary->village_id, FALSE); // village_id
		$this->BuildSearchSql($sWhere, $paymentsummary->pay_sum_date, FALSE); // pay_sum_date
		$this->BuildSearchSql($sWhere, $paymentsummary->pay_sum_type, FALSE); // pay_sum_type
		$this->BuildSearchSql($sWhere, $paymentsummary->pay_death_begin, FALSE); // pay_death_begin
		$this->BuildSearchSql($sWhere, $paymentsummary->pay_sum_adv_num, FALSE); // pay_sum_adv_num

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($paymentsummary->pay_sum_id); // pay_sum_id
			$this->SetSearchParm($paymentsummary->t_code); // t_code
			$this->SetSearchParm($paymentsummary->village_id); // village_id
			$this->SetSearchParm($paymentsummary->pay_sum_date); // pay_sum_date
			$this->SetSearchParm($paymentsummary->pay_sum_type); // pay_sum_type
			$this->SetSearchParm($paymentsummary->pay_death_begin); // pay_death_begin
			$this->SetSearchParm($paymentsummary->pay_sum_adv_num); // pay_sum_adv_num
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $paymentsummary;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$paymentsummary->setAdvancedSearch("x_$FldParm", $FldVal);
		$paymentsummary->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$paymentsummary->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$paymentsummary->setAdvancedSearch("y_$FldParm", $FldVal2);
		$paymentsummary->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $paymentsummary;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $paymentsummary->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $paymentsummary->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $paymentsummary->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $paymentsummary->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $paymentsummary->getAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $paymentsummary;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$paymentsummary->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $paymentsummary;
		$paymentsummary->setAdvancedSearch("x_pay_sum_id", "");
		$paymentsummary->setAdvancedSearch("x_t_code", "");
		$paymentsummary->setAdvancedSearch("x_village_id", "");
		$paymentsummary->setAdvancedSearch("x_pay_sum_date", "");
		$paymentsummary->setAdvancedSearch("x_pay_sum_type", "");
		$paymentsummary->setAdvancedSearch("x_pay_death_begin", "");
		$paymentsummary->setAdvancedSearch("x_pay_sum_adv_num", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $paymentsummary;
		$bRestore = TRUE;
		if ($paymentsummary->pay_sum_id->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentsummary->t_code->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentsummary->village_id->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentsummary->pay_sum_date->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentsummary->pay_sum_type->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentsummary->pay_death_begin->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentsummary->pay_sum_adv_num->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($paymentsummary->pay_sum_id);
			$this->GetSearchParm($paymentsummary->t_code);
			$this->GetSearchParm($paymentsummary->village_id);
			$this->GetSearchParm($paymentsummary->pay_sum_date);
			$this->GetSearchParm($paymentsummary->pay_sum_type);
			$this->GetSearchParm($paymentsummary->pay_death_begin);
			$this->GetSearchParm($paymentsummary->pay_sum_adv_num);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $paymentsummary;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$paymentsummary->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$paymentsummary->CurrentOrderType = @$_GET["ordertype"];
			$paymentsummary->UpdateSort($paymentsummary->t_code); // t_code
			$paymentsummary->UpdateSort($paymentsummary->village_id); // village_id
			$paymentsummary->UpdateSort($paymentsummary->member_code); // member_code
			$paymentsummary->UpdateSort($paymentsummary->pay_sum_date); // pay_sum_date
			$paymentsummary->UpdateSort($paymentsummary->pay_sum_type); // pay_sum_type
			$paymentsummary->UpdateSort($paymentsummary->pay_death_begin); // pay_death_begin
			$paymentsummary->UpdateSort($paymentsummary->pay_sum_adv_num); // pay_sum_adv_num
			$paymentsummary->UpdateSort($paymentsummary->pay_annual_year); // pay_annual_year
			$paymentsummary->UpdateSort($paymentsummary->pay_sum_detail); // pay_sum_detail
			$paymentsummary->UpdateSort($paymentsummary->pay_sum_total); // pay_sum_total
			$paymentsummary->UpdateSort($paymentsummary->pay_sum_note); // pay_sum_note
			$paymentsummary->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $paymentsummary;
		$sOrderBy = $paymentsummary->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($paymentsummary->SqlOrderBy() <> "") {
				$sOrderBy = $paymentsummary->SqlOrderBy();
				$paymentsummary->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $paymentsummary;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$paymentsummary->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$paymentsummary->village_id->setSessionValue("");
				$paymentsummary->t_code->setSessionValue("");
				$paymentsummary->flag->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$paymentsummary->setSessionOrderBy($sOrderBy);
				$paymentsummary->t_code->setSort("");
				$paymentsummary->village_id->setSort("");
				$paymentsummary->member_code->setSort("");
				$paymentsummary->pay_sum_date->setSort("");
				$paymentsummary->pay_sum_type->setSort("");
				$paymentsummary->pay_death_begin->setSort("");
				$paymentsummary->pay_sum_adv_num->setSort("");
				$paymentsummary->pay_annual_year->setSort("");
				$paymentsummary->pay_sum_detail->setSort("");
				$paymentsummary->pay_sum_total->setSort("");
				$paymentsummary->pay_sum_note->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$paymentsummary->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $paymentsummary;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

		// "checkbox"
		$item =& $this->ListOptions->Add("checkbox");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"paymentsummary_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $paymentsummary, $objForm;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($paymentsummary->pay_sum_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $paymentsummary;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $paymentsummary;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$paymentsummary->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$paymentsummary->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $paymentsummary->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$paymentsummary->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$paymentsummary->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$paymentsummary->setStartRecordNumber($this->StartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $paymentsummary;

		// Load search values
		// pay_sum_id

		$paymentsummary->pay_sum_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pay_sum_id"]);
		$paymentsummary->pay_sum_id->AdvancedSearch->SearchOperator = @$_GET["z_pay_sum_id"];

		// t_code
		$paymentsummary->t_code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_t_code"]);
		$paymentsummary->t_code->AdvancedSearch->SearchOperator = @$_GET["z_t_code"];

		// village_id
		$paymentsummary->village_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_village_id"]);
		$paymentsummary->village_id->AdvancedSearch->SearchOperator = @$_GET["z_village_id"];

		// pay_sum_date
		$paymentsummary->pay_sum_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pay_sum_date"]);
		$paymentsummary->pay_sum_date->AdvancedSearch->SearchOperator = @$_GET["z_pay_sum_date"];

		// pay_sum_type
		$paymentsummary->pay_sum_type->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pay_sum_type"]);
		$paymentsummary->pay_sum_type->AdvancedSearch->SearchOperator = @$_GET["z_pay_sum_type"];

		// pay_death_begin
		$paymentsummary->pay_death_begin->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pay_death_begin"]);
		$paymentsummary->pay_death_begin->AdvancedSearch->SearchOperator = @$_GET["z_pay_death_begin"];

		// pay_sum_adv_num
		$paymentsummary->pay_sum_adv_num->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pay_sum_adv_num"]);
		$paymentsummary->pay_sum_adv_num->AdvancedSearch->SearchOperator = @$_GET["z_pay_sum_adv_num"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $paymentsummary;

		// Call Recordset Selecting event
		$paymentsummary->Recordset_Selecting($paymentsummary->CurrentFilter);

		// Load List page SQL
		$sSql = $paymentsummary->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$paymentsummary->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $paymentsummary;
		$sFilter = $paymentsummary->KeyFilter();

		// Call Row Selecting event
		$paymentsummary->Row_Selecting($sFilter);

		// Load SQL based on filter
		$paymentsummary->CurrentFilter = $sFilter;
		$sSql = $paymentsummary->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $paymentsummary;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$paymentsummary->Row_Selected($row);
		$paymentsummary->pay_sum_id->setDbValue($rs->fields('pay_sum_id'));
		$paymentsummary->t_code->setDbValue($rs->fields('t_code'));
		$paymentsummary->village_id->setDbValue($rs->fields('village_id'));
		$paymentsummary->member_code->setDbValue($rs->fields('member_code'));
		$paymentsummary->pay_sum_date->setDbValue($rs->fields('pay_sum_date'));
		$paymentsummary->pay_sum_type->setDbValue($rs->fields('pay_sum_type'));
		$paymentsummary->pay_death_begin->setDbValue($rs->fields('pay_death_begin'));
		$paymentsummary->pay_sum_adv_count->setDbValue($rs->fields('pay_sum_adv_count'));
		$paymentsummary->pay_sum_adv_num->setDbValue($rs->fields('pay_sum_adv_num'));
		$paymentsummary->pay_death_end->setDbValue($rs->fields('pay_death_end'));
		$paymentsummary->pay_annual_year->setDbValue($rs->fields('pay_annual_year'));
		$paymentsummary->pay_sum_detail->setDbValue($rs->fields('pay_sum_detail'));
		$paymentsummary->pay_sum_total->setDbValue($rs->fields('pay_sum_total'));
		$paymentsummary->pay_sum_note->setDbValue($rs->fields('pay_sum_note'));
		$paymentsummary->flag->setDbValue($rs->fields('flag'));
	}

	// Load old record
	function LoadOldRecord() {
		global $paymentsummary;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($paymentsummary->getKey("pay_sum_id")) <> "")
			$paymentsummary->pay_sum_id->CurrentValue = $paymentsummary->getKey("pay_sum_id"); // pay_sum_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$paymentsummary->CurrentFilter = $paymentsummary->KeyFilter();
			$sSql = $paymentsummary->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $paymentsummary;

		// Initialize URLs
		$this->ViewUrl = $paymentsummary->ViewUrl();
		$this->EditUrl = $paymentsummary->EditUrl();
		$this->InlineEditUrl = $paymentsummary->InlineEditUrl();
		$this->CopyUrl = $paymentsummary->CopyUrl();
		$this->InlineCopyUrl = $paymentsummary->InlineCopyUrl();
		$this->DeleteUrl = $paymentsummary->DeleteUrl();

		// Call Row_Rendering event
		$paymentsummary->Row_Rendering();

		// Common render codes for all row types
		// pay_sum_id
		// t_code

		$paymentsummary->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$paymentsummary->village_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$paymentsummary->member_code->CellCssStyle = "white-space: nowrap;";

		// pay_sum_date
		// pay_sum_type

		$paymentsummary->pay_sum_type->CellCssStyle = "white-space: nowrap;";

		// pay_death_begin
		// pay_sum_adv_count

		$paymentsummary->pay_sum_adv_count->CellCssStyle = "white-space: nowrap;";

		// pay_sum_adv_num
		// pay_death_end

		$paymentsummary->pay_death_end->CellCssStyle = "white-space: nowrap;";

		// pay_annual_year
		// pay_sum_detail
		// pay_sum_total

		$paymentsummary->pay_sum_total->CellCssStyle = "white-space: nowrap;";

		// pay_sum_note
		// flag

		$paymentsummary->flag->CellCssStyle = "white-space: nowrap;";

		// Accumulate aggregate value
		if ($paymentsummary->RowType <> EW_ROWTYPE_AGGREGATEINIT && $paymentsummary->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($paymentsummary->pay_sum_total->CurrentValue))
				$paymentsummary->pay_sum_total->Total += $paymentsummary->pay_sum_total->CurrentValue; // Accumulate total
		}
		if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View row

			// pay_sum_id
			$paymentsummary->pay_sum_id->ViewValue = $paymentsummary->pay_sum_id->CurrentValue;
			$paymentsummary->pay_sum_id->ViewCustomAttributes = "";

			// t_code
			if (strval($paymentsummary->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentsummary->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->t_code->ViewValue = $rswrk->fields('t_code');
					$paymentsummary->t_code->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$paymentsummary->t_code->ViewValue = $paymentsummary->t_code->CurrentValue;
				}
			} else {
				$paymentsummary->t_code->ViewValue = NULL;
			}
			$paymentsummary->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($paymentsummary->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentsummary->village_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `v_code`, `v_title` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->village_id->ViewValue = $rswrk->fields('v_code');
					$paymentsummary->village_id->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$paymentsummary->village_id->ViewValue = $paymentsummary->village_id->CurrentValue;
				}
			} else {
				$paymentsummary->village_id->ViewValue = NULL;
			}
			$paymentsummary->village_id->ViewCustomAttributes = "";

			// member_code
			if (strval($paymentsummary->member_code->CurrentValue) <> "") {
				$arwrk = explode(",", $paymentsummary->member_code->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`member_code` = '" . ew_AdjustSql(trim($wrk)) . "'";
				}	
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` != 'เสียชีวิต' ";;
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `member_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->member_code->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$paymentsummary->member_code->ViewValue .= $rswrk->fields('member_code');
						$paymentsummary->member_code->ViewValue .= ew_ValueSeparator($ari,1,$paymentsummary->member_code) . $rswrk->fields('fname');
						$paymentsummary->member_code->ViewValue .= ew_ValueSeparator($ari,2,$paymentsummary->member_code) . $rswrk->fields('lname');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $paymentsummary->member_code->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$paymentsummary->member_code->ViewValue = $paymentsummary->member_code->CurrentValue;
				}
			} else {
				$paymentsummary->member_code->ViewValue = NULL;
			}
			$paymentsummary->member_code->ViewCustomAttributes = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->ViewValue = $paymentsummary->pay_sum_date->CurrentValue;
			$paymentsummary->pay_sum_date->ViewValue = ew_FormatDateTime($paymentsummary->pay_sum_date->ViewValue, 7);
			$paymentsummary->pay_sum_date->ViewCustomAttributes = "";

			// pay_sum_type
			if (strval($paymentsummary->pay_sum_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentsummary->pay_sum_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_type->ViewValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_type->ViewValue = $paymentsummary->pay_sum_type->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_type->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_type->ViewCustomAttributes = "";

			// pay_death_begin
			if (strval($paymentsummary->pay_death_begin->CurrentValue) <> "") {
				$sFilterWrk = "`dead_id` = " . ew_AdjustSql($paymentsummary->pay_death_begin->CurrentValue) . "";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `dead_id` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_death_begin->ViewValue = $rswrk->fields('dead_id');
					$paymentsummary->pay_death_begin->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->pay_death_begin) . $rswrk->fields('fname');
					$paymentsummary->pay_death_begin->ViewValue .= ew_ValueSeparator(0,2,$paymentsummary->pay_death_begin) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_death_begin->ViewValue = $paymentsummary->pay_death_begin->CurrentValue;
				}
			} else {
				$paymentsummary->pay_death_begin->ViewValue = NULL;
			}
			$paymentsummary->pay_death_begin->ViewCustomAttributes = "";

			// pay_sum_adv_num
			if (strval($paymentsummary->pay_sum_adv_num->CurrentValue) <> "") {
				$sFilterWrk = "`adv_num` = " . ew_AdjustSql($paymentsummary->pay_sum_adv_num->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `adv_num` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`adv_num` != '0'";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `adv_num`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_adv_num->ViewValue = $rswrk->fields('adv_num');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_adv_num->ViewValue = $paymentsummary->pay_sum_adv_num->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_adv_num->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_adv_num->ViewCustomAttributes = "";

			// pay_annual_year
			if (strval($paymentsummary->pay_annual_year->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_annual_year->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 3";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cal_detail` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_annual_year->ViewValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_annual_year->ViewValue = $paymentsummary->pay_annual_year->CurrentValue;
				}
			} else {
				$paymentsummary->pay_annual_year->ViewValue = NULL;
			}
			$paymentsummary->pay_annual_year->ViewCustomAttributes = "";

			// pay_sum_detail
			if (strval($paymentsummary->pay_sum_detail->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_sum_detail->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 5";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_detail->ViewValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_detail->ViewValue = $paymentsummary->pay_sum_detail->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_detail->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_detail->ViewCustomAttributes = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->ViewValue = $paymentsummary->pay_sum_total->CurrentValue;
			$paymentsummary->pay_sum_total->ViewCustomAttributes = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->ViewValue = $paymentsummary->pay_sum_note->CurrentValue;
			$paymentsummary->pay_sum_note->ViewCustomAttributes = "";

			// t_code
			$paymentsummary->t_code->LinkCustomAttributes = "";
			$paymentsummary->t_code->HrefValue = "";
			$paymentsummary->t_code->TooltipValue = "";

			// village_id
			$paymentsummary->village_id->LinkCustomAttributes = "";
			$paymentsummary->village_id->HrefValue = "";
			$paymentsummary->village_id->TooltipValue = "";

			// member_code
			$paymentsummary->member_code->LinkCustomAttributes = "";
			$paymentsummary->member_code->HrefValue = "";
			$paymentsummary->member_code->TooltipValue = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_date->HrefValue = "";
			$paymentsummary->pay_sum_date->TooltipValue = "";

			// pay_sum_type
			$paymentsummary->pay_sum_type->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_type->HrefValue = "";
			$paymentsummary->pay_sum_type->TooltipValue = "";

			// pay_death_begin
			$paymentsummary->pay_death_begin->LinkCustomAttributes = "";
			$paymentsummary->pay_death_begin->HrefValue = "";
			$paymentsummary->pay_death_begin->TooltipValue = "";

			// pay_sum_adv_num
			$paymentsummary->pay_sum_adv_num->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_adv_num->HrefValue = "";
			$paymentsummary->pay_sum_adv_num->TooltipValue = "";

			// pay_annual_year
			$paymentsummary->pay_annual_year->LinkCustomAttributes = "";
			$paymentsummary->pay_annual_year->HrefValue = "";
			$paymentsummary->pay_annual_year->TooltipValue = "";

			// pay_sum_detail
			$paymentsummary->pay_sum_detail->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_detail->HrefValue = "";
			$paymentsummary->pay_sum_detail->TooltipValue = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_total->HrefValue = "";
			$paymentsummary->pay_sum_total->TooltipValue = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_note->HrefValue = "";
			$paymentsummary->pay_sum_note->TooltipValue = "";
		} elseif ($paymentsummary->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// t_code
			$paymentsummary->t_code->EditCustomAttributes = "";
			if (trim(strval($paymentsummary->t_code->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentsummary->t_code->AdvancedSearch->SearchValue) . "'";
			}
			$sSqlWrk = "SELECT `t_code`, `t_code` AS `DispFld`, `t_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$paymentsummary->t_code->EditValue = $arwrk;

			// village_id
			$paymentsummary->village_id->EditCustomAttributes = "";
			if (trim(strval($paymentsummary->village_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentsummary->village_id->AdvancedSearch->SearchValue) . "";
			}
			$sSqlWrk = "SELECT `village_id`, `v_code` AS `DispFld`, `v_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `t_code` AS `SelectFilterFld` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", ""));
			$paymentsummary->village_id->EditValue = $arwrk;

			// member_code
			$paymentsummary->member_code->EditCustomAttributes = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->EditCustomAttributes = "";
			$paymentsummary->pay_sum_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($paymentsummary->pay_sum_date->AdvancedSearch->SearchValue, 7), 7));

			// pay_sum_type
			$paymentsummary->pay_sum_type->EditCustomAttributes = 'onchange=showfield(this.options[this.selectedIndex].value);';
			if (trim(strval($paymentsummary->pay_sum_type->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentsummary->pay_sum_type->AdvancedSearch->SearchValue) . "";
			}
			$sSqlWrk = "SELECT `pt_id`, `pt_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$paymentsummary->pay_sum_type->EditValue = $arwrk;

			// pay_death_begin
			$paymentsummary->pay_death_begin->EditCustomAttributes = "";
			if (trim(strval($paymentsummary->pay_death_begin->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`dead_id` = " . ew_AdjustSql($paymentsummary->pay_death_begin->AdvancedSearch->SearchValue) . "";
			}
			$sSqlWrk = "SELECT `dead_id`, `dead_id` AS `DispFld`, `fname` AS `Disp2Fld`, `lname` AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `dead_id` Desc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", ""));
			$paymentsummary->pay_death_begin->EditValue = $arwrk;

			// pay_sum_adv_num
			$paymentsummary->pay_sum_adv_num->EditCustomAttributes = "";

			// pay_annual_year
			$paymentsummary->pay_annual_year->EditCustomAttributes = "";

			// pay_sum_detail
			$paymentsummary->pay_sum_detail->EditCustomAttributes = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->EditCustomAttributes = "";
			$paymentsummary->pay_sum_total->EditValue = ew_HtmlEncode($paymentsummary->pay_sum_total->AdvancedSearch->SearchValue);

			// pay_sum_note
			$paymentsummary->pay_sum_note->EditCustomAttributes = "";
			$paymentsummary->pay_sum_note->EditValue = ew_HtmlEncode($paymentsummary->pay_sum_note->AdvancedSearch->SearchValue);
		} elseif ($paymentsummary->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$paymentsummary->pay_sum_total->Total = 0; // Initialize total
		} elseif ($paymentsummary->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$paymentsummary->pay_sum_total->CurrentValue = $paymentsummary->pay_sum_total->Total;
			$paymentsummary->pay_sum_total->ViewValue = $paymentsummary->pay_sum_total->CurrentValue;
			$paymentsummary->pay_sum_total->ViewCustomAttributes = "";
			$paymentsummary->pay_sum_total->HrefValue = ""; // Clear href value
		}
		if ($paymentsummary->RowType == EW_ROWTYPE_ADD ||
			$paymentsummary->RowType == EW_ROWTYPE_EDIT ||
			$paymentsummary->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$paymentsummary->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($paymentsummary->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$paymentsummary->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $paymentsummary;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $paymentsummary;
		$paymentsummary->pay_sum_id->AdvancedSearch->SearchValue = $paymentsummary->getAdvancedSearch("x_pay_sum_id");
		$paymentsummary->t_code->AdvancedSearch->SearchValue = $paymentsummary->getAdvancedSearch("x_t_code");
		$paymentsummary->village_id->AdvancedSearch->SearchValue = $paymentsummary->getAdvancedSearch("x_village_id");
		$paymentsummary->pay_sum_date->AdvancedSearch->SearchValue = $paymentsummary->getAdvancedSearch("x_pay_sum_date");
		$paymentsummary->pay_sum_type->AdvancedSearch->SearchValue = $paymentsummary->getAdvancedSearch("x_pay_sum_type");
		$paymentsummary->pay_death_begin->AdvancedSearch->SearchValue = $paymentsummary->getAdvancedSearch("x_pay_death_begin");
		$paymentsummary->pay_sum_adv_num->AdvancedSearch->SearchValue = $paymentsummary->getAdvancedSearch("x_pay_sum_adv_num");
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $paymentsummary;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = FALSE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_paymentsummary\" id=\"emf_paymentsummary\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_paymentsummary',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fpaymentsummarylist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($paymentsummary->Export <> "" ||
			$paymentsummary->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $paymentsummary;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $paymentsummary->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($paymentsummary->ExportAll) {
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs < 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($paymentsummary->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($paymentsummary, "h");
		}
		$ParentTable = "";

		// Export master record
		if (EW_EXPORT_MASTER_RECORD && $paymentsummary->getMasterFilter() <> "" && $paymentsummary->getCurrentMasterTable() == "village") {
			global $village;
			$rsmaster = $village->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				if ($paymentsummary->Export == "xml") {
					$ParentTable = "village";
					$village->ExportXmlDocument($XmlDoc, '', $rsmaster, 1, 1);
				} else {
					$ExportStyle = $ExportDoc->Style;
					$ExportDoc->ChangeStyle("v"); // Change to vertical
					if ($paymentsummary->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
						$village->ExportDocument($ExportDoc, $rsmaster, 1, 1);
						$ExportDoc->ExportEmptyLine();
					}
					$ExportDoc->ChangeStyle($ExportStyle); // Restore
				}
				$rsmaster->Close();
			}
		}
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($paymentsummary->Export == "xml") {
			$paymentsummary->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$paymentsummary->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($paymentsummary->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($paymentsummary->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($paymentsummary->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($paymentsummary->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($paymentsummary->ExportReturnUrl());
		} elseif ($paymentsummary->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $paymentsummary;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "village") {
				$bValidMaster = TRUE;
				if (@$_GET["village_id"] <> "") {
					$GLOBALS["village"]->village_id->setQueryStringValue($_GET["village_id"]);
					$paymentsummary->village_id->setQueryStringValue($GLOBALS["village"]->village_id->QueryStringValue);
					$paymentsummary->village_id->setSessionValue($paymentsummary->village_id->QueryStringValue);
					if (!is_numeric($GLOBALS["village"]->village_id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_GET["t_code"] <> "") {
					$GLOBALS["village"]->t_code->setQueryStringValue($_GET["t_code"]);
					$paymentsummary->t_code->setQueryStringValue($GLOBALS["village"]->t_code->QueryStringValue);
					$paymentsummary->t_code->setSessionValue($paymentsummary->t_code->QueryStringValue);
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_GET["flag"] <> "") {
					$GLOBALS["village"]->flag->setQueryStringValue($_GET["flag"]);
					$paymentsummary->flag->setQueryStringValue($GLOBALS["village"]->flag->QueryStringValue);
					$paymentsummary->flag->setSessionValue($paymentsummary->flag->QueryStringValue);
					if (!is_numeric($GLOBALS["village"]->flag->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$paymentsummary->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$paymentsummary->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "village") {
				if ($paymentsummary->village_id->QueryStringValue == "") $paymentsummary->village_id->setSessionValue("");
				if ($paymentsummary->t_code->QueryStringValue == "") $paymentsummary->t_code->setSessionValue("");
				if ($paymentsummary->flag->QueryStringValue == "") $paymentsummary->flag->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $paymentsummary->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $paymentsummary->getDetailFilter(); // Get detail filter
	}

	// Export PDF
	function ExportPDF($html) {
		global $gsExportFile;
		include_once "dompdf060b2/dompdf_config.inc.php";
		@ini_set("memory_limit", EW_PDF_MEMORY_LIMIT);
		set_time_limit(EW_PDF_TIME_LIMIT);
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "portrait");
		$dompdf->render();
		ob_end_clean();
		ew_DeleteTmpImages();
		$dompdf->stream($gsExportFile . ".pdf", array("Attachment" => 1)); // 0 to open in browser, 1 to download

//		exit();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

		// Page Redirecting event
function Page_Redirecting(&$url) {
	// Example:
   // global $paymentsummary;         
   // $id = $paymentsummary->pay_sum_id->CurrentValue;  
   // $url = "paymentsummaryadd.php?flag=2";
}                                                             

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

		// ListOptions Load event
function ListOptions_Load() {
	// Example:
  //  $opt =& $this->ListOptions->Add("new");
  //  $opt->Header = "";
  //  $opt->OnLeft = TRUE; // Link on left
  //  $opt->MoveTo(1); // Move to first column 
}                                                 

		// ListOptions Rendered event
function ListOptions_Rendered() {      

  //  global $paymentsummary;
	// Example: 
  ///  $this->ListOptions->Items["new"]->Body = "<a href='notpaylist.php?pay_sum_id=".$paymentsummary->pay_sum_id->CurrentValue.".'>ชำระทั้งหมด</a>";
}                                                                 


}
?>
