<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "expresspaymentinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$expresspayment_list = new cexpresspayment_list();
$Page =& $expresspayment_list;

// Page init
$expresspayment_list->Page_Init();

// Page main
$expresspayment_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($expresspayment->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expresspayment_list = new ew_Page("expresspayment_list");

// page properties
expresspayment_list.PageID = "list"; // page ID
expresspayment_list.FormID = "fexpresspaymentlist"; // form ID
var EW_PAGE_ID = expresspayment_list.PageID; // for backward compatibility

// extend page with validate function for search
expresspayment_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_expr_slipt_num"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expresspayment->expr_slipt_num->FldErrMsg()) ?>");

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
expresspayment_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expresspayment_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expresspayment_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expresspayment_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($expresspayment->Export == "") || (EW_EXPORT_MASTER_RECORD && $expresspayment->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$expresspayment_list->TotalRecs = $expresspayment->SelectRecordCount();
	} else {
		if ($expresspayment_list->Recordset = $expresspayment_list->LoadRecordset())
			$expresspayment_list->TotalRecs = $expresspayment_list->Recordset->RecordCount();
	}
	$expresspayment_list->StartRec = 1;
	if ($expresspayment_list->DisplayRecs <= 0 || ($expresspayment->Export <> "" && $expresspayment->ExportAll)) // Display all records
		$expresspayment_list->DisplayRecs = $expresspayment_list->TotalRecs;
	if (!($expresspayment->Export <> "" && $expresspayment->ExportAll))
		$expresspayment_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$expresspayment_list->Recordset = $expresspayment_list->LoadRecordset($expresspayment_list->StartRec-1, $expresspayment_list->DisplayRecs);
?>
<div class="phpmaker ewTitle" style="white-space: nowrap;"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expresspayment->TableCaption() ?>
&nbsp;&nbsp;<?php $expresspayment_list->ExportOptions->Render("body"); ?>
</div>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($expresspayment->Export == "" && $expresspayment->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(expresspayment_list);" style="text-decoration: none;"><img src="phpimages/collapse.png" alt="" border="0" align="absmiddle" id="expresspayment_list_SearchImage"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="expresspayment_list_SearchPanel" class="listSearch">
<form name="fexpresspaymentlistsrch" id="fexpresspaymentlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return expresspayment_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="expresspayment">
<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$expresspayment_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$expresspayment->RowType = EW_ROWTYPE_SEARCH;

// Render row
$expresspayment->ResetAttrs();
$expresspayment_list->RenderRow();
?>
<div id="xsr_1" class="ewCssTableRow">
	<span id="xsc_t_code" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $expresspayment->t_code->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_t_code" id="z_t_code" value="LIKE"></span>
		<span class="ewSearchField">
<?php $expresspayment->t_code->EditAttrs["onchange"] = "ew_UpdateOpt('x_village_id','x_t_code',true); " . @$expresspayment->t_code->EditAttrs["onchange"]; ?>
<select id="x_t_code" name="x_t_code"<?php echo $expresspayment->t_code->EditAttributes() ?>>
<?php
if (is_array($expresspayment->t_code->EditValue)) {
	$arwrk = $expresspayment->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expresspayment->t_code->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$expresspayment->t_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
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
</div>
<div id="xsr_2" class="ewCssTableRow">
	<span id="xsc_village_id" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $expresspayment->village_id->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_village_id" id="z_village_id" value="="></span>
		<span class="ewSearchField">
<select id="x_village_id" name="x_village_id"<?php echo $expresspayment->village_id->EditAttributes() ?>>
<?php
if (is_array($expresspayment->village_id->EditValue)) {
	$arwrk = $expresspayment->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expresspayment->village_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$expresspayment->village_id) ?><?php echo $arwrk[$rowcntwrk][2] ?>
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
</div>
<div id="xsr_3" class="ewCssTableRow">
	<span id="xsc_expr_slipt_num" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $expresspayment->expr_slipt_num->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_expr_slipt_num" id="z_expr_slipt_num" value="="></span>
		<span class="ewSearchField">
<input type="text" name="x_expr_slipt_num" id="x_expr_slipt_num" size="30" value="<?php echo $expresspayment->expr_slipt_num->EditValue ?>"<?php echo $expresspayment->expr_slipt_num->EditAttributes() ?>>
</span>
	</span>
</div>
<div id="xsr_4" class="ewCssTableRow">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $expresspayment_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $expresspayment_list->ShowPageHeader(); ?>
<?php
$expresspayment_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($expresspayment->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($expresspayment->CurrentAction <> "gridadd" && $expresspayment->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expresspayment_list->Pager)) $expresspayment_list->Pager = new cPrevNextPager($expresspayment_list->StartRec, $expresspayment_list->DisplayRecs, $expresspayment_list->TotalRecs) ?>
<?php if ($expresspayment_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expresspayment_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_list->PageUrl() ?>start=<?php echo $expresspayment_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expresspayment_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_list->PageUrl() ?>start=<?php echo $expresspayment_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expresspayment_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expresspayment_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_list->PageUrl() ?>start=<?php echo $expresspayment_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expresspayment_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_list->PageUrl() ?>start=<?php echo $expresspayment_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expresspayment_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expresspayment_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expresspayment_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expresspayment_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($expresspayment_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expresspayment_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expresspayment">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($expresspayment_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($expresspayment_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expresspayment_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expresspayment_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($expresspayment_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($expresspayment_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($expresspayment_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($expresspayment_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($expresspayment_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($expresspayment->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $expresspayment_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($expresspayment_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fexpresspaymentlist, '<?php echo $expresspayment_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fexpresspaymentlist" id="fexpresspaymentlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="expresspayment">
<div id="gmp_expresspayment" class="ewGridMiddlePanel">
<?php if ($expresspayment_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $expresspayment->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$expresspayment_list->RenderListOptions();

// Render list options (header, left)
$expresspayment_list->ListOptions->Render("header", "left");
?>
<?php if ($expresspayment->t_code->Visible) { // t_code ?>
	<?php if ($expresspayment->SortUrl($expresspayment->t_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->t_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->t_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->t_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->t_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->t_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->village_id->Visible) { // village_id ?>
	<?php if ($expresspayment->SortUrl($expresspayment->village_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->village_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->village_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->village_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->village_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->village_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->subv_total->Visible) { // subv_total ?>
	<?php if ($expresspayment->SortUrl($expresspayment->subv_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->subv_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->subv_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->subv_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->subv_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->subv_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->subv_detail->Visible) { // subv_detail ?>
	<?php if ($expresspayment->SortUrl($expresspayment->subv_detail) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->subv_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->subv_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->subv_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->subv_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->subv_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->adv_total->Visible) { // adv_total ?>
	<?php if ($expresspayment->SortUrl($expresspayment->adv_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->adv_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->adv_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->adv_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->adv_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->adv_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->adv_detail->Visible) { // adv_detail ?>
	<?php if ($expresspayment->SortUrl($expresspayment->adv_detail) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->adv_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->adv_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->adv_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->adv_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->adv_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->rc_total->Visible) { // rc_total ?>
	<?php if ($expresspayment->SortUrl($expresspayment->rc_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->rc_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->rc_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->rc_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->rc_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->rc_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->rc_detail->Visible) { // rc_detail ?>
	<?php if ($expresspayment->SortUrl($expresspayment->rc_detail) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->rc_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->rc_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->rc_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->rc_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->rc_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>	
<?php if ($expresspayment->annual_total->Visible) { // annual_total ?>
	<?php if ($expresspayment->SortUrl($expresspayment->annual_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->annual_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->annual_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->annual_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->annual_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->annual_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->annual_detail->Visible) { // annual_detail ?>
	<?php if ($expresspayment->SortUrl($expresspayment->annual_detail) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->annual_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->annual_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->annual_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->annual_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->annual_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->regis_total->Visible) { // regis_total ?>
	<?php if ($expresspayment->SortUrl($expresspayment->regis_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->regis_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->regis_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->regis_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->regis_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->regis_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->regis_detail->Visible) { // regis_detail ?>
	<?php if ($expresspayment->SortUrl($expresspayment->regis_detail) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->regis_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->regis_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->regis_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->regis_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->regis_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->other_total->Visible) { // other_total ?>
	<?php if ($expresspayment->SortUrl($expresspayment->other_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->other_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->other_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->other_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->other_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->other_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->other_detail->Visible) { // other_detail ?>
	<?php if ($expresspayment->SortUrl($expresspayment->other_detail) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->other_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->other_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->other_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->other_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->other_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->expr_total->Visible) { // expr_total ?>
	<?php if ($expresspayment->SortUrl($expresspayment->expr_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->expr_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->expr_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->expr_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->expr_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->expr_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->expr_note->Visible) { // expr_note ?>
	<?php if ($expresspayment->SortUrl($expresspayment->expr_note) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->expr_note->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->expr_note) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->expr_note->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->expr_note->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->expr_note->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->expr_pay_date->Visible) { // expr_pay_date ?>
	<?php if ($expresspayment->SortUrl($expresspayment->expr_pay_date) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->expr_pay_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->expr_pay_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->expr_pay_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->expr_pay_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->expr_pay_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expresspayment->expr_slipt_num->Visible) { // expr_slipt_num ?>
	<?php if ($expresspayment->SortUrl($expresspayment->expr_slipt_num) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expresspayment->expr_slipt_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expresspayment->SortUrl($expresspayment->expr_slipt_num) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expresspayment->expr_slipt_num->FldCaption() ?></td><td style="width: 10px;"><?php if ($expresspayment->expr_slipt_num->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expresspayment->expr_slipt_num->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$expresspayment_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($expresspayment->ExportAll && $expresspayment->Export <> "") {
	$expresspayment_list->StopRec = $expresspayment_list->TotalRecs;
} else {

	// Set the last record to display
	if ($expresspayment_list->TotalRecs > $expresspayment_list->StartRec + $expresspayment_list->DisplayRecs - 1)
		$expresspayment_list->StopRec = $expresspayment_list->StartRec + $expresspayment_list->DisplayRecs - 1;
	else
		$expresspayment_list->StopRec = $expresspayment_list->TotalRecs;
}
$expresspayment_list->RecCnt = $expresspayment_list->StartRec - 1;
if ($expresspayment_list->Recordset && !$expresspayment_list->Recordset->EOF) {
	$expresspayment_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $expresspayment_list->StartRec > 1)
		$expresspayment_list->Recordset->Move($expresspayment_list->StartRec - 1);
} elseif (!$expresspayment->AllowAddDeleteRow && $expresspayment_list->StopRec == 0) {
	$expresspayment_list->StopRec = $expresspayment->GridAddRowCount;
}

// Initialize aggregate
$expresspayment->RowType = EW_ROWTYPE_AGGREGATEINIT;
$expresspayment->ResetAttrs();
$expresspayment_list->RenderRow();
$expresspayment_list->RowCnt = 0;
while ($expresspayment_list->RecCnt < $expresspayment_list->StopRec) {
	$expresspayment_list->RecCnt++;
	if (intval($expresspayment_list->RecCnt) >= intval($expresspayment_list->StartRec)) {
		$expresspayment_list->RowCnt++;

		// Set up key count
		$expresspayment_list->KeyCount = $expresspayment_list->RowIndex;

		// Init row class and style
		$expresspayment->ResetAttrs();
		$expresspayment->CssClass = "";
		if ($expresspayment->CurrentAction == "gridadd") {
		} else {
			$expresspayment_list->LoadRowValues($expresspayment_list->Recordset); // Load row values
		}
		$expresspayment->RowType = EW_ROWTYPE_VIEW; // Render view
		$expresspayment->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$expresspayment_list->RenderRow();

		// Render list options
		$expresspayment_list->RenderListOptions();
?>
	<tr<?php echo $expresspayment->RowAttributes() ?>>
<?php

// Render list options (body, left)
$expresspayment_list->ListOptions->Render("body", "left");
?>
	<?php if ($expresspayment->t_code->Visible) { // t_code ?>
		<td<?php echo $expresspayment->t_code->CellAttributes() ?>>
<div<?php echo $expresspayment->t_code->ViewAttributes() ?>><?php echo $expresspayment->t_code->ListViewValue() ?></div>
<a name="<?php echo $expresspayment_list->PageObjName . "_row_" . $expresspayment_list->RowCnt ?>" id="<?php echo $expresspayment_list->PageObjName . "_row_" . $expresspayment_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($expresspayment->village_id->Visible) { // village_id ?>
		<td<?php echo $expresspayment->village_id->CellAttributes() ?>>
<div<?php echo $expresspayment->village_id->ViewAttributes() ?>><?php echo $expresspayment->village_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->subv_total->Visible) { // subv_total ?>
		<td<?php echo $expresspayment->subv_total->CellAttributes() ?>>
<div<?php echo $expresspayment->subv_total->ViewAttributes() ?>><?php echo $expresspayment->subv_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->subv_detail->Visible) { // subv_detail ?>
		<td<?php echo $expresspayment->subv_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->subv_detail->ViewAttributes() ?>><?php echo $expresspayment->subv_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->adv_total->Visible) { // adv_total ?>
		<td<?php echo $expresspayment->adv_total->CellAttributes() ?>>
<div<?php echo $expresspayment->adv_total->ViewAttributes() ?>><?php echo $expresspayment->adv_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->adv_detail->Visible) { // adv_detail ?>
		<td<?php echo $expresspayment->adv_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->adv_detail->ViewAttributes() ?>><?php echo $expresspayment->adv_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($expresspayment->rc_total->Visible) { // rc_total ?>
		<td<?php echo $expresspayment->rc_total->CellAttributes() ?>>
<div<?php echo $expresspayment->rc_total->ViewAttributes() ?>><?php echo $expresspayment->rc_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->rc_detail->Visible) { // rc_detail ?>
		<td<?php echo $expresspayment->rc_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->rc_detail->ViewAttributes() ?>><?php echo $expresspayment->rc_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->annual_total->Visible) { // annual_total ?>
		<td<?php echo $expresspayment->annual_total->CellAttributes() ?>>
<div<?php echo $expresspayment->annual_total->ViewAttributes() ?>><?php echo $expresspayment->annual_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->annual_detail->Visible) { // annual_detail ?>
		<td<?php echo $expresspayment->annual_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->annual_detail->ViewAttributes() ?>><?php echo $expresspayment->annual_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->regis_total->Visible) { // regis_total ?>
		<td<?php echo $expresspayment->regis_total->CellAttributes() ?>>
<div<?php echo $expresspayment->regis_total->ViewAttributes() ?>><?php echo $expresspayment->regis_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->regis_detail->Visible) { // regis_detail ?>
		<td<?php echo $expresspayment->regis_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->regis_detail->ViewAttributes() ?>><?php echo $expresspayment->regis_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->other_total->Visible) { // other_total ?>
		<td<?php echo $expresspayment->other_total->CellAttributes() ?> width="80">
<div<?php echo $expresspayment->other_total->ViewAttributes() ?>><?php echo $expresspayment->other_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->other_detail->Visible) { // other_detail ?>
		<td<?php echo $expresspayment->other_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->other_detail->ViewAttributes() ?>><?php echo $expresspayment->other_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->expr_total->Visible) { // expr_total ?>
		<td<?php echo $expresspayment->expr_total->CellAttributes() ?>>
<div<?php echo $expresspayment->expr_total->ViewAttributes() ?>><?php echo $expresspayment->expr_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->expr_note->Visible) { // expr_note ?>
		<td<?php echo $expresspayment->expr_note->CellAttributes() ?>>
<div<?php echo $expresspayment->expr_note->ViewAttributes() ?>><?php echo $expresspayment->expr_note->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->expr_pay_date->Visible) { // expr_pay_date ?>
		<td<?php echo $expresspayment->expr_pay_date->CellAttributes() ?>>
<div<?php echo $expresspayment->expr_pay_date->ViewAttributes() ?>><?php echo $expresspayment->expr_pay_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expresspayment->expr_slipt_num->Visible) { // expr_slipt_num ?>
		<td<?php echo $expresspayment->expr_slipt_num->CellAttributes() ?> align="center">
<div<?php echo $expresspayment->expr_slipt_num->ViewAttributes() ?>><?php echo $expresspayment->expr_slipt_num->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$expresspayment_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($expresspayment->CurrentAction <> "gridadd")
		$expresspayment_list->Recordset->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$expresspayment->RowType = EW_ROWTYPE_AGGREGATE;
$expresspayment->ResetAttrs();
$expresspayment_list->RenderRow();
?>
<?php if ($expresspayment_list->TotalRecs > 0 && ($expresspayment->CurrentAction <> "gridadd" && $expresspayment->CurrentAction <> "gridedit")) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$expresspayment_list->RenderListOptions();

// Render list options (footer, left)
$expresspayment_list->ListOptions->Render("footer", "left");
?>
	<?php if ($expresspayment->t_code->Visible) { // t_code ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($expresspayment->village_id->Visible) { // village_id ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($expresspayment->subv_total->Visible) { // subv_total ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expresspayment->subv_total->ViewAttributes() ?>><?php echo $expresspayment->subv_total->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expresspayment->subv_detail->Visible) { // subv_detail ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($expresspayment->adv_total->Visible) { // adv_total ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expresspayment->adv_total->ViewAttributes() ?>><?php echo $expresspayment->adv_total->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expresspayment->adv_detail->Visible) { // adv_detail ?>
<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expresspayment->rc_total->Visible) { // rc_total ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expresspayment->rc_total->ViewAttributes() ?>><?php echo $expresspayment->rc_total->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expresspayment->rc_detail->Visible) { // rc_detail ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expresspayment->annual_total->Visible) { // annual_total ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expresspayment->annual_total->ViewAttributes() ?>><?php echo $expresspayment->annual_total->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expresspayment->annual_detail->Visible) { // annual_detail ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($expresspayment->regis_total->Visible) { // regis_total ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expresspayment->regis_total->ViewAttributes() ?>><?php echo $expresspayment->regis_total->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expresspayment->regis_detail->Visible) { // regis_detail ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($expresspayment->other_total->Visible) { // other_total ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expresspayment->other_total->ViewAttributes() ?>><?php echo $expresspayment->other_total->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expresspayment->other_detail->Visible) { // other_detail ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($expresspayment->expr_total->Visible) { // expr_total ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expresspayment->expr_total->ViewAttributes() ?>><?php echo $expresspayment->expr_total->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expresspayment->expr_note->Visible) { // expr_note ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($expresspayment->expr_pay_date->Visible) { // expr_pay_date ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
	<?php if ($expresspayment->expr_slipt_num->Visible) { // expr_slipt_num ?>
		<td>&nbsp;
		
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$expresspayment_list->ListOptions->Render("footer", "right");
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
if ($expresspayment_list->Recordset)
	$expresspayment_list->Recordset->Close();
?>
<?php if ($expresspayment_list->TotalRecs > 0) { ?>
<?php if ($expresspayment->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($expresspayment->CurrentAction <> "gridadd" && $expresspayment->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expresspayment_list->Pager)) $expresspayment_list->Pager = new cPrevNextPager($expresspayment_list->StartRec, $expresspayment_list->DisplayRecs, $expresspayment_list->TotalRecs) ?>
<?php if ($expresspayment_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expresspayment_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_list->PageUrl() ?>start=<?php echo $expresspayment_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expresspayment_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_list->PageUrl() ?>start=<?php echo $expresspayment_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expresspayment_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expresspayment_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_list->PageUrl() ?>start=<?php echo $expresspayment_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expresspayment_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_list->PageUrl() ?>start=<?php echo $expresspayment_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expresspayment_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expresspayment_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expresspayment_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expresspayment_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($expresspayment_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expresspayment_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expresspayment">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($expresspayment_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($expresspayment_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expresspayment_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expresspayment_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($expresspayment_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($expresspayment_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($expresspayment_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($expresspayment_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($expresspayment_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($expresspayment->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $expresspayment_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($expresspayment_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fexpresspaymentlist, '<?php echo $expresspayment_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($expresspayment->Export == "" && $expresspayment->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(expresspayment_list); // Init search panel as collapsed

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_village_id','x_t_code',false],
['x_t_code','x_t_code',false]]);

//-->
</script>
<?php } ?>
<?php
$expresspayment_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($expresspayment->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$expresspayment_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpresspayment_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'expresspayment';

	// Page object name
	var $PageObjName = 'expresspayment_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expresspayment;
		if ($expresspayment->UseTokenInUrl) $PageUrl .= "t=" . $expresspayment->TableVar . "&"; // Add page token
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
		global $objForm, $expresspayment;
		if ($expresspayment->UseTokenInUrl) {
			if ($objForm)
				return ($expresspayment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expresspayment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpresspayment_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expresspayment)
		if (!isset($GLOBALS["expresspayment"])) {
			$GLOBALS["expresspayment"] = new cexpresspayment();
			$GLOBALS["Table"] =& $GLOBALS["expresspayment"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "expresspaymentadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "expresspaymentdelete.php";
		$this->MultiUpdateUrl = "expresspaymentupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expresspayment', TRUE);

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
		global $expresspayment;

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
			$expresspayment->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $expresspayment;

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
			if ($expresspayment->Export <> "" ||
				$expresspayment->CurrentAction == "gridadd" ||
				$expresspayment->CurrentAction == "gridedit") {
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
			$expresspayment->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($expresspayment->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $expresspayment->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$expresspayment->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$expresspayment->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$expresspayment->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $expresspayment->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$expresspayment->setSessionWhere($sFilter);
		$expresspayment->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $expresspayment;
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
			$expresspayment->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$expresspayment->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $expresspayment;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $expresspayment->t_code, FALSE); // t_code
		$this->BuildSearchSql($sWhere, $expresspayment->village_id, FALSE); // village_id
		$this->BuildSearchSql($sWhere, $expresspayment->expr_slipt_num, FALSE); // expr_slipt_num

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($expresspayment->t_code); // t_code
			$this->SetSearchParm($expresspayment->village_id); // village_id
			$this->SetSearchParm($expresspayment->expr_slipt_num); // expr_slipt_num
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
		global $expresspayment;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$expresspayment->setAdvancedSearch("x_$FldParm", $FldVal);
		$expresspayment->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$expresspayment->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$expresspayment->setAdvancedSearch("y_$FldParm", $FldVal2);
		$expresspayment->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $expresspayment;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $expresspayment->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $expresspayment->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $expresspayment->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $expresspayment->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $expresspayment->getAdvancedSearch("w_$FldParm");
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
		global $expresspayment;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$expresspayment->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $expresspayment;
		$expresspayment->setAdvancedSearch("x_t_code", "");
		$expresspayment->setAdvancedSearch("x_village_id", "");
		$expresspayment->setAdvancedSearch("x_expr_slipt_num", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $expresspayment;
		$bRestore = TRUE;
		if ($expresspayment->t_code->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($expresspayment->village_id->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($expresspayment->expr_slipt_num->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($expresspayment->t_code);
			$this->GetSearchParm($expresspayment->village_id);
			$this->GetSearchParm($expresspayment->expr_slipt_num);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $expresspayment;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$expresspayment->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$expresspayment->CurrentOrderType = @$_GET["ordertype"];
			$expresspayment->UpdateSort($expresspayment->t_code); // t_code
			$expresspayment->UpdateSort($expresspayment->village_id); // village_id
			$expresspayment->UpdateSort($expresspayment->subv_total); // subv_total
			$expresspayment->UpdateSort($expresspayment->subv_detail); // subv_detail
			$expresspayment->UpdateSort($expresspayment->adv_total); // adv_total
			$expresspayment->UpdateSort($expresspayment->adv_detail); // adv_detail
			$expresspayment->UpdateSort($expresspayment->rc_total); // rc_total
			$expresspayment->UpdateSort($expresspayment->rc_detail); // rc_detail
			$expresspayment->UpdateSort($expresspayment->annual_total); // annual_total
			$expresspayment->UpdateSort($expresspayment->annual_detail); // annual_detail
			$expresspayment->UpdateSort($expresspayment->regis_total); // regis_total
			$expresspayment->UpdateSort($expresspayment->regis_detail); // regis_detail
			$expresspayment->UpdateSort($expresspayment->other_total); // other_total
			$expresspayment->UpdateSort($expresspayment->other_detail); // other_detail
			$expresspayment->UpdateSort($expresspayment->expr_total); // expr_total
			$expresspayment->UpdateSort($expresspayment->expr_note); // expr_note
			$expresspayment->UpdateSort($expresspayment->expr_pay_date); // expr_pay_date
			$expresspayment->UpdateSort($expresspayment->expr_slipt_num); // expr_slipt_num
			$expresspayment->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $expresspayment;
		$sOrderBy = $expresspayment->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($expresspayment->SqlOrderBy() <> "") {
				$sOrderBy = $expresspayment->SqlOrderBy();
				$expresspayment->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $expresspayment;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$expresspayment->setSessionOrderBy($sOrderBy);
				$expresspayment->t_code->setSort("");
				$expresspayment->village_id->setSort("");
				$expresspayment->subv_total->setSort("");
				$expresspayment->subv_detail->setSort("");
				$expresspayment->adv_total->setSort("");
				$expresspayment->adv_detail->setSort("");
				$expresspayment->rc_total->setSort("");
				$expresspayment->rc_detail->setSort("");
				$expresspayment->annual_total->setSort("");
				$expresspayment->annual_detail->setSort("");
				$expresspayment->regis_total->setSort("");
				$expresspayment->regis_detail->setSort("");
				$expresspayment->other_total->setSort("");
				$expresspayment->other_detail->setSort("");
				$expresspayment->expr_total->setSort("");
				$expresspayment->expr_note->setSort("");
				$expresspayment->expr_pay_date->setSort("");
				$expresspayment->expr_slipt_num->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$expresspayment->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $expresspayment;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"expresspayment_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $expresspayment, $objForm;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($expresspayment->expr_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $expresspayment;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $expresspayment;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$expresspayment->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$expresspayment->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $expresspayment->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$expresspayment->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$expresspayment->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$expresspayment->setStartRecordNumber($this->StartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $expresspayment;

		// Load search values
		// t_code

		$expresspayment->t_code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_t_code"]);
		$expresspayment->t_code->AdvancedSearch->SearchOperator = @$_GET["z_t_code"];

		// village_id
		$expresspayment->village_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_village_id"]);
		$expresspayment->village_id->AdvancedSearch->SearchOperator = @$_GET["z_village_id"];

		// expr_slipt_num
		$expresspayment->expr_slipt_num->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_expr_slipt_num"]);
		$expresspayment->expr_slipt_num->AdvancedSearch->SearchOperator = @$_GET["z_expr_slipt_num"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expresspayment;

		// Call Recordset Selecting event
		$expresspayment->Recordset_Selecting($expresspayment->CurrentFilter);

		// Load List page SQL
		$sSql = $expresspayment->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expresspayment->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expresspayment;
		$sFilter = $expresspayment->KeyFilter();

		// Call Row Selecting event
		$expresspayment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expresspayment->CurrentFilter = $sFilter;
		$sSql = $expresspayment->SQL();
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
		global $conn, $expresspayment;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$expresspayment->Row_Selected($row);
		$expresspayment->expr_id->setDbValue($rs->fields('expr_id'));
		$expresspayment->t_code->setDbValue($rs->fields('t_code'));
		$expresspayment->village_id->setDbValue($rs->fields('village_id'));
		$expresspayment->subv_total->setDbValue($rs->fields('subv_total'));
		$expresspayment->subv_detail->setDbValue($rs->fields('subv_detail'));
		$expresspayment->adv_total->setDbValue($rs->fields('adv_total'));
		$expresspayment->adv_detail->setDbValue($rs->fields('adv_detail'));
		$expresspayment->rc_total->setDbValue($rs->fields('rc_total'));
		$expresspayment->rc_detail->setDbValue($rs->fields('rc_detail'));
		$expresspayment->annual_total->setDbValue($rs->fields('annual_total'));
		$expresspayment->annual_detail->setDbValue($rs->fields('annual_detail'));
		$expresspayment->regis_total->setDbValue($rs->fields('regis_total'));
		$expresspayment->regis_detail->setDbValue($rs->fields('regis_detail'));
		$expresspayment->other_total->setDbValue($rs->fields('other_total'));
		$expresspayment->other_detail->setDbValue($rs->fields('other_detail'));
		$expresspayment->expr_total->setDbValue($rs->fields('expr_total'));
		$expresspayment->expr_note->setDbValue($rs->fields('expr_note'));
		$expresspayment->expr_pay_date->setDbValue($rs->fields('expr_pay_date'));
		$expresspayment->expr_slipt_num->setDbValue($rs->fields('expr_slipt_num'));
	}

	// Load old record
	function LoadOldRecord() {
		global $expresspayment;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($expresspayment->getKey("expr_id")) <> "")
			$expresspayment->expr_id->CurrentValue = $expresspayment->getKey("expr_id"); // expr_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$expresspayment->CurrentFilter = $expresspayment->KeyFilter();
			$sSql = $expresspayment->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expresspayment;

		// Initialize URLs
		$this->ViewUrl = $expresspayment->ViewUrl();
		$this->EditUrl = $expresspayment->EditUrl();
		$this->InlineEditUrl = $expresspayment->InlineEditUrl();
		$this->CopyUrl = $expresspayment->CopyUrl();
		$this->InlineCopyUrl = $expresspayment->InlineCopyUrl();
		$this->DeleteUrl = $expresspayment->DeleteUrl();

		// Call Row_Rendering event
		$expresspayment->Row_Rendering();

		// Common render codes for all row types
		// expr_id

		$expresspayment->expr_id->CellCssStyle = "white-space: nowrap;";

		// t_code
		$expresspayment->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$expresspayment->village_id->CellCssStyle = "white-space: nowrap;";

		// subv_total
		$expresspayment->subv_total->CellCssStyle = "white-space: nowrap;";

		// subv_detail
		$expresspayment->subv_detail->CellCssStyle = "white-space: nowrap;";

		// adv_total
		$expresspayment->adv_total->CellCssStyle = "white-space: nowrap;";

		// adv_detail
		$expresspayment->adv_detail->CellCssStyle = "white-space: nowrap;";

		// rc_total
		$expresspayment->rc_total->CellCssStyle = "white-space: nowrap;";

		// rc_detail
		$expresspayment->rc_detail->CellCssStyle = "white-space: nowrap;";

		// annual_total
		$expresspayment->annual_total->CellCssStyle = "white-space: nowrap;";

		// annual_detail
		$expresspayment->annual_detail->CellCssStyle = "white-space: nowrap;";

		// regis_total
		$expresspayment->regis_total->CellCssStyle = "white-space: nowrap;";

		// regis_detail
		$expresspayment->regis_detail->CellCssStyle = "white-space: nowrap;";

		// other_total
		$expresspayment->other_total->CellCssStyle = "white-space: nowrap;";

		// other_detail
		$expresspayment->other_detail->CellCssStyle = "white-space: nowrap;";

		// expr_total
		$expresspayment->expr_total->CellCssStyle = "white-space: nowrap;";

		// expr_note
		$expresspayment->expr_note->CellCssStyle = "white-space: nowrap;";

		// expr_pay_date
		$expresspayment->expr_pay_date->CellCssStyle = "white-space: nowrap;";

		// expr_slipt_num
		$expresspayment->expr_slipt_num->CellCssStyle = "white-space: nowrap;";

	// Accumulate aggregate value
		if ($expresspayment->RowType <> EW_ROWTYPE_AGGREGATEINIT && $expresspayment->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($expresspayment->subv_total->CurrentValue))
				$expresspayment->subv_total->Total += $expresspayment->subv_total->CurrentValue; // Accumulate total
			if (is_numeric($expresspayment->adv_total->CurrentValue))
				$expresspayment->adv_total->Total += $expresspayment->adv_total->CurrentValue; // Accumulate total
			if (is_numeric($expresspayment->rc_total->CurrentValue))
				$expresspayment->rc_total->Total += $expresspayment->rc_total->CurrentValue; // Accumulate total
			if (is_numeric($expresspayment->annual_total->CurrentValue))
				$expresspayment->annual_total->Total += $expresspayment->annual_total->CurrentValue; // Accumulate total
			if (is_numeric($expresspayment->regis_total->CurrentValue))
				$expresspayment->regis_total->Total += $expresspayment->regis_total->CurrentValue; // Accumulate total
			if (is_numeric($expresspayment->other_total->CurrentValue))
				$expresspayment->other_total->Total += $expresspayment->other_total->CurrentValue; // Accumulate total
			if (is_numeric($expresspayment->expr_total->CurrentValue))
				$expresspayment->expr_total->Total += $expresspayment->expr_total->CurrentValue; // Accumulate total
		}
	
		if ($expresspayment->RowType == EW_ROWTYPE_VIEW) { // View row

			// t_code
			if (strval($expresspayment->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($expresspayment->t_code->CurrentValue) . "'";
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
					$expresspayment->t_code->ViewValue = $rswrk->fields('t_code');
					$expresspayment->t_code->ViewValue .= ew_ValueSeparator(0,1,$expresspayment->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$expresspayment->t_code->ViewValue = $expresspayment->t_code->CurrentValue;
				}
			} else {
				$expresspayment->t_code->ViewValue = NULL;
			}
			$expresspayment->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($expresspayment->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($expresspayment->village_id->CurrentValue) . "";
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
					$expresspayment->village_id->ViewValue = $rswrk->fields('v_code');
					$expresspayment->village_id->ViewValue .= ew_ValueSeparator(0,1,$expresspayment->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$expresspayment->village_id->ViewValue = $expresspayment->village_id->CurrentValue;
				}
			} else {
				$expresspayment->village_id->ViewValue = NULL;
			}
			$expresspayment->village_id->ViewCustomAttributes = "";

			// subv_total
			$expresspayment->subv_total->ViewValue = $expresspayment->subv_total->CurrentValue;
			$expresspayment->subv_total->ViewValue = ew_FormatCurrency($expresspayment->subv_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->subv_total->ViewCustomAttributes = "";

			// subv_detail
			$expresspayment->subv_detail->ViewValue = $expresspayment->subv_detail->CurrentValue;
			$expresspayment->subv_detail->ViewCustomAttributes = "";

			// adv_total
			$expresspayment->adv_total->ViewValue = $expresspayment->adv_total->CurrentValue;
			$expresspayment->adv_total->ViewValue = ew_FormatCurrency($expresspayment->adv_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->adv_total->ViewCustomAttributes = "";

			// adv_detail
			$expresspayment->adv_detail->ViewValue = $expresspayment->adv_detail->CurrentValue;
			$expresspayment->adv_detail->ViewCustomAttributes = "";

			// rc_total
			$expresspayment->rc_total->ViewValue = $expresspayment->rc_total->CurrentValue;
			$expresspayment->rc_total->ViewCustomAttributes = "";

			// rc_detail
			$expresspayment->rc_detail->ViewValue = $expresspayment->rc_detail->CurrentValue;
			$expresspayment->rc_detail->ViewCustomAttributes = "";
			// annual_total
			$expresspayment->annual_total->ViewValue = $expresspayment->annual_total->CurrentValue;
			$expresspayment->annual_total->ViewValue = ew_FormatCurrency($expresspayment->annual_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->annual_total->ViewCustomAttributes = "";

			// annual_detail
			$expresspayment->annual_detail->ViewValue = $expresspayment->annual_detail->CurrentValue;
			$expresspayment->annual_detail->ViewCustomAttributes = "";

			// regis_total
			$expresspayment->regis_total->ViewValue = $expresspayment->regis_total->CurrentValue;
			$expresspayment->regis_total->ViewValue = ew_FormatCurrency($expresspayment->regis_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->regis_total->ViewCustomAttributes = "";

			// regis_detail
			$expresspayment->regis_detail->ViewValue = $expresspayment->regis_detail->CurrentValue;
			$expresspayment->regis_detail->ViewCustomAttributes = "";

			// other_total
			$expresspayment->other_total->ViewValue = $expresspayment->other_total->CurrentValue;
			$expresspayment->other_total->ViewValue = ew_FormatCurrency($expresspayment->other_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->other_total->ViewCustomAttributes = "";

			// other_detail
			$expresspayment->other_detail->ViewValue = $expresspayment->other_detail->CurrentValue;
			$expresspayment->other_detail->ViewCustomAttributes = "";

			// expr_total
			$expresspayment->expr_total->ViewValue = $expresspayment->expr_total->CurrentValue;
			$expresspayment->expr_total->ViewValue = ew_FormatCurrency($expresspayment->expr_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->expr_total->ViewCustomAttributes = "";

			// expr_note
			$expresspayment->expr_note->ViewValue = $expresspayment->expr_note->CurrentValue;
			$expresspayment->expr_note->ViewCustomAttributes = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->ViewValue = $expresspayment->expr_pay_date->CurrentValue;
			$expresspayment->expr_pay_date->ViewValue = ew_FormatDateTime($expresspayment->expr_pay_date->ViewValue, 7);
			$expresspayment->expr_pay_date->ViewCustomAttributes = "";

			// expr_slipt_num
			$expresspayment->expr_slipt_num->ViewValue = $expresspayment->expr_slipt_num->CurrentValue;
			$expresspayment->expr_slipt_num->ViewCustomAttributes = "";

			// t_code
			$expresspayment->t_code->LinkCustomAttributes = "";
			$expresspayment->t_code->HrefValue = "";
			$expresspayment->t_code->TooltipValue = "";

			// village_id
			$expresspayment->village_id->LinkCustomAttributes = "";
			$expresspayment->village_id->HrefValue = "";
			$expresspayment->village_id->TooltipValue = "";

			// subv_total
			$expresspayment->subv_total->LinkCustomAttributes = "";
			$expresspayment->subv_total->HrefValue = "";
			$expresspayment->subv_total->TooltipValue = "";

			// subv_detail
			$expresspayment->subv_detail->LinkCustomAttributes = "";
			$expresspayment->subv_detail->HrefValue = "";
			$expresspayment->subv_detail->TooltipValue = "";

			// adv_total
			$expresspayment->adv_total->LinkCustomAttributes = "";
			$expresspayment->adv_total->HrefValue = "";
			$expresspayment->adv_total->TooltipValue = "";

			// adv_detail
			$expresspayment->adv_detail->LinkCustomAttributes = "";
			$expresspayment->adv_detail->HrefValue = "";
			$expresspayment->adv_detail->TooltipValue = "";

			// rc_total
			$expresspayment->rc_total->LinkCustomAttributes = "";
			$expresspayment->rc_total->HrefValue = "";
			$expresspayment->rc_total->TooltipValue = "";

			// rc_detail
			$expresspayment->rc_detail->LinkCustomAttributes = "";
			$expresspayment->rc_detail->HrefValue = "";
			$expresspayment->rc_detail->TooltipValue = "";

			// annual_total
			$expresspayment->annual_total->LinkCustomAttributes = "";
			$expresspayment->annual_total->HrefValue = "";
			$expresspayment->annual_total->TooltipValue = "";

			// annual_detail
			$expresspayment->annual_detail->LinkCustomAttributes = "";
			$expresspayment->annual_detail->HrefValue = "";
			$expresspayment->annual_detail->TooltipValue = "";

			// regis_total
			$expresspayment->regis_total->LinkCustomAttributes = "";
			$expresspayment->regis_total->HrefValue = "";
			$expresspayment->regis_total->TooltipValue = "";

			// regis_detail
			$expresspayment->regis_detail->LinkCustomAttributes = "";
			$expresspayment->regis_detail->HrefValue = "";
			$expresspayment->regis_detail->TooltipValue = "";

			// other_total
			$expresspayment->other_total->LinkCustomAttributes = "";
			$expresspayment->other_total->HrefValue = "";
			$expresspayment->other_total->TooltipValue = "";

			// other_detail
			$expresspayment->other_detail->LinkCustomAttributes = "";
			$expresspayment->other_detail->HrefValue = "";
			$expresspayment->other_detail->TooltipValue = "";

			// expr_total
			$expresspayment->expr_total->LinkCustomAttributes = "";
			$expresspayment->expr_total->HrefValue = "";
			$expresspayment->expr_total->TooltipValue = "";

			// expr_note
			$expresspayment->expr_note->LinkCustomAttributes = "";
			$expresspayment->expr_note->HrefValue = "";
			$expresspayment->expr_note->TooltipValue = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->LinkCustomAttributes = "";
			$expresspayment->expr_pay_date->HrefValue = "";
			$expresspayment->expr_pay_date->TooltipValue = "";

			// expr_slipt_num
			$expresspayment->expr_slipt_num->LinkCustomAttributes = "";
			$expresspayment->expr_slipt_num->HrefValue = "";
			$expresspayment->expr_slipt_num->TooltipValue = "";
		} elseif ($expresspayment->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// t_code
			$expresspayment->t_code->EditCustomAttributes = "";
			if (trim(strval($expresspayment->t_code->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($expresspayment->t_code->AdvancedSearch->SearchValue) . "'";
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
			$expresspayment->t_code->EditValue = $arwrk;

			// village_id
			$expresspayment->village_id->EditCustomAttributes = "";
			if (trim(strval($expresspayment->village_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($expresspayment->village_id->AdvancedSearch->SearchValue) . "";
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
			$expresspayment->village_id->EditValue = $arwrk;

			// subv_total
			$expresspayment->subv_total->EditCustomAttributes = "";
			$expresspayment->subv_total->EditValue = ew_HtmlEncode($expresspayment->subv_total->AdvancedSearch->SearchValue);

			// subv_detail
			$expresspayment->subv_detail->EditCustomAttributes = "";
			$expresspayment->subv_detail->EditValue = ew_HtmlEncode($expresspayment->subv_detail->AdvancedSearch->SearchValue);

			// adv_total
			$expresspayment->adv_total->EditCustomAttributes = "";
			$expresspayment->adv_total->EditValue = ew_HtmlEncode($expresspayment->adv_total->AdvancedSearch->SearchValue);

			// adv_detail
			$expresspayment->adv_detail->EditCustomAttributes = "";
			$expresspayment->adv_detail->EditValue = ew_HtmlEncode($expresspayment->adv_detail->AdvancedSearch->SearchValue);

			// rc_total
			$expresspayment->rc_total->EditCustomAttributes = "";
			$expresspayment->rc_total->EditValue = ew_HtmlEncode($expresspayment->rc_total->AdvancedSearch->SearchValue);

			// rc_detail
			$expresspayment->rc_detail->EditCustomAttributes = "";
			$expresspayment->rc_detail->EditValue = ew_HtmlEncode($expresspayment->rc_detail->AdvancedSearch->SearchValue);

			// annual_total
			$expresspayment->annual_total->EditCustomAttributes = "";
			$expresspayment->annual_total->EditValue = ew_HtmlEncode($expresspayment->annual_total->AdvancedSearch->SearchValue);

			// annual_detail
			$expresspayment->annual_detail->EditCustomAttributes = "";
			$expresspayment->annual_detail->EditValue = ew_HtmlEncode($expresspayment->annual_detail->AdvancedSearch->SearchValue);

			// regis_total
			$expresspayment->regis_total->EditCustomAttributes = "";
			$expresspayment->regis_total->EditValue = ew_HtmlEncode($expresspayment->regis_total->AdvancedSearch->SearchValue);

			// regis_detail
			$expresspayment->regis_detail->EditCustomAttributes = "";
			$expresspayment->regis_detail->EditValue = ew_HtmlEncode($expresspayment->regis_detail->AdvancedSearch->SearchValue);

			// other_total
			$expresspayment->other_total->EditCustomAttributes = "";
			$expresspayment->other_total->EditValue = ew_HtmlEncode($expresspayment->other_total->AdvancedSearch->SearchValue);

			// other_detail
			$expresspayment->other_detail->EditCustomAttributes = "";
			$expresspayment->other_detail->EditValue = ew_HtmlEncode($expresspayment->other_detail->AdvancedSearch->SearchValue);

			// expr_total
			$expresspayment->expr_total->EditCustomAttributes = "";
			$expresspayment->expr_total->EditValue = ew_HtmlEncode($expresspayment->expr_total->AdvancedSearch->SearchValue);

			// expr_note
			$expresspayment->expr_note->EditCustomAttributes = "";
			$expresspayment->expr_note->EditValue = ew_HtmlEncode($expresspayment->expr_note->AdvancedSearch->SearchValue);

			// expr_pay_date
			$expresspayment->expr_pay_date->EditCustomAttributes = "";
			$expresspayment->expr_pay_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($expresspayment->expr_pay_date->AdvancedSearch->SearchValue, 7), 7));

			// expr_slipt_num
			$expresspayment->expr_slipt_num->EditCustomAttributes = "";
			$expresspayment->expr_slipt_num->EditValue = ew_HtmlEncode($expresspayment->expr_slipt_num->AdvancedSearch->SearchValue);
		} elseif ($expresspayment->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$expresspayment->subv_total->Total = 0; // Initialize total
			$expresspayment->adv_total->Total = 0; // Initialize total
			$expresspayment->rc_total->Total = 0; // Initialize total
			$expresspayment->annual_total->Total = 0; // Initialize total
			$expresspayment->regis_total->Total = 0; // Initialize total
			$expresspayment->other_total->Total = 0; // Initialize total
			$expresspayment->expr_total->Total = 0; // Initialize total
		} elseif ($expresspayment->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$expresspayment->subv_total->CurrentValue = $expresspayment->subv_total->Total;
			$expresspayment->subv_total->ViewValue = $expresspayment->subv_total->CurrentValue;
			$expresspayment->subv_total->ViewValue = ew_FormatCurrency($expresspayment->subv_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->subv_total->ViewCustomAttributes = "";
			$expresspayment->subv_total->HrefValue = ""; // Clear href value
			$expresspayment->adv_total->CurrentValue = $expresspayment->adv_total->Total;
			$expresspayment->adv_total->ViewValue = $expresspayment->adv_total->CurrentValue;
			$expresspayment->adv_total->ViewValue = ew_FormatCurrency($expresspayment->adv_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->adv_total->ViewCustomAttributes = "";
			$expresspayment->adv_total->HrefValue = ""; // Clear href value
			$expresspayment->rc_total->CurrentValue = $expresspayment->rc_total->Total;
			$expresspayment->rc_total->ViewValue = $expresspayment->rc_total->CurrentValue;
			$expresspayment->rc_total->ViewCustomAttributes = "";
			$expresspayment->rc_total->HrefValue = ""; // Clear href value
			$expresspayment->annual_total->CurrentValue = $expresspayment->annual_total->Total;
			$expresspayment->annual_total->ViewValue = $expresspayment->annual_total->CurrentValue;
			$expresspayment->annual_total->ViewValue = ew_FormatCurrency($expresspayment->annual_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->annual_total->ViewCustomAttributes = "";
			$expresspayment->annual_total->HrefValue = ""; // Clear href value
			$expresspayment->regis_total->CurrentValue = $expresspayment->regis_total->Total;
			$expresspayment->regis_total->ViewValue = $expresspayment->regis_total->CurrentValue;
			$expresspayment->regis_total->ViewValue = ew_FormatCurrency($expresspayment->regis_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->regis_total->ViewCustomAttributes = "";
			$expresspayment->regis_total->HrefValue = ""; // Clear href value
			$expresspayment->other_total->CurrentValue = $expresspayment->other_total->Total;
			$expresspayment->other_total->ViewValue = $expresspayment->other_total->CurrentValue;
			$expresspayment->other_total->ViewValue = ew_FormatCurrency($expresspayment->other_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->other_total->ViewCustomAttributes = "";
			$expresspayment->other_total->HrefValue = ""; // Clear href value
			$expresspayment->expr_total->CurrentValue = $expresspayment->expr_total->Total;
			$expresspayment->expr_total->ViewValue = $expresspayment->expr_total->CurrentValue;
			$expresspayment->expr_total->ViewValue = ew_FormatCurrency($expresspayment->expr_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->expr_total->ViewCustomAttributes = "";
			$expresspayment->expr_total->HrefValue = ""; // Clear href value
	
		}
		if ($expresspayment->RowType == EW_ROWTYPE_ADD ||
			$expresspayment->RowType == EW_ROWTYPE_EDIT ||
			$expresspayment->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$expresspayment->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($expresspayment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expresspayment->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $expresspayment;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($expresspayment->expr_slipt_num->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $expresspayment->expr_slipt_num->FldErrMsg());
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
		global $expresspayment;
		$expresspayment->t_code->AdvancedSearch->SearchValue = $expresspayment->getAdvancedSearch("x_t_code");
		$expresspayment->village_id->AdvancedSearch->SearchValue = $expresspayment->getAdvancedSearch("x_village_id");
		$expresspayment->expr_slipt_num->AdvancedSearch->SearchValue = $expresspayment->getAdvancedSearch("x_expr_slipt_num");
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
				$opt =& $this->ListOptions->Add("expressslipt");
				$opt->Header = "<center>ใบเสร็จ</center>";
				$opt->OnLeft = TRUE; // Link on left
				$opt->MoveTo(3); // Move to first column 
	}

		// ListOptions Rendered event
	function ListOptions_Rendered() {

	   // Example:    
			 global $expresspayment; 
			 global $Language;
			 $this->ListOptions->Items["expressslipt"]->Body = "<a href='exprsubvsliptview.php?expr_id=".$expresspayment->expr_id->CurrentValue."' title='พิมพ์ใบเสร็จรับเงิน' target='_blank'><center><img src='images/ico_send_notice.png' align='absmiddle'></center></a>";
	}                                                                                                                                                                                                              
}
?>
