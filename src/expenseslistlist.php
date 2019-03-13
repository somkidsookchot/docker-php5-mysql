<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "expenseslistinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "expensescategoryinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$expenseslist_list = new cexpenseslist_list();
$Page =& $expenseslist_list;

// Page init
$expenseslist_list->Page_Init();

// Page main
$expenseslist_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($expenseslist->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expenseslist_list = new ew_Page("expenseslist_list");

// page properties
expenseslist_list.PageID = "list"; // page ID
expenseslist_list.FormID = "fexpenseslistlist"; // form ID
var EW_PAGE_ID = expenseslist_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expenseslist_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expenseslist_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expenseslist_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenseslist_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($expenseslist->Export == "") || (EW_EXPORT_MASTER_RECORD && $expenseslist->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "expensescategorylist.php";
if ($expenseslist_list->DbMasterFilter <> "" && $expenseslist->getCurrentMasterTable() == "expensescategory") {
	if ($expenseslist_list->MasterRecordExists) {
		if ($expenseslist->getCurrentMasterTable() == $expenseslist->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<div class="phpmaker ewTitle"><img src="images/finance55x55.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("MasterRecord") ?><?php echo $expensescategory->TableCaption() ?>
&nbsp;&nbsp; </div>
<div class="clear"></div><br />
<?php if ($expenseslist->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "expensescategorymaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$expenseslist_list->TotalRecs = $expenseslist->SelectRecordCount();
	} else {
		if ($expenseslist_list->Recordset = $expenseslist_list->LoadRecordset())
			$expenseslist_list->TotalRecs = $expenseslist_list->Recordset->RecordCount();
	}
	$expenseslist_list->StartRec = 1;
	if ($expenseslist_list->DisplayRecs <= 0 || ($expenseslist->Export <> "" && $expenseslist->ExportAll)) // Display all records
		$expenseslist_list->DisplayRecs = $expenseslist_list->TotalRecs;
	if (!($expenseslist->Export <> "" && $expenseslist->ExportAll))
		$expenseslist_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$expenseslist_list->Recordset = $expenseslist_list->LoadRecordset($expenseslist_list->StartRec-1, $expenseslist_list->DisplayRecs);
?>
<div class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><img src="images/finance55x55.png" width="40" height="40" align="absmiddle" /><?php echo $expenseslist->TableCaption() ?>
<?php if ($expenseslist->getCurrentMasterTable() == "") { ?>
&nbsp;&nbsp;
<?php } ?>
</div>
<div class="clear"></div>
<?php $expenseslist_list->ShowPageHeader(); ?>
<?php
$expenseslist_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($expenseslist->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($expenseslist->CurrentAction <> "gridadd" && $expenseslist->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expenseslist_list->Pager)) $expenseslist_list->Pager = new cPrevNextPager($expenseslist_list->StartRec, $expenseslist_list->DisplayRecs, $expenseslist_list->TotalRecs) ?>
<?php if ($expenseslist_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expenseslist_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_list->PageUrl() ?>start=<?php echo $expenseslist_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expenseslist_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_list->PageUrl() ?>start=<?php echo $expenseslist_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expenseslist_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expenseslist_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_list->PageUrl() ?>start=<?php echo $expenseslist_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expenseslist_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_list->PageUrl() ?>start=<?php echo $expenseslist_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expenseslist_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expenseslist_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expenseslist_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expenseslist_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($expenseslist_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expenseslist_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expenseslist">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($expenseslist_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($expenseslist_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expenseslist_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expenseslist_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($expenseslist_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($expenseslist_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($expenseslist_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($expenseslist_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($expenseslist_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($expenseslist->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $expenseslist_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($expenseslist_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fexpenseslistlist, '<?php echo $expenseslist_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fexpenseslistlist" id="fexpenseslistlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="expenseslist">
<div id="gmp_expenseslist" class="ewGridMiddlePanel">
<?php if ($expenseslist_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $expenseslist->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$expenseslist_list->RenderListOptions();

// Render list options (header, left)
$expenseslist_list->ListOptions->Render("header", "left");
?>
<?php if ($expenseslist->exp_cat->Visible) { // exp_cat ?>
	<?php if ($expenseslist->SortUrl($expenseslist->exp_cat) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expenseslist->exp_cat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenseslist->SortUrl($expenseslist->exp_cat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expenseslist->exp_cat->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenseslist->exp_cat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenseslist->exp_cat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenseslist->exp_total->Visible) { // exp_total ?>
	<?php if ($expenseslist->SortUrl($expenseslist->exp_total) == "") { ?>
		<td><?php echo $expenseslist->exp_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenseslist->SortUrl($expenseslist->exp_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenseslist->exp_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenseslist->exp_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenseslist->exp_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenseslist->exp_date->Visible) { // exp_date ?>
	<?php if ($expenseslist->SortUrl($expenseslist->exp_date) == "") { ?>
		<td><?php echo $expenseslist->exp_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenseslist->SortUrl($expenseslist->exp_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenseslist->exp_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenseslist->exp_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenseslist->exp_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenseslist->exp_dispencer->Visible) { // exp_dispencer ?>
	<?php if ($expenseslist->SortUrl($expenseslist->exp_dispencer) == "") { ?>
		<td><?php echo $expenseslist->exp_dispencer->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenseslist->SortUrl($expenseslist->exp_dispencer) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenseslist->exp_dispencer->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenseslist->exp_dispencer->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenseslist->exp_dispencer->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenseslist->exp_slipt_num->Visible) { // exp_slipt_num ?>
	<?php if ($expenseslist->SortUrl($expenseslist->exp_slipt_num) == "") { ?>
		<td><?php echo $expenseslist->exp_slipt_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenseslist->SortUrl($expenseslist->exp_slipt_num) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenseslist->exp_slipt_num->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenseslist->exp_slipt_num->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenseslist->exp_slipt_num->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$expenseslist_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($expenseslist->ExportAll && $expenseslist->Export <> "") {
	$expenseslist_list->StopRec = $expenseslist_list->TotalRecs;
} else {

	// Set the last record to display
	if ($expenseslist_list->TotalRecs > $expenseslist_list->StartRec + $expenseslist_list->DisplayRecs - 1)
		$expenseslist_list->StopRec = $expenseslist_list->StartRec + $expenseslist_list->DisplayRecs - 1;
	else
		$expenseslist_list->StopRec = $expenseslist_list->TotalRecs;
}
$expenseslist_list->RecCnt = $expenseslist_list->StartRec - 1;
if ($expenseslist_list->Recordset && !$expenseslist_list->Recordset->EOF) {
	$expenseslist_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $expenseslist_list->StartRec > 1)
		$expenseslist_list->Recordset->Move($expenseslist_list->StartRec - 1);
} elseif (!$expenseslist->AllowAddDeleteRow && $expenseslist_list->StopRec == 0) {
	$expenseslist_list->StopRec = $expenseslist->GridAddRowCount;
}

// Initialize aggregate
$expenseslist->RowType = EW_ROWTYPE_AGGREGATEINIT;
$expenseslist->ResetAttrs();
$expenseslist_list->RenderRow();
$expenseslist_list->RowCnt = 0;
while ($expenseslist_list->RecCnt < $expenseslist_list->StopRec) {
	$expenseslist_list->RecCnt++;
	if (intval($expenseslist_list->RecCnt) >= intval($expenseslist_list->StartRec)) {
		$expenseslist_list->RowCnt++;

		// Set up key count
		$expenseslist_list->KeyCount = $expenseslist_list->RowIndex;

		// Init row class and style
		$expenseslist->ResetAttrs();
		$expenseslist->CssClass = "";
		if ($expenseslist->CurrentAction == "gridadd") {
		} else {
			$expenseslist_list->LoadRowValues($expenseslist_list->Recordset); // Load row values
		}
		$expenseslist->RowType = EW_ROWTYPE_VIEW; // Render view
		$expenseslist->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$expenseslist_list->RenderRow();

		// Render list options
		$expenseslist_list->RenderListOptions();
?>
	<tr<?php echo $expenseslist->RowAttributes() ?>>
<?php

// Render list options (body, left)
$expenseslist_list->ListOptions->Render("body", "left");
?>
	<?php if ($expenseslist->exp_cat->Visible) { // exp_cat ?>
		<td<?php echo $expenseslist->exp_cat->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_cat->ViewAttributes() ?>><?php echo $expenseslist->exp_cat->ListViewValue() ?></div>
<a name="<?php echo $expenseslist_list->PageObjName . "_row_" . $expenseslist_list->RowCnt ?>" id="<?php echo $expenseslist_list->PageObjName . "_row_" . $expenseslist_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($expenseslist->exp_total->Visible) { // exp_total ?>
		<td<?php echo $expenseslist->exp_total->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_total->ViewAttributes() ?>><?php echo $expenseslist->exp_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenseslist->exp_date->Visible) { // exp_date ?>
		<td<?php echo $expenseslist->exp_date->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_date->ViewAttributes() ?>><?php echo $expenseslist->exp_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenseslist->exp_dispencer->Visible) { // exp_dispencer ?>
		<td<?php echo $expenseslist->exp_dispencer->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_dispencer->ViewAttributes() ?>><?php echo $expenseslist->exp_dispencer->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenseslist->exp_slipt_num->Visible) { // exp_slipt_num ?>
		<td<?php echo $expenseslist->exp_slipt_num->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_slipt_num->ViewAttributes() ?>><?php echo $expenseslist->exp_slipt_num->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$expenseslist_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($expenseslist->CurrentAction <> "gridadd")
		$expenseslist_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($expenseslist_list->Recordset)
	$expenseslist_list->Recordset->Close();
?>
<?php if ($expenseslist_list->TotalRecs > 0) { ?>
<?php if ($expenseslist->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($expenseslist->CurrentAction <> "gridadd" && $expenseslist->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expenseslist_list->Pager)) $expenseslist_list->Pager = new cPrevNextPager($expenseslist_list->StartRec, $expenseslist_list->DisplayRecs, $expenseslist_list->TotalRecs) ?>
<?php if ($expenseslist_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expenseslist_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_list->PageUrl() ?>start=<?php echo $expenseslist_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expenseslist_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_list->PageUrl() ?>start=<?php echo $expenseslist_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expenseslist_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expenseslist_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_list->PageUrl() ?>start=<?php echo $expenseslist_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expenseslist_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_list->PageUrl() ?>start=<?php echo $expenseslist_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expenseslist_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expenseslist_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expenseslist_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expenseslist_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($expenseslist_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expenseslist_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expenseslist">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($expenseslist_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($expenseslist_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expenseslist_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expenseslist_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($expenseslist_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($expenseslist_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($expenseslist_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($expenseslist_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($expenseslist_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($expenseslist->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $expenseslist_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($expenseslist_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fexpenseslistlist, '<?php echo $expenseslist_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($expenseslist->Export == "" && $expenseslist->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(expenseslist_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$expenseslist_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($expenseslist->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$expenseslist_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpenseslist_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'expenseslist';

	// Page object name
	var $PageObjName = 'expenseslist_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expenseslist;
		if ($expenseslist->UseTokenInUrl) $PageUrl .= "t=" . $expenseslist->TableVar . "&"; // Add page token
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
		global $objForm, $expenseslist;
		if ($expenseslist->UseTokenInUrl) {
			if ($objForm)
				return ($expenseslist->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expenseslist->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpenseslist_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expenseslist)
		if (!isset($GLOBALS["expenseslist"])) {
			$GLOBALS["expenseslist"] = new cexpenseslist();
			$GLOBALS["Table"] =& $GLOBALS["expenseslist"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "expenseslistadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "expenseslistdelete.php";
		$this->MultiUpdateUrl = "expenseslistupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (expensescategory)
		if (!isset($GLOBALS['expensescategory'])) $GLOBALS['expensescategory'] = new cexpensescategory();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expenseslist', TRUE);

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
		global $expenseslist;

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
			$expenseslist->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$expenseslist->Export = $_POST["exporttype"];
		} else {
			$expenseslist->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $expenseslist->Export; // Get export parameter, used in header
		$gsExportFile = $expenseslist->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($expenseslist->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($expenseslist->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$expenseslist->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $expenseslist;

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
			if ($expenseslist->Export <> "" ||
				$expenseslist->CurrentAction == "gridadd" ||
				$expenseslist->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($expenseslist->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $expenseslist->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $expenseslist->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $expenseslist->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($expenseslist->getMasterFilter() <> "" && $expenseslist->getCurrentMasterTable() == "expensescategory") {
			global $expensescategory;
			$rsmaster = $expensescategory->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($expenseslist->getReturnUrl()); // Return to caller
			} else {
				$expensescategory->LoadListRowValues($rsmaster);
				$expensescategory->RowType = EW_ROWTYPE_MASTER; // Master row
				$expensescategory->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$expenseslist->setSessionWhere($sFilter);
		$expenseslist->CurrentFilter = "";

		// Export data only
		if (in_array($expenseslist->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($expenseslist->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $expenseslist;
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
			$expenseslist->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$expenseslist->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $expenseslist;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$expenseslist->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$expenseslist->CurrentOrderType = @$_GET["ordertype"];
			$expenseslist->UpdateSort($expenseslist->exp_cat); // exp_cat
			$expenseslist->UpdateSort($expenseslist->exp_total); // exp_total
			$expenseslist->UpdateSort($expenseslist->exp_date); // exp_date
			$expenseslist->UpdateSort($expenseslist->exp_dispencer); // exp_dispencer
			$expenseslist->UpdateSort($expenseslist->exp_slipt_num); // exp_slipt_num
			$expenseslist->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $expenseslist;
		$sOrderBy = $expenseslist->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($expenseslist->SqlOrderBy() <> "") {
				$sOrderBy = $expenseslist->SqlOrderBy();
				$expenseslist->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $expenseslist;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$expenseslist->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$expenseslist->exp_cat->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$expenseslist->setSessionOrderBy($sOrderBy);
				$expenseslist->exp_cat->setSort("");
				$expenseslist->exp_total->setSort("");
				$expenseslist->exp_date->setSort("");
				$expenseslist->exp_dispencer->setSort("");
				$expenseslist->exp_slipt_num->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$expenseslist->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $expenseslist;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"expenseslist_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $expenseslist, $objForm;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($expenseslist->exp_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $expenseslist;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $expenseslist;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$expenseslist->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$expenseslist->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $expenseslist->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$expenseslist->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$expenseslist->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$expenseslist->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expenseslist;

		// Call Recordset Selecting event
		$expenseslist->Recordset_Selecting($expenseslist->CurrentFilter);

		// Load List page SQL
		$sSql = $expenseslist->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expenseslist->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expenseslist;
		$sFilter = $expenseslist->KeyFilter();

		// Call Row Selecting event
		$expenseslist->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expenseslist->CurrentFilter = $sFilter;
		$sSql = $expenseslist->SQL();
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
		global $conn, $expenseslist;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$expenseslist->Row_Selected($row);
		$expenseslist->exp_id->setDbValue($rs->fields('exp_id'));
		$expenseslist->exp_cat->setDbValue($rs->fields('exp_cat'));
		$expenseslist->exp_detail->setDbValue($rs->fields('exp_detail'));
		$expenseslist->exp_total->setDbValue($rs->fields('exp_total'));
		$expenseslist->exp_date->setDbValue($rs->fields('exp_date'));
		$expenseslist->exp_dispencer->setDbValue($rs->fields('exp_dispencer'));
		$expenseslist->exp_slipt_num->setDbValue($rs->fields('exp_slipt_num'));
	}

	// Load old record
	function LoadOldRecord() {
		global $expenseslist;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($expenseslist->getKey("exp_id")) <> "")
			$expenseslist->exp_id->CurrentValue = $expenseslist->getKey("exp_id"); // exp_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$expenseslist->CurrentFilter = $expenseslist->KeyFilter();
			$sSql = $expenseslist->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expenseslist;

		// Initialize URLs
		$this->ViewUrl = $expenseslist->ViewUrl();
		$this->EditUrl = $expenseslist->EditUrl();
		$this->InlineEditUrl = $expenseslist->InlineEditUrl();
		$this->CopyUrl = $expenseslist->CopyUrl();
		$this->InlineCopyUrl = $expenseslist->InlineCopyUrl();
		$this->DeleteUrl = $expenseslist->DeleteUrl();

		// Call Row_Rendering event
		$expenseslist->Row_Rendering();

		// Common render codes for all row types
		// exp_id

		$expenseslist->exp_id->CellCssStyle = "white-space: nowrap;";

		// exp_cat
		$expenseslist->exp_cat->CellCssStyle = "white-space: nowrap;";

		// exp_detail
		// exp_total
		// exp_date
		// exp_dispencer
		// exp_slipt_num

		if ($expenseslist->RowType == EW_ROWTYPE_VIEW) { // View row

			// exp_cat
			if (strval($expenseslist->exp_cat->CurrentValue) <> "") {
				$sFilterWrk = "`exp_cat_id` = " . ew_AdjustSql($expenseslist->exp_cat->CurrentValue) . "";
			$sSqlWrk = "SELECT `exp_cat_title` FROM `expensescategory`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `exp_cat_title`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenseslist->exp_cat->ViewValue = $rswrk->fields('exp_cat_title');
					$rswrk->Close();
				} else {
					$expenseslist->exp_cat->ViewValue = $expenseslist->exp_cat->CurrentValue;
				}
			} else {
				$expenseslist->exp_cat->ViewValue = NULL;
			}
			$expenseslist->exp_cat->ViewCustomAttributes = "";

			// exp_total
			$expenseslist->exp_total->ViewValue = $expenseslist->exp_total->CurrentValue;
			$expenseslist->exp_total->ViewCustomAttributes = "";

			// exp_date
			$expenseslist->exp_date->ViewValue = $expenseslist->exp_date->CurrentValue;
			$expenseslist->exp_date->ViewValue = ew_FormatDateTime($expenseslist->exp_date->ViewValue, 7);
			$expenseslist->exp_date->ViewCustomAttributes = "";

			// exp_dispencer
			$expenseslist->exp_dispencer->ViewValue = $expenseslist->exp_dispencer->CurrentValue;
			$expenseslist->exp_dispencer->ViewCustomAttributes = "";

			// exp_slipt_num
			$expenseslist->exp_slipt_num->ViewValue = $expenseslist->exp_slipt_num->CurrentValue;
			$expenseslist->exp_slipt_num->ViewCustomAttributes = "";

			// exp_cat
			$expenseslist->exp_cat->LinkCustomAttributes = "";
			$expenseslist->exp_cat->HrefValue = "";
			$expenseslist->exp_cat->TooltipValue = "";

			// exp_total
			$expenseslist->exp_total->LinkCustomAttributes = "";
			$expenseslist->exp_total->HrefValue = "";
			$expenseslist->exp_total->TooltipValue = "";

			// exp_date
			$expenseslist->exp_date->LinkCustomAttributes = "";
			$expenseslist->exp_date->HrefValue = "";
			$expenseslist->exp_date->TooltipValue = "";

			// exp_dispencer
			$expenseslist->exp_dispencer->LinkCustomAttributes = "";
			$expenseslist->exp_dispencer->HrefValue = "";
			$expenseslist->exp_dispencer->TooltipValue = "";

			// exp_slipt_num
			$expenseslist->exp_slipt_num->LinkCustomAttributes = "";
			$expenseslist->exp_slipt_num->HrefValue = "";
			$expenseslist->exp_slipt_num->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expenseslist->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expenseslist->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $expenseslist;

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
		$item->Body = "<a name=\"emf_expenseslist\" id=\"emf_expenseslist\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_expenseslist',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fexpenseslistlist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($expenseslist->Export <> "" ||
			$expenseslist->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $expenseslist;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $expenseslist->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($expenseslist->ExportAll) {
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
		if ($expenseslist->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($expenseslist, "h");
		}
		$ParentTable = "";

		// Export master record
		if (EW_EXPORT_MASTER_RECORD && $expenseslist->getMasterFilter() <> "" && $expenseslist->getCurrentMasterTable() == "expensescategory") {
			global $expensescategory;
			$rsmaster = $expensescategory->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				if ($expenseslist->Export == "xml") {
					$ParentTable = "expensescategory";
					$expensescategory->ExportXmlDocument($XmlDoc, '', $rsmaster, 1, 1);
				} else {
					$ExportStyle = $ExportDoc->Style;
					$ExportDoc->ChangeStyle("v"); // Change to vertical
					if ($expenseslist->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
						$expensescategory->ExportDocument($ExportDoc, $rsmaster, 1, 1);
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
		if ($expenseslist->Export == "xml") {
			$expenseslist->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$expenseslist->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($expenseslist->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($expenseslist->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($expenseslist->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($expenseslist->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($expenseslist->ExportReturnUrl());
		} elseif ($expenseslist->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $expenseslist;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "expensescategory") {
				$bValidMaster = TRUE;
				if (@$_GET["exp_cat_id"] <> "") {
					$GLOBALS["expensescategory"]->exp_cat_id->setQueryStringValue($_GET["exp_cat_id"]);
					$expenseslist->exp_cat->setQueryStringValue($GLOBALS["expensescategory"]->exp_cat_id->QueryStringValue);
					$expenseslist->exp_cat->setSessionValue($expenseslist->exp_cat->QueryStringValue);
					if (!is_numeric($GLOBALS["expensescategory"]->exp_cat_id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$expenseslist->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$expenseslist->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "expensescategory") {
				if ($expenseslist->exp_cat->QueryStringValue == "") $expenseslist->exp_cat->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $expenseslist->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $expenseslist->getDetailFilter(); // Get detail filter
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
