<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "villageinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "paymentsummaryinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$village_list = new cvillage_list();
$Page =& $village_list;

// Page init
$village_list->Page_Init();

// Page main
$village_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($village->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var village_list = new ew_Page("village_list");

// page properties
village_list.PageID = "list"; // page ID
village_list.FormID = "fvillagelist"; // form ID
var EW_PAGE_ID = village_list.PageID; // for backward compatibility

// extend page with validate function for search
village_list.ValidateSearch = function(fobj) {
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
village_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
village_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
village_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
village_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($village->Export == "") || (EW_EXPORT_MASTER_RECORD && $village->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$village_list->TotalRecs = $village->SelectRecordCount();
	} else {
		if ($village_list->Recordset = $village_list->LoadRecordset())
			$village_list->TotalRecs = $village_list->Recordset->RecordCount();
	}
	$village_list->StartRec = 1;
	if ($village_list->DisplayRecs <= 0 || ($village->Export <> "" && $village->ExportAll)) // Display all records
		$village_list->DisplayRecs = $village_list->TotalRecs;
	if (!($village->Export <> "" && $village->ExportAll))
		$village_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$village_list->Recordset = $village_list->LoadRecordset($village_list->StartRec-1, $village_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $village->TableCaption() ?>
&nbsp;&nbsp;<?php $village_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($village->Export == "" && $village->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(village_list);" style="text-decoration: none;"><img id="village_list_SearchImage" src="phpimages/collapse.png" alt=""  border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="village_list_SearchPanel">
<form name="fvillagelistsrch" id="fvillagelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return village_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="village">
<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$village_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$village->RowType = EW_ROWTYPE_SEARCH;

// Render row
$village->ResetAttrs();
$village_list->RenderRow();
?>
<div id="xsr_1" class="ewCssTableRow">
	<span id="xsc_t_code" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $village->t_code->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_t_code" id="z_t_code" value="="></span>
		<span class="ewSearchField">
<select id="x_t_code" name="x_t_code"<?php echo $village->t_code->EditAttributes() ?>>
<?php
if (is_array($village->t_code->EditValue)) {
	$arwrk = $village->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($village->t_code->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$village->t_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span>
	</span>
</div>
<div id="xsr_2" class="ewCssTableRow">
	<span id="xsc_v_title" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $village->v_title->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_v_title" id="z_v_title" value="="></span>
		<span class="ewSearchField">
<input type="text" name="x_v_title" id="x_v_title" size="30" maxlength="100" value="<?php echo $village->v_title->EditValue ?>"<?php echo $village->v_title->EditAttributes() ?>>
</span>
	</span>
</div>
<div id="xsr_3" class="ewCssTableRow">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $village_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $village_list->ShowPageHeader(); ?>
<?php
$village_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($village->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($village->CurrentAction <> "gridadd" && $village->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($village_list->Pager)) $village_list->Pager = new cPrevNextPager($village_list->StartRec, $village_list->DisplayRecs, $village_list->TotalRecs) ?>
<?php if ($village_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($village_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $village_list->PageUrl() ?>start=<?php echo $village_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($village_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $village_list->PageUrl() ?>start=<?php echo $village_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $village_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($village_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $village_list->PageUrl() ?>start=<?php echo $village_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($village_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $village_list->PageUrl() ?>start=<?php echo $village_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $village_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $village_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $village_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $village_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($village_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($village_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="village">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($village_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($village_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($village_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($village_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($village_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($village_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($village_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($village_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($village_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
</span>
</div>
<?php } ?>
<form name="fvillagelist" id="fvillagelist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="village">
<div id="gmp_village" class="ewGridMiddlePanel">
<?php if ($village_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $village->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$village_list->RenderListOptions();

// Render list options (header, left)
$village_list->ListOptions->Render("header", "left");
?>
<?php if ($village->t_code->Visible) { // t_code ?>
	<?php if ($village->SortUrl($village->t_code) == "") { ?>
		<td><?php echo $village->t_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $village->SortUrl($village->t_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $village->t_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($village->t_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($village->t_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($village->v_code->Visible) { // v_code ?>
	<?php if ($village->SortUrl($village->v_code) == "") { ?>
		<td><?php echo $village->v_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $village->SortUrl($village->v_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $village->v_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($village->v_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($village->v_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($village->v_title->Visible) { // v_title ?>
	<?php if ($village->SortUrl($village->v_title) == "") { ?>
		<td><?php echo $village->v_title->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $village->SortUrl($village->v_title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $village->v_title->FldCaption() ?></td><td style="width: 10px;"><?php if ($village->v_title->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($village->v_title->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$village_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($village->ExportAll && $village->Export <> "") {
	$village_list->StopRec = $village_list->TotalRecs;
} else {

	// Set the last record to display
	if ($village_list->TotalRecs > $village_list->StartRec + $village_list->DisplayRecs - 1)
		$village_list->StopRec = $village_list->StartRec + $village_list->DisplayRecs - 1;
	else
		$village_list->StopRec = $village_list->TotalRecs;
}
$village_list->RecCnt = $village_list->StartRec - 1;
if ($village_list->Recordset && !$village_list->Recordset->EOF) {
	$village_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $village_list->StartRec > 1)
		$village_list->Recordset->Move($village_list->StartRec - 1);
} elseif (!$village->AllowAddDeleteRow && $village_list->StopRec == 0) {
	$village_list->StopRec = $village->GridAddRowCount;
}

// Initialize aggregate
$village->RowType = EW_ROWTYPE_AGGREGATEINIT;
$village->ResetAttrs();
$village_list->RenderRow();
$village_list->RowCnt = 0;
while ($village_list->RecCnt < $village_list->StopRec) {
	$village_list->RecCnt++;
	if (intval($village_list->RecCnt) >= intval($village_list->StartRec)) {
		$village_list->RowCnt++;

		// Set up key count
		$village_list->KeyCount = $village_list->RowIndex;

		// Init row class and style
		$village->ResetAttrs();
		$village->CssClass = "";
		if ($village->CurrentAction == "gridadd") {
		} else {
			$village_list->LoadRowValues($village_list->Recordset); // Load row values
		}
		$village->RowType = EW_ROWTYPE_VIEW; // Render view
		$village->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$village_list->RenderRow();

		// Render list options
		$village_list->RenderListOptions();
?>
	<tr<?php echo $village->RowAttributes() ?>>
<?php

// Render list options (body, left)
$village_list->ListOptions->Render("body", "left");
?>
	<?php if ($village->t_code->Visible) { // t_code ?>
		<td<?php echo $village->t_code->CellAttributes() ?>>
<div<?php echo $village->t_code->ViewAttributes() ?>><?php echo $village->t_code->ListViewValue() ?></div>
<a name="<?php echo $village_list->PageObjName . "_row_" . $village_list->RowCnt ?>" id="<?php echo $village_list->PageObjName . "_row_" . $village_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($village->v_code->Visible) { // v_code ?>
		<td<?php echo $village->v_code->CellAttributes() ?>>
<div<?php echo $village->v_code->ViewAttributes() ?>><?php echo $village->v_code->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($village->v_title->Visible) { // v_title ?>
		<td<?php echo $village->v_title->CellAttributes() ?>>
<div<?php echo $village->v_title->ViewAttributes() ?>><?php echo $village->v_title->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$village_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($village->CurrentAction <> "gridadd")
		$village_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($village_list->Recordset)
	$village_list->Recordset->Close();
?>
<?php if ($village_list->TotalRecs > 0) { ?>
<?php if ($village->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($village->CurrentAction <> "gridadd" && $village->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($village_list->Pager)) $village_list->Pager = new cPrevNextPager($village_list->StartRec, $village_list->DisplayRecs, $village_list->TotalRecs) ?>
<?php if ($village_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($village_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $village_list->PageUrl() ?>start=<?php echo $village_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($village_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $village_list->PageUrl() ?>start=<?php echo $village_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $village_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($village_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $village_list->PageUrl() ?>start=<?php echo $village_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($village_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $village_list->PageUrl() ?>start=<?php echo $village_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $village_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $village_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $village_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $village_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($village_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($village_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="village">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($village_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($village_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($village_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($village_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($village_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($village_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($village_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($village_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($village_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($village->Export == "" && $village->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(village_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$village_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($village->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$village_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cvillage_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'village';

	// Page object name
	var $PageObjName = 'village_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $village;
		if ($village->UseTokenInUrl) $PageUrl .= "t=" . $village->TableVar . "&"; // Add page token
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
		global $objForm, $village;
		if ($village->UseTokenInUrl) {
			if ($objForm)
				return ($village->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($village->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cvillage_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (village)
		if (!isset($GLOBALS["village"])) {
			$GLOBALS["village"] = new cvillage();
			$GLOBALS["Table"] =& $GLOBALS["village"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "villageadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "villagedelete.php";
		$this->MultiUpdateUrl = "villageupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (paymentsummary)
		if (!isset($GLOBALS['paymentsummary'])) $GLOBALS['paymentsummary'] = new cpaymentsummary();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'village', TRUE);

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
		global $village;

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
			$village->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$village->Export = $_POST["exporttype"];
		} else {
			$village->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $village->Export; // Get export parameter, used in header
		$gsExportFile = $village->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($village->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($village->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$village->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $village;

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
			if ($village->Export <> "" ||
				$village->CurrentAction == "gridadd" ||
				$village->CurrentAction == "gridedit") {
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
			$village->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($village->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $village->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$village->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$village->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$village->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $village->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$village->setSessionWhere($sFilter);
		$village->CurrentFilter = "";

		// Export data only
		if (in_array($village->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($village->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $village;
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
			$village->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$village->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $village;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $village->village_id, FALSE); // village_id
		$this->BuildSearchSql($sWhere, $village->t_code, FALSE); // t_code
		$this->BuildSearchSql($sWhere, $village->v_title, FALSE); // v_title
		$this->BuildSearchSql($sWhere, $village->flag, FALSE); // flag

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($village->village_id); // village_id
			$this->SetSearchParm($village->t_code); // t_code
			$this->SetSearchParm($village->v_title); // v_title
			$this->SetSearchParm($village->flag); // flag
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
		global $village;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$village->setAdvancedSearch("x_$FldParm", $FldVal);
		$village->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$village->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$village->setAdvancedSearch("y_$FldParm", $FldVal2);
		$village->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $village;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $village->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $village->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $village->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $village->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $village->getAdvancedSearch("w_$FldParm");
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
		global $village;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$village->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $village;
		$village->setAdvancedSearch("x_village_id", "");
		$village->setAdvancedSearch("x_t_code", "");
		$village->setAdvancedSearch("x_v_title", "");
		$village->setAdvancedSearch("x_flag", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $village;
		$bRestore = TRUE;
		if ($village->village_id->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($village->t_code->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($village->v_title->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($village->flag->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($village->village_id);
			$this->GetSearchParm($village->t_code);
			$this->GetSearchParm($village->v_title);
			$this->GetSearchParm($village->flag);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $village;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$village->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$village->CurrentOrderType = @$_GET["ordertype"];
			$village->UpdateSort($village->t_code); // t_code
			$village->UpdateSort($village->v_code); // v_code
			$village->UpdateSort($village->v_title); // v_title
			$village->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $village;
		$sOrderBy = $village->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($village->SqlOrderBy() <> "") {
				$sOrderBy = $village->SqlOrderBy();
				$village->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $village;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$village->setSessionOrderBy($sOrderBy);
				$village->t_code->setSort("");
				$village->v_code->setSort("");
				$village->v_title->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$village->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $village;

		// "detail_paymentsummary"
		$item =& $this->ListOptions->Add("detail_paymentsummary");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $village, $objForm;
		$this->ListOptions->LoadDefault();

		// "detail_paymentsummary"
		$oListOpt =& $this->ListOptions->Items["detail_paymentsummary"];
		if ($Security->IsLoggedIn()) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("paymentsummary", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"paymentsummarylist.php?" . EW_TABLE_SHOW_MASTER . "=village&village_id=" . urlencode(strval($village->village_id->CurrentValue)) . "&t_code=" . urlencode(strval($village->t_code->CurrentValue)) . "&flag=" . urlencode(strval($village->flag->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $village;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $village;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$village->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$village->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $village->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$village->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$village->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$village->setStartRecordNumber($this->StartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $village;

		// Load search values
		// village_id

		$village->village_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_village_id"]);
		$village->village_id->AdvancedSearch->SearchOperator = @$_GET["z_village_id"];

		// t_code
		$village->t_code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_t_code"]);
		$village->t_code->AdvancedSearch->SearchOperator = @$_GET["z_t_code"];

		// v_title
		$village->v_title->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_v_title"]);
		$village->v_title->AdvancedSearch->SearchOperator = @$_GET["z_v_title"];

		// flag
		$village->flag->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_flag"]);
		$village->flag->AdvancedSearch->SearchOperator = @$_GET["z_flag"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $village;

		// Call Recordset Selecting event
		$village->Recordset_Selecting($village->CurrentFilter);

		// Load List page SQL
		$sSql = $village->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$village->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $village;
		$sFilter = $village->KeyFilter();

		// Call Row Selecting event
		$village->Row_Selecting($sFilter);

		// Load SQL based on filter
		$village->CurrentFilter = $sFilter;
		$sSql = $village->SQL();
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
		global $conn, $village;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$village->Row_Selected($row);
		$village->village_id->setDbValue($rs->fields('village_id'));
		$village->t_code->setDbValue($rs->fields('t_code'));
		$village->v_code->setDbValue($rs->fields('v_code'));
		$village->v_title->setDbValue($rs->fields('v_title'));
		$village->flag->setDbValue($rs->fields('flag'));
	}

	// Load old record
	function LoadOldRecord() {
		global $village;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($village->getKey("village_id")) <> "")
			$village->village_id->CurrentValue = $village->getKey("village_id"); // village_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$village->CurrentFilter = $village->KeyFilter();
			$sSql = $village->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $village;

		// Initialize URLs
		$this->ViewUrl = $village->ViewUrl();
		$this->EditUrl = $village->EditUrl();
		$this->InlineEditUrl = $village->InlineEditUrl();
		$this->CopyUrl = $village->CopyUrl();
		$this->InlineCopyUrl = $village->InlineCopyUrl();
		$this->DeleteUrl = $village->DeleteUrl();

		// Call Row_Rendering event
		$village->Row_Rendering();

		// Common render codes for all row types
		// village_id
		// t_code
		// v_code
		// v_title
		// flag

		$village->flag->CellCssStyle = "white-space: nowrap;";
		if ($village->RowType == EW_ROWTYPE_VIEW) { // View row

			// village_id
			$village->village_id->ViewValue = $village->village_id->CurrentValue;
			$village->village_id->ViewCustomAttributes = "";

			// t_code
			if (strval($village->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($village->t_code->CurrentValue) . "'";
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
					$village->t_code->ViewValue = $rswrk->fields('t_code');
					$village->t_code->ViewValue .= ew_ValueSeparator(0,1,$village->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$village->t_code->ViewValue = $village->t_code->CurrentValue;
				}
			} else {
				$village->t_code->ViewValue = NULL;
			}
			$village->t_code->ViewCustomAttributes = "";

			// v_code
			$village->v_code->ViewValue = $village->v_code->CurrentValue;
			$village->v_code->ViewCustomAttributes = "";

			// v_title
			$village->v_title->ViewValue = $village->v_title->CurrentValue;
			$village->v_title->ViewCustomAttributes = "";

			// t_code
			$village->t_code->LinkCustomAttributes = "";
			$village->t_code->HrefValue = "";
			$village->t_code->TooltipValue = "";

			// v_code
			$village->v_code->LinkCustomAttributes = "";
			$village->v_code->HrefValue = "";
			$village->v_code->TooltipValue = "";

			// v_title
			$village->v_title->LinkCustomAttributes = "";
			$village->v_title->HrefValue = "";
			$village->v_title->TooltipValue = "";
		} elseif ($village->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// t_code
			$village->t_code->EditCustomAttributes = "";
				$sFilterWrk = "";
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
			$village->t_code->EditValue = $arwrk;

			// v_code
			$village->v_code->EditCustomAttributes = "";
			$village->v_code->EditValue = ew_HtmlEncode($village->v_code->AdvancedSearch->SearchValue);

			// v_title
			$village->v_title->EditCustomAttributes = "";
			$village->v_title->EditValue = ew_HtmlEncode($village->v_title->AdvancedSearch->SearchValue);
		}
		if ($village->RowType == EW_ROWTYPE_ADD ||
			$village->RowType == EW_ROWTYPE_EDIT ||
			$village->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$village->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($village->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$village->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $village;

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
		global $village;
		$village->village_id->AdvancedSearch->SearchValue = $village->getAdvancedSearch("x_village_id");
		$village->t_code->AdvancedSearch->SearchValue = $village->getAdvancedSearch("x_t_code");
		$village->v_title->AdvancedSearch->SearchValue = $village->getAdvancedSearch("x_v_title");
		$village->flag->AdvancedSearch->SearchValue = $village->getAdvancedSearch("x_flag");
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $village;

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
		$item->Body = "<a name=\"emf_village\" id=\"emf_village\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_village',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fvillagelist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($village->Export <> "" ||
			$village->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $village;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $village->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($village->ExportAll) {
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
		if ($village->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($village, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($village->Export == "xml") {
			$village->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$village->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($village->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($village->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($village->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($village->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($village->ExportReturnUrl());
		} elseif ($village->Export == "pdf") {
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
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
