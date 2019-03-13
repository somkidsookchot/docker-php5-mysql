<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subvchargeinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subvcharge_list = new csubvcharge_list();
$Page =& $subvcharge_list;

// Page init
$subvcharge_list->Page_Init();

// Page main
$subvcharge_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($subvcharge->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subvcharge_list = new ew_Page("subvcharge_list");

// page properties
subvcharge_list.PageID = "list"; // page ID
subvcharge_list.FormID = "fsubvchargelist"; // form ID
var EW_PAGE_ID = subvcharge_list.PageID; // for backward compatibility

// extend page with validate function for search
subvcharge_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_member_code"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcharge->member_code->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_subvc_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcharge->subvc_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_subvc_slipt_num"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcharge->subvc_slipt_num->FldErrMsg()) ?>");

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
subvcharge_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subvcharge_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subvcharge_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subvcharge_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($subvcharge->Export == "") || (EW_EXPORT_MASTER_RECORD && $subvcharge->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$subvcharge_list->TotalRecs = $subvcharge->SelectRecordCount();
	} else {
		if ($subvcharge_list->Recordset = $subvcharge_list->LoadRecordset())
			$subvcharge_list->TotalRecs = $subvcharge_list->Recordset->RecordCount();
	}
	$subvcharge_list->StartRec = 1;
	if ($subvcharge_list->DisplayRecs <= 0 || ($subvcharge->Export <> "" && $subvcharge->ExportAll)) // Display all records
		$subvcharge_list->DisplayRecs = $subvcharge_list->TotalRecs;
	if (!($subvcharge->Export <> "" && $subvcharge->ExportAll))
		$subvcharge_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$subvcharge_list->Recordset = $subvcharge_list->LoadRecordset($subvcharge_list->StartRec-1, $subvcharge_list->DisplayRecs);
?>
<div class="ewTitle"><img src="images/finance55x55.png" width="40" height="40" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subvcharge->TableCaption() ?>
&nbsp;&nbsp; </div>
<div class="clear"></div>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($subvcharge->Export == "" && $subvcharge->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(subvcharge_list);" style="text-decoration: none;"><img id="subvcharge_list_SearchImage" src="phpimages/collapse.png" alt=""  border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="subvcharge_list_SearchPanel" class="listSearch">
  <form name="fsubvchargelistsrch" id="fsubvchargelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return subvcharge_list.ValidateSearch(this);">
    <input type="hidden" id="t2" name="t2" value="subvcharge" />
    <div class="ewBasicSearch">
      <?php
if ($gsSearchError == "")
	$subvcharge_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$subvcharge->RowType = EW_ROWTYPE_SEARCH;

// Render row
$subvcharge->ResetAttrs();
$subvcharge_list->RenderRow();
?>
      <span id="xsc_member_code" class="ewCssTableCell"> <span class="ewSearchCaption"><?php echo $subvcharge->member_code->FldCaption() ?></span> <span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?>
        <input type="hidden" name="z_member_code" id="z_member_code" value="LIKE" />
        </span> <span class="ewSearchField"> <span id="as_x_member_code" style="white-space: nowrap; z-index: 8980">
          <input type="text" name="sv_x_member_code" id="sv_x_member_code" value="<?php echo $subvcharge->member_code->EditValue ?>" size="10" maxlength="100"<?php echo $subvcharge->member_code->EditAttributes() ?> />
          &nbsp;<span id="em_x_member_code" class="ewMessage" style="display: none"><?php echo str_replace("%f", "phpimages/", $Language->Phrase("UnmatchedValue")) ?></span> </span>
          <input type="hidden" name="x_member_code" id="x_member_code" value="<?php echo $subvcharge->member_code->AdvancedSearch->SearchValue ?>" />
          <?php
$sSqlWrk = "SELECT `member_code`, `dead_id`, `fname`, `lname` FROM `members`";
$sWhereWrk = "`dead_id`  LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
          <input type="hidden" name="s_x_member_code" id="s_x_member_code" value="<?php echo $sSqlWrk ?>" />
          <script type="text/javascript">
<!--
var oas_x_member_code = new ew_AutoSuggest("sv_x_member_code", "sc_x_member_code", "s_x_member_code", "em_x_member_code", "x_member_code", "", false, EW_AUTO_SUGGEST_MAX_ENTRIES);
oas_x_member_code.formatResult = function(ar) {	
	var df1 = ar[1];
	var df2 = ar[2];
	if (df2 != "")
		df1 += EW_FIELD_SEP + df2;
	var df3 = ar[3];
	if (df3 != "")
		df1 += EW_FIELD_SEP + df3;
	return df1;
};
oas_x_member_code.ac.typeAhead = false;

//-->
</script>
          </span> </span> <span id="xsc_subvc_status" class="ewCssTableCell"> <span class="ewSearchCaption"><?php echo $subvcharge->subvc_status->FldCaption() ?></span> <span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?>
            <input type="hidden" name="z_subvc_status" id="z_subvc_status" value="LIKE" />
            </span> <span class="ewSearchField">
              <select id="x_subvc_status" name="x_subvc_status"<?php echo $subvcharge->subvc_status->EditAttributes() ?>>
                <?php
if (is_array($subvcharge->subvc_status->EditValue)) {
	$arwrk = $subvcharge->subvc_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subvcharge->subvc_status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
                <option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>> <?php echo $arwrk[$rowcntwrk][1] ?> </option>
                <?php
	}
}
?>
              </select>
              </span> </span>
      <div class="clear"></div>
      <span id="xsc_subvc_date" class="ewCssTableCell"> <span class="ewSearchCaption"><?php echo $subvcharge->subvc_date->FldCaption() ?></span> <span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?>
        <input type="hidden" name="z_subvc_date" id="z_subvc_date" value="=" />
        </span> <span class="ewSearchField">
          <input name="x_subvc_date" type="text" id="x_subvc_date" value="<?php echo $subvcharge->subvc_date->EditValue ?>" size="20"<?php echo $subvcharge->subvc_date->EditAttributes() ?> />
          &nbsp;<img src="phpimages/calendar.png" id="cal_x_subvc_date" name="cal_x_subvc_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;" />
          <script type="text/javascript">
Calendar.setup({
	inputField: "x_subvc_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_subvc_date" // button id
});
</script>
          </span> </span> <span id="xsc_subvc_slipt_num" class="ewCssTableCell"> <span class="ewSearchCaption"><?php echo $subvcharge->subvc_slipt_num->FldCaption() ?></span> <span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?>
            <input type="hidden" name="z_subvc_slipt_num" id="z_subvc_slipt_num" value="=" />
            </span> <span class="ewSearchField">
              <input type="text" name="x_subvc_slipt_num" id="x_subvc_slipt_num" size="5" value="<?php echo $subvcharge->subvc_slipt_num->EditValue ?>"<?php echo $subvcharge->subvc_slipt_num->EditAttributes() ?> />
              </span> </span>
      <div id="xsr_5" class="ewCssTableRow">
        <input type="submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>" />
        &nbsp; <a href="<?php echo $subvcharge_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp; </div>
    </div>
  </form>
</div>
<?php } ?>
<?php } ?>
<?php $subvcharge_list->ShowPageHeader(); ?>
<?php
$subvcharge_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($subvcharge->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($subvcharge->CurrentAction <> "gridadd" && $subvcharge->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subvcharge_list->Pager)) $subvcharge_list->Pager = new cPrevNextPager($subvcharge_list->StartRec, $subvcharge_list->DisplayRecs, $subvcharge_list->TotalRecs) ?>
<?php if ($subvcharge_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subvcharge_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_list->PageUrl() ?>start=<?php echo $subvcharge_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subvcharge_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_list->PageUrl() ?>start=<?php echo $subvcharge_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subvcharge_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subvcharge_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_list->PageUrl() ?>start=<?php echo $subvcharge_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subvcharge_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_list->PageUrl() ?>start=<?php echo $subvcharge_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subvcharge_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subvcharge_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subvcharge_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subvcharge_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($subvcharge_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($subvcharge_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="subvcharge">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($subvcharge_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($subvcharge_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($subvcharge_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($subvcharge_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($subvcharge_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($subvcharge_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($subvcharge_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($subvcharge_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($subvcharge_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($subvcharge->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($subvcharge_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsubvchargelist, '<?php echo $subvcharge_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fsubvchargelist" id="fsubvchargelist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="subvcharge">
<div id="gmp_subvcharge" class="ewGridMiddlePanel">
<?php if ($subvcharge_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $subvcharge->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$subvcharge_list->RenderListOptions();

// Render list options (header, left)
$subvcharge_list->ListOptions->Render("header", "left");
?>
<?php if ($subvcharge->member_code->Visible) { // member_code ?>
	<?php if ($subvcharge->SortUrl($subvcharge->member_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcharge->member_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcharge->SortUrl($subvcharge->member_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcharge->member_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->member_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->member_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->subvc_total->Visible) { // subvc_total ?>
	<?php if ($subvcharge->SortUrl($subvcharge->subvc_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcharge->subvc_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcharge->SortUrl($subvcharge->subvc_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcharge->subvc_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->subvc_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->subvc_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->assc_percent->Visible) { // assc_percent ?>
	<?php if ($subvcharge->SortUrl($subvcharge->assc_percent) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcharge->assc_percent->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcharge->SortUrl($subvcharge->assc_percent) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcharge->assc_percent->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->assc_percent->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->assc_percent->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->assc_total->Visible) { // assc_total ?>
	<?php if ($subvcharge->SortUrl($subvcharge->assc_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcharge->assc_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcharge->SortUrl($subvcharge->assc_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcharge->assc_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->assc_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->assc_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->bnfc_total->Visible) { // bnfc_total ?>
	<?php if ($subvcharge->SortUrl($subvcharge->bnfc_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcharge->bnfc_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcharge->SortUrl($subvcharge->bnfc_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcharge->bnfc_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->bnfc_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->bnfc_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->subvc_status->Visible) { // subvc_status ?>
	<?php if ($subvcharge->SortUrl($subvcharge->subvc_status) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcharge->subvc_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcharge->SortUrl($subvcharge->subvc_status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcharge->subvc_status->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->subvc_status->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->subvc_status->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->subvc_date->Visible) { // subvc_date ?>
	<?php if ($subvcharge->SortUrl($subvcharge->subvc_date) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcharge->subvc_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcharge->SortUrl($subvcharge->subvc_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcharge->subvc_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->subvc_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->subvc_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->subvc_slipt_num->Visible) { // subvc_slipt_num ?>
	<?php if ($subvcharge->SortUrl($subvcharge->subvc_slipt_num) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcharge->subvc_slipt_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subvcharge->SortUrl($subvcharge->subvc_slipt_num) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcharge->subvc_slipt_num->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->subvc_slipt_num->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->subvc_slipt_num->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$subvcharge_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($subvcharge->ExportAll && $subvcharge->Export <> "") {
	$subvcharge_list->StopRec = $subvcharge_list->TotalRecs;
} else {

	// Set the last record to display
	if ($subvcharge_list->TotalRecs > $subvcharge_list->StartRec + $subvcharge_list->DisplayRecs - 1)
		$subvcharge_list->StopRec = $subvcharge_list->StartRec + $subvcharge_list->DisplayRecs - 1;
	else
		$subvcharge_list->StopRec = $subvcharge_list->TotalRecs;
}
$subvcharge_list->RecCnt = $subvcharge_list->StartRec - 1;
if ($subvcharge_list->Recordset && !$subvcharge_list->Recordset->EOF) {
	$subvcharge_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $subvcharge_list->StartRec > 1)
		$subvcharge_list->Recordset->Move($subvcharge_list->StartRec - 1);
} elseif (!$subvcharge->AllowAddDeleteRow && $subvcharge_list->StopRec == 0) {
	$subvcharge_list->StopRec = $subvcharge->GridAddRowCount;
}

// Initialize aggregate
$subvcharge->RowType = EW_ROWTYPE_AGGREGATEINIT;
$subvcharge->ResetAttrs();
$subvcharge_list->RenderRow();
$subvcharge_list->RowCnt = 0;
while ($subvcharge_list->RecCnt < $subvcharge_list->StopRec) {
	$subvcharge_list->RecCnt++;
	if (intval($subvcharge_list->RecCnt) >= intval($subvcharge_list->StartRec)) {
		$subvcharge_list->RowCnt++;

		// Set up key count
		$subvcharge_list->KeyCount = $subvcharge_list->RowIndex;

		// Init row class and style
		$subvcharge->ResetAttrs();
		$subvcharge->CssClass = "";
		if ($subvcharge->CurrentAction == "gridadd") {
		} else {
			$subvcharge_list->LoadRowValues($subvcharge_list->Recordset); // Load row values
		}
		$subvcharge->RowType = EW_ROWTYPE_VIEW; // Render view
		$subvcharge->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$subvcharge_list->RenderRow();

		// Render list options
		$subvcharge_list->RenderListOptions();
?>
	<tr<?php echo $subvcharge->RowAttributes() ?>>
<?php

// Render list options (body, left)
$subvcharge_list->ListOptions->Render("body", "left");
?>
	<?php if ($subvcharge->member_code->Visible) { // member_code ?>
		<td<?php echo $subvcharge->member_code->CellAttributes() ?>>
<div<?php echo $subvcharge->member_code->ViewAttributes() ?>><?php echo $subvcharge->member_code->ListViewValue() ?></div>
<a name="<?php echo $subvcharge_list->PageObjName . "_row_" . $subvcharge_list->RowCnt ?>" id="<?php echo $subvcharge_list->PageObjName . "_row_" . $subvcharge_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($subvcharge->subvc_total->Visible) { // subvc_total ?>
		<td<?php echo $subvcharge->subvc_total->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_total->ViewAttributes() ?>><?php echo number_format($subvcharge->subvc_total->ListViewValue()) ?></div>
</td>
	<?php } ?>
	<?php if ($subvcharge->assc_percent->Visible) { // assc_percent ?>
		<td<?php echo $subvcharge->assc_percent->CellAttributes() ?>>
<div<?php echo $subvcharge->assc_percent->ViewAttributes() ?>><?php echo $subvcharge->assc_percent->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcharge->assc_total->Visible) { // assc_total ?>
		<td<?php echo $subvcharge->assc_total->CellAttributes() ?>>
<div<?php echo $subvcharge->assc_total->ViewAttributes() ?>><?php echo number_format($subvcharge->assc_total->ListViewValue()) ?></div>
</td>
	<?php } ?>
	<?php if ($subvcharge->bnfc_total->Visible) { // bnfc_total ?>
		<td<?php echo $subvcharge->bnfc_total->CellAttributes() ?>>
<div<?php echo $subvcharge->bnfc_total->ViewAttributes() ?>><?php echo number_format($subvcharge->bnfc_total->ListViewValue()) ?></div>
</td>
	<?php } ?>
	<?php if ($subvcharge->subvc_status->Visible) { // subvc_status ?>
		<td<?php echo $subvcharge->subvc_status->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_status->ViewAttributes() ?>><?php echo $subvcharge->subvc_status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcharge->subvc_date->Visible) { // subvc_date ?>
		<td<?php echo $subvcharge->subvc_date->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_date->ViewAttributes() ?>><?php echo $subvcharge->subvc_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subvcharge->subvc_slipt_num->Visible) { // subvc_slipt_num ?>
		<td<?php echo $subvcharge->subvc_slipt_num->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_slipt_num->ViewAttributes() ?>><?php echo $subvcharge->subvc_slipt_num->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subvcharge_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($subvcharge->CurrentAction <> "gridadd")
		$subvcharge_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($subvcharge_list->Recordset)
	$subvcharge_list->Recordset->Close();
?>
<?php if ($subvcharge_list->TotalRecs > 0) { ?>
<?php if ($subvcharge->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($subvcharge->CurrentAction <> "gridadd" && $subvcharge->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subvcharge_list->Pager)) $subvcharge_list->Pager = new cPrevNextPager($subvcharge_list->StartRec, $subvcharge_list->DisplayRecs, $subvcharge_list->TotalRecs) ?>
<?php if ($subvcharge_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subvcharge_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_list->PageUrl() ?>start=<?php echo $subvcharge_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subvcharge_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_list->PageUrl() ?>start=<?php echo $subvcharge_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subvcharge_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subvcharge_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_list->PageUrl() ?>start=<?php echo $subvcharge_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subvcharge_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_list->PageUrl() ?>start=<?php echo $subvcharge_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subvcharge_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subvcharge_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subvcharge_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subvcharge_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($subvcharge_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($subvcharge_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="subvcharge">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($subvcharge_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($subvcharge_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($subvcharge_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($subvcharge_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($subvcharge_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($subvcharge_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($subvcharge_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($subvcharge_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($subvcharge_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($subvcharge->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($subvcharge_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsubvchargelist, '<?php echo $subvcharge_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($subvcharge->Export == "" && $subvcharge->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(subvcharge_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$subvcharge_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($subvcharge->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$subvcharge_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csubvcharge_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'subvcharge';

	// Page object name
	var $PageObjName = 'subvcharge_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subvcharge;
		if ($subvcharge->UseTokenInUrl) $PageUrl .= "t=" . $subvcharge->TableVar . "&"; // Add page token
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
		global $objForm, $subvcharge;
		if ($subvcharge->UseTokenInUrl) {
			if ($objForm)
				return ($subvcharge->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subvcharge->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubvcharge_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subvcharge)
		if (!isset($GLOBALS["subvcharge"])) {
			$GLOBALS["subvcharge"] = new csubvcharge();
			$GLOBALS["Table"] =& $GLOBALS["subvcharge"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "subvchargeadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "subvchargedelete.php";
		$this->MultiUpdateUrl = "subvchargeupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subvcharge', TRUE);

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
		global $subvcharge;

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
			$subvcharge->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $subvcharge;

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
			if ($subvcharge->Export <> "" ||
				$subvcharge->CurrentAction == "gridadd" ||
				$subvcharge->CurrentAction == "gridedit") {
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
			$subvcharge->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($subvcharge->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $subvcharge->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$subvcharge->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$subvcharge->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$subvcharge->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $subvcharge->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$subvcharge->setSessionWhere($sFilter);
		$subvcharge->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $subvcharge;
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
			$subvcharge->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$subvcharge->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $subvcharge;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $subvcharge->member_code, FALSE); // member_code
		$this->BuildSearchSql($sWhere, $subvcharge->all_member, FALSE); // all_member
		$this->BuildSearchSql($sWhere, $subvcharge->alive_count, FALSE); // alive_count
		$this->BuildSearchSql($sWhere, $subvcharge->dead_count, FALSE); // dead_count
		$this->BuildSearchSql($sWhere, $subvcharge->resign_count, FALSE); // resign_count
		$this->BuildSearchSql($sWhere, $subvcharge->terminate_count, FALSE); // terminate_count
		$this->BuildSearchSql($sWhere, $subvcharge->subv_rate, FALSE); // subv_rate
		$this->BuildSearchSql($sWhere, $subvcharge->can_pay_count, FALSE); // can_pay_count
		$this->BuildSearchSql($sWhere, $subvcharge->cant_pay_count, FALSE); // cant_pay_count
		$this->BuildSearchSql($sWhere, $subvcharge->cant_pay_detail, FALSE); // cant_pay_detail
		$this->BuildSearchSql($sWhere, $subvcharge->subvc_total, FALSE); // subvc_total
		$this->BuildSearchSql($sWhere, $subvcharge->assc_percent, FALSE); // assc_percent
		$this->BuildSearchSql($sWhere, $subvcharge->assc_total, FALSE); // assc_total
		$this->BuildSearchSql($sWhere, $subvcharge->bnfc_total, FALSE); // bnfc_total
		$this->BuildSearchSql($sWhere, $subvcharge->canculate_date, FALSE); // canculate_date
		$this->BuildSearchSql($sWhere, $subvcharge->subvc_status, FALSE); // subvc_status
		$this->BuildSearchSql($sWhere, $subvcharge->subvc_date, FALSE); // subvc_date
		$this->BuildSearchSql($sWhere, $subvcharge->subvc_slipt_num, FALSE); // subvc_slipt_num

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($subvcharge->member_code); // member_code
			$this->SetSearchParm($subvcharge->all_member); // all_member
			$this->SetSearchParm($subvcharge->alive_count); // alive_count
			$this->SetSearchParm($subvcharge->dead_count); // dead_count
			$this->SetSearchParm($subvcharge->resign_count); // resign_count
			$this->SetSearchParm($subvcharge->terminate_count); // terminate_count
			$this->SetSearchParm($subvcharge->subv_rate); // subv_rate
			$this->SetSearchParm($subvcharge->can_pay_count); // can_pay_count
			$this->SetSearchParm($subvcharge->cant_pay_count); // cant_pay_count
			$this->SetSearchParm($subvcharge->cant_pay_detail); // cant_pay_detail
			$this->SetSearchParm($subvcharge->subvc_total); // subvc_total
			$this->SetSearchParm($subvcharge->assc_percent); // assc_percent
			$this->SetSearchParm($subvcharge->assc_total); // assc_total
			$this->SetSearchParm($subvcharge->bnfc_total); // bnfc_total
			$this->SetSearchParm($subvcharge->canculate_date); // canculate_date
			$this->SetSearchParm($subvcharge->subvc_status); // subvc_status
			$this->SetSearchParm($subvcharge->subvc_date); // subvc_date
			$this->SetSearchParm($subvcharge->subvc_slipt_num); // subvc_slipt_num
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
		global $subvcharge;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$subvcharge->setAdvancedSearch("x_$FldParm", $FldVal);
		$subvcharge->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$subvcharge->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$subvcharge->setAdvancedSearch("y_$FldParm", $FldVal2);
		$subvcharge->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $subvcharge;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $subvcharge->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $subvcharge->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $subvcharge->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $subvcharge->getAdvancedSearch("w_$FldParm");
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
		global $subvcharge;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$subvcharge->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $subvcharge;
		$subvcharge->setAdvancedSearch("x_member_code", "");
		$subvcharge->setAdvancedSearch("x_all_member", "");
		$subvcharge->setAdvancedSearch("x_alive_count", "");
		$subvcharge->setAdvancedSearch("x_dead_count", "");
		$subvcharge->setAdvancedSearch("x_resign_count", "");
		$subvcharge->setAdvancedSearch("x_terminate_count", "");
		$subvcharge->setAdvancedSearch("x_subv_rate", "");
		$subvcharge->setAdvancedSearch("x_can_pay_count", "");
		$subvcharge->setAdvancedSearch("x_cant_pay_count", "");
		$subvcharge->setAdvancedSearch("x_cant_pay_detail", "");
		$subvcharge->setAdvancedSearch("x_subvc_total", "");
		$subvcharge->setAdvancedSearch("x_assc_percent", "");
		$subvcharge->setAdvancedSearch("x_assc_total", "");
		$subvcharge->setAdvancedSearch("x_bnfc_total", "");
		$subvcharge->setAdvancedSearch("x_canculate_date", "");
		$subvcharge->setAdvancedSearch("x_subvc_status", "");
		$subvcharge->setAdvancedSearch("x_subvc_date", "");
		$subvcharge->setAdvancedSearch("x_subvc_slipt_num", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $subvcharge;
		$bRestore = TRUE;
		if ($subvcharge->member_code->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->all_member->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->alive_count->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->dead_count->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->resign_count->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->terminate_count->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->subv_rate->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->can_pay_count->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->cant_pay_count->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->cant_pay_detail->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->subvc_total->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->assc_percent->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->assc_total->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->bnfc_total->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->canculate_date->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->subvc_status->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->subvc_date->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($subvcharge->subvc_slipt_num->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($subvcharge->member_code);
			$this->GetSearchParm($subvcharge->all_member);
			$this->GetSearchParm($subvcharge->alive_count);
			$this->GetSearchParm($subvcharge->dead_count);
			$this->GetSearchParm($subvcharge->resign_count);
			$this->GetSearchParm($subvcharge->terminate_count);
			$this->GetSearchParm($subvcharge->subv_rate);
			$this->GetSearchParm($subvcharge->can_pay_count);
			$this->GetSearchParm($subvcharge->cant_pay_count);
			$this->GetSearchParm($subvcharge->cant_pay_detail);
			$this->GetSearchParm($subvcharge->subvc_total);
			$this->GetSearchParm($subvcharge->assc_percent);
			$this->GetSearchParm($subvcharge->assc_total);
			$this->GetSearchParm($subvcharge->bnfc_total);
			$this->GetSearchParm($subvcharge->canculate_date);
			$this->GetSearchParm($subvcharge->subvc_status);
			$this->GetSearchParm($subvcharge->subvc_date);
			$this->GetSearchParm($subvcharge->subvc_slipt_num);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $subvcharge;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$subvcharge->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$subvcharge->CurrentOrderType = @$_GET["ordertype"];
			$subvcharge->UpdateSort($subvcharge->member_code); // member_code
			$subvcharge->UpdateSort($subvcharge->subvc_total); // subvc_total
			$subvcharge->UpdateSort($subvcharge->assc_percent); // assc_percent
			$subvcharge->UpdateSort($subvcharge->assc_total); // assc_total
			$subvcharge->UpdateSort($subvcharge->bnfc_total); // bnfc_total
			$subvcharge->UpdateSort($subvcharge->subvc_status); // subvc_status
			$subvcharge->UpdateSort($subvcharge->subvc_date); // subvc_date
			$subvcharge->UpdateSort($subvcharge->subvc_slipt_num); // subvc_slipt_num
			$subvcharge->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $subvcharge;
		$sOrderBy = $subvcharge->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($subvcharge->SqlOrderBy() <> "") {
				$sOrderBy = $subvcharge->SqlOrderBy();
				$subvcharge->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $subvcharge;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$subvcharge->setSessionOrderBy($sOrderBy);
				$subvcharge->member_code->setSort("");
				$subvcharge->subvc_total->setSort("");
				$subvcharge->assc_percent->setSort("");
				$subvcharge->assc_total->setSort("");
				$subvcharge->bnfc_total->setSort("");
				$subvcharge->subvc_status->setSort("");
				$subvcharge->subvc_date->setSort("");
				$subvcharge->subvc_slipt_num->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$subvcharge->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $subvcharge;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"subvcharge_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $subvcharge, $objForm;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($subvcharge->subvc_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $subvcharge;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subvcharge;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$subvcharge->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$subvcharge->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $subvcharge->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$subvcharge->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$subvcharge->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$subvcharge->setStartRecordNumber($this->StartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $subvcharge;

		// Load search values
		// member_code

		$subvcharge->member_code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_member_code"]);
		$subvcharge->member_code->AdvancedSearch->SearchOperator = @$_GET["z_member_code"];

		// all_member
		$subvcharge->all_member->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_all_member"]);
		$subvcharge->all_member->AdvancedSearch->SearchOperator = @$_GET["z_all_member"];

		// alive_count
		$subvcharge->alive_count->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_alive_count"]);
		$subvcharge->alive_count->AdvancedSearch->SearchOperator = @$_GET["z_alive_count"];

		// dead_count
		$subvcharge->dead_count->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_dead_count"]);
		$subvcharge->dead_count->AdvancedSearch->SearchOperator = @$_GET["z_dead_count"];

		// resign_count
		$subvcharge->resign_count->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_resign_count"]);
		$subvcharge->resign_count->AdvancedSearch->SearchOperator = @$_GET["z_resign_count"];

		// terminate_count
		$subvcharge->terminate_count->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_terminate_count"]);
		$subvcharge->terminate_count->AdvancedSearch->SearchOperator = @$_GET["z_terminate_count"];

		// subv_rate
		$subvcharge->subv_rate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_subv_rate"]);
		$subvcharge->subv_rate->AdvancedSearch->SearchOperator = @$_GET["z_subv_rate"];

		// can_pay_count
		$subvcharge->can_pay_count->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_can_pay_count"]);
		$subvcharge->can_pay_count->AdvancedSearch->SearchOperator = @$_GET["z_can_pay_count"];

		// cant_pay_count
		$subvcharge->cant_pay_count->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_cant_pay_count"]);
		$subvcharge->cant_pay_count->AdvancedSearch->SearchOperator = @$_GET["z_cant_pay_count"];

		// cant_pay_detail
		$subvcharge->cant_pay_detail->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_cant_pay_detail"]);
		$subvcharge->cant_pay_detail->AdvancedSearch->SearchOperator = @$_GET["z_cant_pay_detail"];

		// subvc_total
		$subvcharge->subvc_total->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_subvc_total"]);
		$subvcharge->subvc_total->AdvancedSearch->SearchOperator = @$_GET["z_subvc_total"];

		// assc_percent
		$subvcharge->assc_percent->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_assc_percent"]);
		$subvcharge->assc_percent->AdvancedSearch->SearchOperator = @$_GET["z_assc_percent"];

		// assc_total
		$subvcharge->assc_total->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_assc_total"]);
		$subvcharge->assc_total->AdvancedSearch->SearchOperator = @$_GET["z_assc_total"];

		// bnfc_total
		$subvcharge->bnfc_total->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_bnfc_total"]);
		$subvcharge->bnfc_total->AdvancedSearch->SearchOperator = @$_GET["z_bnfc_total"];

		// canculate_date
		$subvcharge->canculate_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_canculate_date"]);
		$subvcharge->canculate_date->AdvancedSearch->SearchOperator = @$_GET["z_canculate_date"];

		// subvc_status
		$subvcharge->subvc_status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_subvc_status"]);
		$subvcharge->subvc_status->AdvancedSearch->SearchOperator = @$_GET["z_subvc_status"];

		// subvc_date
		$subvcharge->subvc_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_subvc_date"]);
		$subvcharge->subvc_date->AdvancedSearch->SearchOperator = @$_GET["z_subvc_date"];

		// subvc_slipt_num
		$subvcharge->subvc_slipt_num->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_subvc_slipt_num"]);
		$subvcharge->subvc_slipt_num->AdvancedSearch->SearchOperator = @$_GET["z_subvc_slipt_num"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subvcharge;

		// Call Recordset Selecting event
		$subvcharge->Recordset_Selecting($subvcharge->CurrentFilter);

		// Load List page SQL
		$sSql = $subvcharge->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subvcharge->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subvcharge;
		$sFilter = $subvcharge->KeyFilter();

		// Call Row Selecting event
		$subvcharge->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subvcharge->CurrentFilter = $sFilter;
		$sSql = $subvcharge->SQL();
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
		global $conn, $subvcharge;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subvcharge->Row_Selected($row);
		$subvcharge->subvc_id->setDbValue($rs->fields('subvc_id'));
		$subvcharge->member_code->setDbValue($rs->fields('member_code'));
		$subvcharge->all_member->setDbValue($rs->fields('all_member'));
		$subvcharge->alive_count->setDbValue($rs->fields('alive_count'));
		$subvcharge->dead_count->setDbValue($rs->fields('dead_count'));
		$subvcharge->resign_count->setDbValue($rs->fields('resign_count'));
		$subvcharge->terminate_count->setDbValue($rs->fields('terminate_count'));
		$subvcharge->subv_rate->setDbValue($rs->fields('subv_rate'));
		$subvcharge->can_pay_count->setDbValue($rs->fields('can_pay_count'));
		$subvcharge->cant_pay_count->setDbValue($rs->fields('cant_pay_count'));
		$subvcharge->cant_pay_detail->setDbValue($rs->fields('cant_pay_detail'));
		$subvcharge->subvc_total->setDbValue($rs->fields('subvc_total'));
		$subvcharge->assc_percent->setDbValue($rs->fields('assc_percent'));
		$subvcharge->assc_total->setDbValue($rs->fields('assc_total'));
		$subvcharge->bnfc_total->setDbValue($rs->fields('bnfc_total'));
		$subvcharge->canculate_date->setDbValue($rs->fields('canculate_date'));
		$subvcharge->subvc_status->setDbValue($rs->fields('subvc_status'));
		$subvcharge->subvc_date->setDbValue($rs->fields('subvc_date'));
		$subvcharge->subvc_slipt_num->setDbValue($rs->fields('subvc_slipt_num'));
	}

	// Load old record
	function LoadOldRecord() {
		global $subvcharge;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($subvcharge->getKey("subvc_id")) <> "")
			$subvcharge->subvc_id->CurrentValue = $subvcharge->getKey("subvc_id"); // subvc_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$subvcharge->CurrentFilter = $subvcharge->KeyFilter();
			$sSql = $subvcharge->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subvcharge;

		// Initialize URLs
		$this->ViewUrl = $subvcharge->ViewUrl();
		$this->EditUrl = $subvcharge->EditUrl();
		$this->InlineEditUrl = $subvcharge->InlineEditUrl();
		$this->CopyUrl = $subvcharge->CopyUrl();
		$this->InlineCopyUrl = $subvcharge->InlineCopyUrl();
		$this->DeleteUrl = $subvcharge->DeleteUrl();

		// Call Row_Rendering event
		$subvcharge->Row_Rendering();

		// Common render codes for all row types
		// subvc_id

		$subvcharge->subvc_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$subvcharge->member_code->CellCssStyle = "white-space: nowrap;";

		// all_member
		$subvcharge->all_member->CellCssStyle = "white-space: nowrap;";

		// alive_count
		$subvcharge->alive_count->CellCssStyle = "white-space: nowrap;";

		// dead_count
		$subvcharge->dead_count->CellCssStyle = "white-space: nowrap;";

		// resign_count
		$subvcharge->resign_count->CellCssStyle = "white-space: nowrap;";

		// terminate_count
		$subvcharge->terminate_count->CellCssStyle = "white-space: nowrap;";

		// subv_rate
		$subvcharge->subv_rate->CellCssStyle = "white-space: nowrap;";

		// can_pay_count
		$subvcharge->can_pay_count->CellCssStyle = "white-space: nowrap;";

		// cant_pay_count
		$subvcharge->cant_pay_count->CellCssStyle = "white-space: nowrap;";

		// cant_pay_detail
		$subvcharge->cant_pay_detail->CellCssStyle = "white-space: nowrap;";

		// subvc_total
		$subvcharge->subvc_total->CellCssStyle = "white-space: nowrap;";

		// assc_percent
		$subvcharge->assc_percent->CellCssStyle = "white-space: nowrap;";

		// assc_total
		$subvcharge->assc_total->CellCssStyle = "white-space: nowrap;";

		// bnfc_total
		$subvcharge->bnfc_total->CellCssStyle = "white-space: nowrap;";

		// canculate_date
		$subvcharge->canculate_date->CellCssStyle = "white-space: nowrap;";

		// subvc_status
		$subvcharge->subvc_status->CellCssStyle = "white-space: nowrap;";

		// subvc_date
		$subvcharge->subvc_date->CellCssStyle = "white-space: nowrap;";

		// subvc_slipt_num
		$subvcharge->subvc_slipt_num->CellCssStyle = "white-space: nowrap;";
		if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$subvcharge->member_code->ViewValue = $subvcharge->member_code->CurrentValue;
			if (strval($subvcharge->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcharge->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcharge->member_code->ViewValue = $rswrk->fields('dead_id');
					$subvcharge->member_code->ViewValue .= ew_ValueSeparator(0,1,$subvcharge->member_code) . $rswrk->fields('fname');
					$subvcharge->member_code->ViewValue .= ew_ValueSeparator(0,2,$subvcharge->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcharge->member_code->ViewValue = $subvcharge->member_code->CurrentValue;
				}
			} else {
				$subvcharge->member_code->ViewValue = NULL;
			}
			$subvcharge->member_code->ViewCustomAttributes = "";

			// subvc_total
			$subvcharge->subvc_total->ViewValue = $subvcharge->subvc_total->CurrentValue;
			$subvcharge->subvc_total->ViewCustomAttributes = "";

			// assc_percent
			$subvcharge->assc_percent->ViewValue = $subvcharge->assc_percent->CurrentValue;
			$subvcharge->assc_percent->ViewCustomAttributes = "";

			// assc_total
			$subvcharge->assc_total->ViewValue = $subvcharge->assc_total->CurrentValue;
			$subvcharge->assc_total->ViewCustomAttributes = "";

			// bnfc_total
			$subvcharge->bnfc_total->ViewValue = $subvcharge->bnfc_total->CurrentValue;
			$subvcharge->bnfc_total->ViewCustomAttributes = "";

			// subvc_status
			if (strval($subvcharge->subvc_status->CurrentValue) <> "") {
				switch ($subvcharge->subvc_status->CurrentValue) {
					case "รอจ่าย":
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->FldTagCaption(1) <> "" ? $subvcharge->subvc_status->FldTagCaption(1) : $subvcharge->subvc_status->CurrentValue;
						break;
					case "จ่ายแล้ว":
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->FldTagCaption(2) <> "" ? $subvcharge->subvc_status->FldTagCaption(2) : $subvcharge->subvc_status->CurrentValue;
						break;
					default:
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->CurrentValue;
				}
			} else {
				$subvcharge->subvc_status->ViewValue = NULL;
			}
			$subvcharge->subvc_status->ViewCustomAttributes = "";

			// subvc_date
			$subvcharge->subvc_date->ViewValue = $subvcharge->subvc_date->CurrentValue;
			$subvcharge->subvc_date->ViewValue = ew_FormatDateTime($subvcharge->subvc_date->ViewValue, 7);
			$subvcharge->subvc_date->ViewCustomAttributes = "";

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->ViewValue = $subvcharge->subvc_slipt_num->CurrentValue;
			$subvcharge->subvc_slipt_num->ViewCustomAttributes = "";

			// member_code
			$subvcharge->member_code->LinkCustomAttributes = "";
			$subvcharge->member_code->HrefValue = "";
			$subvcharge->member_code->TooltipValue = "";

			// subvc_total
			$subvcharge->subvc_total->LinkCustomAttributes = "";
			$subvcharge->subvc_total->HrefValue = "";
			$subvcharge->subvc_total->TooltipValue = "";

			// assc_percent
			$subvcharge->assc_percent->LinkCustomAttributes = "";
			$subvcharge->assc_percent->HrefValue = "";
			$subvcharge->assc_percent->TooltipValue = "";

			// assc_total
			$subvcharge->assc_total->LinkCustomAttributes = "";
			$subvcharge->assc_total->HrefValue = "";
			$subvcharge->assc_total->TooltipValue = "";

			// bnfc_total
			$subvcharge->bnfc_total->LinkCustomAttributes = "";
			$subvcharge->bnfc_total->HrefValue = "";
			$subvcharge->bnfc_total->TooltipValue = "";

			// subvc_status
			$subvcharge->subvc_status->LinkCustomAttributes = "";
			$subvcharge->subvc_status->HrefValue = "";
			$subvcharge->subvc_status->TooltipValue = "";

			// subvc_date
			$subvcharge->subvc_date->LinkCustomAttributes = "";
			$subvcharge->subvc_date->HrefValue = "";
			$subvcharge->subvc_date->TooltipValue = "";

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->LinkCustomAttributes = "";
			$subvcharge->subvc_slipt_num->HrefValue = "";
			$subvcharge->subvc_slipt_num->TooltipValue = "";
		} elseif ($subvcharge->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// member_code
			$subvcharge->member_code->EditCustomAttributes = "";
			$subvcharge->member_code->EditValue = ew_HtmlEncode($subvcharge->member_code->AdvancedSearch->SearchValue);
			if (strval($subvcharge->member_code->AdvancedSearch->SearchValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcharge->member_code->AdvancedSearch->SearchValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcharge->member_code->EditValue = $rswrk->fields('dead_id');
					$subvcharge->member_code->EditValue .= ew_ValueSeparator(0,1,$subvcharge->member_code) . $rswrk->fields('fname');
					$subvcharge->member_code->EditValue .= ew_ValueSeparator(0,2,$subvcharge->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcharge->member_code->EditValue = $subvcharge->member_code->AdvancedSearch->SearchValue;
				}
			} else {
				$subvcharge->member_code->EditValue = NULL;
			}

			// subvc_total
			$subvcharge->subvc_total->EditCustomAttributes = "";
			$subvcharge->subvc_total->EditValue = ew_HtmlEncode($subvcharge->subvc_total->AdvancedSearch->SearchValue);

			// assc_percent
			$subvcharge->assc_percent->EditCustomAttributes = "";
			$subvcharge->assc_percent->EditValue = ew_HtmlEncode($subvcharge->assc_percent->AdvancedSearch->SearchValue);

			// assc_total
			$subvcharge->assc_total->EditCustomAttributes = "";
			$subvcharge->assc_total->EditValue = ew_HtmlEncode($subvcharge->assc_total->AdvancedSearch->SearchValue);

			// bnfc_total
			$subvcharge->bnfc_total->EditCustomAttributes = "";
			$subvcharge->bnfc_total->EditValue = ew_HtmlEncode($subvcharge->bnfc_total->AdvancedSearch->SearchValue);

			// subvc_status
			$subvcharge->subvc_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("รอจ่าย", $subvcharge->subvc_status->FldTagCaption(1) <> "" ? $subvcharge->subvc_status->FldTagCaption(1) : "รอจ่าย");
			$arwrk[] = array("จ่ายแล้ว", $subvcharge->subvc_status->FldTagCaption(2) <> "" ? $subvcharge->subvc_status->FldTagCaption(2) : "จ่ายแล้ว");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$subvcharge->subvc_status->EditValue = $arwrk;

			// subvc_date
			$subvcharge->subvc_date->EditCustomAttributes = "";
			$subvcharge->subvc_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($subvcharge->subvc_date->AdvancedSearch->SearchValue, 7), 7));

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->EditCustomAttributes = "";
			$subvcharge->subvc_slipt_num->EditValue = ew_HtmlEncode($subvcharge->subvc_slipt_num->AdvancedSearch->SearchValue);
		}
		if ($subvcharge->RowType == EW_ROWTYPE_ADD ||
			$subvcharge->RowType == EW_ROWTYPE_EDIT ||
			$subvcharge->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$subvcharge->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($subvcharge->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subvcharge->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $subvcharge;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($subvcharge->member_code->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $subvcharge->member_code->FldErrMsg());
		}
		if (!ew_CheckEuroDate($subvcharge->subvc_date->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $subvcharge->subvc_date->FldErrMsg());
		}
		if (!ew_CheckInteger($subvcharge->subvc_slipt_num->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $subvcharge->subvc_slipt_num->FldErrMsg());
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
		global $subvcharge;
		$subvcharge->member_code->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_member_code");
		$subvcharge->all_member->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_all_member");
		$subvcharge->alive_count->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_alive_count");
		$subvcharge->dead_count->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_dead_count");
		$subvcharge->resign_count->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_resign_count");
		$subvcharge->terminate_count->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_terminate_count");
		$subvcharge->subv_rate->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_subv_rate");
		$subvcharge->can_pay_count->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_can_pay_count");
		$subvcharge->cant_pay_count->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_cant_pay_count");
		$subvcharge->cant_pay_detail->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_cant_pay_detail");
		$subvcharge->subvc_total->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_subvc_total");
		$subvcharge->assc_percent->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_assc_percent");
		$subvcharge->assc_total->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_assc_total");
		$subvcharge->bnfc_total->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_bnfc_total");
		$subvcharge->canculate_date->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_canculate_date");
		$subvcharge->subvc_status->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_subvc_status");
		$subvcharge->subvc_date->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_subvc_date");
		$subvcharge->subvc_slipt_num->AdvancedSearch->SearchValue = $subvcharge->getAdvancedSearch("x_subvc_slipt_num");
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
		 global $subvcharge; 
		 global $Language;
		 $this->ListOptions->Items["subvslipt"]->Body = "<a href='subvsliptview.php?subvc_id=".$subvcharge->subvc_id->CurrentValue."' title='พิมพ์ใบสำคัญรับเงิน' target='_blank'><center><img src='images/ico_send_notice.png' align='absmiddle'></center></a>";
			   
}                                                                                                                        


}
?>
