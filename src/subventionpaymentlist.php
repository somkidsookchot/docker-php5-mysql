<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subventionpaymentinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subventionpayment_list = new csubventionpayment_list();
$Page =& $subventionpayment_list;

// Page init
$subventionpayment_list->Page_Init();

// Page main
$subventionpayment_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($subventionpayment->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subventionpayment_list = new ew_Page("subventionpayment_list");

// page properties
subventionpayment_list.PageID = "list"; // page ID
subventionpayment_list.FormID = "fsubventionpaymentlist"; // form ID
var EW_PAGE_ID = subventionpayment_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subventionpayment_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subventionpayment_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subventionpayment_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subventionpayment_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($subventionpayment->Export == "") || (EW_EXPORT_MASTER_RECORD && $subventionpayment->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$subventionpayment_list->TotalRecs = $subventionpayment->SelectRecordCount();
	} else {
		if ($subventionpayment_list->Recordset = $subventionpayment_list->LoadRecordset())
			$subventionpayment_list->TotalRecs = $subventionpayment_list->Recordset->RecordCount();
	}
	$subventionpayment_list->StartRec = 1;
	if ($subventionpayment_list->DisplayRecs <= 0 || ($subventionpayment->Export <> "" && $subventionpayment->ExportAll)) // Display all records
		$subventionpayment_list->DisplayRecs = $subventionpayment_list->TotalRecs;
	if (!($subventionpayment->Export <> "" && $subventionpayment->ExportAll))
		$subventionpayment_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$subventionpayment_list->Recordset = $subventionpayment_list->LoadRecordset($subventionpayment_list->StartRec-1, $subventionpayment_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subventionpayment->TableCaption() ?>
&nbsp;&nbsp;<?php $subventionpayment_list->ExportOptions->Render("body"); ?>
</p>
<?php $subventionpayment_list->ShowPageHeader(); ?>
<?php
$subventionpayment_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($subventionpayment->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($subventionpayment->CurrentAction <> "gridadd" && $subventionpayment->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subventionpayment_list->Pager)) $subventionpayment_list->Pager = new cPrevNextPager($subventionpayment_list->StartRec, $subventionpayment_list->DisplayRecs, $subventionpayment_list->TotalRecs) ?>
<?php if ($subventionpayment_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subventionpayment_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_list->PageUrl() ?>start=<?php echo $subventionpayment_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subventionpayment_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_list->PageUrl() ?>start=<?php echo $subventionpayment_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subventionpayment_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subventionpayment_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_list->PageUrl() ?>start=<?php echo $subventionpayment_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subventionpayment_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_list->PageUrl() ?>start=<?php echo $subventionpayment_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subventionpayment_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subventionpayment_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subventionpayment_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subventionpayment_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($subventionpayment_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($subventionpayment_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="subventionpayment">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($subventionpayment_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($subventionpayment_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($subventionpayment_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($subventionpayment_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($subventionpayment_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($subventionpayment_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($subventionpayment_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($subventionpayment_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($subventionpayment_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $subventionpayment_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($subventionpayment_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsubventionpaymentlist, '<?php echo $subventionpayment_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fsubventionpaymentlist" id="fsubventionpaymentlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="subventionpayment">
<div id="gmp_subventionpayment" class="ewGridMiddlePanel">
<?php if ($subventionpayment_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $subventionpayment->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$subventionpayment_list->RenderListOptions();

// Render list options (header, left)
$subventionpayment_list->ListOptions->Render("header", "left");
?>
<?php if ($subventionpayment->payment_id->Visible) { // payment_id ?>
	<?php if ($subventionpayment->SortUrl($subventionpayment->payment_id) == "") { ?>
		<td><?php echo $subventionpayment->payment_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subventionpayment->SortUrl($subventionpayment->payment_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subventionpayment->payment_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($subventionpayment->payment_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subventionpayment->payment_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subventionpayment->dead_id->Visible) { // dead_id ?>
	<?php if ($subventionpayment->SortUrl($subventionpayment->dead_id) == "") { ?>
		<td><?php echo $subventionpayment->dead_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subventionpayment->SortUrl($subventionpayment->dead_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subventionpayment->dead_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($subventionpayment->dead_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subventionpayment->dead_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subventionpayment->payment_date->Visible) { // payment_date ?>
	<?php if ($subventionpayment->SortUrl($subventionpayment->payment_date) == "") { ?>
		<td><?php echo $subventionpayment->payment_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subventionpayment->SortUrl($subventionpayment->payment_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subventionpayment->payment_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($subventionpayment->payment_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subventionpayment->payment_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subventionpayment->subvent_total->Visible) { // subvent_total ?>
	<?php if ($subventionpayment->SortUrl($subventionpayment->subvent_total) == "") { ?>
		<td><?php echo $subventionpayment->subvent_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subventionpayment->SortUrl($subventionpayment->subvent_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subventionpayment->subvent_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($subventionpayment->subvent_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subventionpayment->subvent_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subventionpayment->payee->Visible) { // payee ?>
	<?php if ($subventionpayment->SortUrl($subventionpayment->payee) == "") { ?>
		<td><?php echo $subventionpayment->payee->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subventionpayment->SortUrl($subventionpayment->payee) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subventionpayment->payee->FldCaption() ?></td><td style="width: 10px;"><?php if ($subventionpayment->payee->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subventionpayment->payee->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$subventionpayment_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($subventionpayment->ExportAll && $subventionpayment->Export <> "") {
	$subventionpayment_list->StopRec = $subventionpayment_list->TotalRecs;
} else {

	// Set the last record to display
	if ($subventionpayment_list->TotalRecs > $subventionpayment_list->StartRec + $subventionpayment_list->DisplayRecs - 1)
		$subventionpayment_list->StopRec = $subventionpayment_list->StartRec + $subventionpayment_list->DisplayRecs - 1;
	else
		$subventionpayment_list->StopRec = $subventionpayment_list->TotalRecs;
}
$subventionpayment_list->RecCnt = $subventionpayment_list->StartRec - 1;
if ($subventionpayment_list->Recordset && !$subventionpayment_list->Recordset->EOF) {
	$subventionpayment_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $subventionpayment_list->StartRec > 1)
		$subventionpayment_list->Recordset->Move($subventionpayment_list->StartRec - 1);
} elseif (!$subventionpayment->AllowAddDeleteRow && $subventionpayment_list->StopRec == 0) {
	$subventionpayment_list->StopRec = $subventionpayment->GridAddRowCount;
}

// Initialize aggregate
$subventionpayment->RowType = EW_ROWTYPE_AGGREGATEINIT;
$subventionpayment->ResetAttrs();
$subventionpayment_list->RenderRow();
$subventionpayment_list->RowCnt = 0;
while ($subventionpayment_list->RecCnt < $subventionpayment_list->StopRec) {
	$subventionpayment_list->RecCnt++;
	if (intval($subventionpayment_list->RecCnt) >= intval($subventionpayment_list->StartRec)) {
		$subventionpayment_list->RowCnt++;

		// Set up key count
		$subventionpayment_list->KeyCount = $subventionpayment_list->RowIndex;

		// Init row class and style
		$subventionpayment->ResetAttrs();
		$subventionpayment->CssClass = "";
		if ($subventionpayment->CurrentAction == "gridadd") {
		} else {
			$subventionpayment_list->LoadRowValues($subventionpayment_list->Recordset); // Load row values
		}
		$subventionpayment->RowType = EW_ROWTYPE_VIEW; // Render view
		$subventionpayment->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$subventionpayment_list->RenderRow();

		// Render list options
		$subventionpayment_list->RenderListOptions();
?>
	<tr<?php echo $subventionpayment->RowAttributes() ?>>
<?php

// Render list options (body, left)
$subventionpayment_list->ListOptions->Render("body", "left");
?>
	<?php if ($subventionpayment->payment_id->Visible) { // payment_id ?>
		<td<?php echo $subventionpayment->payment_id->CellAttributes() ?>>
<div<?php echo $subventionpayment->payment_id->ViewAttributes() ?>><?php echo $subventionpayment->payment_id->ListViewValue() ?></div>
<a name="<?php echo $subventionpayment_list->PageObjName . "_row_" . $subventionpayment_list->RowCnt ?>" id="<?php echo $subventionpayment_list->PageObjName . "_row_" . $subventionpayment_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($subventionpayment->dead_id->Visible) { // dead_id ?>
		<td<?php echo $subventionpayment->dead_id->CellAttributes() ?>>
<div<?php echo $subventionpayment->dead_id->ViewAttributes() ?>><?php echo $subventionpayment->dead_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subventionpayment->payment_date->Visible) { // payment_date ?>
		<td<?php echo $subventionpayment->payment_date->CellAttributes() ?>>
<div<?php echo $subventionpayment->payment_date->ViewAttributes() ?>><?php echo $subventionpayment->payment_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subventionpayment->subvent_total->Visible) { // subvent_total ?>
		<td<?php echo $subventionpayment->subvent_total->CellAttributes() ?>>
<div<?php echo $subventionpayment->subvent_total->ViewAttributes() ?>><?php echo $subventionpayment->subvent_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subventionpayment->payee->Visible) { // payee ?>
		<td<?php echo $subventionpayment->payee->CellAttributes() ?>>
<div<?php echo $subventionpayment->payee->ViewAttributes() ?>><?php echo $subventionpayment->payee->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subventionpayment_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($subventionpayment->CurrentAction <> "gridadd")
		$subventionpayment_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($subventionpayment_list->Recordset)
	$subventionpayment_list->Recordset->Close();
?>
<?php if ($subventionpayment_list->TotalRecs > 0) { ?>
<?php if ($subventionpayment->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($subventionpayment->CurrentAction <> "gridadd" && $subventionpayment->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subventionpayment_list->Pager)) $subventionpayment_list->Pager = new cPrevNextPager($subventionpayment_list->StartRec, $subventionpayment_list->DisplayRecs, $subventionpayment_list->TotalRecs) ?>
<?php if ($subventionpayment_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subventionpayment_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_list->PageUrl() ?>start=<?php echo $subventionpayment_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subventionpayment_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_list->PageUrl() ?>start=<?php echo $subventionpayment_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subventionpayment_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subventionpayment_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_list->PageUrl() ?>start=<?php echo $subventionpayment_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subventionpayment_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_list->PageUrl() ?>start=<?php echo $subventionpayment_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subventionpayment_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subventionpayment_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subventionpayment_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subventionpayment_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($subventionpayment_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($subventionpayment_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="subventionpayment">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($subventionpayment_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($subventionpayment_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($subventionpayment_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($subventionpayment_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($subventionpayment_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($subventionpayment_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($subventionpayment_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($subventionpayment_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($subventionpayment_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $subventionpayment_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($subventionpayment_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsubventionpaymentlist, '<?php echo $subventionpayment_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($subventionpayment->Export == "" && $subventionpayment->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(subventionpayment_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$subventionpayment_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($subventionpayment->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$subventionpayment_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csubventionpayment_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'subventionpayment';

	// Page object name
	var $PageObjName = 'subventionpayment_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subventionpayment;
		if ($subventionpayment->UseTokenInUrl) $PageUrl .= "t=" . $subventionpayment->TableVar . "&"; // Add page token
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
		global $objForm, $subventionpayment;
		if ($subventionpayment->UseTokenInUrl) {
			if ($objForm)
				return ($subventionpayment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subventionpayment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubventionpayment_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subventionpayment)
		if (!isset($GLOBALS["subventionpayment"])) {
			$GLOBALS["subventionpayment"] = new csubventionpayment();
			$GLOBALS["Table"] =& $GLOBALS["subventionpayment"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "subventionpaymentadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "subventionpaymentdelete.php";
		$this->MultiUpdateUrl = "subventionpaymentupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subventionpayment', TRUE);

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
		global $subventionpayment;

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
			$subventionpayment->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$subventionpayment->Export = $_POST["exporttype"];
		} else {
			$subventionpayment->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $subventionpayment->Export; // Get export parameter, used in header
		$gsExportFile = $subventionpayment->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($subventionpayment->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($subventionpayment->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$subventionpayment->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $subventionpayment;

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
			if ($subventionpayment->Export <> "" ||
				$subventionpayment->CurrentAction == "gridadd" ||
				$subventionpayment->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($subventionpayment->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $subventionpayment->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$subventionpayment->setSessionWhere($sFilter);
		$subventionpayment->CurrentFilter = "";

		// Export data only
		if (in_array($subventionpayment->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($subventionpayment->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $subventionpayment;
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
			$subventionpayment->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$subventionpayment->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $subventionpayment;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$subventionpayment->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$subventionpayment->CurrentOrderType = @$_GET["ordertype"];
			$subventionpayment->UpdateSort($subventionpayment->payment_id); // payment_id
			$subventionpayment->UpdateSort($subventionpayment->dead_id); // dead_id
			$subventionpayment->UpdateSort($subventionpayment->payment_date); // payment_date
			$subventionpayment->UpdateSort($subventionpayment->subvent_total); // subvent_total
			$subventionpayment->UpdateSort($subventionpayment->payee); // payee
			$subventionpayment->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $subventionpayment;
		$sOrderBy = $subventionpayment->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($subventionpayment->SqlOrderBy() <> "") {
				$sOrderBy = $subventionpayment->SqlOrderBy();
				$subventionpayment->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $subventionpayment;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$subventionpayment->setSessionOrderBy($sOrderBy);
				$subventionpayment->payment_id->setSort("");
				$subventionpayment->dead_id->setSort("");
				$subventionpayment->payment_date->setSort("");
				$subventionpayment->subvent_total->setSort("");
				$subventionpayment->payee->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$subventionpayment->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $subventionpayment;

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

		// "copy"
		$item =& $this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

		// "checkbox"
		$item =& $this->ListOptions->Add("checkbox");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"subventionpayment_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $subventionpayment, $objForm;
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

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($subventionpayment->payment_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $subventionpayment;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subventionpayment;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$subventionpayment->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$subventionpayment->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $subventionpayment->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$subventionpayment->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$subventionpayment->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$subventionpayment->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subventionpayment;

		// Call Recordset Selecting event
		$subventionpayment->Recordset_Selecting($subventionpayment->CurrentFilter);

		// Load List page SQL
		$sSql = $subventionpayment->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subventionpayment->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subventionpayment;
		$sFilter = $subventionpayment->KeyFilter();

		// Call Row Selecting event
		$subventionpayment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subventionpayment->CurrentFilter = $sFilter;
		$sSql = $subventionpayment->SQL();
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
		global $conn, $subventionpayment;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subventionpayment->Row_Selected($row);
		$subventionpayment->payment_id->setDbValue($rs->fields('payment_id'));
		$subventionpayment->dead_id->setDbValue($rs->fields('dead_id'));
		$subventionpayment->payment_date->setDbValue($rs->fields('payment_date'));
		$subventionpayment->subvent_total->setDbValue($rs->fields('subvent_total'));
		$subventionpayment->payee->setDbValue($rs->fields('payee'));
		$subventionpayment->pay_des->setDbValue($rs->fields('pay_des'));
		$subventionpayment->donate_total->setDbValue($rs->fields('donate_total'));
	}

	// Load old record
	function LoadOldRecord() {
		global $subventionpayment;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($subventionpayment->getKey("payment_id")) <> "")
			$subventionpayment->payment_id->CurrentValue = $subventionpayment->getKey("payment_id"); // payment_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$subventionpayment->CurrentFilter = $subventionpayment->KeyFilter();
			$sSql = $subventionpayment->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subventionpayment;

		// Initialize URLs
		$this->ViewUrl = $subventionpayment->ViewUrl();
		$this->EditUrl = $subventionpayment->EditUrl();
		$this->InlineEditUrl = $subventionpayment->InlineEditUrl();
		$this->CopyUrl = $subventionpayment->CopyUrl();
		$this->InlineCopyUrl = $subventionpayment->InlineCopyUrl();
		$this->DeleteUrl = $subventionpayment->DeleteUrl();

		// Call Row_Rendering event
		$subventionpayment->Row_Rendering();

		// Common render codes for all row types
		// payment_id
		// dead_id
		// payment_date
		// subvent_total
		// payee
		// pay_des
		// donate_total

		$subventionpayment->donate_total->CellCssStyle = "white-space: nowrap;";
		if ($subventionpayment->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_id
			$subventionpayment->payment_id->ViewValue = $subventionpayment->payment_id->CurrentValue;
			$subventionpayment->payment_id->ViewCustomAttributes = "";

			// dead_id
			$subventionpayment->dead_id->ViewValue = $subventionpayment->dead_id->CurrentValue;
			$subventionpayment->dead_id->ViewCustomAttributes = "";

			// payment_date
			$subventionpayment->payment_date->ViewValue = $subventionpayment->payment_date->CurrentValue;
			$subventionpayment->payment_date->ViewValue = ew_FormatDateTime($subventionpayment->payment_date->ViewValue, 7);
			$subventionpayment->payment_date->ViewCustomAttributes = "";

			// subvent_total
			$subventionpayment->subvent_total->ViewValue = $subventionpayment->subvent_total->CurrentValue;
			$subventionpayment->subvent_total->ViewCustomAttributes = "";

			// payee
			$subventionpayment->payee->ViewValue = $subventionpayment->payee->CurrentValue;
			$subventionpayment->payee->ViewCustomAttributes = "";

			// payment_id
			$subventionpayment->payment_id->LinkCustomAttributes = "";
			$subventionpayment->payment_id->HrefValue = "";
			$subventionpayment->payment_id->TooltipValue = "";

			// dead_id
			$subventionpayment->dead_id->LinkCustomAttributes = "";
			$subventionpayment->dead_id->HrefValue = "";
			$subventionpayment->dead_id->TooltipValue = "";

			// payment_date
			$subventionpayment->payment_date->LinkCustomAttributes = "";
			$subventionpayment->payment_date->HrefValue = "";
			$subventionpayment->payment_date->TooltipValue = "";

			// subvent_total
			$subventionpayment->subvent_total->LinkCustomAttributes = "";
			$subventionpayment->subvent_total->HrefValue = "";
			$subventionpayment->subvent_total->TooltipValue = "";

			// payee
			$subventionpayment->payee->LinkCustomAttributes = "";
			$subventionpayment->payee->HrefValue = "";
			$subventionpayment->payee->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subventionpayment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subventionpayment->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $subventionpayment;

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
		$item->Body = "<a name=\"emf_subventionpayment\" id=\"emf_subventionpayment\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_subventionpayment',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fsubventionpaymentlist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($subventionpayment->Export <> "" ||
			$subventionpayment->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $subventionpayment;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $subventionpayment->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($subventionpayment->ExportAll) {
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
		if ($subventionpayment->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($subventionpayment, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($subventionpayment->Export == "xml") {
			$subventionpayment->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$subventionpayment->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($subventionpayment->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($subventionpayment->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($subventionpayment->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($subventionpayment->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($subventionpayment->ExportReturnUrl());
		} elseif ($subventionpayment->Export == "pdf") {
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
