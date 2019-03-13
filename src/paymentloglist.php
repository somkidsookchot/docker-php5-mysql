<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "paymentloginfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$paymentlog_list = new cpaymentlog_list();
$Page =& $paymentlog_list;

// Page init
$paymentlog_list->Page_Init();

// Page main
$paymentlog_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($paymentlog->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var paymentlog_list = new ew_Page("paymentlog_list");

// page properties
paymentlog_list.PageID = "list"; // page ID
paymentlog_list.FormID = "fpaymentloglist"; // form ID
var EW_PAGE_ID = paymentlog_list.PageID; // for backward compatibility

// extend page with validate function for search
paymentlog_list.ValidateSearch = function(fobj) {
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
paymentlog_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
paymentlog_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
paymentlog_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
paymentlog_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($paymentlog->Export == "") || (EW_EXPORT_MASTER_RECORD && $paymentlog->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$paymentlog_list->TotalRecs = $paymentlog->SelectRecordCount();
	} else {
		if ($paymentlog_list->Recordset = $paymentlog_list->LoadRecordset())
			$paymentlog_list->TotalRecs = $paymentlog_list->Recordset->RecordCount();
	}
	$paymentlog_list->StartRec = 1;
	if ($paymentlog_list->DisplayRecs <= 0 || ($paymentlog->Export <> "" && $paymentlog->ExportAll)) // Display all records
		$paymentlog_list->DisplayRecs = $paymentlog_list->TotalRecs;
	if (!($paymentlog->Export <> "" && $paymentlog->ExportAll))
		$paymentlog_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$paymentlog_list->Recordset = $paymentlog_list->LoadRecordset($paymentlog_list->StartRec-1, $paymentlog_list->DisplayRecs);
?>
<div class="phpmaker ewTitle"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $paymentlog->TableCaption() ?>
&nbsp;&nbsp;<?php $paymentlog_list->ExportOptions->Render("body"); ?>
</div>
<div class="clear"></div>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($paymentlog->Export == "" && $paymentlog->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(paymentlog_list);" style="text-decoration: none;"><img src="phpimages/collapse.png" alt=""  border="0" align="absmiddle" id="paymentlog_list_SearchImage" /></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="paymentlog_list_SearchPanel" class="listSearch">
<form name="fpaymentloglistsrch" id="fpaymentloglistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return paymentlog_list.ValidateSearch(this);" >
<input type="hidden" id="t" name="t" value="paymentlog">
<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$paymentlog_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$paymentlog->RowType = EW_ROWTYPE_SEARCH;

// Render row
$paymentlog->ResetAttrs();
$paymentlog_list->RenderRow();
?>
<span id="xsc_t_code" class="ewCssTableCell">
	  <span class="ewSearchCaption"><?php echo $paymentlog->t_code->FldCaption() ?></span>
	  <span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_t_code" id="z_t_code" value="LIKE"></span>
	  <span class="ewSearchField">
<?php $paymentlog->t_code->EditAttrs["onchange"] = "ew_UpdateOpt('x_village_id','x_t_code',true); " . @$paymentlog->t_code->EditAttrs["onchange"]; ?>
<select id="x_t_code" name="x_t_code"<?php echo $paymentlog->t_code->EditAttributes() ?>>
<?php
if (is_array($paymentlog->t_code->EditValue)) {
	$arwrk = $paymentlog->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentlog->t_code->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$paymentlog->t_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
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
		<span class="ewSearchCaption"><?php echo $paymentlog->village_id->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_village_id" id="z_village_id" value="="></span>
		<span class="ewSearchField">
<select id="x_village_id" name="x_village_id"<?php echo $paymentlog->village_id->EditAttributes() ?>>
<?php
if (is_array($paymentlog->village_id->EditValue)) {
	$arwrk = $paymentlog->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentlog->village_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$paymentlog->village_id) ?><?php echo $arwrk[$rowcntwrk][2] ?>
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
	<span id="xsc_pay_type" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $paymentlog->pay_type->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_pay_type" id="z_pay_type" value="="></span>
		<span class="ewSearchField">
<select id="x_pay_type" name="x_pay_type"<?php echo $paymentlog->pay_type->EditAttributes() ?>>
<?php
if (is_array($paymentlog->pay_type->EditValue)) {
	$arwrk = $paymentlog->pay_type->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentlog->pay_type->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="hidden" name="s_x_pay_type" id="s_x_pay_type" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_pay_type" id="lft_x_pay_type" value="">
</span>
	</span>
</div>
<div id="xsr_4" class="ewCssTableRow">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $paymentlog_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $paymentlog_list->ShowPageHeader(); ?>
<?php
$paymentlog_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($paymentlog->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($paymentlog->CurrentAction <> "gridadd" && $paymentlog->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($paymentlog_list->Pager)) $paymentlog_list->Pager = new cPrevNextPager($paymentlog_list->StartRec, $paymentlog_list->DisplayRecs, $paymentlog_list->TotalRecs) ?>
<?php if ($paymentlog_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($paymentlog_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_list->PageUrl() ?>start=<?php echo $paymentlog_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($paymentlog_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_list->PageUrl() ?>start=<?php echo $paymentlog_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $paymentlog_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($paymentlog_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_list->PageUrl() ?>start=<?php echo $paymentlog_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($paymentlog_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_list->PageUrl() ?>start=<?php echo $paymentlog_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $paymentlog_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $paymentlog_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $paymentlog_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $paymentlog_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($paymentlog_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($paymentlog_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="paymentlog">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($paymentlog_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($paymentlog_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($paymentlog_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($paymentlog_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($paymentlog_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($paymentlog_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($paymentlog_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($paymentlog_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($paymentlog_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($paymentlog->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $paymentlog_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;<?php } ?>
<?php if ($paymentlog_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fpaymentloglist, '<?php echo $paymentlog_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fpaymentloglist" id="fpaymentloglist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="paymentlog">
<div id="gmp_paymentlog" class="ewGridMiddlePanel">
<?php if ($paymentlog_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $paymentlog->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$paymentlog_list->RenderListOptions();

// Render list options (header, left)
$paymentlog_list->ListOptions->Render("header", "left");
?>
<?php if ($paymentlog->pay_date->Visible) { // pay_date ?>
	<?php if ($paymentlog->SortUrl($paymentlog->pay_date) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->pay_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->pay_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->pay_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->pay_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->pay_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->t_code->Visible) { // t_code ?>
	<?php if ($paymentlog->SortUrl($paymentlog->t_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->t_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->t_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->t_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->t_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->t_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->village_id->Visible) { // village_id ?>
	<?php if ($paymentlog->SortUrl($paymentlog->village_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->village_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->village_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->village_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->village_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->village_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->pay_type->Visible) { // pay_type ?>
	<?php if ($paymentlog->SortUrl($paymentlog->pay_type) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->pay_type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->pay_type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->pay_type->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->pay_type->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->pay_type->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->pay_detail->Visible) { // pay_detail ?>
	<?php if ($paymentlog->SortUrl($paymentlog->pay_detail) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->pay_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->pay_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->pay_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->pay_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->pay_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->count_member->Visible) { // count_member ?>
	<?php if ($paymentlog->SortUrl($paymentlog->count_member) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->count_member->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->count_member) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->count_member->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->count_member->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->count_member->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->pay_rate->Visible) { // pay_rate ?>
	<?php if ($paymentlog->SortUrl($paymentlog->pay_rate) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->pay_rate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->pay_rate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->pay_rate->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->pay_rate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->pay_rate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->sub_total->Visible) { // sub_total ?>
	<?php if ($paymentlog->SortUrl($paymentlog->sub_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->sub_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->sub_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->sub_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->sub_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->sub_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->assc_rate->Visible) { // assc_rate ?>
	<?php if ($paymentlog->SortUrl($paymentlog->assc_rate) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->assc_rate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->assc_rate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->assc_rate->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->assc_rate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->assc_rate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->assc_total->Visible) { // assc_total ?>
	<?php if ($paymentlog->SortUrl($paymentlog->assc_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->assc_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->assc_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->assc_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->assc_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->assc_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->grand_total->Visible) { // grand_total ?>
	<?php if ($paymentlog->SortUrl($paymentlog->grand_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->grand_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->grand_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->grand_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->grand_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->grand_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->pay_note->Visible) { // pay_note ?>
	<?php if ($paymentlog->SortUrl($paymentlog->pay_note) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->pay_note->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->pay_note) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->pay_note->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->pay_note->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->pay_note->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentlog->pml_slipt_num->Visible) { // pml_slipt_num ?>
	<?php if ($paymentlog->SortUrl($paymentlog->pml_slipt_num) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentlog->pml_slipt_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $paymentlog->SortUrl($paymentlog->pml_slipt_num) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentlog->pml_slipt_num->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentlog->pml_slipt_num->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentlog->pml_slipt_num->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$paymentlog_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($paymentlog->ExportAll && $paymentlog->Export <> "") {
	$paymentlog_list->StopRec = $paymentlog_list->TotalRecs;
} else {

	// Set the last record to display
	if ($paymentlog_list->TotalRecs > $paymentlog_list->StartRec + $paymentlog_list->DisplayRecs - 1)
		$paymentlog_list->StopRec = $paymentlog_list->StartRec + $paymentlog_list->DisplayRecs - 1;
	else
		$paymentlog_list->StopRec = $paymentlog_list->TotalRecs;
}
$paymentlog_list->RecCnt = $paymentlog_list->StartRec - 1;
if ($paymentlog_list->Recordset && !$paymentlog_list->Recordset->EOF) {
	$paymentlog_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $paymentlog_list->StartRec > 1)
		$paymentlog_list->Recordset->Move($paymentlog_list->StartRec - 1);
} elseif (!$paymentlog->AllowAddDeleteRow && $paymentlog_list->StopRec == 0) {
	$paymentlog_list->StopRec = $paymentlog->GridAddRowCount;
}

// Initialize aggregate
$paymentlog->RowType = EW_ROWTYPE_AGGREGATEINIT;
$paymentlog->ResetAttrs();
$paymentlog_list->RenderRow();
$paymentlog_list->RowCnt = 0;
while ($paymentlog_list->RecCnt < $paymentlog_list->StopRec) {
	$paymentlog_list->RecCnt++;
	if (intval($paymentlog_list->RecCnt) >= intval($paymentlog_list->StartRec)) {
		$paymentlog_list->RowCnt++;

		// Set up key count
		$paymentlog_list->KeyCount = $paymentlog_list->RowIndex;

		// Init row class and style
		$paymentlog->ResetAttrs();
		$paymentlog->CssClass = "";
		if ($paymentlog->CurrentAction == "gridadd") {
		} else {
			$paymentlog_list->LoadRowValues($paymentlog_list->Recordset); // Load row values
		}
		$paymentlog->RowType = EW_ROWTYPE_VIEW; // Render view
		$paymentlog->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$paymentlog_list->RenderRow();

		// Render list options
		$paymentlog_list->RenderListOptions();
?>
	<tr<?php echo $paymentlog->RowAttributes() ?>>
<?php

// Render list options (body, left)
$paymentlog_list->ListOptions->Render("body", "left");
?>
	<?php if ($paymentlog->pay_date->Visible) { // pay_date ?>
		<td<?php echo $paymentlog->pay_date->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_date->ViewAttributes() ?>><?php echo $paymentlog->pay_date->ListViewValue() ?></div>
<a name="<?php echo $paymentlog_list->PageObjName . "_row_" . $paymentlog_list->RowCnt ?>" id="<?php echo $paymentlog_list->PageObjName . "_row_" . $paymentlog_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($paymentlog->t_code->Visible) { // t_code ?>
		<td<?php echo $paymentlog->t_code->CellAttributes() ?>>
<div<?php echo $paymentlog->t_code->ViewAttributes() ?>><?php echo $paymentlog->t_code->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentlog->village_id->Visible) { // village_id ?>
		<td<?php echo $paymentlog->village_id->CellAttributes() ?>>
<div<?php echo $paymentlog->village_id->ViewAttributes() ?>><?php echo $paymentlog->village_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentlog->pay_type->Visible) { // pay_type ?>
		<td<?php echo $paymentlog->pay_type->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_type->ViewAttributes() ?>><?php echo $paymentlog->pay_type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentlog->pay_detail->Visible) { // pay_detail ?>
		<td<?php echo $paymentlog->pay_detail->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_detail->ViewAttributes() ?>><?php echo $paymentlog->pay_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentlog->count_member->Visible) { // count_member ?>
		<td<?php echo $paymentlog->count_member->CellAttributes() ?>>
<div<?php echo $paymentlog->count_member->ViewAttributes() ?>><?php echo $paymentlog->count_member->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentlog->pay_rate->Visible) { // pay_rate ?>
		<td<?php echo $paymentlog->pay_rate->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_rate->ViewAttributes() ?>><?php echo $paymentlog->pay_rate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentlog->sub_total->Visible) { // sub_total ?>
		<td<?php echo $paymentlog->sub_total->CellAttributes() ?>>
<div<?php echo $paymentlog->sub_total->ViewAttributes() ?>><?php echo number_format($paymentlog->sub_total->ListViewValue()) ?></div>
</td>
	<?php } ?>
	<?php if ($paymentlog->assc_rate->Visible) { // assc_rate ?>
		<td<?php echo $paymentlog->assc_rate->CellAttributes() ?>>
<div<?php echo $paymentlog->assc_rate->ViewAttributes() ?>><?php echo $paymentlog->assc_rate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentlog->assc_total->Visible) { // assc_total ?>
		<td<?php echo $paymentlog->assc_total->CellAttributes() ?>>
<div<?php echo $paymentlog->assc_total->ViewAttributes() ?>><?php echo number_format($paymentlog->assc_total->ListViewValue()) ?></div>
</td>
	<?php } ?>
	<?php if ($paymentlog->grand_total->Visible) { // grand_total ?>
		<td<?php echo $paymentlog->grand_total->CellAttributes() ?>>
<div<?php echo $paymentlog->grand_total->ViewAttributes() ?>><?php echo number_format($paymentlog->grand_total->ListViewValue()) ?></div>
</td>
	<?php } ?>
	<?php if ($paymentlog->pay_note->Visible) { // pay_note ?>
		<td<?php echo $paymentlog->pay_note->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_note->ViewAttributes() ?>><?php echo $paymentlog->pay_note->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($paymentlog->pml_slipt_num->Visible) { // pml_slipt_num ?>
		<td<?php echo $paymentlog->pml_slipt_num->CellAttributes() ?>>
<div<?php echo $paymentlog->pml_slipt_num->ViewAttributes() ?>><?php echo $paymentlog->pml_slipt_num->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paymentlog_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($paymentlog->CurrentAction <> "gridadd")
		$paymentlog_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($paymentlog_list->Recordset)
	$paymentlog_list->Recordset->Close();
?>
<?php if ($paymentlog_list->TotalRecs > 0) { ?>
<?php if ($paymentlog->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($paymentlog->CurrentAction <> "gridadd" && $paymentlog->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($paymentlog_list->Pager)) $paymentlog_list->Pager = new cPrevNextPager($paymentlog_list->StartRec, $paymentlog_list->DisplayRecs, $paymentlog_list->TotalRecs) ?>
<?php if ($paymentlog_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($paymentlog_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_list->PageUrl() ?>start=<?php echo $paymentlog_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($paymentlog_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_list->PageUrl() ?>start=<?php echo $paymentlog_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $paymentlog_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($paymentlog_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_list->PageUrl() ?>start=<?php echo $paymentlog_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($paymentlog_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_list->PageUrl() ?>start=<?php echo $paymentlog_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $paymentlog_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $paymentlog_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $paymentlog_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $paymentlog_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($paymentlog_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($paymentlog_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="paymentlog">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($paymentlog_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($paymentlog_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($paymentlog_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($paymentlog_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($paymentlog_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($paymentlog_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($paymentlog_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($paymentlog_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($paymentlog_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($paymentlog->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $paymentlog_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;<?php } ?>
<?php if ($paymentlog_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fpaymentloglist, '<?php echo $paymentlog_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($paymentlog->Export == "" && $paymentlog->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(paymentlog_list); // Init search panel as collapsed

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_village_id','x_t_code',false],
['x_t_code','x_t_code',false],
['x_pay_type','x_pay_type',false]]);

//-->
</script>
<?php } ?>
<?php
$paymentlog_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($paymentlog->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$paymentlog_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpaymentlog_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'paymentlog';

	// Page object name
	var $PageObjName = 'paymentlog_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $paymentlog;
		if ($paymentlog->UseTokenInUrl) $PageUrl .= "t=" . $paymentlog->TableVar . "&"; // Add page token
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
		global $objForm, $paymentlog;
		if ($paymentlog->UseTokenInUrl) {
			if ($objForm)
				return ($paymentlog->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($paymentlog->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpaymentlog_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (paymentlog)
		if (!isset($GLOBALS["paymentlog"])) {
			$GLOBALS["paymentlog"] = new cpaymentlog();
			$GLOBALS["Table"] =& $GLOBALS["paymentlog"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "paymentlogadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "paymentlogdelete.php";
		$this->MultiUpdateUrl = "paymentlogupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'paymentlog', TRUE);

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
		global $paymentlog;

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

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$paymentlog->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $paymentlog;

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
			if ($paymentlog->Export <> "" ||
				$paymentlog->CurrentAction == "gridadd" ||
				$paymentlog->CurrentAction == "gridedit") {
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
			$paymentlog->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($paymentlog->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $paymentlog->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$paymentlog->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$paymentlog->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$paymentlog->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $paymentlog->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$paymentlog->setSessionWhere($sFilter);
		$paymentlog->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $paymentlog;
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
			$paymentlog->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$paymentlog->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $paymentlog;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $paymentlog->pay_date, FALSE); // pay_date
		$this->BuildSearchSql($sWhere, $paymentlog->t_code, FALSE); // t_code
		$this->BuildSearchSql($sWhere, $paymentlog->village_id, FALSE); // village_id
		$this->BuildSearchSql($sWhere, $paymentlog->pay_type, FALSE); // pay_type
		$this->BuildSearchSql($sWhere, $paymentlog->pay_detail, FALSE); // pay_detail
		$this->BuildSearchSql($sWhere, $paymentlog->count_member, FALSE); // count_member
		$this->BuildSearchSql($sWhere, $paymentlog->pay_rate, FALSE); // pay_rate
		$this->BuildSearchSql($sWhere, $paymentlog->sub_total, FALSE); // sub_total
		$this->BuildSearchSql($sWhere, $paymentlog->assc_rate, FALSE); // assc_rate
		$this->BuildSearchSql($sWhere, $paymentlog->assc_total, FALSE); // assc_total
		$this->BuildSearchSql($sWhere, $paymentlog->grand_total, FALSE); // grand_total
		$this->BuildSearchSql($sWhere, $paymentlog->pay_note, FALSE); // pay_note
		$this->BuildSearchSql($sWhere, $paymentlog->pml_slipt_num, FALSE); // pml_slipt_num

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($paymentlog->pay_date); // pay_date
			$this->SetSearchParm($paymentlog->t_code); // t_code
			$this->SetSearchParm($paymentlog->village_id); // village_id
			$this->SetSearchParm($paymentlog->pay_type); // pay_type
			$this->SetSearchParm($paymentlog->pay_detail); // pay_detail
			$this->SetSearchParm($paymentlog->count_member); // count_member
			$this->SetSearchParm($paymentlog->pay_rate); // pay_rate
			$this->SetSearchParm($paymentlog->sub_total); // sub_total
			$this->SetSearchParm($paymentlog->assc_rate); // assc_rate
			$this->SetSearchParm($paymentlog->assc_total); // assc_total
			$this->SetSearchParm($paymentlog->grand_total); // grand_total
			$this->SetSearchParm($paymentlog->pay_note); // pay_note
			$this->SetSearchParm($paymentlog->pml_slipt_num); // pml_slipt_num
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
		global $paymentlog;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$paymentlog->setAdvancedSearch("x_$FldParm", $FldVal);
		$paymentlog->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$paymentlog->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$paymentlog->setAdvancedSearch("y_$FldParm", $FldVal2);
		$paymentlog->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $paymentlog;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $paymentlog->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $paymentlog->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $paymentlog->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $paymentlog->getAdvancedSearch("w_$FldParm");
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
		global $paymentlog;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$paymentlog->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $paymentlog;
		$paymentlog->setAdvancedSearch("x_pay_date", "");
		$paymentlog->setAdvancedSearch("x_t_code", "");
		$paymentlog->setAdvancedSearch("x_village_id", "");
		$paymentlog->setAdvancedSearch("x_pay_type", "");
		$paymentlog->setAdvancedSearch("x_pay_detail", "");
		$paymentlog->setAdvancedSearch("x_count_member", "");
		$paymentlog->setAdvancedSearch("x_pay_rate", "");
		$paymentlog->setAdvancedSearch("x_sub_total", "");
		$paymentlog->setAdvancedSearch("x_assc_rate", "");
		$paymentlog->setAdvancedSearch("x_assc_total", "");
		$paymentlog->setAdvancedSearch("x_grand_total", "");
		$paymentlog->setAdvancedSearch("x_pay_note", "");
		$paymentlog->setAdvancedSearch("x_pml_slipt_num", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $paymentlog;
		$bRestore = TRUE;
		if ($paymentlog->pay_date->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->t_code->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->village_id->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->pay_type->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->pay_detail->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->count_member->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->pay_rate->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->sub_total->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->assc_rate->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->assc_total->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->grand_total->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->pay_note->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($paymentlog->pml_slipt_num->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($paymentlog->pay_date);
			$this->GetSearchParm($paymentlog->t_code);
			$this->GetSearchParm($paymentlog->village_id);
			$this->GetSearchParm($paymentlog->pay_type);
			$this->GetSearchParm($paymentlog->pay_detail);
			$this->GetSearchParm($paymentlog->count_member);
			$this->GetSearchParm($paymentlog->pay_rate);
			$this->GetSearchParm($paymentlog->sub_total);
			$this->GetSearchParm($paymentlog->assc_rate);
			$this->GetSearchParm($paymentlog->assc_total);
			$this->GetSearchParm($paymentlog->grand_total);
			$this->GetSearchParm($paymentlog->pay_note);
			$this->GetSearchParm($paymentlog->pml_slipt_num);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $paymentlog;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$paymentlog->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$paymentlog->CurrentOrderType = @$_GET["ordertype"];
			$paymentlog->UpdateSort($paymentlog->pay_date); // pay_date
			$paymentlog->UpdateSort($paymentlog->t_code); // t_code
			$paymentlog->UpdateSort($paymentlog->village_id); // village_id
			$paymentlog->UpdateSort($paymentlog->pay_type); // pay_type
			$paymentlog->UpdateSort($paymentlog->pay_detail); // pay_detail
			$paymentlog->UpdateSort($paymentlog->count_member); // count_member
			$paymentlog->UpdateSort($paymentlog->pay_rate); // pay_rate
			$paymentlog->UpdateSort($paymentlog->sub_total); // sub_total
			$paymentlog->UpdateSort($paymentlog->assc_rate); // assc_rate
			$paymentlog->UpdateSort($paymentlog->assc_total); // assc_total
			$paymentlog->UpdateSort($paymentlog->grand_total); // grand_total
			$paymentlog->UpdateSort($paymentlog->pay_note); // pay_note
			$paymentlog->UpdateSort($paymentlog->pml_slipt_num); // pml_slipt_num
			$paymentlog->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $paymentlog;
		$sOrderBy = $paymentlog->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($paymentlog->SqlOrderBy() <> "") {
				$sOrderBy = $paymentlog->SqlOrderBy();
				$paymentlog->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $paymentlog;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$paymentlog->setSessionOrderBy($sOrderBy);
				$paymentlog->pay_date->setSort("");
				$paymentlog->t_code->setSort("");
				$paymentlog->village_id->setSort("");
				$paymentlog->pay_type->setSort("");
				$paymentlog->pay_detail->setSort("");
				$paymentlog->count_member->setSort("");
				$paymentlog->pay_rate->setSort("");
				$paymentlog->sub_total->setSort("");
				$paymentlog->assc_rate->setSort("");
				$paymentlog->assc_total->setSort("");
				$paymentlog->grand_total->setSort("");
				$paymentlog->pay_note->setSort("");
				$paymentlog->pml_slipt_num->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$paymentlog->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $paymentlog;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"paymentlog_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $paymentlog, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($paymentlog->pml_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $paymentlog;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $paymentlog;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$paymentlog->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$paymentlog->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $paymentlog->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$paymentlog->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$paymentlog->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$paymentlog->setStartRecordNumber($this->StartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $paymentlog;

		// Load search values
		// pay_date

		$paymentlog->pay_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pay_date"]);
		$paymentlog->pay_date->AdvancedSearch->SearchOperator = @$_GET["z_pay_date"];

		// t_code
		$paymentlog->t_code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_t_code"]);
		$paymentlog->t_code->AdvancedSearch->SearchOperator = @$_GET["z_t_code"];

		// village_id
		$paymentlog->village_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_village_id"]);
		$paymentlog->village_id->AdvancedSearch->SearchOperator = @$_GET["z_village_id"];

		// pay_type
		$paymentlog->pay_type->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pay_type"]);
		$paymentlog->pay_type->AdvancedSearch->SearchOperator = @$_GET["z_pay_type"];

		// pay_detail
		$paymentlog->pay_detail->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pay_detail"]);
		$paymentlog->pay_detail->AdvancedSearch->SearchOperator = @$_GET["z_pay_detail"];

		// count_member
		$paymentlog->count_member->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_count_member"]);
		$paymentlog->count_member->AdvancedSearch->SearchOperator = @$_GET["z_count_member"];

		// pay_rate
		$paymentlog->pay_rate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pay_rate"]);
		$paymentlog->pay_rate->AdvancedSearch->SearchOperator = @$_GET["z_pay_rate"];

		// sub_total
		$paymentlog->sub_total->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sub_total"]);
		$paymentlog->sub_total->AdvancedSearch->SearchOperator = @$_GET["z_sub_total"];

		// assc_rate
		$paymentlog->assc_rate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_assc_rate"]);
		$paymentlog->assc_rate->AdvancedSearch->SearchOperator = @$_GET["z_assc_rate"];

		// assc_total
		$paymentlog->assc_total->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_assc_total"]);
		$paymentlog->assc_total->AdvancedSearch->SearchOperator = @$_GET["z_assc_total"];

		// grand_total
		$paymentlog->grand_total->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_grand_total"]);
		$paymentlog->grand_total->AdvancedSearch->SearchOperator = @$_GET["z_grand_total"];

		// pay_note
		$paymentlog->pay_note->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pay_note"]);
		$paymentlog->pay_note->AdvancedSearch->SearchOperator = @$_GET["z_pay_note"];

		// pml_slipt_num
		$paymentlog->pml_slipt_num->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pml_slipt_num"]);
		$paymentlog->pml_slipt_num->AdvancedSearch->SearchOperator = @$_GET["z_pml_slipt_num"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $paymentlog;

		// Call Recordset Selecting event
		$paymentlog->Recordset_Selecting($paymentlog->CurrentFilter);

		// Load List page SQL
		$sSql = $paymentlog->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$paymentlog->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $paymentlog;
		$sFilter = $paymentlog->KeyFilter();

		// Call Row Selecting event
		$paymentlog->Row_Selecting($sFilter);

		// Load SQL based on filter
		$paymentlog->CurrentFilter = $sFilter;
		$sSql = $paymentlog->SQL();
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
		global $conn, $paymentlog;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$paymentlog->Row_Selected($row);
		$paymentlog->pml_id->setDbValue($rs->fields('pml_id'));
		$paymentlog->pay_date->setDbValue($rs->fields('pay_date'));
		$paymentlog->t_code->setDbValue($rs->fields('t_code'));
		$paymentlog->village_id->setDbValue($rs->fields('village_id'));
		$paymentlog->pay_type->setDbValue($rs->fields('pay_type'));
		$paymentlog->pay_detail->setDbValue($rs->fields('pay_detail'));
		$paymentlog->count_member->setDbValue($rs->fields('count_member'));
		$paymentlog->pay_rate->setDbValue($rs->fields('pay_rate'));
		$paymentlog->sub_total->setDbValue($rs->fields('sub_total'));
		$paymentlog->assc_rate->setDbValue($rs->fields('assc_rate'));
		$paymentlog->assc_total->setDbValue($rs->fields('assc_total'));
		$paymentlog->grand_total->setDbValue($rs->fields('grand_total'));
		$paymentlog->pay_note->setDbValue($rs->fields('pay_note'));
		$paymentlog->pml_slipt_num->setDbValue($rs->fields('pml_slipt_num'));
	}

	// Load old record
	function LoadOldRecord() {
		global $paymentlog;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($paymentlog->getKey("pml_id")) <> "")
			$paymentlog->pml_id->CurrentValue = $paymentlog->getKey("pml_id"); // pml_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$paymentlog->CurrentFilter = $paymentlog->KeyFilter();
			$sSql = $paymentlog->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $paymentlog;

		// Initialize URLs
		$this->ViewUrl = $paymentlog->ViewUrl();
		$this->EditUrl = $paymentlog->EditUrl();
		$this->InlineEditUrl = $paymentlog->InlineEditUrl();
		$this->CopyUrl = $paymentlog->CopyUrl();
		$this->InlineCopyUrl = $paymentlog->InlineCopyUrl();
		$this->DeleteUrl = $paymentlog->DeleteUrl();

		// Call Row_Rendering event
		$paymentlog->Row_Rendering();

		// Common render codes for all row types
		// pml_id

		$paymentlog->pml_id->CellCssStyle = "white-space: nowrap;";

		// pay_date
		$paymentlog->pay_date->CellCssStyle = "white-space: nowrap;";

		// t_code
		$paymentlog->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$paymentlog->village_id->CellCssStyle = "white-space: nowrap;";

		// pay_type
		$paymentlog->pay_type->CellCssStyle = "white-space: nowrap;";

		// pay_detail
		$paymentlog->pay_detail->CellCssStyle = "white-space: nowrap;";

		// count_member
		$paymentlog->count_member->CellCssStyle = "white-space: nowrap;";

		// pay_rate
		$paymentlog->pay_rate->CellCssStyle = "white-space: nowrap;";

		// sub_total
		$paymentlog->sub_total->CellCssStyle = "white-space: nowrap;";

		// assc_rate
		$paymentlog->assc_rate->CellCssStyle = "white-space: nowrap;";

		// assc_total
		$paymentlog->assc_total->CellCssStyle = "white-space: nowrap;";

		// grand_total
		$paymentlog->grand_total->CellCssStyle = "white-space: nowrap;";

		// pay_note
		$paymentlog->pay_note->CellCssStyle = "white-space: nowrap;";

		// pml_slipt_num
		$paymentlog->pml_slipt_num->CellCssStyle = "white-space: nowrap;";
		if ($paymentlog->RowType == EW_ROWTYPE_VIEW) { // View row

			// pay_date
			$paymentlog->pay_date->ViewValue = $paymentlog->pay_date->CurrentValue;
			$paymentlog->pay_date->ViewValue = ew_FormatDateTime($paymentlog->pay_date->ViewValue, 7);
			$paymentlog->pay_date->ViewCustomAttributes = "";

			// t_code
			if (strval($paymentlog->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentlog->t_code->CurrentValue) . "'";
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
					$paymentlog->t_code->ViewValue = $rswrk->fields('t_code');
					$paymentlog->t_code->ViewValue .= ew_ValueSeparator(0,1,$paymentlog->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$paymentlog->t_code->ViewValue = $paymentlog->t_code->CurrentValue;
				}
			} else {
				$paymentlog->t_code->ViewValue = NULL;
			}
			$paymentlog->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($paymentlog->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentlog->village_id->CurrentValue) . "";
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
					$paymentlog->village_id->ViewValue = $rswrk->fields('v_code');
					$paymentlog->village_id->ViewValue .= ew_ValueSeparator(0,1,$paymentlog->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$paymentlog->village_id->ViewValue = $paymentlog->village_id->CurrentValue;
				}
			} else {
				$paymentlog->village_id->ViewValue = NULL;
			}
			$paymentlog->village_id->ViewCustomAttributes = "";

			// pay_type
			if (strval($paymentlog->pay_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentlog->pay_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `pt_order`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentlog->pay_type->ViewValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$paymentlog->pay_type->ViewValue = $paymentlog->pay_type->CurrentValue;
				}
			} else {
				$paymentlog->pay_type->ViewValue = NULL;
			}
			$paymentlog->pay_type->ViewCustomAttributes = "";

			// pay_detail
			$paymentlog->pay_detail->ViewValue = $paymentlog->pay_detail->CurrentValue;
			$paymentlog->pay_detail->ViewCustomAttributes = "";

			// count_member
			$paymentlog->count_member->ViewValue = $paymentlog->count_member->CurrentValue;
			$paymentlog->count_member->ViewCustomAttributes = "";

			// pay_rate
			$paymentlog->pay_rate->ViewValue = $paymentlog->pay_rate->CurrentValue;
			$paymentlog->pay_rate->ViewCustomAttributes = "";

			// sub_total
			$paymentlog->sub_total->ViewValue = $paymentlog->sub_total->CurrentValue;
			$paymentlog->sub_total->ViewCustomAttributes = "";

			// assc_rate
			$paymentlog->assc_rate->ViewValue = $paymentlog->assc_rate->CurrentValue;
			$paymentlog->assc_rate->ViewCustomAttributes = "";

			// assc_total
			$paymentlog->assc_total->ViewValue = $paymentlog->assc_total->CurrentValue;
			$paymentlog->assc_total->ViewCustomAttributes = "";

			// grand_total
			$paymentlog->grand_total->ViewValue = $paymentlog->grand_total->CurrentValue;
			$paymentlog->grand_total->ViewCustomAttributes = "";

			// pay_note
			$paymentlog->pay_note->ViewValue = $paymentlog->pay_note->CurrentValue;
			$paymentlog->pay_note->ViewCustomAttributes = "";

			// pml_slipt_num
			$paymentlog->pml_slipt_num->ViewValue = $paymentlog->pml_slipt_num->CurrentValue;
			$paymentlog->pml_slipt_num->ViewCustomAttributes = "";

			// pay_date
			$paymentlog->pay_date->LinkCustomAttributes = "";
			$paymentlog->pay_date->HrefValue = "";
			$paymentlog->pay_date->TooltipValue = "";

			// t_code
			$paymentlog->t_code->LinkCustomAttributes = "";
			$paymentlog->t_code->HrefValue = "";
			$paymentlog->t_code->TooltipValue = "";

			// village_id
			$paymentlog->village_id->LinkCustomAttributes = "";
			$paymentlog->village_id->HrefValue = "";
			$paymentlog->village_id->TooltipValue = "";

			// pay_type
			$paymentlog->pay_type->LinkCustomAttributes = "";
			$paymentlog->pay_type->HrefValue = "";
			$paymentlog->pay_type->TooltipValue = "";

			// pay_detail
			$paymentlog->pay_detail->LinkCustomAttributes = "";
			$paymentlog->pay_detail->HrefValue = "";
			$paymentlog->pay_detail->TooltipValue = "";

			// count_member
			$paymentlog->count_member->LinkCustomAttributes = "";
			$paymentlog->count_member->HrefValue = "";
			$paymentlog->count_member->TooltipValue = "";

			// pay_rate
			$paymentlog->pay_rate->LinkCustomAttributes = "";
			$paymentlog->pay_rate->HrefValue = "";
			$paymentlog->pay_rate->TooltipValue = "";

			// sub_total
			$paymentlog->sub_total->LinkCustomAttributes = "";
			$paymentlog->sub_total->HrefValue = "";
			$paymentlog->sub_total->TooltipValue = "";

			// assc_rate
			$paymentlog->assc_rate->LinkCustomAttributes = "";
			$paymentlog->assc_rate->HrefValue = "";
			$paymentlog->assc_rate->TooltipValue = "";

			// assc_total
			$paymentlog->assc_total->LinkCustomAttributes = "";
			$paymentlog->assc_total->HrefValue = "";
			$paymentlog->assc_total->TooltipValue = "";

			// grand_total
			$paymentlog->grand_total->LinkCustomAttributes = "";
			$paymentlog->grand_total->HrefValue = "";
			$paymentlog->grand_total->TooltipValue = "";

			// pay_note
			$paymentlog->pay_note->LinkCustomAttributes = "";
			$paymentlog->pay_note->HrefValue = "";
			$paymentlog->pay_note->TooltipValue = "";

			// pml_slipt_num
			$paymentlog->pml_slipt_num->LinkCustomAttributes = "";
			$paymentlog->pml_slipt_num->HrefValue = "";
			$paymentlog->pml_slipt_num->TooltipValue = "";
		} elseif ($paymentlog->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// pay_date
			$paymentlog->pay_date->EditCustomAttributes = "";
			$paymentlog->pay_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($paymentlog->pay_date->AdvancedSearch->SearchValue, 7), 7));

			// t_code
			$paymentlog->t_code->EditCustomAttributes = "";
			if (trim(strval($paymentlog->t_code->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentlog->t_code->AdvancedSearch->SearchValue) . "'";
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
			$paymentlog->t_code->EditValue = $arwrk;

			// village_id
			$paymentlog->village_id->EditCustomAttributes = "";
			if (trim(strval($paymentlog->village_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentlog->village_id->AdvancedSearch->SearchValue) . "";
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
			$paymentlog->village_id->EditValue = $arwrk;

			// pay_type
			$paymentlog->pay_type->EditCustomAttributes = "";
			if (trim(strval($paymentlog->pay_type->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentlog->pay_type->AdvancedSearch->SearchValue) . "";
			}
			$sSqlWrk = "SELECT `pt_id`, `pt_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `pt_order`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$paymentlog->pay_type->EditValue = $arwrk;

			// pay_detail
			$paymentlog->pay_detail->EditCustomAttributes = "";
			$paymentlog->pay_detail->EditValue = ew_HtmlEncode($paymentlog->pay_detail->AdvancedSearch->SearchValue);

			// count_member
			$paymentlog->count_member->EditCustomAttributes = "";
			$paymentlog->count_member->EditValue = ew_HtmlEncode($paymentlog->count_member->AdvancedSearch->SearchValue);

			// pay_rate
			$paymentlog->pay_rate->EditCustomAttributes = "";
			$paymentlog->pay_rate->EditValue = ew_HtmlEncode($paymentlog->pay_rate->AdvancedSearch->SearchValue);

			// sub_total
			$paymentlog->sub_total->EditCustomAttributes = "";
			$paymentlog->sub_total->EditValue = ew_HtmlEncode($paymentlog->sub_total->AdvancedSearch->SearchValue);

			// assc_rate
			$paymentlog->assc_rate->EditCustomAttributes = "";
			$paymentlog->assc_rate->EditValue = ew_HtmlEncode($paymentlog->assc_rate->AdvancedSearch->SearchValue);

			// assc_total
			$paymentlog->assc_total->EditCustomAttributes = "";
			$paymentlog->assc_total->EditValue = ew_HtmlEncode($paymentlog->assc_total->AdvancedSearch->SearchValue);

			// grand_total
			$paymentlog->grand_total->EditCustomAttributes = "";
			$paymentlog->grand_total->EditValue = ew_HtmlEncode($paymentlog->grand_total->AdvancedSearch->SearchValue);

			// pay_note
			$paymentlog->pay_note->EditCustomAttributes = "";
			$paymentlog->pay_note->EditValue = ew_HtmlEncode($paymentlog->pay_note->AdvancedSearch->SearchValue);

			// pml_slipt_num
			$paymentlog->pml_slipt_num->EditCustomAttributes = "";
			$paymentlog->pml_slipt_num->EditValue = ew_HtmlEncode($paymentlog->pml_slipt_num->AdvancedSearch->SearchValue);
		}
		if ($paymentlog->RowType == EW_ROWTYPE_ADD ||
			$paymentlog->RowType == EW_ROWTYPE_EDIT ||
			$paymentlog->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$paymentlog->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($paymentlog->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$paymentlog->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $paymentlog;

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
		global $paymentlog;
		$paymentlog->pay_date->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_pay_date");
		$paymentlog->t_code->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_t_code");
		$paymentlog->village_id->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_village_id");
		$paymentlog->pay_type->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_pay_type");
		$paymentlog->pay_detail->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_pay_detail");
		$paymentlog->count_member->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_count_member");
		$paymentlog->pay_rate->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_pay_rate");
		$paymentlog->sub_total->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_sub_total");
		$paymentlog->assc_rate->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_assc_rate");
		$paymentlog->assc_total->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_assc_total");
		$paymentlog->grand_total->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_grand_total");
		$paymentlog->pay_note->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_pay_note");
		$paymentlog->pml_slipt_num->AdvancedSearch->SearchValue = $paymentlog->getAdvancedSearch("x_pml_slipt_num");
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
				$opt =& $this->ListOptions->Add("paylogslipt");
				$opt->Header = "<center>ใบเสร็จ</center>";
				$opt->OnLeft = TRUE; // Link on left
				$opt->MoveTo(3); // Move to first column 

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		   // Example:    
			 global $paymentlog; 
			 global $Language;
			 $this->ListOptions->Items["paylogslipt"]->Body = "<a href='paylogsliptview.php?paylog_id=".$paymentlog->pml_id->CurrentValue."' title='พิมพ์ใบเสร็จรับเงิน' target='_blank'><center><img src='images/ico_send_notice.png' align='absmiddle'></center></a>";

	}
}
?>
