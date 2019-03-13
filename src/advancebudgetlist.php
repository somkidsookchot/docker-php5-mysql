<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "advancebudgetinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$advancebudget_list = new cadvancebudget_list();
$Page =& $advancebudget_list;

// Page init
$advancebudget_list->Page_Init();

// Page main
$advancebudget_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($advancebudget->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var advancebudget_list = new ew_Page("advancebudget_list");

// page properties
advancebudget_list.PageID = "list"; // page ID
advancebudget_list.FormID = "fadvancebudgetlist"; // form ID
var EW_PAGE_ID = advancebudget_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
advancebudget_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
advancebudget_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
advancebudget_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
advancebudget_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($advancebudget->Export == "") || (EW_EXPORT_MASTER_RECORD && $advancebudget->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$advancebudget_list->TotalRecs = $advancebudget->SelectRecordCount();
	} else {
		if ($advancebudget_list->Recordset = $advancebudget_list->LoadRecordset())
			$advancebudget_list->TotalRecs = $advancebudget_list->Recordset->RecordCount();
	}
	$advancebudget_list->StartRec = 1;
	if ($advancebudget_list->DisplayRecs <= 0 || ($advancebudget->Export <> "" && $advancebudget->ExportAll)) // Display all records
		$advancebudget_list->DisplayRecs = $advancebudget_list->TotalRecs;
	if (!($advancebudget->Export <> "" && $advancebudget->ExportAll))
		$advancebudget_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$advancebudget_list->Recordset = $advancebudget_list->LoadRecordset($advancebudget_list->StartRec-1, $advancebudget_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $advancebudget->TableCaption() ?>
&nbsp;&nbsp;<?php $advancebudget_list->ExportOptions->Render("body"); ?>
</p>
<?php $advancebudget_list->ShowPageHeader(); ?>
<?php
$advancebudget_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($advancebudget->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($advancebudget->CurrentAction <> "gridadd" && $advancebudget->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($advancebudget_list->Pager)) $advancebudget_list->Pager = new cPrevNextPager($advancebudget_list->StartRec, $advancebudget_list->DisplayRecs, $advancebudget_list->TotalRecs) ?>
<?php if ($advancebudget_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($advancebudget_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $advancebudget_list->PageUrl() ?>start=<?php echo $advancebudget_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($advancebudget_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $advancebudget_list->PageUrl() ?>start=<?php echo $advancebudget_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $advancebudget_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($advancebudget_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $advancebudget_list->PageUrl() ?>start=<?php echo $advancebudget_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($advancebudget_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $advancebudget_list->PageUrl() ?>start=<?php echo $advancebudget_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $advancebudget_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $advancebudget_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $advancebudget_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $advancebudget_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($advancebudget_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($advancebudget_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="advancebudget">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($advancebudget_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($advancebudget_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($advancebudget_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($advancebudget_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($advancebudget_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($advancebudget_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($advancebudget_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($advancebudget_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($advancebudget_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $advancebudget_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($advancebudget_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fadvancebudgetlist, '<?php echo $advancebudget_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fadvancebudgetlist" id="fadvancebudgetlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="advancebudget">
<div id="gmp_advancebudget" class="ewGridMiddlePanel">
<?php if ($advancebudget_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $advancebudget->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$advancebudget_list->RenderListOptions();

// Render list options (header, left)
$advancebudget_list->ListOptions->Render("header", "left");
?>
<?php if ($advancebudget->adv_id->Visible) { // adv_id ?>
	<?php if ($advancebudget->SortUrl($advancebudget->adv_id) == "") { ?>
		<td><?php echo $advancebudget->adv_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $advancebudget->SortUrl($advancebudget->adv_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $advancebudget->adv_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($advancebudget->adv_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($advancebudget->adv_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($advancebudget->member_id->Visible) { // member_id ?>
	<?php if ($advancebudget->SortUrl($advancebudget->member_id) == "") { ?>
		<td><?php echo $advancebudget->member_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $advancebudget->SortUrl($advancebudget->member_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $advancebudget->member_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($advancebudget->member_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($advancebudget->member_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($advancebudget->death_count->Visible) { // death_count ?>
	<?php if ($advancebudget->SortUrl($advancebudget->death_count) == "") { ?>
		<td><?php echo $advancebudget->death_count->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $advancebudget->SortUrl($advancebudget->death_count) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $advancebudget->death_count->FldCaption() ?></td><td style="width: 10px;"><?php if ($advancebudget->death_count->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($advancebudget->death_count->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($advancebudget->adv_total->Visible) { // adv_total ?>
	<?php if ($advancebudget->SortUrl($advancebudget->adv_total) == "") { ?>
		<td><?php echo $advancebudget->adv_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $advancebudget->SortUrl($advancebudget->adv_total) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $advancebudget->adv_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($advancebudget->adv_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($advancebudget->adv_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($advancebudget->adb_detail->Visible) { // adb_detail ?>
	<?php if ($advancebudget->SortUrl($advancebudget->adb_detail) == "") { ?>
		<td><?php echo $advancebudget->adb_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $advancebudget->SortUrl($advancebudget->adb_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $advancebudget->adb_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($advancebudget->adb_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($advancebudget->adb_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$advancebudget_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($advancebudget->ExportAll && $advancebudget->Export <> "") {
	$advancebudget_list->StopRec = $advancebudget_list->TotalRecs;
} else {

	// Set the last record to display
	if ($advancebudget_list->TotalRecs > $advancebudget_list->StartRec + $advancebudget_list->DisplayRecs - 1)
		$advancebudget_list->StopRec = $advancebudget_list->StartRec + $advancebudget_list->DisplayRecs - 1;
	else
		$advancebudget_list->StopRec = $advancebudget_list->TotalRecs;
}
$advancebudget_list->RecCnt = $advancebudget_list->StartRec - 1;
if ($advancebudget_list->Recordset && !$advancebudget_list->Recordset->EOF) {
	$advancebudget_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $advancebudget_list->StartRec > 1)
		$advancebudget_list->Recordset->Move($advancebudget_list->StartRec - 1);
} elseif (!$advancebudget->AllowAddDeleteRow && $advancebudget_list->StopRec == 0) {
	$advancebudget_list->StopRec = $advancebudget->GridAddRowCount;
}

// Initialize aggregate
$advancebudget->RowType = EW_ROWTYPE_AGGREGATEINIT;
$advancebudget->ResetAttrs();
$advancebudget_list->RenderRow();
$advancebudget_list->RowCnt = 0;
while ($advancebudget_list->RecCnt < $advancebudget_list->StopRec) {
	$advancebudget_list->RecCnt++;
	if (intval($advancebudget_list->RecCnt) >= intval($advancebudget_list->StartRec)) {
		$advancebudget_list->RowCnt++;

		// Set up key count
		$advancebudget_list->KeyCount = $advancebudget_list->RowIndex;

		// Init row class and style
		$advancebudget->ResetAttrs();
		$advancebudget->CssClass = "";
		if ($advancebudget->CurrentAction == "gridadd") {
		} else {
			$advancebudget_list->LoadRowValues($advancebudget_list->Recordset); // Load row values
		}
		$advancebudget->RowType = EW_ROWTYPE_VIEW; // Render view
		$advancebudget->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$advancebudget_list->RenderRow();

		// Render list options
		$advancebudget_list->RenderListOptions();
?>
	<tr<?php echo $advancebudget->RowAttributes() ?>>
<?php

// Render list options (body, left)
$advancebudget_list->ListOptions->Render("body", "left");
?>
	<?php if ($advancebudget->adv_id->Visible) { // adv_id ?>
		<td<?php echo $advancebudget->adv_id->CellAttributes() ?>>
<div<?php echo $advancebudget->adv_id->ViewAttributes() ?>><?php echo $advancebudget->adv_id->ListViewValue() ?></div>
<a name="<?php echo $advancebudget_list->PageObjName . "_row_" . $advancebudget_list->RowCnt ?>" id="<?php echo $advancebudget_list->PageObjName . "_row_" . $advancebudget_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($advancebudget->member_id->Visible) { // member_id ?>
		<td<?php echo $advancebudget->member_id->CellAttributes() ?>>
<div<?php echo $advancebudget->member_id->ViewAttributes() ?>><?php echo $advancebudget->member_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($advancebudget->death_count->Visible) { // death_count ?>
		<td<?php echo $advancebudget->death_count->CellAttributes() ?>>
<div<?php echo $advancebudget->death_count->ViewAttributes() ?>><?php echo $advancebudget->death_count->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($advancebudget->adv_total->Visible) { // adv_total ?>
		<td<?php echo $advancebudget->adv_total->CellAttributes() ?>>
<div<?php echo $advancebudget->adv_total->ViewAttributes() ?>><?php echo $advancebudget->adv_total->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($advancebudget->adb_detail->Visible) { // adb_detail ?>
		<td<?php echo $advancebudget->adb_detail->CellAttributes() ?>>
<div<?php echo $advancebudget->adb_detail->ViewAttributes() ?>><?php echo $advancebudget->adb_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$advancebudget_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($advancebudget->CurrentAction <> "gridadd")
		$advancebudget_list->Recordset->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$advancebudget->RowType = EW_ROWTYPE_AGGREGATE;
$advancebudget->ResetAttrs();
$advancebudget_list->RenderRow();
?>
<?php if ($advancebudget_list->TotalRecs > 0 && ($advancebudget->CurrentAction <> "gridadd" && $advancebudget->CurrentAction <> "gridedit")) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$advancebudget_list->RenderListOptions();

// Render list options (footer, left)
$advancebudget_list->ListOptions->Render("footer", "left");
?>
	<?php if ($advancebudget->adv_id->Visible) { // adv_id ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($advancebudget->member_id->Visible) { // member_id ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($advancebudget->death_count->Visible) { // death_count ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($advancebudget->adv_total->Visible) { // adv_total ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $advancebudget->adv_total->ViewAttributes() ?>><?php echo $advancebudget->adv_total->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($advancebudget->adb_detail->Visible) { // adb_detail ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$advancebudget_list->ListOptions->Render("footer", "right");
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
if ($advancebudget_list->Recordset)
	$advancebudget_list->Recordset->Close();
?>
<?php if ($advancebudget_list->TotalRecs > 0) { ?>
<?php if ($advancebudget->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($advancebudget->CurrentAction <> "gridadd" && $advancebudget->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($advancebudget_list->Pager)) $advancebudget_list->Pager = new cPrevNextPager($advancebudget_list->StartRec, $advancebudget_list->DisplayRecs, $advancebudget_list->TotalRecs) ?>
<?php if ($advancebudget_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($advancebudget_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $advancebudget_list->PageUrl() ?>start=<?php echo $advancebudget_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($advancebudget_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $advancebudget_list->PageUrl() ?>start=<?php echo $advancebudget_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $advancebudget_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($advancebudget_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $advancebudget_list->PageUrl() ?>start=<?php echo $advancebudget_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($advancebudget_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $advancebudget_list->PageUrl() ?>start=<?php echo $advancebudget_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $advancebudget_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $advancebudget_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $advancebudget_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $advancebudget_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($advancebudget_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($advancebudget_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="advancebudget">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($advancebudget_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($advancebudget_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($advancebudget_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($advancebudget_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($advancebudget_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($advancebudget_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($advancebudget_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($advancebudget_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($advancebudget_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $advancebudget_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($advancebudget_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fadvancebudgetlist, '<?php echo $advancebudget_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($advancebudget->Export == "" && $advancebudget->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(advancebudget_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$advancebudget_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($advancebudget->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$advancebudget_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cadvancebudget_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'advancebudget';

	// Page object name
	var $PageObjName = 'advancebudget_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $advancebudget;
		if ($advancebudget->UseTokenInUrl) $PageUrl .= "t=" . $advancebudget->TableVar . "&"; // Add page token
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
		global $objForm, $advancebudget;
		if ($advancebudget->UseTokenInUrl) {
			if ($objForm)
				return ($advancebudget->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($advancebudget->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cadvancebudget_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (advancebudget)
		if (!isset($GLOBALS["advancebudget"])) {
			$GLOBALS["advancebudget"] = new cadvancebudget();
			$GLOBALS["Table"] =& $GLOBALS["advancebudget"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "advancebudgetadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "advancebudgetdelete.php";
		$this->MultiUpdateUrl = "advancebudgetupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'advancebudget', TRUE);

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
		global $advancebudget;

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
			$advancebudget->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$advancebudget->Export = $_POST["exporttype"];
		} else {
			$advancebudget->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $advancebudget->Export; // Get export parameter, used in header
		$gsExportFile = $advancebudget->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($advancebudget->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($advancebudget->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$advancebudget->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $advancebudget;

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
			if ($advancebudget->Export <> "" ||
				$advancebudget->CurrentAction == "gridadd" ||
				$advancebudget->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($advancebudget->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $advancebudget->getRecordsPerPage(); // Restore from Session
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
		$advancebudget->setSessionWhere($sFilter);
		$advancebudget->CurrentFilter = "";

		// Export data only
		if (in_array($advancebudget->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($advancebudget->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $advancebudget;
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
			$advancebudget->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$advancebudget->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $advancebudget;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$advancebudget->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$advancebudget->CurrentOrderType = @$_GET["ordertype"];
			$advancebudget->UpdateSort($advancebudget->adv_id); // adv_id
			$advancebudget->UpdateSort($advancebudget->member_id); // member_id
			$advancebudget->UpdateSort($advancebudget->death_count); // death_count
			$advancebudget->UpdateSort($advancebudget->adv_total); // adv_total
			$advancebudget->UpdateSort($advancebudget->adb_detail); // adb_detail
			$advancebudget->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $advancebudget;
		$sOrderBy = $advancebudget->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($advancebudget->SqlOrderBy() <> "") {
				$sOrderBy = $advancebudget->SqlOrderBy();
				$advancebudget->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $advancebudget;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$advancebudget->setSessionOrderBy($sOrderBy);
				$advancebudget->adv_id->setSort("");
				$advancebudget->member_id->setSort("");
				$advancebudget->death_count->setSort("");
				$advancebudget->adv_total->setSort("");
				$advancebudget->adb_detail->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$advancebudget->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $advancebudget;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"advancebudget_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $advancebudget, $objForm;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($advancebudget->adv_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $advancebudget;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $advancebudget;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$advancebudget->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$advancebudget->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $advancebudget->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$advancebudget->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$advancebudget->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$advancebudget->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $advancebudget;

		// Call Recordset Selecting event
		$advancebudget->Recordset_Selecting($advancebudget->CurrentFilter);

		// Load List page SQL
		$sSql = $advancebudget->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$advancebudget->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $advancebudget;
		$sFilter = $advancebudget->KeyFilter();

		// Call Row Selecting event
		$advancebudget->Row_Selecting($sFilter);

		// Load SQL based on filter
		$advancebudget->CurrentFilter = $sFilter;
		$sSql = $advancebudget->SQL();
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
		global $conn, $advancebudget;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$advancebudget->Row_Selected($row);
		$advancebudget->adv_id->setDbValue($rs->fields('adv_id'));
		$advancebudget->member_id->setDbValue($rs->fields('member_id'));
		$advancebudget->death_count->setDbValue($rs->fields('death_count'));
		$advancebudget->adv_total->setDbValue($rs->fields('adv_total'));
		$advancebudget->adb_detail->setDbValue($rs->fields('adb_detail'));
	}

	// Load old record
	function LoadOldRecord() {
		global $advancebudget;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($advancebudget->getKey("adv_id")) <> "")
			$advancebudget->adv_id->CurrentValue = $advancebudget->getKey("adv_id"); // adv_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$advancebudget->CurrentFilter = $advancebudget->KeyFilter();
			$sSql = $advancebudget->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $advancebudget;

		// Initialize URLs
		$this->ViewUrl = $advancebudget->ViewUrl();
		$this->EditUrl = $advancebudget->EditUrl();
		$this->InlineEditUrl = $advancebudget->InlineEditUrl();
		$this->CopyUrl = $advancebudget->CopyUrl();
		$this->InlineCopyUrl = $advancebudget->InlineCopyUrl();
		$this->DeleteUrl = $advancebudget->DeleteUrl();

		// Call Row_Rendering event
		$advancebudget->Row_Rendering();

		// Common render codes for all row types
		// adv_id
		// member_id
		// death_count
		// adv_total
		// adb_detail
		// Accumulate aggregate value

		if ($advancebudget->RowType <> EW_ROWTYPE_AGGREGATEINIT && $advancebudget->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($advancebudget->adv_total->CurrentValue))
				$advancebudget->adv_total->Total += $advancebudget->adv_total->CurrentValue; // Accumulate total
		}
		if ($advancebudget->RowType == EW_ROWTYPE_VIEW) { // View row

			// adv_id
			$advancebudget->adv_id->ViewValue = $advancebudget->adv_id->CurrentValue;
			$advancebudget->adv_id->ViewCustomAttributes = "";

			// member_id
			$advancebudget->member_id->ViewValue = $advancebudget->member_id->CurrentValue;
			$advancebudget->member_id->ViewCustomAttributes = "";

			// death_count
			$advancebudget->death_count->ViewValue = $advancebudget->death_count->CurrentValue;
			$advancebudget->death_count->ViewCustomAttributes = "";

			// adv_total
			$advancebudget->adv_total->ViewValue = $advancebudget->adv_total->CurrentValue;
			$advancebudget->adv_total->ViewCustomAttributes = "";

			// adb_detail
			$advancebudget->adb_detail->ViewValue = $advancebudget->adb_detail->CurrentValue;
			$advancebudget->adb_detail->ViewCustomAttributes = "";

			// adv_id
			$advancebudget->adv_id->LinkCustomAttributes = "";
			$advancebudget->adv_id->HrefValue = "";
			$advancebudget->adv_id->TooltipValue = "";

			// member_id
			$advancebudget->member_id->LinkCustomAttributes = "";
			$advancebudget->member_id->HrefValue = "";
			$advancebudget->member_id->TooltipValue = "";

			// death_count
			$advancebudget->death_count->LinkCustomAttributes = "";
			$advancebudget->death_count->HrefValue = "";
			$advancebudget->death_count->TooltipValue = "";

			// adv_total
			$advancebudget->adv_total->LinkCustomAttributes = "";
			$advancebudget->adv_total->HrefValue = "";
			$advancebudget->adv_total->TooltipValue = "";

			// adb_detail
			$advancebudget->adb_detail->LinkCustomAttributes = "";
			$advancebudget->adb_detail->HrefValue = "";
			$advancebudget->adb_detail->TooltipValue = "";
		} elseif ($advancebudget->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$advancebudget->adv_total->Total = 0; // Initialize total
		} elseif ($advancebudget->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$advancebudget->adv_total->CurrentValue = $advancebudget->adv_total->Total;
			$advancebudget->adv_total->ViewValue = $advancebudget->adv_total->CurrentValue;
			$advancebudget->adv_total->ViewCustomAttributes = "";
			$advancebudget->adv_total->HrefValue = ""; // Clear href value
		}

		// Call Row Rendered event
		if ($advancebudget->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$advancebudget->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $advancebudget;

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
		$item->Body = "<a name=\"emf_advancebudget\" id=\"emf_advancebudget\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_advancebudget',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fadvancebudgetlist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($advancebudget->Export <> "" ||
			$advancebudget->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $advancebudget;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $advancebudget->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($advancebudget->ExportAll) {
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
		if ($advancebudget->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($advancebudget, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($advancebudget->Export == "xml") {
			$advancebudget->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$advancebudget->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($advancebudget->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($advancebudget->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($advancebudget->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($advancebudget->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($advancebudget->ExportReturnUrl());
		} elseif ($advancebudget->Export == "pdf") {
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
