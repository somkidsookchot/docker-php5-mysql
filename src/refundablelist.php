<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "refundableinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$refundable_list = new crefundable_list();
$Page =& $refundable_list;

// Page init
$refundable_list->Page_Init();

// Page main
$refundable_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($refundable->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var refundable_list = new ew_Page("refundable_list");

// page properties
refundable_list.PageID = "list"; // page ID
refundable_list.FormID = "frefundablelist"; // form ID
var EW_PAGE_ID = refundable_list.PageID; // for backward compatibility

// extend page with validate function for search
refundable_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_refund_slipt_num"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($refundable->refund_slipt_num->FldErrMsg()) ?>");

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
refundable_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
refundable_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
refundable_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
refundable_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<?php if (($refundable->Export == "") || (EW_EXPORT_MASTER_RECORD && $refundable->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$refundable_list->TotalRecs = $refundable->SelectRecordCount();
	} else {
		if ($refundable_list->Recordset = $refundable_list->LoadRecordset())
			$refundable_list->TotalRecs = $refundable_list->Recordset->RecordCount();
	}
	$refundable_list->StartRec = 1;
	if ($refundable_list->DisplayRecs <= 0 || ($refundable->Export <> "" && $refundable->ExportAll)) // Display all records
		$refundable_list->DisplayRecs = $refundable_list->TotalRecs;
	if (!($refundable->Export <> "" && $refundable->ExportAll))
		$refundable_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$refundable_list->Recordset = $refundable_list->LoadRecordset($refundable_list->StartRec-1, $refundable_list->DisplayRecs);
?>
<div class="phpmaker ewTitle" style="white-space: nowrap;"><img src="images/finance55x55.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $refundable->TableCaption() ?>
&nbsp;&nbsp; </div>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($refundable->Export == "" && $refundable->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(refundable_list);" style="text-decoration: none;"><img id="refundable_list_SearchImage" src="phpimages/collapse.png" alt=""  border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="refundable_list_SearchPanel" class="listSearch">
<form name="frefundablelistsrch" id="frefundablelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return refundable_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="refundable">
<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$refundable_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$refundable->RowType = EW_ROWTYPE_SEARCH;

// Render row
$refundable->ResetAttrs();
$refundable_list->RenderRow();
?>
<span id="xsc_member_code" class="ewCssTableCell">
	  <span class="ewSearchCaption"><?php echo $refundable->member_code->FldCaption() ?></span>
	  <span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_member_code" id="z_member_code" value="LIKE"></span>
	  <span class="ewSearchField">
<span id="as_x_member_code" style="white-space: nowrap; z-index: 8980">
	<input type="text" name="sv_x_member_code" id="sv_x_member_code" value="<?php echo $refundable->member_code->EditValue ?>" size="30" maxlength="100"<?php echo $refundable->member_code->EditAttributes() ?>><span id="em_x_member_code" class="ewMessage" style="display: none"><?php echo str_replace("%f", "phpimages/", $Language->Phrase("UnmatchedValue")) ?></span>
	<div id="sc_x_member_code" style="z-index: 8980"></div>
</span>
<input type="hidden" name="x_member_code" id="x_member_code" value="<?php echo $refundable->member_code->AdvancedSearch->SearchValue ?>">
<?php
$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
$sWhereWrk = "`member_code`  LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_member_code" id="s_x_member_code" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_member_code = new ew_AutoSuggest("sv_x_member_code", "sc_x_member_code", "s_x_member_code", "em_x_member_code", "x_member_code", "", false, EW_AUTO_SUGGEST_MAX_ENTRIES);
oas_x_member_code.formatResult = function(ar) {	
	var df1 = ar[0];
	var df2 = ar[1];
	if (df2 != "")
		df1 += EW_FIELD_SEP + df2;
	var df3 = ar[2];
	if (df3 != "")
		df1 += EW_FIELD_SEP + df3;
	return df1;
};
oas_x_member_code.ac.typeAhead = false;

//-->
</script>
</span>
	</span>
<span id="xsc_refund_status" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $refundable->refund_status->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_refund_status" id="z_refund_status" value="LIKE"></span>
		<span class="ewSearchField">
<select id="x_refund_status" name="x_refund_status"<?php echo $refundable->refund_status->EditAttributes() ?>>
<?php
if (is_array($refundable->refund_status->EditValue)) {
	$arwrk = $refundable->refund_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($refundable->refund_status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<span id="xsc_refund_slipt_num" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $refundable->refund_slipt_num->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_refund_slipt_num" id="z_refund_slipt_num" value="="></span>
		<span class="ewSearchField">
<input type="text" name="x_refund_slipt_num" id="x_refund_slipt_num" size="30" value="<?php echo $refundable->refund_slipt_num->EditValue ?>"<?php echo $refundable->refund_slipt_num->EditAttributes() ?>>
</span>
	</span>

<div id="xsr_4" class="ewCssTableRow">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $refundable_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $refundable_list->ShowPageHeader(); ?>
<?php
$refundable_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($refundable->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($refundable->CurrentAction <> "gridadd" && $refundable->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($refundable_list->Pager)) $refundable_list->Pager = new cPrevNextPager($refundable_list->StartRec, $refundable_list->DisplayRecs, $refundable_list->TotalRecs) ?>
<?php if ($refundable_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($refundable_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_list->PageUrl() ?>start=<?php echo $refundable_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($refundable_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_list->PageUrl() ?>start=<?php echo $refundable_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $refundable_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($refundable_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_list->PageUrl() ?>start=<?php echo $refundable_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($refundable_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_list->PageUrl() ?>start=<?php echo $refundable_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $refundable_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $refundable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $refundable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $refundable_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($refundable_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($refundable_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="refundable">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($refundable_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($refundable_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($refundable_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($refundable_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($refundable_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($refundable_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($refundable_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($refundable_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($refundable_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($refundable->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($refundable_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.frefundablelist, '<?php echo $refundable_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="frefundablelist" id="frefundablelist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="refundable">
<div id="gmp_refundable" class="ewGridMiddlePanel">
<?php if ($refundable_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $refundable->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$refundable_list->RenderListOptions();

// Render list options (header, left)
$refundable_list->ListOptions->Render("header", "left");
?>
<?php if ($refundable->member_code->Visible) { // member_code ?>
	<?php if ($refundable->SortUrl($refundable->member_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $refundable->member_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $refundable->SortUrl($refundable->member_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $refundable->member_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($refundable->member_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($refundable->member_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($refundable->refund_total->Visible) { // refund_total ?>
	<?php if ($refundable->SortUrl($refundable->refund_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $refundable->refund_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $refundable->SortUrl($refundable->refund_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $refundable->refund_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($refundable->refund_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($refundable->refund_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($refundable->assc_percent->Visible) { // assc_percent ?>
	<?php if ($refundable->SortUrl($refundable->assc_percent) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $refundable->assc_percent->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $refundable->SortUrl($refundable->assc_percent) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $refundable->assc_percent->FldCaption() ?></td><td style="width: 10px;"><?php if ($refundable->assc_percent->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($refundable->assc_percent->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($refundable->assc_total->Visible) { // assc_total ?>
	<?php if ($refundable->SortUrl($refundable->assc_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $refundable->assc_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $refundable->SortUrl($refundable->assc_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $refundable->assc_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($refundable->assc_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($refundable->assc_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($refundable->sub_total->Visible) { // sub_total ?>
	<?php if ($refundable->SortUrl($refundable->sub_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $refundable->sub_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $refundable->SortUrl($refundable->sub_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $refundable->sub_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($refundable->sub_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($refundable->sub_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($refundable->refund_status->Visible) { // refund_status ?>
	<?php if ($refundable->SortUrl($refundable->refund_status) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $refundable->refund_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $refundable->SortUrl($refundable->refund_status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $refundable->refund_status->FldCaption() ?></td><td style="width: 10px;"><?php if ($refundable->refund_status->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($refundable->refund_status->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($refundable->pay_date->Visible) { // pay_date ?>
	<?php if ($refundable->SortUrl($refundable->pay_date) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $refundable->pay_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $refundable->SortUrl($refundable->pay_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $refundable->pay_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($refundable->pay_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($refundable->pay_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($refundable->refund_slipt_num->Visible) { // refund_slipt_num ?>
	<?php if ($refundable->SortUrl($refundable->refund_slipt_num) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $refundable->refund_slipt_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $refundable->SortUrl($refundable->refund_slipt_num) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $refundable->refund_slipt_num->FldCaption() ?></td><td style="width: 10px;"><?php if ($refundable->refund_slipt_num->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($refundable->refund_slipt_num->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$refundable_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($refundable->ExportAll && $refundable->Export <> "") {
	$refundable_list->StopRec = $refundable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($refundable_list->TotalRecs > $refundable_list->StartRec + $refundable_list->DisplayRecs - 1)
		$refundable_list->StopRec = $refundable_list->StartRec + $refundable_list->DisplayRecs - 1;
	else
		$refundable_list->StopRec = $refundable_list->TotalRecs;
}
$refundable_list->RecCnt = $refundable_list->StartRec - 1;
if ($refundable_list->Recordset && !$refundable_list->Recordset->EOF) {
	$refundable_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $refundable_list->StartRec > 1)
		$refundable_list->Recordset->Move($refundable_list->StartRec - 1);
} elseif (!$refundable->AllowAddDeleteRow && $refundable_list->StopRec == 0) {
	$refundable_list->StopRec = $refundable->GridAddRowCount;
}

// Initialize aggregate
$refundable->RowType = EW_ROWTYPE_AGGREGATEINIT;
$refundable->ResetAttrs();
$refundable_list->RenderRow();
$refundable_list->RowCnt = 0;
while ($refundable_list->RecCnt < $refundable_list->StopRec) {
	$refundable_list->RecCnt++;
	if (intval($refundable_list->RecCnt) >= intval($refundable_list->StartRec)) {
		$refundable_list->RowCnt++;

		// Set up key count
		$refundable_list->KeyCount = $refundable_list->RowIndex;

		// Init row class and style
		$refundable->ResetAttrs();
		$refundable->CssClass = "";
		if ($refundable->CurrentAction == "gridadd") {
		} else {
			$refundable_list->LoadRowValues($refundable_list->Recordset); // Load row values
		}
		$refundable->RowType = EW_ROWTYPE_VIEW; // Render view
		$refundable->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$refundable_list->RenderRow();

		// Render list options
		$refundable_list->RenderListOptions();
?>
	<tr<?php echo $refundable->RowAttributes() ?>>
<?php

// Render list options (body, left)
$refundable_list->ListOptions->Render("body", "left");
?>
	<?php if ($refundable->member_code->Visible) { // member_code ?>
		<td<?php echo $refundable->member_code->CellAttributes() ?>>
<div<?php echo $refundable->member_code->ViewAttributes() ?>><?php echo $refundable->member_code->ListViewValue() ?></div>
<a name="<?php echo $refundable_list->PageObjName . "_row_" . $refundable_list->RowCnt ?>" id="<?php echo $refundable_list->PageObjName . "_row_" . $refundable_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($refundable->refund_total->Visible) { // refund_total ?>
		<td<?php echo $refundable->refund_total->CellAttributes() ?>>
<div<?php echo $refundable->refund_total->ViewAttributes() ?>><?php echo $refundable->refund_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($refundable->assc_percent->Visible) { // assc_percent ?>
		<td<?php echo $refundable->assc_percent->CellAttributes() ?>>
<div<?php echo $refundable->assc_percent->ViewAttributes() ?>><?php echo $refundable->assc_percent->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($refundable->assc_total->Visible) { // assc_total ?>
		<td<?php echo $refundable->assc_total->CellAttributes() ?>>
<div<?php echo $refundable->assc_total->ViewAttributes() ?>><?php echo $refundable->assc_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($refundable->sub_total->Visible) { // sub_total ?>
		<td<?php echo $refundable->sub_total->CellAttributes() ?>>
<div<?php echo $refundable->sub_total->ViewAttributes() ?>><?php echo $refundable->sub_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($refundable->refund_status->Visible) { // refund_status ?>
		<td<?php echo $refundable->refund_status->CellAttributes() ?>>
<div<?php echo $refundable->refund_status->ViewAttributes() ?>><?php echo $refundable->refund_status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($refundable->pay_date->Visible) { // pay_date ?>
		<td<?php echo $refundable->pay_date->CellAttributes() ?>>
<div<?php echo $refundable->pay_date->ViewAttributes() ?>><?php echo $refundable->pay_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($refundable->refund_slipt_num->Visible) { // refund_slipt_num ?>
		<td<?php echo $refundable->refund_slipt_num->CellAttributes() ?>>
<div<?php echo $refundable->refund_slipt_num->ViewAttributes() ?>><?php echo $refundable->refund_slipt_num->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$refundable_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($refundable->CurrentAction <> "gridadd")
		$refundable_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($refundable_list->Recordset)
	$refundable_list->Recordset->Close();
?>
<?php if ($refundable_list->TotalRecs > 0) { ?>
<?php if ($refundable->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($refundable->CurrentAction <> "gridadd" && $refundable->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($refundable_list->Pager)) $refundable_list->Pager = new cPrevNextPager($refundable_list->StartRec, $refundable_list->DisplayRecs, $refundable_list->TotalRecs) ?>
<?php if ($refundable_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($refundable_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_list->PageUrl() ?>start=<?php echo $refundable_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($refundable_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_list->PageUrl() ?>start=<?php echo $refundable_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $refundable_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($refundable_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_list->PageUrl() ?>start=<?php echo $refundable_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($refundable_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_list->PageUrl() ?>start=<?php echo $refundable_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $refundable_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $refundable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $refundable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $refundable_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($refundable_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($refundable_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="refundable">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($refundable_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($refundable_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($refundable_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($refundable_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($refundable_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($refundable_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($refundable_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($refundable_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($refundable_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($refundable->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($refundable_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.frefundablelist, '<?php echo $refundable_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($refundable->Export == "" && $refundable->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(refundable_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$refundable_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($refundable->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$refundable_list->Page_Terminate();
?>
<?php

//
// Page class
//
class crefundable_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'refundable';

	// Page object name
	var $PageObjName = 'refundable_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $refundable;
		if ($refundable->UseTokenInUrl) $PageUrl .= "t=" . $refundable->TableVar . "&"; // Add page token
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
		global $objForm, $refundable;
		if ($refundable->UseTokenInUrl) {
			if ($objForm)
				return ($refundable->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($refundable->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crefundable_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (refundable)
		if (!isset($GLOBALS["refundable"])) {
			$GLOBALS["refundable"] = new crefundable();
			$GLOBALS["Table"] =& $GLOBALS["refundable"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "refundableadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "refundabledelete.php";
		$this->MultiUpdateUrl = "refundableupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'refundable', TRUE);

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
		global $refundable;

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
			$refundable->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$refundable->Export = $_POST["exporttype"];
		} else {
			$refundable->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $refundable->Export; // Get export parameter, used in header
		$gsExportFile = $refundable->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($refundable->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($refundable->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$refundable->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $refundable;

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
			if ($refundable->Export <> "" ||
				$refundable->CurrentAction == "gridadd" ||
				$refundable->CurrentAction == "gridedit") {
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
			$refundable->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($refundable->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $refundable->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$refundable->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$refundable->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$refundable->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $refundable->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$refundable->setSessionWhere($sFilter);
		$refundable->CurrentFilter = "";

		// Export data only
		if (in_array($refundable->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($refundable->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $refundable;
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
			$refundable->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$refundable->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $refundable;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $refundable->member_code, FALSE); // member_code
		$this->BuildSearchSql($sWhere, $refundable->refund_status, FALSE); // refund_status
		$this->BuildSearchSql($sWhere, $refundable->refund_slipt_num, FALSE); // refund_slipt_num

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($refundable->member_code); // member_code
			$this->SetSearchParm($refundable->refund_status); // refund_status
			$this->SetSearchParm($refundable->refund_slipt_num); // refund_slipt_num
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
		global $refundable;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$refundable->setAdvancedSearch("x_$FldParm", $FldVal);
		$refundable->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$refundable->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$refundable->setAdvancedSearch("y_$FldParm", $FldVal2);
		$refundable->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $refundable;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $refundable->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $refundable->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $refundable->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $refundable->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $refundable->getAdvancedSearch("w_$FldParm");
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
		global $refundable;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$refundable->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $refundable;
		$refundable->setAdvancedSearch("x_member_code", "");
		$refundable->setAdvancedSearch("x_refund_status", "");
		$refundable->setAdvancedSearch("x_refund_slipt_num", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $refundable;
		$bRestore = TRUE;
		if ($refundable->member_code->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($refundable->refund_status->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($refundable->refund_slipt_num->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($refundable->member_code);
			$this->GetSearchParm($refundable->refund_status);
			$this->GetSearchParm($refundable->refund_slipt_num);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $refundable;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$refundable->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$refundable->CurrentOrderType = @$_GET["ordertype"];
			$refundable->UpdateSort($refundable->member_code); // member_code
			$refundable->UpdateSort($refundable->refund_total); // refund_total
			$refundable->UpdateSort($refundable->assc_percent); // assc_percent
			$refundable->UpdateSort($refundable->assc_total); // assc_total
			$refundable->UpdateSort($refundable->sub_total); // sub_total
			$refundable->UpdateSort($refundable->refund_status); // refund_status
			$refundable->UpdateSort($refundable->pay_date); // pay_date
			$refundable->UpdateSort($refundable->refund_slipt_num); // refund_slipt_num
			$refundable->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $refundable;
		$sOrderBy = $refundable->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($refundable->SqlOrderBy() <> "") {
				$sOrderBy = $refundable->SqlOrderBy();
				$refundable->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $refundable;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$refundable->setSessionOrderBy($sOrderBy);
				$refundable->member_code->setSort("");
				$refundable->refund_total->setSort("");
				$refundable->assc_percent->setSort("");
				$refundable->assc_total->setSort("");
				$refundable->sub_total->setSort("");
				$refundable->refund_status->setSort("");
				$refundable->pay_date->setSort("");
				$refundable->refund_slipt_num->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$refundable->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $refundable;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"refundable_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $refundable, $objForm;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($refundable->refund_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $refundable;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $refundable;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$refundable->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$refundable->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $refundable->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$refundable->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$refundable->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$refundable->setStartRecordNumber($this->StartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $refundable;

		// Load search values
		// member_code

		$refundable->member_code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_member_code"]);
		$refundable->member_code->AdvancedSearch->SearchOperator = @$_GET["z_member_code"];

		// refund_status
		$refundable->refund_status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_refund_status"]);
		$refundable->refund_status->AdvancedSearch->SearchOperator = @$_GET["z_refund_status"];

		// refund_slipt_num
		$refundable->refund_slipt_num->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_refund_slipt_num"]);
		$refundable->refund_slipt_num->AdvancedSearch->SearchOperator = @$_GET["z_refund_slipt_num"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $refundable;

		// Call Recordset Selecting event
		$refundable->Recordset_Selecting($refundable->CurrentFilter);

		// Load List page SQL
		$sSql = $refundable->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$refundable->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $refundable;
		$sFilter = $refundable->KeyFilter();

		// Call Row Selecting event
		$refundable->Row_Selecting($sFilter);

		// Load SQL based on filter
		$refundable->CurrentFilter = $sFilter;
		$sSql = $refundable->SQL();
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
		global $conn, $refundable;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$refundable->Row_Selected($row);
		$refundable->refund_id->setDbValue($rs->fields('refund_id'));
		$refundable->member_code->setDbValue($rs->fields('member_code'));
		$refundable->refund_total->setDbValue($rs->fields('refund_total'));
		$refundable->assc_percent->setDbValue($rs->fields('assc_percent'));
		$refundable->assc_total->setDbValue($rs->fields('assc_total'));
		$refundable->sub_total->setDbValue($rs->fields('sub_total'));
		$refundable->refund_status->setDbValue($rs->fields('refund_status'));
		$refundable->pay_date->setDbValue($rs->fields('pay_date'));
		$refundable->calculate_date->setDbValue($rs->fields('calculate_date'));
		$refundable->refund_slipt_num->setDbValue($rs->fields('refund_slipt_num'));
	}

	// Load old record
	function LoadOldRecord() {
		global $refundable;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($refundable->getKey("refund_id")) <> "")
			$refundable->refund_id->CurrentValue = $refundable->getKey("refund_id"); // refund_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$refundable->CurrentFilter = $refundable->KeyFilter();
			$sSql = $refundable->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $refundable;

		// Initialize URLs
		$this->ViewUrl = $refundable->ViewUrl();
		$this->EditUrl = $refundable->EditUrl();
		$this->InlineEditUrl = $refundable->InlineEditUrl();
		$this->CopyUrl = $refundable->CopyUrl();
		$this->InlineCopyUrl = $refundable->InlineCopyUrl();
		$this->DeleteUrl = $refundable->DeleteUrl();

		// Call Row_Rendering event
		$refundable->Row_Rendering();

		// Common render codes for all row types
		// refund_id

		$refundable->refund_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$refundable->member_code->CellCssStyle = "white-space: nowrap;";

		// refund_total
		$refundable->refund_total->CellCssStyle = "white-space: nowrap;";

		// assc_percent
		$refundable->assc_percent->CellCssStyle = "white-space: nowrap;";

		// assc_total
		$refundable->assc_total->CellCssStyle = "white-space: nowrap;";

		// sub_total
		$refundable->sub_total->CellCssStyle = "white-space: nowrap;";

		// refund_status
		$refundable->refund_status->CellCssStyle = "white-space: nowrap;";

		// pay_date
		$refundable->pay_date->CellCssStyle = "white-space: nowrap;";

		// calculate_date
		$refundable->calculate_date->CellCssStyle = "white-space: nowrap;";

		// refund_slipt_num
		$refundable->refund_slipt_num->CellCssStyle = "white-space: nowrap;";
		if ($refundable->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$refundable->member_code->ViewValue = $refundable->member_code->CurrentValue;
			if (strval($refundable->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($refundable->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$refundable->member_code->ViewValue = $rswrk->fields('member_code');
					$refundable->member_code->ViewValue .= ew_ValueSeparator(0,1,$refundable->member_code) . $rswrk->fields('fname');
					$refundable->member_code->ViewValue .= ew_ValueSeparator(0,2,$refundable->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$refundable->member_code->ViewValue = $refundable->member_code->CurrentValue;
				}
			} else {
				$refundable->member_code->ViewValue = NULL;
			}
			$refundable->member_code->ViewCustomAttributes = "";

			// refund_total
			$refundable->refund_total->ViewValue = $refundable->refund_total->CurrentValue;
			$refundable->refund_total->ViewValue = ew_FormatCurrency($refundable->refund_total->ViewValue, 0, -2, -2, -2);
			$refundable->refund_total->ViewCustomAttributes = "";

			// assc_percent
			$refundable->assc_percent->ViewValue = $refundable->assc_percent->CurrentValue;
			$refundable->assc_percent->ViewCustomAttributes = "";

			// assc_total
			$refundable->assc_total->ViewValue = $refundable->assc_total->CurrentValue;
			$refundable->assc_total->ViewValue = ew_FormatCurrency($refundable->assc_total->ViewValue, 0, -2, -2, -2);
			$refundable->assc_total->ViewCustomAttributes = "";

			// sub_total
			$refundable->sub_total->ViewValue = $refundable->sub_total->CurrentValue;
			$refundable->sub_total->ViewValue = ew_FormatCurrency($refundable->sub_total->ViewValue, 0, -2, -2, -2);
			$refundable->sub_total->ViewCustomAttributes = "";

			// refund_status
			if (strval($refundable->refund_status->CurrentValue) <> "") {
				switch ($refundable->refund_status->CurrentValue) {
					case "รอจ่าย":
						$refundable->refund_status->ViewValue = $refundable->refund_status->FldTagCaption(1) <> "" ? $refundable->refund_status->FldTagCaption(1) : $refundable->refund_status->CurrentValue;
						break;
					case "จ่ายแล้ว":
						$refundable->refund_status->ViewValue = $refundable->refund_status->FldTagCaption(2) <> "" ? $refundable->refund_status->FldTagCaption(2) : $refundable->refund_status->CurrentValue;
						break;
					default:
						$refundable->refund_status->ViewValue = $refundable->refund_status->CurrentValue;
				}
			} else {
				$refundable->refund_status->ViewValue = NULL;
			}
			$refundable->refund_status->ViewCustomAttributes = "";

			// pay_date
			$refundable->pay_date->ViewValue = $refundable->pay_date->CurrentValue;
			$refundable->pay_date->ViewValue = ew_FormatDateTime($refundable->pay_date->ViewValue, 7);
			$refundable->pay_date->ViewCustomAttributes = "";

			// refund_slipt_num
			$refundable->refund_slipt_num->ViewValue = $refundable->refund_slipt_num->CurrentValue;
			$refundable->refund_slipt_num->ViewCustomAttributes = "";

			// member_code
			$refundable->member_code->LinkCustomAttributes = "";
			$refundable->member_code->HrefValue = "";
			$refundable->member_code->TooltipValue = "";

			// refund_total
			$refundable->refund_total->LinkCustomAttributes = "";
			$refundable->refund_total->HrefValue = "";
			$refundable->refund_total->TooltipValue = "";

			// assc_percent
			$refundable->assc_percent->LinkCustomAttributes = "";
			$refundable->assc_percent->HrefValue = "";
			$refundable->assc_percent->TooltipValue = "";

			// assc_total
			$refundable->assc_total->LinkCustomAttributes = "";
			$refundable->assc_total->HrefValue = "";
			$refundable->assc_total->TooltipValue = "";

			// sub_total
			$refundable->sub_total->LinkCustomAttributes = "";
			$refundable->sub_total->HrefValue = "";
			$refundable->sub_total->TooltipValue = "";

			// refund_status
			$refundable->refund_status->LinkCustomAttributes = "";
			$refundable->refund_status->HrefValue = "";
			$refundable->refund_status->TooltipValue = "";

			// pay_date
			$refundable->pay_date->LinkCustomAttributes = "";
			$refundable->pay_date->HrefValue = "";
			$refundable->pay_date->TooltipValue = "";

			// refund_slipt_num
			$refundable->refund_slipt_num->LinkCustomAttributes = "";
			$refundable->refund_slipt_num->HrefValue = "";
			$refundable->refund_slipt_num->TooltipValue = "";
		} elseif ($refundable->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// member_code
			$refundable->member_code->EditCustomAttributes = "";
			$refundable->member_code->EditValue = ew_HtmlEncode($refundable->member_code->AdvancedSearch->SearchValue);
			if (strval($refundable->member_code->AdvancedSearch->SearchValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($refundable->member_code->AdvancedSearch->SearchValue) . "'";
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$refundable->member_code->EditValue = $rswrk->fields('member_code');
					$refundable->member_code->EditValue .= ew_ValueSeparator(0,1,$refundable->member_code) . $rswrk->fields('fname');
					$refundable->member_code->EditValue .= ew_ValueSeparator(0,2,$refundable->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$refundable->member_code->EditValue = $refundable->member_code->AdvancedSearch->SearchValue;
				}
			} else {
				$refundable->member_code->EditValue = NULL;
			}

			// refund_total
			$refundable->refund_total->EditCustomAttributes = "";
			$refundable->refund_total->EditValue = ew_HtmlEncode($refundable->refund_total->AdvancedSearch->SearchValue);

			// assc_percent
			$refundable->assc_percent->EditCustomAttributes = "";
			$refundable->assc_percent->EditValue = ew_HtmlEncode($refundable->assc_percent->AdvancedSearch->SearchValue);

			// assc_total
			$refundable->assc_total->EditCustomAttributes = "";
			$refundable->assc_total->EditValue = ew_HtmlEncode($refundable->assc_total->AdvancedSearch->SearchValue);

			// sub_total
			$refundable->sub_total->EditCustomAttributes = "";
			$refundable->sub_total->EditValue = ew_HtmlEncode($refundable->sub_total->AdvancedSearch->SearchValue);

			// refund_status
			$refundable->refund_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("รอจ่าย", $refundable->refund_status->FldTagCaption(1) <> "" ? $refundable->refund_status->FldTagCaption(1) : "รอจ่าย");
			$arwrk[] = array("จ่ายแล้ว", $refundable->refund_status->FldTagCaption(2) <> "" ? $refundable->refund_status->FldTagCaption(2) : "จ่ายแล้ว");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$refundable->refund_status->EditValue = $arwrk;

			// pay_date
			$refundable->pay_date->EditCustomAttributes = "";
			$refundable->pay_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($refundable->pay_date->AdvancedSearch->SearchValue, 7), 7));

			// refund_slipt_num
			$refundable->refund_slipt_num->EditCustomAttributes = "";
			$refundable->refund_slipt_num->EditValue = ew_HtmlEncode($refundable->refund_slipt_num->AdvancedSearch->SearchValue);
		}
		if ($refundable->RowType == EW_ROWTYPE_ADD ||
			$refundable->RowType == EW_ROWTYPE_EDIT ||
			$refundable->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$refundable->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($refundable->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$refundable->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $refundable;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($refundable->refund_slipt_num->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $refundable->refund_slipt_num->FldErrMsg());
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
		global $refundable;
		$refundable->member_code->AdvancedSearch->SearchValue = $refundable->getAdvancedSearch("x_member_code");
		$refundable->refund_status->AdvancedSearch->SearchValue = $refundable->getAdvancedSearch("x_refund_status");
		$refundable->refund_slipt_num->AdvancedSearch->SearchValue = $refundable->getAdvancedSearch("x_refund_slipt_num");
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $refundable;

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
		$item->Body = "<a name=\"emf_refundable\" id=\"emf_refundable\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_refundable',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.frefundablelist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($refundable->Export <> "" ||
			$refundable->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $refundable;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $refundable->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($refundable->ExportAll) {
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
		if ($refundable->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($refundable, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($refundable->Export == "xml") {
			$refundable->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$refundable->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($refundable->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($refundable->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($refundable->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($refundable->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($refundable->ExportReturnUrl());
		} elseif ($refundable->Export == "pdf") {
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
		//$url = "your URL";

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
			$opt =& $this->ListOptions->Add("subvslipt");
			$opt->Header = "<center>พิมพ์</center>";
			$opt->OnLeft = TRUE; // Link on left
			$opt->MoveTo(3); // Move to first column
	}

		// ListOptions Rendered event
	function ListOptions_Rendered() {

	 // Example:    
		 global $refundable; 
		 global $Language;
		 $this->ListOptions->Items["subvslipt"]->Body = "<a href='refundsliptview.php?refund_id=".$refundable->refund_id->CurrentValue."' title='พิมพ์ใบสำคัญรับเงิน'><center><img src='images/ico_send_notice.png' align='absmiddle'></center></a>";
	}                                                   
}
?>
