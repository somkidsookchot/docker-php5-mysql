<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subvcalculateinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subvcalculate_list = new csubvcalculate_list();
$Page =& $subvcalculate_list;

// Page init
$subvcalculate_list->Page_Init();

// Page main
$subvcalculate_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($subvcalculate->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subvcalculate_list = new ew_Page("subvcalculate_list");

// page properties
subvcalculate_list.PageID = "list"; // page ID
subvcalculate_list.FormID = "fsubvcalculatelist"; // form ID
var EW_PAGE_ID = subvcalculate_list.PageID; // for backward compatibility

// extend page with validate function for search
subvcalculate_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_adv_num"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcalculate->adv_num->FldErrMsg()) ?>");

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
subvcalculate_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subvcalculate_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subvcalculate_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subvcalculate_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
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

<?php if (($subvcalculate->Export == "") || (EW_EXPORT_MASTER_RECORD && $subvcalculate->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$subvcalculate_list->TotalRecs = $subvcalculate->SelectRecordCount();
	} else {
		if ($subvcalculate_list->Recordset = $subvcalculate_list->LoadRecordset())
			$subvcalculate_list->TotalRecs = $subvcalculate_list->Recordset->RecordCount();
	}
	$subvcalculate_list->StartRec = 1;
	if ($subvcalculate_list->DisplayRecs <= 0 || ($subvcalculate->Export <> "" && $subvcalculate->ExportAll)) // Display all records
		$subvcalculate_list->DisplayRecs = $subvcalculate_list->TotalRecs;
	if (!($subvcalculate->Export <> "" && $subvcalculate->ExportAll))
		$subvcalculate_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$subvcalculate_list->Recordset = $subvcalculate_list->LoadRecordset($subvcalculate_list->StartRec-1, $subvcalculate_list->DisplayRecs);
?>
<div class="ewTitle" style="white-space: nowrap;"><img src="images/ico_unpay.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subvcalculate->TableCaption() ?><?php switch($_GET["x_cal_type"]){
	
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
	case 6 : echo 'ค่าสงเคราะห์ย้อนหลัง';
		break;
} ?>&nbsp;&nbsp;
</div>
<div class="clear"></div>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($subvcalculate->Export == "" && $subvcalculate->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(subvcalculate_list);" style="text-decoration: none;"><img id="subvcalculate_list_SearchImage" src="phpimages/collapse.png" alt=""  border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="subvcalculate_list_SearchPanel" class="listSearch">
<form name="fsubvcalculatelistsrch" id="fsubvcalculatelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return subvcalculate_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="subvcalculate">
<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$subvcalculate_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$subvcalculate->RowType = EW_ROWTYPE_SEARCH;

// Render row
$subvcalculate->ResetAttrs();
$subvcalculate_list->RenderRow();
?>
<span id="xsc_t_code" class="ewCssTableCell">
	  <span class="ewSearchCaption"><?php echo $subvcalculate->t_code->FldCaption() ?></span>
	  <span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_t_code" id="z_t_code" value="LIKE"></span>
	  <span class="ewSearchField">
<?php $subvcalculate->t_code->EditAttrs["onchange"] = "ew_UpdateOpt('x_village_id','x_t_code',true); " . @$subvcalculate->t_code->EditAttrs["onchange"]; ?>
<select id="x_t_code" name="x_t_code"<?php echo $subvcalculate->t_code->EditAttributes() ?>>
<?php
if (is_array($subvcalculate->t_code->EditValue)) {
	$arwrk = $subvcalculate->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subvcalculate->t_code->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$subvcalculate->t_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
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
</span>
	</span>
<span id="xsc_village_id" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $subvcalculate->village_id->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_village_id" id="z_village_id" value="="></span>
		<span class="ewSearchField">
<select id="x_village_id" name="x_village_id"<?php echo $subvcalculate->village_id->EditAttributes() ?>>
<?php
if (is_array($subvcalculate->village_id->EditValue)) {
	$arwrk = $subvcalculate->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subvcalculate->village_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$subvcalculate->village_id) ?><?php echo $arwrk[$rowcntwrk][2] ?>
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
</span>
	</span>

<div id="xsr_3" class="ewCssTableRow">
	<span id="xsc_cal_type" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $subvcalculate->cal_type->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_cal_type" id="z_cal_type" value="="></span>
		<span class="ewSearchField">
<select id="x_cal_type" name="x_cal_type"<?php echo $subvcalculate->cal_type->EditAttributes() ?>>
<?php
if (is_array($subvcalculate->cal_type->EditValue)) {
	$arwrk = $subvcalculate->cal_type->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subvcalculate->cal_type->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
	</span>
</div>
<span id="xsc_member_code" class="ewCssTableCell">
	  <span class="ewSearchCaption"><?php echo $subvcalculate->member_code->FldCaption() ?></span>
	  <span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_member_code" id="z_member_code" value="LIKE"></span>
	  <span class="ewSearchField">
<select id="x_member_code" name="x_member_code"<?php echo $subvcalculate->member_code->EditAttributes() ?>>
<?php
if (is_array($subvcalculate->member_code->EditValue)) {
	$arwrk = $subvcalculate->member_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subvcalculate->member_code->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$subvcalculate->member_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
<?php if ($arwrk[$rowcntwrk][3] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,2,$subvcalculate->member_code) ?><?php echo $arwrk[$rowcntwrk][3] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php
$sSqlWrk = "SELECT `member_code`, `dead_id` AS `DispFld`, `fname` AS `Disp2Fld`, `lname` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `members`";
$sWhereWrk = "";
$lookuptblfilter = "`member_status` = 'เสียชีวิต'";
if (strval($lookuptblfilter) <> "") {
	if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
	$sWhereWrk .= "(" . $lookuptblfilter . ")";
}
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_member_code" id="s_x_member_code" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_member_code" id="lft_x_member_code" value="">
</span>
	</span>
<span id="xsc_adv_num" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $subvcalculate->adv_num->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_adv_num" id="z_adv_num" value="="></span>
		<span class="ewSearchField">
<input type="text" name="x_adv_num" id="x_adv_num" size="10" value="<?php echo $subvcalculate->adv_num->EditValue ?>"<?php echo $subvcalculate->adv_num->EditAttributes() ?>>
</span>
	</span>
	<span id="xsc_cal_status" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $subvcalculate->cal_status->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_cal_status" id="z_cal_status" value="LIKE"></span>
		<span class="ewSearchField">
<select id="x_cal_status" name="x_cal_status"<?php echo $subvcalculate->cal_status->EditAttributes() ?>>
<?php
if (is_array($subvcalculate->cal_status->EditValue)) {
	$arwrk = $subvcalculate->cal_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subvcalculate->cal_status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
	</span>

<div id="xsr_7" class="ewCssTableRow">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $subvcalculate_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $subvcalculate_list->ShowPageHeader(); ?>
<?php
$subvcalculate_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($subvcalculate->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($subvcalculate->CurrentAction <> "gridadd" && $subvcalculate->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subvcalculate_list->Pager)) $subvcalculate_list->Pager = new cPrevNextPager($subvcalculate_list->StartRec, $subvcalculate_list->DisplayRecs, $subvcalculate_list->TotalRecs) ?>
<?php if ($subvcalculate_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subvcalculate_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subvcalculate_list->PageUrl() ?>start=<?php echo $subvcalculate_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subvcalculate_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subvcalculate_list->PageUrl() ?>start=<?php echo $subvcalculate_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subvcalculate_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subvcalculate_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subvcalculate_list->PageUrl() ?>start=<?php echo $subvcalculate_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subvcalculate_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subvcalculate_list->PageUrl() ?>start=<?php echo $subvcalculate_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subvcalculate_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subvcalculate_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subvcalculate_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subvcalculate_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($subvcalculate_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($subvcalculate_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="subvcalculate">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($subvcalculate_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($subvcalculate_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($subvcalculate_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($subvcalculate_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($subvcalculate_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($subvcalculate_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($subvcalculate_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($subvcalculate_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($subvcalculate_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($subvcalculate->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($subvcalculate_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsubvcalculatelist, '<?php echo $subvcalculate_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a><a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsubvcalculatelist, 'invoice.php?xprint=0');return false;"> <img src="images/ico_create_invoice.png" width="131" height="37" border="0" align="absmiddle" /></a><a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsubvcalculatelist, 'notice.php?xprint=0');return false;"> <img src="images/ico_create_notice.png" width="142" height="37" border="0" align="absmiddle" /></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php if ($_GET["x_cal_type"]){?>
<?php if($_GET["x_cal_type"] > 1) {?><img src="images/ico_small_add.png" width="20" height="20" align="absmiddle" /><?php } ?> <b>
<?php switch($_GET["x_cal_type"]){
	
	case 2 : echo ' <a href="advsubvcalulate.php">เพิ่มรายการเรียกเก็บงวดที่ '.(getAdvNum()+1).'</a>';
		break;
	case 3 : echo ' <a href="annualfeecalculate.php">เพิ่มรายการเรียกเก็บประจำปี '.thaiYear(date('Y')).'</a>';
		break;
	case 4 : echo ' <a href="regiscalculate.php">เพิ่มรายการเรียกเก็บเงินค่าสมัคร</a>';
		break;
	case 5 : echo ' <a href="othercalculate.php">เพิ่มรายการเรียกเก็บอื่นๆ</a>';
		break;
	case 6 : echo ' <a href="rcsubvcalulate.php">เพิ่มรายการเรียกเก็บค่าสงเคราะห์ย้อนหลัง</a>';
		break;
} ?>
</b>
<?php } ?>
</div>
<?php } ?>
<form name="fsubvcalculatelist" id="fsubvcalculatelist" class="ewForm" action="" method="post">
  <input type="hidden" name="t" id="t" value="subvcalculate">
<div id="gmp_subvcalculate" class="ewGridMiddlePanel">
<?php if ($subvcalculate_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $subvcalculate->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$subvcalculate_list->RenderListOptions();

// Render list options (header, left)
$subvcalculate_list->ListOptions->Render("header", "left");
?>
<?php if ($subvcalculate->t_code->Visible) { // t_code ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->t_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcalculate->t_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->t_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcalculate->t_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->t_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->t_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->village_id->Visible) { // village_id ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->village_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcalculate->village_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->village_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcalculate->village_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->village_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->village_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->cal_type->Visible) { // cal_type ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->cal_type) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcalculate->cal_type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->cal_type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcalculate->cal_type->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->cal_type->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->cal_type->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->member_code->Visible) { // member_code ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->member_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcalculate->member_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->member_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcalculate->member_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->member_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->member_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->adv_num->Visible) { // adv_num ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->adv_num) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcalculate->adv_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->adv_num) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcalculate->adv_num->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->adv_num->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->adv_num->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->cal_detail->Visible) { // cal_detail ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->cal_detail) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcalculate->cal_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->cal_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcalculate->cal_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->cal_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->cal_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->count_member->Visible) { // count_member ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->count_member) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcalculate->count_member->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->count_member) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcalculate->count_member->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->count_member->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->count_member->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->unit_rate->Visible) { // unit_rate ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->unit_rate) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcalculate->unit_rate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->unit_rate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcalculate->unit_rate->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->unit_rate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->unit_rate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->total->Visible) { // total ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcalculate->total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcalculate->total->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->cal_status->Visible) { // cal_status ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->cal_status) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcalculate->cal_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->cal_status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcalculate->cal_status->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->cal_status->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->cal_status->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->invoice_senddate->Visible) { // invoice_senddate ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->invoice_senddate) == "") { ?>
		<td><?php echo $subvcalculate->invoice_senddate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->invoice_senddate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subvcalculate->invoice_senddate->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->invoice_senddate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->invoice_senddate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->invoice_duedate->Visible) { // invoice_duedate ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->invoice_duedate) == "") { ?>
		<td><?php echo $subvcalculate->invoice_duedate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->invoice_duedate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subvcalculate->invoice_duedate->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->invoice_duedate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->invoice_duedate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->notice_senddate->Visible) { // notice_senddate ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->notice_senddate) == "") { ?>
		<td><?php echo $subvcalculate->notice_senddate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->notice_senddate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subvcalculate->notice_senddate->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->notice_senddate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->notice_senddate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcalculate->notice_duedate->Visible) { // notice_duedate ?>
	<?php if ($subvcalculate->SortUrl($subvcalculate->notice_duedate) == "") { ?>
		<td><?php echo $subvcalculate->notice_duedate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcalculate->SortUrl($subvcalculate->notice_duedate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subvcalculate->notice_duedate->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcalculate->notice_duedate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcalculate->notice_duedate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$subvcalculate_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($subvcalculate->ExportAll && $subvcalculate->Export <> "") {
	$subvcalculate_list->StopRec = $subvcalculate_list->TotalRecs;
} else {

	// Set the last record to display
	if ($subvcalculate_list->TotalRecs > $subvcalculate_list->StartRec + $subvcalculate_list->DisplayRecs - 1)
		$subvcalculate_list->StopRec = $subvcalculate_list->StartRec + $subvcalculate_list->DisplayRecs - 1;
	else
		$subvcalculate_list->StopRec = $subvcalculate_list->TotalRecs;
}
$subvcalculate_list->RecCnt = $subvcalculate_list->StartRec - 1;
if ($subvcalculate_list->Recordset && !$subvcalculate_list->Recordset->EOF) {
	$subvcalculate_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $subvcalculate_list->StartRec > 1)
		$subvcalculate_list->Recordset->Move($subvcalculate_list->StartRec - 1);
} elseif (!$subvcalculate->AllowAddDeleteRow && $subvcalculate_list->StopRec == 0) {
	$subvcalculate_list->StopRec = $subvcalculate->GridAddRowCount;
}

// Initialize aggregate
$subvcalculate->RowType = EW_ROWTYPE_AGGREGATEINIT;
$subvcalculate->ResetAttrs();
$subvcalculate_list->RenderRow();
$subvcalculate_list->RowCnt = 0;
while ($subvcalculate_list->RecCnt < $subvcalculate_list->StopRec) {
	$subvcalculate_list->RecCnt++;
	if (intval($subvcalculate_list->RecCnt) >= intval($subvcalculate_list->StartRec)) {
		$subvcalculate_list->RowCnt++;

		// Set up key count
		$subvcalculate_list->KeyCount = $subvcalculate_list->RowIndex;

		// Init row class and style
		$subvcalculate->ResetAttrs();
		$subvcalculate->CssClass = "";
		if ($subvcalculate->CurrentAction == "gridadd") {
		} else {
			$subvcalculate_list->LoadRowValues($subvcalculate_list->Recordset); // Load row values
		}
		$subvcalculate->RowType = EW_ROWTYPE_VIEW; // Render view
		$subvcalculate->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$subvcalculate_list->RenderRow();

		// Render list options
		$subvcalculate_list->RenderListOptions();
?>
	<tr<?php echo $subvcalculate->RowAttributes() ?>>
<?php

// Render list options (body, left)
$subvcalculate_list->ListOptions->Render("body", "left");
?>
	<?php if ($subvcalculate->t_code->Visible) { // t_code ?>
		<td<?php echo $subvcalculate->t_code->CellAttributes() ?>>
<div<?php echo $subvcalculate->t_code->ViewAttributes() ?>><?php echo $subvcalculate->t_code->ListViewValue() ?></div>
<a name="<?php echo $subvcalculate_list->PageObjName . "_row_" . $subvcalculate_list->RowCnt ?>" id="<?php echo $subvcalculate_list->PageObjName . "_row_" . $subvcalculate_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($subvcalculate->village_id->Visible) { // village_id ?>
		<td<?php echo $subvcalculate->village_id->CellAttributes() ?>>
<div<?php echo $subvcalculate->village_id->ViewAttributes() ?>><?php echo $subvcalculate->village_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->cal_type->Visible) { // cal_type ?>
		<td<?php echo $subvcalculate->cal_type->CellAttributes() ?>>
<div<?php echo $subvcalculate->cal_type->ViewAttributes() ?>><?php echo $subvcalculate->cal_type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->member_code->Visible) { // member_code ?>
		<td<?php echo $subvcalculate->member_code->CellAttributes() ?>>
<div<?php echo $subvcalculate->member_code->ViewAttributes() ?>><?php echo $subvcalculate->member_code->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->adv_num->Visible) { // adv_num ?>
		<td<?php echo $subvcalculate->adv_num->CellAttributes() ?>>
<div<?php echo $subvcalculate->adv_num->ViewAttributes() ?>><?php echo $subvcalculate->adv_num->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->cal_detail->Visible) { // cal_detail ?>
		<td<?php echo $subvcalculate->cal_detail->CellAttributes() ?>>
<div<?php echo $subvcalculate->cal_detail->ViewAttributes() ?>><?php echo $subvcalculate->cal_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->count_member->Visible) { // count_member ?>
		<td<?php echo $subvcalculate->count_member->CellAttributes() ?>>
<div<?php echo $subvcalculate->count_member->ViewAttributes() ?>><?php echo number_format($subvcalculate->count_member->ListViewValue()) ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->unit_rate->Visible) { // unit_rate ?>
		<td<?php echo $subvcalculate->unit_rate->CellAttributes() ?>>
<div<?php echo $subvcalculate->unit_rate->ViewAttributes() ?>><?php echo number_format($subvcalculate->unit_rate->ListViewValue()) ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->total->Visible) { // total ?>
		<td<?php echo $subvcalculate->total->CellAttributes() ?>>
<div<?php echo $subvcalculate->total->ViewAttributes() ?>><?php echo number_format($subvcalculate->total->ListViewValue()) ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->cal_status->Visible) { // cal_status ?>
		<td<?php echo $subvcalculate->cal_status->CellAttributes() ?>>
<div<?php echo $subvcalculate->cal_status->ViewAttributes() ?>><?php echo $subvcalculate->cal_status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->invoice_senddate->Visible) { // invoice_senddate ?>
		<td<?php echo $subvcalculate->invoice_senddate->CellAttributes() ?>>
<div<?php echo $subvcalculate->invoice_senddate->ViewAttributes() ?>><?php echo $subvcalculate->invoice_senddate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->invoice_duedate->Visible) { // invoice_duedate ?>
		<td<?php echo $subvcalculate->invoice_duedate->CellAttributes() ?>>
<div<?php echo $subvcalculate->invoice_duedate->ViewAttributes() ?>><?php echo $subvcalculate->invoice_duedate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->notice_senddate->Visible) { // notice_senddate ?>
		<td<?php echo $subvcalculate->notice_senddate->CellAttributes() ?>>
<div<?php echo $subvcalculate->notice_senddate->ViewAttributes() ?>><?php echo $subvcalculate->notice_senddate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcalculate->notice_duedate->Visible) { // notice_duedate ?>
		<td<?php echo $subvcalculate->notice_duedate->CellAttributes() ?>>
<div<?php echo $subvcalculate->notice_duedate->ViewAttributes() ?>><?php echo $subvcalculate->notice_duedate->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subvcalculate_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($subvcalculate->CurrentAction <> "gridadd")
		$subvcalculate_list->Recordset->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$subvcalculate->RowType = EW_ROWTYPE_AGGREGATE;
$subvcalculate->ResetAttrs();
$subvcalculate_list->RenderRow();
?>
<?php if ($subvcalculate_list->TotalRecs > 0 && ($subvcalculate->CurrentAction <> "gridadd" && $subvcalculate->CurrentAction <> "gridedit")) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$subvcalculate_list->RenderListOptions();

// Render list options (footer, left)
$subvcalculate_list->ListOptions->Render("footer", "left");
?>
	<?php if ($subvcalculate->t_code->Visible) { // t_code ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($subvcalculate->village_id->Visible) { // village_id ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($subvcalculate->cal_type->Visible) { // cal_type ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($subvcalculate->member_code->Visible) { // member_code ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($subvcalculate->adv_num->Visible) { // adv_num ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($subvcalculate->cal_detail->Visible) { // cal_detail ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($subvcalculate->count_member->Visible) { // count_member ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $subvcalculate->count_member->ViewAttributes() ?>><?php echo number_format($subvcalculate->count_member->ViewValue) ?></span> 
		</td>
	<?php } ?>
	<?php if ($subvcalculate->unit_rate->Visible) { // unit_rate ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($subvcalculate->total->Visible) { // total ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $subvcalculate->total->ViewAttributes() ?>><?php echo number_format($subvcalculate->total->ViewValue) ?></span> 
		</td>
	<?php } ?>
	<?php if ($subvcalculate->cal_status->Visible) { // cal_status ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($subvcalculate->invoice_senddate->Visible) { // invoice_senddate ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($subvcalculate->invoice_duedate->Visible) { // invoice_duedate ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($subvcalculate->notice_senddate->Visible) { // notice_senddate ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($subvcalculate->notice_duedate->Visible) { // notice_duedate ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$subvcalculate_list->ListOptions->Render("footer", "right");
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
if ($subvcalculate_list->Recordset)
	$subvcalculate_list->Recordset->Close();
?>
<?php if ($subvcalculate_list->TotalRecs > 0) { ?>
<?php if ($subvcalculate->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($subvcalculate->CurrentAction <> "gridadd" && $subvcalculate->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subvcalculate_list->Pager)) $subvcalculate_list->Pager = new cPrevNextPager($subvcalculate_list->StartRec, $subvcalculate_list->DisplayRecs, $subvcalculate_list->TotalRecs) ?>
<?php if ($subvcalculate_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subvcalculate_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subvcalculate_list->PageUrl() ?>start=<?php echo $subvcalculate_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subvcalculate_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subvcalculate_list->PageUrl() ?>start=<?php echo $subvcalculate_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subvcalculate_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subvcalculate_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subvcalculate_list->PageUrl() ?>start=<?php echo $subvcalculate_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subvcalculate_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subvcalculate_list->PageUrl() ?>start=<?php echo $subvcalculate_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subvcalculate_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subvcalculate_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subvcalculate_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subvcalculate_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($subvcalculate_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($subvcalculate_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="subvcalculate">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($subvcalculate_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($subvcalculate_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($subvcalculate_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($subvcalculate_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($subvcalculate_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($subvcalculate_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($subvcalculate_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($subvcalculate_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($subvcalculate_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($subvcalculate->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($subvcalculate_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsubvcalculatelist, '<?php echo $subvcalculate_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a><a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsubvcalculatelist, 'invoice.php?xprint=0');return false;"> <img src="images/ico_create_slipt.png" width="109" height="37" border="0" align="absmiddle" /> </a><a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsubvcalculatelist, 'notice.php?xprint=0');return false;"><img src="images/ico_create_notice.png" width="142" height="37" border="0" align="absmiddle" /></a>&nbsp;
<?php if ($_GET["x_cal_type"]){?>
<?php if($_GET["x_cal_type"] > 1) {?><img src="images/ico_small_add.png" width="20" height="20" align="absmiddle" /><?php } ?> <b>
<?php switch($_GET["x_cal_type"]){
	
	case 2 : echo ' <a href="advsubvcalulate.php">เพิ่มรายการเรียกเก็บงวดที่ '.(getAdvNum()+1).'</a>';
		break;
	case 3 : echo ' <a href="annualfeecalculate.php">เพิ่มรายการเรียกเก็บประจำปี '.thaiYear(date('Y')).'</a>';
		break;
	case 4 : echo ' <a href="regiscalculate.php">เพิ่มรายการเรียกเก็บเงินค่าสมัคร</a>';
		break;
	case 5 : echo ' <a href="othercalculate.php">เพิ่มรายการเรียกเก็บอื่นๆ</a>';
		break;
} ?>
</b>
<?php } ?>
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($subvcalculate->Export == "" && $subvcalculate->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(subvcalculate_list); // Init search panel as collapsed

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_village_id','x_t_code',false],
['x_t_code','x_t_code',false],
['x_member_code','x_member_code',false]]);

//-->
</script>
<?php } ?>
<?php
$subvcalculate_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($subvcalculate->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$subvcalculate_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csubvcalculate_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'subvcalculate';

	// Page object name
	var $PageObjName = 'subvcalculate_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subvcalculate;
		if ($subvcalculate->UseTokenInUrl) $PageUrl .= "t=" . $subvcalculate->TableVar . "&"; // Add page token
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
		global $objForm, $subvcalculate;
		if ($subvcalculate->UseTokenInUrl) {
			if ($objForm)
				return ($subvcalculate->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subvcalculate->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubvcalculate_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subvcalculate)
		if (!isset($GLOBALS["subvcalculate"])) {
			$GLOBALS["subvcalculate"] = new csubvcalculate();
			$GLOBALS["Table"] =& $GLOBALS["subvcalculate"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "subvcalculateadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "subvcalculatedelete.php";
		$this->MultiUpdateUrl = "subvcalculateupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subvcalculate', TRUE);

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
		global $subvcalculate;

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
			$subvcalculate->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$subvcalculate->Export = $_POST["exporttype"];
		} else {
			$subvcalculate->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $subvcalculate->Export; // Get export parameter, used in header
		$gsExportFile = $subvcalculate->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($subvcalculate->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($subvcalculate->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$subvcalculate->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $subvcalculate;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($subvcalculate->Export <> "" ||
				$subvcalculate->CurrentAction == "gridadd" ||
				$subvcalculate->CurrentAction == "gridedit") {
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
			$subvcalculate->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($subvcalculate->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $subvcalculate->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$subvcalculate->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$subvcalculate->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$subvcalculate->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $subvcalculate->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$subvcalculate->setSessionWhere($sFilter);
		$subvcalculate->CurrentFilter = "";

		// Export data only
		if (in_array($subvcalculate->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($subvcalculate->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $subvcalculate;
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
			$subvcalculate->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$subvcalculate->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $subvcalculate;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $subvcalculate->t_code, FALSE); // t_code
		$this->BuildSearchSql($sWhere, $subvcalculate->village_id, FALSE); // village_id
		$this->BuildSearchSql($sWhere, $subvcalculate->cal_type, FALSE); // cal_type
		$this->BuildSearchSql($sWhere, $subvcalculate->member_code, FALSE); // member_code
		$this->BuildSearchSql($sWhere, $subvcalculate->adv_num, FALSE); // adv_num
		$this->BuildSearchSql($sWhere, $subvcalculate->cal_detail, FALSE); // cal_detail
		$this->BuildSearchSql($sWhere, $subvcalculate->count_member, FALSE); // count_member
		$this->BuildSearchSql($sWhere, $subvcalculate->unit_rate, FALSE); // unit_rate
		$this->BuildSearchSql($sWhere, $subvcalculate->total, FALSE); // total
		$this->BuildSearchSql($sWhere, $subvcalculate->cal_status, FALSE); // cal_status
		$this->BuildSearchSql($sWhere, $subvcalculate->invoice_senddate, FALSE); // invoice_senddate
		$this->BuildSearchSql($sWhere, $subvcalculate->invoice_duedate, FALSE); // invoice_duedate
		$this->BuildSearchSql($sWhere, $subvcalculate->notice_senddate, FALSE); // notice_senddate
		$this->BuildSearchSql($sWhere, $subvcalculate->notice_duedate, FALSE); // notice_duedate

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($subvcalculate->t_code); // t_code
			$this->SetSearchParm($subvcalculate->village_id); // village_id
			$this->SetSearchParm($subvcalculate->cal_type); // cal_type
			$this->SetSearchParm($subvcalculate->member_code); // member_code
			$this->SetSearchParm($subvcalculate->adv_num); // adv_num
			$this->SetSearchParm($subvcalculate->cal_detail); // cal_detail
			$this->SetSearchParm($subvcalculate->count_member); // count_member
			$this->SetSearchParm($subvcalculate->unit_rate); // unit_rate
			$this->SetSearchParm($subvcalculate->total); // total
			$this->SetSearchParm($subvcalculate->cal_status); // cal_status
			$this->SetSearchParm($subvcalculate->invoice_senddate); // invoice_senddate
			$this->SetSearchParm($subvcalculate->invoice_duedate); // invoice_duedate
			$this->SetSearchParm($subvcalculate->notice_senddate); // notice_senddate
			$this->SetSearchParm($subvcalculate->notice_duedate); // notice_duedate
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
		global $subvcalculate;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$subvcalculate->setAdvancedSearch("x_$FldParm", $FldVal);
		$subvcalculate->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$subvcalculate->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$subvcalculate->setAdvancedSearch("y_$FldParm", $FldVal2);
		$subvcalculate->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $subvcalculate;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $subvcalculate->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $subvcalculate->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $subvcalculate->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $subvcalculate->getAdvancedSearch("w_$FldParm");
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
		global $subvcalculate;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$subvcalculate->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $subvcalculate;
		$subvcalculate->setAdvancedSearch("x_t_code", "");
		$subvcalculate->setAdvancedSearch("x_village_id", "");
		$subvcalculate->setAdvancedSearch("x_cal_type", "");
		$subvcalculate->setAdvancedSearch("x_member_code", "");
		$subvcalculate->setAdvancedSearch("x_adv_num", "");
		$subvcalculate->setAdvancedSearch("x_cal_detail", "");
		$subvcalculate->setAdvancedSearch("x_count_member", "");
		$subvcalculate->setAdvancedSearch("x_unit_rate", "");
		$subvcalculate->setAdvancedSearch("x_total", "");
		$subvcalculate->setAdvancedSearch("x_cal_status", "");
		$subvcalculate->setAdvancedSearch("x_invoice_senddate", "");
		$subvcalculate->setAdvancedSearch("x_invoice_duedate", "");
		$subvcalculate->setAdvancedSearch("x_notice_senddate", "");
		$subvcalculate->setAdvancedSearch("x_notice_duedate", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $subvcalculate;
		$bRestore = TRUE;
		if ($subvcalculate->t_code->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->village_id->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->cal_type->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->member_code->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->adv_num->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->cal_detail->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->count_member->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->unit_rate->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->total->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->cal_status->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->invoice_senddate->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->invoice_duedate->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->notice_senddate->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcalculate->notice_duedate->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($subvcalculate->t_code);
			$this->GetSearchParm($subvcalculate->village_id);
			$this->GetSearchParm($subvcalculate->cal_type);
			$this->GetSearchParm($subvcalculate->member_code);
			$this->GetSearchParm($subvcalculate->adv_num);
			$this->GetSearchParm($subvcalculate->cal_detail);
			$this->GetSearchParm($subvcalculate->count_member);
			$this->GetSearchParm($subvcalculate->unit_rate);
			$this->GetSearchParm($subvcalculate->total);
			$this->GetSearchParm($subvcalculate->cal_status);
			$this->GetSearchParm($subvcalculate->invoice_senddate);
			$this->GetSearchParm($subvcalculate->invoice_duedate);
			$this->GetSearchParm($subvcalculate->notice_senddate);
			$this->GetSearchParm($subvcalculate->notice_duedate);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $subvcalculate;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$subvcalculate->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$subvcalculate->CurrentOrderType = @$_GET["ordertype"];
			$subvcalculate->UpdateSort($subvcalculate->t_code); // t_code
			$subvcalculate->UpdateSort($subvcalculate->village_id); // village_id
			$subvcalculate->UpdateSort($subvcalculate->cal_type); // cal_type
			$subvcalculate->UpdateSort($subvcalculate->member_code); // member_code
			$subvcalculate->UpdateSort($subvcalculate->adv_num); // adv_num
			$subvcalculate->UpdateSort($subvcalculate->cal_detail); // cal_detail
			$subvcalculate->UpdateSort($subvcalculate->count_member); // count_member
			$subvcalculate->UpdateSort($subvcalculate->unit_rate); // unit_rate
			$subvcalculate->UpdateSort($subvcalculate->total); // total
			$subvcalculate->UpdateSort($subvcalculate->cal_status); // cal_status
			$subvcalculate->UpdateSort($subvcalculate->invoice_senddate); // invoice_senddate
			$subvcalculate->UpdateSort($subvcalculate->invoice_duedate); // invoice_duedate
			$subvcalculate->UpdateSort($subvcalculate->notice_senddate); // notice_senddate
			$subvcalculate->UpdateSort($subvcalculate->notice_duedate); // notice_duedate
			$subvcalculate->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $subvcalculate;
		$sOrderBy = $subvcalculate->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($subvcalculate->SqlOrderBy() <> "") {
				$sOrderBy = $subvcalculate->SqlOrderBy();
				$subvcalculate->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $subvcalculate;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$subvcalculate->setSessionOrderBy($sOrderBy);
				$subvcalculate->t_code->setSort("");
				$subvcalculate->village_id->setSort("");
				$subvcalculate->cal_type->setSort("");
				$subvcalculate->member_code->setSort("");
				$subvcalculate->adv_num->setSort("");
				$subvcalculate->cal_detail->setSort("");
				$subvcalculate->count_member->setSort("");
				$subvcalculate->unit_rate->setSort("");
				$subvcalculate->total->setSort("");
				$subvcalculate->cal_status->setSort("");
				$subvcalculate->invoice_senddate->setSort("");
				$subvcalculate->invoice_duedate->setSort("");
				$subvcalculate->notice_senddate->setSort("");
				$subvcalculate->notice_duedate->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$subvcalculate->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $subvcalculate;

		// "checkbox"
		$item =& $this->ListOptions->Add("checkbox");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"subvcalculate_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $subvcalculate, $objForm;
		$this->ListOptions->LoadDefault();

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($subvcalculate->svc_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $subvcalculate;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subvcalculate;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$subvcalculate->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$subvcalculate->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $subvcalculate->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$subvcalculate->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$subvcalculate->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$subvcalculate->setStartRecordNumber($this->StartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $subvcalculate;

		// Load search values
		// t_code

		$subvcalculate->t_code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_t_code"]);
		$subvcalculate->t_code->AdvancedSearch->SearchOperator = @$_GET["z_t_code"];

		// village_id
		$subvcalculate->village_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_village_id"]);
		$subvcalculate->village_id->AdvancedSearch->SearchOperator = @$_GET["z_village_id"];

		// cal_type
		$subvcalculate->cal_type->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_cal_type"]);
		$subvcalculate->cal_type->AdvancedSearch->SearchOperator = @$_GET["z_cal_type"];

		// member_code
		$subvcalculate->member_code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_member_code"]);
		$subvcalculate->member_code->AdvancedSearch->SearchOperator = @$_GET["z_member_code"];

		// adv_num
		$subvcalculate->adv_num->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_adv_num"]);
		$subvcalculate->adv_num->AdvancedSearch->SearchOperator = @$_GET["z_adv_num"];

		// cal_detail
		$subvcalculate->cal_detail->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_cal_detail"]);
		$subvcalculate->cal_detail->AdvancedSearch->SearchOperator = @$_GET["z_cal_detail"];

		// count_member
		$subvcalculate->count_member->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_count_member"]);
		$subvcalculate->count_member->AdvancedSearch->SearchOperator = @$_GET["z_count_member"];

		// unit_rate
		$subvcalculate->unit_rate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_unit_rate"]);
		$subvcalculate->unit_rate->AdvancedSearch->SearchOperator = @$_GET["z_unit_rate"];

		// cal_status
		$subvcalculate->cal_status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_cal_status"]);
		$subvcalculate->cal_status->AdvancedSearch->SearchOperator = @$_GET["z_cal_status"];
		
		
		// total
		$subvcalculate->total->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_total"]);
		$subvcalculate->total->AdvancedSearch->SearchOperator = @$_GET["z_total"];

			// cal_status
			if (strval($subvcalculate->cal_status->CurrentValue) <> "") {
				switch ($subvcalculate->cal_status->CurrentValue) {
					case "ส่งใบแจ้งหนี้":
						$subvcalculate->cal_status->ViewValue = $subvcalculate->cal_status->FldTagCaption(1) <> "" ? $subvcalculate->cal_status->FldTagCaption(1) : $subvcalculate->cal_status->CurrentValue;
						break;
					case "ส่งหนังสือเตือน":
						$subvcalculate->cal_status->ViewValue = $subvcalculate->cal_status->FldTagCaption(2) <> "" ? $subvcalculate->cal_status->FldTagCaption(2) : $subvcalculate->cal_status->CurrentValue;
						break;
					default:
						$subvcalculate->cal_status->ViewValue = $subvcalculate->cal_status->CurrentValue;
				}
			} else {
				$subvcalculate->cal_status->ViewValue = NULL;
			}
			$subvcalculate->cal_status->ViewCustomAttributes = "";

		// invoice_senddate
		$subvcalculate->invoice_senddate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_invoice_senddate"]);
		$subvcalculate->invoice_senddate->AdvancedSearch->SearchOperator = @$_GET["z_invoice_senddate"];

		// invoice_duedate
		$subvcalculate->invoice_duedate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_invoice_duedate"]);
		$subvcalculate->invoice_duedate->AdvancedSearch->SearchOperator = @$_GET["z_invoice_duedate"];

		// notice_senddate
		$subvcalculate->notice_senddate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_notice_senddate"]);
		$subvcalculate->notice_senddate->AdvancedSearch->SearchOperator = @$_GET["z_notice_senddate"];

		// notice_duedate
		$subvcalculate->notice_duedate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_notice_duedate"]);
		$subvcalculate->notice_duedate->AdvancedSearch->SearchOperator = @$_GET["z_notice_duedate"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subvcalculate;

		// Call Recordset Selecting event
		$subvcalculate->Recordset_Selecting($subvcalculate->CurrentFilter);

		// Load List page SQL
		$sSql = $subvcalculate->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subvcalculate->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subvcalculate;
		$sFilter = $subvcalculate->KeyFilter();

		// Call Row Selecting event
		$subvcalculate->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subvcalculate->CurrentFilter = $sFilter;
		$sSql = $subvcalculate->SQL();
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
		global $conn, $subvcalculate;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subvcalculate->Row_Selected($row);
		$subvcalculate->svc_id->setDbValue($rs->fields('svc_id'));
		$subvcalculate->t_code->setDbValue($rs->fields('t_code'));
		$subvcalculate->village_id->setDbValue($rs->fields('village_id'));
		$subvcalculate->cal_type->setDbValue($rs->fields('cal_type'));
		$subvcalculate->member_code->setDbValue($rs->fields('member_code'));
		$subvcalculate->adv_num->setDbValue($rs->fields('adv_num'));
		$subvcalculate->cal_detail->setDbValue($rs->fields('cal_detail'));
		$subvcalculate->count_member->setDbValue($rs->fields('count_member'));
		$subvcalculate->all_member->setDbValue($rs->fields('all_member'));
		$subvcalculate->unit_rate->setDbValue($rs->fields('unit_rate'));
		$subvcalculate->total->setDbValue($rs->fields('total'));
		$subvcalculate->cal_date->setDbValue($rs->fields('cal_date'));
		$subvcalculate->cal_status->setDbValue($rs->fields('cal_status'));
		$subvcalculate->invoice_senddate->setDbValue($rs->fields('invoice_senddate'));
		$subvcalculate->invoice_duedate->setDbValue($rs->fields('invoice_duedate'));
		$subvcalculate->notice_senddate->setDbValue($rs->fields('notice_senddate'));
		$subvcalculate->notice_duedate->setDbValue($rs->fields('notice_duedate'));
	}

	// Load old record
	function LoadOldRecord() {
		global $subvcalculate;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($subvcalculate->getKey("svc_id")) <> "")
			$subvcalculate->svc_id->CurrentValue = $subvcalculate->getKey("svc_id"); // svc_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$subvcalculate->CurrentFilter = $subvcalculate->KeyFilter();
			$sSql = $subvcalculate->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subvcalculate;

		// Initialize URLs
		$this->ViewUrl = $subvcalculate->ViewUrl();
		$this->EditUrl = $subvcalculate->EditUrl();
		$this->InlineEditUrl = $subvcalculate->InlineEditUrl();
		$this->CopyUrl = $subvcalculate->CopyUrl();
		$this->InlineCopyUrl = $subvcalculate->InlineCopyUrl();
		$this->DeleteUrl = $subvcalculate->DeleteUrl();

		// Call Row_Rendering event
		$subvcalculate->Row_Rendering();

		// Common render codes for all row types
		// svc_id

		$subvcalculate->svc_id->CellCssStyle = "white-space: nowrap;";

		// t_code
		$subvcalculate->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$subvcalculate->village_id->CellCssStyle = "white-space: nowrap;";

		// cal_type
		$subvcalculate->cal_type->CellCssStyle = "white-space: nowrap;";

		// member_code
		$subvcalculate->member_code->CellCssStyle = "white-space: nowrap;";

		// adv_num
		$subvcalculate->adv_num->CellCssStyle = "white-space: nowrap;";

		// cal_detail
		$subvcalculate->cal_detail->CellCssStyle = "white-space: nowrap;";

		// count_member
		$subvcalculate->count_member->CellCssStyle = "white-space: nowrap;";

		// all_member
		$subvcalculate->all_member->CellCssStyle = "white-space: nowrap;";

		// unit_rate
		$subvcalculate->unit_rate->CellCssStyle = "white-space: nowrap;";

		// total
		$subvcalculate->total->CellCssStyle = "white-space: nowrap;";

		// cal_date
		$subvcalculate->cal_date->CellCssStyle = "white-space: nowrap;";

		// cal_status
		$subvcalculate->cal_status->CellCssStyle = "white-space: nowrap;";

		// invoice_senddate
		// invoice_duedate
		// notice_senddate
		// notice_duedate
		// Accumulate aggregate value

		if ($subvcalculate->RowType <> EW_ROWTYPE_AGGREGATEINIT && $subvcalculate->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($subvcalculate->count_member->CurrentValue))
				$subvcalculate->count_member->Total += $subvcalculate->count_member->CurrentValue; // Accumulate total
			if (is_numeric($subvcalculate->total->CurrentValue))
				$subvcalculate->total->Total += $subvcalculate->total->CurrentValue; // Accumulate total
		}
		if ($subvcalculate->RowType == EW_ROWTYPE_VIEW) { // View row

			// t_code
			if (strval($subvcalculate->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($subvcalculate->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->t_code->ViewValue = $rswrk->fields('t_code');
					$subvcalculate->t_code->ViewValue .= ew_ValueSeparator(0,1,$subvcalculate->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$subvcalculate->t_code->ViewValue = $subvcalculate->t_code->CurrentValue;
				}
			} else {
				$subvcalculate->t_code->ViewValue = NULL;
			}
			$subvcalculate->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($subvcalculate->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($subvcalculate->village_id->CurrentValue) . "";
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
					$subvcalculate->village_id->ViewValue = $rswrk->fields('v_code');
					$subvcalculate->village_id->ViewValue .= ew_ValueSeparator(0,1,$subvcalculate->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$subvcalculate->village_id->ViewValue = $subvcalculate->village_id->CurrentValue;
				}
			} else {
				$subvcalculate->village_id->ViewValue = NULL;
			}
			$subvcalculate->village_id->ViewCustomAttributes = "";

			// cal_type
			if (strval($subvcalculate->cal_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($subvcalculate->cal_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->cal_type->ViewValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$subvcalculate->cal_type->ViewValue = $subvcalculate->cal_type->CurrentValue;
				}
			} else {
				$subvcalculate->cal_type->ViewValue = NULL;
			}
			$subvcalculate->cal_type->ViewCustomAttributes = "";

			// member_code
			if (strval($subvcalculate->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcalculate->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต'";
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
					$subvcalculate->member_code->ViewValue = $rswrk->fields('dead_id');
					$subvcalculate->member_code->ViewValue .= ew_ValueSeparator(0,1,$subvcalculate->member_code) . $rswrk->fields('fname');
					$subvcalculate->member_code->ViewValue .= ew_ValueSeparator(0,2,$subvcalculate->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcalculate->member_code->ViewValue = $subvcalculate->member_code->CurrentValue;
				}
			} else {
				$subvcalculate->member_code->ViewValue = NULL;
			}
			$subvcalculate->member_code->ViewCustomAttributes = "";

			// adv_num
			$subvcalculate->adv_num->ViewValue = $subvcalculate->adv_num->CurrentValue;
			$subvcalculate->adv_num->ViewCustomAttributes = "";

			// cal_detail
			$subvcalculate->cal_detail->ViewValue = $subvcalculate->cal_detail->CurrentValue;
			$subvcalculate->cal_detail->ViewCustomAttributes = "";

			// count_member
			$subvcalculate->count_member->ViewValue = $subvcalculate->count_member->CurrentValue;
			$subvcalculate->count_member->ViewCustomAttributes = "";

			// unit_rate
			$subvcalculate->unit_rate->ViewValue = $subvcalculate->unit_rate->CurrentValue;
			$subvcalculate->unit_rate->ViewCustomAttributes = "";

			// total
			$subvcalculate->total->ViewValue = $subvcalculate->total->CurrentValue;
			$subvcalculate->total->ViewCustomAttributes = "";

			// cal_status
			$subvcalculate->cal_status->ViewValue = $subvcalculate->cal_status->CurrentValue;
			$subvcalculate->cal_status->ViewCustomAttributes = "";

			// invoice_senddate
			$subvcalculate->invoice_senddate->ViewValue = $subvcalculate->invoice_senddate->CurrentValue;
			$subvcalculate->invoice_senddate->ViewValue = ew_FormatDateTime($subvcalculate->invoice_senddate->ViewValue, 7);
			$subvcalculate->invoice_senddate->ViewCustomAttributes = "";

			// invoice_duedate
			$subvcalculate->invoice_duedate->ViewValue = $subvcalculate->invoice_duedate->CurrentValue;
			$subvcalculate->invoice_duedate->ViewValue = ew_FormatDateTime($subvcalculate->invoice_duedate->ViewValue, 7);
			$subvcalculate->invoice_duedate->ViewCustomAttributes = "";

			// notice_senddate
			$subvcalculate->notice_senddate->ViewValue = $subvcalculate->notice_senddate->CurrentValue;
			$subvcalculate->notice_senddate->ViewValue = ew_FormatDateTime($subvcalculate->notice_senddate->ViewValue, 7);
			$subvcalculate->notice_senddate->ViewCustomAttributes = "";

			// notice_duedate
			$subvcalculate->notice_duedate->ViewValue = $subvcalculate->notice_duedate->CurrentValue;
			$subvcalculate->notice_duedate->ViewValue = ew_FormatDateTime($subvcalculate->notice_duedate->ViewValue, 7);
			$subvcalculate->notice_duedate->ViewCustomAttributes = "";

			// t_code
			$subvcalculate->t_code->LinkCustomAttributes = "";
			$subvcalculate->t_code->HrefValue = "";
			$subvcalculate->t_code->TooltipValue = "";

			// village_id
			$subvcalculate->village_id->LinkCustomAttributes = "";
			$subvcalculate->village_id->HrefValue = "";
			$subvcalculate->village_id->TooltipValue = "";

			// cal_type
			$subvcalculate->cal_type->LinkCustomAttributes = "";
			$subvcalculate->cal_type->HrefValue = "";
			$subvcalculate->cal_type->TooltipValue = "";

			// member_code
			$subvcalculate->member_code->LinkCustomAttributes = "";
			$subvcalculate->member_code->HrefValue = "";
			$subvcalculate->member_code->TooltipValue = "";

			// adv_num
			$subvcalculate->adv_num->LinkCustomAttributes = "";
			$subvcalculate->adv_num->HrefValue = "";
			$subvcalculate->adv_num->TooltipValue = "";

			// cal_detail
			$subvcalculate->cal_detail->LinkCustomAttributes = "";
			$subvcalculate->cal_detail->HrefValue = "";
			$subvcalculate->cal_detail->TooltipValue = "";

			// count_member
			$subvcalculate->count_member->LinkCustomAttributes = "";
			$subvcalculate->count_member->HrefValue = "";
			$subvcalculate->count_member->TooltipValue = "";

			// unit_rate
			$subvcalculate->unit_rate->LinkCustomAttributes = "";
			$subvcalculate->unit_rate->HrefValue = "";
			$subvcalculate->unit_rate->TooltipValue = "";

			// total
			$subvcalculate->total->LinkCustomAttributes = "";
			$subvcalculate->total->HrefValue = "";
			$subvcalculate->total->TooltipValue = "";

			// cal_status
			$subvcalculate->cal_status->LinkCustomAttributes = "";
			$subvcalculate->cal_status->HrefValue = "";
			$subvcalculate->cal_status->TooltipValue = "";

			// invoice_senddate
			$subvcalculate->invoice_senddate->LinkCustomAttributes = "";
			$subvcalculate->invoice_senddate->HrefValue = "";
			$subvcalculate->invoice_senddate->TooltipValue = "";

			// invoice_duedate
			$subvcalculate->invoice_duedate->LinkCustomAttributes = "";
			$subvcalculate->invoice_duedate->HrefValue = "";
			$subvcalculate->invoice_duedate->TooltipValue = "";

			// notice_senddate
			$subvcalculate->notice_senddate->LinkCustomAttributes = "";
			$subvcalculate->notice_senddate->HrefValue = "";
			$subvcalculate->notice_senddate->TooltipValue = "";

			// notice_duedate
			$subvcalculate->notice_duedate->LinkCustomAttributes = "";
			$subvcalculate->notice_duedate->HrefValue = "";
			$subvcalculate->notice_duedate->TooltipValue = "";
		} elseif ($subvcalculate->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// t_code
			$subvcalculate->t_code->EditCustomAttributes = "";
			if (trim(strval($subvcalculate->t_code->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($subvcalculate->t_code->AdvancedSearch->SearchValue) . "'";
			}
			$sSqlWrk = "SELECT `t_code`, `t_code` AS `DispFld`, `t_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$subvcalculate->t_code->EditValue = $arwrk;

			// village_id
			$subvcalculate->village_id->EditCustomAttributes = "";
			if (trim(strval($subvcalculate->village_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($subvcalculate->village_id->AdvancedSearch->SearchValue) . "";
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
			$subvcalculate->village_id->EditValue = $arwrk;

			// cal_type
			$subvcalculate->cal_type->EditCustomAttributes = 'onchange=showcalculatefield(this.options[this.selectedIndex].value);';
				$sFilterWrk = "";
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
			$subvcalculate->cal_type->EditValue = $arwrk;

			// member_code
			$subvcalculate->member_code->EditCustomAttributes = "";
			if (trim(strval($subvcalculate->member_code->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcalculate->member_code->AdvancedSearch->SearchValue) . "'";
			}
			$sSqlWrk = "SELECT `member_code`, `dead_id` AS `DispFld`, `fname` AS `Disp2Fld`, `lname` AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต'";
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
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", ""));
			$subvcalculate->member_code->EditValue = $arwrk;

			// adv_num
			$subvcalculate->adv_num->EditCustomAttributes = "";
			$subvcalculate->adv_num->EditValue = ew_HtmlEncode($subvcalculate->adv_num->AdvancedSearch->SearchValue);

			// cal_detail
			$subvcalculate->cal_detail->EditCustomAttributes = "";
			$subvcalculate->cal_detail->EditValue = ew_HtmlEncode($subvcalculate->cal_detail->AdvancedSearch->SearchValue);

			// count_member
			$subvcalculate->count_member->EditCustomAttributes = "";
			$subvcalculate->count_member->EditValue = ew_HtmlEncode($subvcalculate->count_member->AdvancedSearch->SearchValue);

			// unit_rate
			$subvcalculate->unit_rate->EditCustomAttributes = "";
			$subvcalculate->unit_rate->EditValue = ew_HtmlEncode($subvcalculate->unit_rate->AdvancedSearch->SearchValue);

			// total
			$subvcalculate->total->EditCustomAttributes = "";
			$subvcalculate->total->EditValue = ew_HtmlEncode($subvcalculate->total->AdvancedSearch->SearchValue);

			// cal_status
			$subvcalculate->cal_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("ส่งใบแจ้งหนี้", $subvcalculate->cal_status->FldTagCaption(1) <> "" ? $subvcalculate->cal_status->FldTagCaption(1) : "ส่งใบแจ้งหนี้");
			$arwrk[] = array("ส่งหนังสือเตือน", $subvcalculate->cal_status->FldTagCaption(2) <> "" ? $subvcalculate->cal_status->FldTagCaption(2) : "ส่งหนังสือเตือน");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$subvcalculate->cal_status->EditValue = $arwrk;

			// invoice_senddate
			$subvcalculate->invoice_senddate->EditCustomAttributes = "";
			$subvcalculate->invoice_senddate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($subvcalculate->invoice_senddate->AdvancedSearch->SearchValue, 7), 7));

			// invoice_duedate
			$subvcalculate->invoice_duedate->EditCustomAttributes = "";
			$subvcalculate->invoice_duedate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($subvcalculate->invoice_duedate->AdvancedSearch->SearchValue, 7), 7));

			// notice_senddate
			$subvcalculate->notice_senddate->EditCustomAttributes = "";
			$subvcalculate->notice_senddate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($subvcalculate->notice_senddate->AdvancedSearch->SearchValue, 7), 7));

			// notice_duedate
			$subvcalculate->notice_duedate->EditCustomAttributes = "";
			$subvcalculate->notice_duedate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($subvcalculate->notice_duedate->AdvancedSearch->SearchValue, 7), 7));
		} elseif ($subvcalculate->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$subvcalculate->count_member->Total = 0; // Initialize total
			$subvcalculate->total->Total = 0; // Initialize total
		} elseif ($subvcalculate->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$subvcalculate->count_member->CurrentValue = $subvcalculate->count_member->Total;
			$subvcalculate->count_member->ViewValue = $subvcalculate->count_member->CurrentValue;
			$subvcalculate->count_member->ViewCustomAttributes = "";
			$subvcalculate->count_member->HrefValue = ""; // Clear href value
			$subvcalculate->total->CurrentValue = $subvcalculate->total->Total;
			$subvcalculate->total->ViewValue = $subvcalculate->total->CurrentValue;
			$subvcalculate->total->ViewCustomAttributes = "";
			$subvcalculate->total->HrefValue = ""; // Clear href value
		}
		if ($subvcalculate->RowType == EW_ROWTYPE_ADD ||
			$subvcalculate->RowType == EW_ROWTYPE_EDIT ||
			$subvcalculate->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$subvcalculate->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($subvcalculate->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subvcalculate->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $subvcalculate;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($subvcalculate->adv_num->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $subvcalculate->adv_num->FldErrMsg());
		}

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
		global $subvcalculate;
		$subvcalculate->t_code->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_t_code");
		$subvcalculate->village_id->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_village_id");
		$subvcalculate->cal_type->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_cal_type");
		$subvcalculate->member_code->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_member_code");
		$subvcalculate->adv_num->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_adv_num");
		$subvcalculate->cal_detail->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_cal_detail");
		$subvcalculate->count_member->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_count_member");
		$subvcalculate->unit_rate->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_unit_rate");
		$subvcalculate->total->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_total");
		$subvcalculate->cal_status->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_cal_status");
		$subvcalculate->invoice_senddate->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_invoice_senddate");
		$subvcalculate->invoice_duedate->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_invoice_duedate");
		$subvcalculate->notice_senddate->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_notice_senddate");
		$subvcalculate->notice_duedate->AdvancedSearch->SearchValue = $subvcalculate->getAdvancedSearch("x_notice_duedate");
	}


	// Set up export options
	function SetupExportOptions() {
		global $Language, $subvcalculate;

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
		$item->Body = "<a name=\"emf_subvcalculate\" id=\"emf_subvcalculate\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_subvcalculate',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fsubvcalculatelist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($subvcalculate->Export <> "" ||
			$subvcalculate->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $subvcalculate;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $subvcalculate->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($subvcalculate->ExportAll) {
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
		if ($subvcalculate->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($subvcalculate, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($subvcalculate->Export == "xml") {
			$subvcalculate->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$subvcalculate->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($subvcalculate->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($subvcalculate->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($subvcalculate->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($subvcalculate->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($subvcalculate->ExportReturnUrl());
		} elseif ($subvcalculate->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
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
   // $url = "subvcalculateadd.php";
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

		    function ListOptions_Load() {

		// Example:
		$opt =& $this->ListOptions->Add("notpaylist");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(1); // Move to first column
	//    $opt2=& $this->ListOptions->Add("notice");
	//    $opt2->Header = "";
	//    $opt2->OnLeft = TRUE; // Link on left
	//    $opt2->MoveTo(2); // Move to first column    
		

	}

									 


		    // ListOptions Rendered event
	function ListOptions_Rendered() {
		global $subvcalculate;
		global $Language;  
		// Example:                                                                                                           
	   $this->ListOptions->Items["notpaylist"]->Body = "<a href='notpaylist.php?id=".$subvcalculate->svc_id->CurrentValue."'>".$Language->Phrase("View")."</a>";
	  //  $this->ListOptions->Items["notice"]->Body = "<a href='notpaylist.php?id=".$subvcalculate->svc_id->CurrentValue."'>ชำระทั้งหมด</a>";
	
	}                                                                                                    

}
?>
