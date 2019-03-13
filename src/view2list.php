<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "view2info.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$view2_list = new cview2_list();
$Page =& $view2_list;

// Page init
$view2_list->Page_Init();

// Page main
$view2_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($view2->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var view2_list = new ew_Page("view2_list");

// page properties
view2_list.PageID = "list"; // page ID
view2_list.FormID = "fview2list"; // form ID
var EW_PAGE_ID = view2_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
view2_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
view2_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
view2_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
view2_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($view2->Export == "") || (EW_EXPORT_MASTER_RECORD && $view2->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$view2_list->TotalRecs = $view2->SelectRecordCount();
	} else {
		if ($view2_list->Recordset = $view2_list->LoadRecordset())
			$view2_list->TotalRecs = $view2_list->Recordset->RecordCount();
	}
	$view2_list->StartRec = 1;
	if ($view2_list->DisplayRecs <= 0 || ($view2->Export <> "" && $view2->ExportAll)) // Display all records
		$view2_list->DisplayRecs = $view2_list->TotalRecs;
	if (!($view2->Export <> "" && $view2->ExportAll))
		$view2_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$view2_list->Recordset = $view2_list->LoadRecordset($view2_list->StartRec-1, $view2_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $view2->TableCaption() ?>
&nbsp;&nbsp;<?php $view2_list->ExportOptions->Render("body"); ?>
</p>
<?php $view2_list->ShowPageHeader(); ?>
<?php
$view2_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($view2->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($view2->CurrentAction <> "gridadd" && $view2->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($view2_list->Pager)) $view2_list->Pager = new cPrevNextPager($view2_list->StartRec, $view2_list->DisplayRecs, $view2_list->TotalRecs) ?>
<?php if ($view2_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($view2_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $view2_list->PageUrl() ?>start=<?php echo $view2_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($view2_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $view2_list->PageUrl() ?>start=<?php echo $view2_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $view2_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($view2_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $view2_list->PageUrl() ?>start=<?php echo $view2_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($view2_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $view2_list->PageUrl() ?>start=<?php echo $view2_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $view2_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $view2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $view2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $view2_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($view2_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($view2_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="view2">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($view2_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($view2_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($view2_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($view2_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($view2_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($view2_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($view2_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($view2_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($view2_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($view2->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
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
<form name="fview2list" id="fview2list" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="view2">
<div id="gmp_view2" class="ewGridMiddlePanel">
<?php if ($view2_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $view2->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$view2_list->RenderListOptions();

// Render list options (header, left)
$view2_list->ListOptions->Render("header", "left");
?>
<?php if ($view2->member_code->Visible) { // member_code ?>
	<?php if ($view2->SortUrl($view2->member_code) == "") { ?>
		<td><?php echo $view2->member_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->member_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view2->member_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->member_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->member_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->id_code->Visible) { // id_code ?>
	<?php if ($view2->SortUrl($view2->id_code) == "") { ?>
		<td><?php echo $view2->id_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->id_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view2->id_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->id_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->id_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->prefix->Visible) { // prefix ?>
	<?php if ($view2->SortUrl($view2->prefix) == "") { ?>
		<td><?php echo $view2->prefix->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->prefix) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view2->prefix->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->prefix->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->prefix->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->gender->Visible) { // gender ?>
	<?php if ($view2->SortUrl($view2->gender) == "") { ?>
		<td><?php echo $view2->gender->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->gender) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view2->gender->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->gender->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->gender->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->fname->Visible) { // fname ?>
	<?php if ($view2->SortUrl($view2->fname) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $view2->fname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->fname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $view2->fname->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->fname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->fname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->lname->Visible) { // lname ?>
	<?php if ($view2->SortUrl($view2->lname) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $view2->lname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->lname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $view2->lname->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->lname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->lname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->age->Visible) { // age ?>
	<?php if ($view2->SortUrl($view2->age) == "") { ?>
		<td><?php echo $view2->age->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->age) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view2->age->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->age->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->age->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->t_code->Visible) { // t_code ?>
	<?php if ($view2->SortUrl($view2->t_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $view2->t_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->t_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $view2->t_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->t_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->t_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->village_id->Visible) { // village_id ?>
	<?php if ($view2->SortUrl($view2->village_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $view2->village_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->village_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $view2->village_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->village_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->village_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->dead_date->Visible) { // dead_date ?>
	<?php if ($view2->SortUrl($view2->dead_date) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $view2->dead_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->dead_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $view2->dead_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->dead_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->dead_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->note->Visible) { // note ?>
	<?php if ($view2->SortUrl($view2->note) == "") { ?>
		<td><?php echo $view2->note->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->note) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view2->note->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->note->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->note->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->dead_id->Visible) { // dead_id ?>
	<?php if ($view2->SortUrl($view2->dead_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $view2->dead_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->dead_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $view2->dead_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->dead_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->dead_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view2->member_status->Visible) { // member_status ?>
	<?php if ($view2->SortUrl($view2->member_status) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $view2->member_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view2->SortUrl($view2->member_status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $view2->member_status->FldCaption() ?></td><td style="width: 10px;"><?php if ($view2->member_status->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view2->member_status->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$view2_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($view2->ExportAll && $view2->Export <> "") {
	$view2_list->StopRec = $view2_list->TotalRecs;
} else {

	// Set the last record to display
	if ($view2_list->TotalRecs > $view2_list->StartRec + $view2_list->DisplayRecs - 1)
		$view2_list->StopRec = $view2_list->StartRec + $view2_list->DisplayRecs - 1;
	else
		$view2_list->StopRec = $view2_list->TotalRecs;
}
$view2_list->RecCnt = $view2_list->StartRec - 1;
if ($view2_list->Recordset && !$view2_list->Recordset->EOF) {
	$view2_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $view2_list->StartRec > 1)
		$view2_list->Recordset->Move($view2_list->StartRec - 1);
} elseif (!$view2->AllowAddDeleteRow && $view2_list->StopRec == 0) {
	$view2_list->StopRec = $view2->GridAddRowCount;
}

// Initialize aggregate
$view2->RowType = EW_ROWTYPE_AGGREGATEINIT;
$view2->ResetAttrs();
$view2_list->RenderRow();
$view2_list->RowCnt = 0;
while ($view2_list->RecCnt < $view2_list->StopRec) {
	$view2_list->RecCnt++;
	if (intval($view2_list->RecCnt) >= intval($view2_list->StartRec)) {
		$view2_list->RowCnt++;

		// Set up key count
		$view2_list->KeyCount = $view2_list->RowIndex;

		// Init row class and style
		$view2->ResetAttrs();
		$view2->CssClass = "";
		if ($view2->CurrentAction == "gridadd") {
		} else {
			$view2_list->LoadRowValues($view2_list->Recordset); // Load row values
		}
		$view2->RowType = EW_ROWTYPE_VIEW; // Render view
		$view2->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$view2_list->RenderRow();

		// Render list options
		$view2_list->RenderListOptions();
?>
	<tr<?php echo $view2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$view2_list->ListOptions->Render("body", "left");
?>
	<?php if ($view2->member_code->Visible) { // member_code ?>
		<td<?php echo $view2->member_code->CellAttributes() ?>>
<div<?php echo $view2->member_code->ViewAttributes() ?>><?php echo $view2->member_code->ListViewValue() ?></div>
<a name="<?php echo $view2_list->PageObjName . "_row_" . $view2_list->RowCnt ?>" id="<?php echo $view2_list->PageObjName . "_row_" . $view2_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($view2->id_code->Visible) { // id_code ?>
		<td<?php echo $view2->id_code->CellAttributes() ?>>
<div<?php echo $view2->id_code->ViewAttributes() ?>><?php echo $view2->id_code->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view2->prefix->Visible) { // prefix ?>
		<td<?php echo $view2->prefix->CellAttributes() ?>>
<div<?php echo $view2->prefix->ViewAttributes() ?>><?php echo $view2->prefix->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view2->gender->Visible) { // gender ?>
		<td<?php echo $view2->gender->CellAttributes() ?>>
<div<?php echo $view2->gender->ViewAttributes() ?>><?php echo $view2->gender->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view2->fname->Visible) { // fname ?>
		<td<?php echo $view2->fname->CellAttributes() ?>>
<div<?php echo $view2->fname->ViewAttributes() ?>><?php echo $view2->fname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view2->lname->Visible) { // lname ?>
		<td<?php echo $view2->lname->CellAttributes() ?>>
<div<?php echo $view2->lname->ViewAttributes() ?>><?php echo $view2->lname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view2->age->Visible) { // age ?>
		<td<?php echo $view2->age->CellAttributes() ?>>
<div<?php echo $view2->age->ViewAttributes() ?>><?php echo $view2->age->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view2->t_code->Visible) { // t_code ?>
		<td<?php echo $view2->t_code->CellAttributes() ?>>
<div<?php echo $view2->t_code->ViewAttributes() ?>><?php echo $view2->t_code->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view2->village_id->Visible) { // village_id ?>
		<td<?php echo $view2->village_id->CellAttributes() ?>>
<div<?php echo $view2->village_id->ViewAttributes() ?>><?php echo $view2->village_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view2->dead_date->Visible) { // dead_date ?>
		<td<?php echo $view2->dead_date->CellAttributes() ?>>
<div<?php echo $view2->dead_date->ViewAttributes() ?>><?php echo $view2->dead_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view2->note->Visible) { // note ?>
		<td<?php echo $view2->note->CellAttributes() ?>>
<div<?php echo $view2->note->ViewAttributes() ?>><?php echo $view2->note->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view2->dead_id->Visible) { // dead_id ?>
		<td<?php echo $view2->dead_id->CellAttributes() ?>>
<div<?php echo $view2->dead_id->ViewAttributes() ?>><?php echo $view2->dead_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view2->member_status->Visible) { // member_status ?>
		<td<?php echo $view2->member_status->CellAttributes() ?>>
<div<?php echo $view2->member_status->ViewAttributes() ?>><?php echo $view2->member_status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view2_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($view2->CurrentAction <> "gridadd")
		$view2_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($view2_list->Recordset)
	$view2_list->Recordset->Close();
?>
<?php if ($view2_list->TotalRecs > 0) { ?>
<?php if ($view2->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($view2->CurrentAction <> "gridadd" && $view2->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($view2_list->Pager)) $view2_list->Pager = new cPrevNextPager($view2_list->StartRec, $view2_list->DisplayRecs, $view2_list->TotalRecs) ?>
<?php if ($view2_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($view2_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $view2_list->PageUrl() ?>start=<?php echo $view2_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($view2_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $view2_list->PageUrl() ?>start=<?php echo $view2_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $view2_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($view2_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $view2_list->PageUrl() ?>start=<?php echo $view2_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($view2_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $view2_list->PageUrl() ?>start=<?php echo $view2_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $view2_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $view2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $view2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $view2_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($view2_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($view2_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="view2">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($view2_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($view2_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($view2_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($view2_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($view2_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($view2_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($view2_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($view2_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($view2_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($view2->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
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
<?php if ($view2->Export == "" && $view2->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(view2_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$view2_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($view2->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$view2_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cview2_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'view2';

	// Page object name
	var $PageObjName = 'view2_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $view2;
		if ($view2->UseTokenInUrl) $PageUrl .= "t=" . $view2->TableVar . "&"; // Add page token
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
		global $objForm, $view2;
		if ($view2->UseTokenInUrl) {
			if ($objForm)
				return ($view2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($view2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cview2_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (view2)
		if (!isset($GLOBALS["view2"])) {
			$GLOBALS["view2"] = new cview2();
			$GLOBALS["Table"] =& $GLOBALS["view2"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "view2add.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "view2delete.php";
		$this->MultiUpdateUrl = "view2update.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'view2', TRUE);

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
		global $view2;

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
			$view2->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$view2->Export = $_POST["exporttype"];
		} else {
			$view2->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $view2->Export; // Get export parameter, used in header
		$gsExportFile = $view2->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($view2->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($view2->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$view2->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $view2;

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
			if ($view2->Export <> "" ||
				$view2->CurrentAction == "gridadd" ||
				$view2->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($view2->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $view2->getRecordsPerPage(); // Restore from Session
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
		$view2->setSessionWhere($sFilter);
		$view2->CurrentFilter = "";

		// Export data only
		if (in_array($view2->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($view2->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $view2;
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
			$view2->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$view2->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $view2;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$view2->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$view2->CurrentOrderType = @$_GET["ordertype"];
			$view2->UpdateSort($view2->member_code); // member_code
			$view2->UpdateSort($view2->id_code); // id_code
			$view2->UpdateSort($view2->prefix); // prefix
			$view2->UpdateSort($view2->gender); // gender
			$view2->UpdateSort($view2->fname); // fname
			$view2->UpdateSort($view2->lname); // lname
			$view2->UpdateSort($view2->age); // age
			$view2->UpdateSort($view2->t_code); // t_code
			$view2->UpdateSort($view2->village_id); // village_id
			$view2->UpdateSort($view2->dead_date); // dead_date
			$view2->UpdateSort($view2->note); // note
			$view2->UpdateSort($view2->dead_id); // dead_id
			$view2->UpdateSort($view2->member_status); // member_status
			$view2->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $view2;
		$sOrderBy = $view2->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($view2->SqlOrderBy() <> "") {
				$sOrderBy = $view2->SqlOrderBy();
				$view2->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $view2;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$view2->setSessionOrderBy($sOrderBy);
				$view2->member_code->setSort("");
				$view2->id_code->setSort("");
				$view2->prefix->setSort("");
				$view2->gender->setSort("");
				$view2->fname->setSort("");
				$view2->lname->setSort("");
				$view2->age->setSort("");
				$view2->t_code->setSort("");
				$view2->village_id->setSort("");
				$view2->dead_date->setSort("");
				$view2->note->setSort("");
				$view2->dead_id->setSort("");
				$view2->member_status->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$view2->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $view2;

		// "detail_subvcharge"
		$item =& $this->ListOptions->Add("detail_subvcharge");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $view2, $objForm;
		$this->ListOptions->LoadDefault();

		// "detail_subvcharge"
		$oListOpt =& $this->ListOptions->Items["detail_subvcharge"];
		if ($Security->IsLoggedIn()) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("subvcharge", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"subvchargelist.php?" . EW_TABLE_SHOW_MASTER . "=view2&member_code=" . urlencode(strval($view2->member_code->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $view2;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $view2;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$view2->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$view2->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $view2->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$view2->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$view2->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$view2->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $view2;

		// Call Recordset Selecting event
		$view2->Recordset_Selecting($view2->CurrentFilter);

		// Load List page SQL
		$sSql = $view2->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$view2->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $view2;
		$sFilter = $view2->KeyFilter();

		// Call Row Selecting event
		$view2->Row_Selecting($sFilter);

		// Load SQL based on filter
		$view2->CurrentFilter = $sFilter;
		$sSql = $view2->SQL();
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
		global $conn, $view2;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$view2->Row_Selected($row);
		$view2->member_code->setDbValue($rs->fields('member_code'));
		$view2->id_code->setDbValue($rs->fields('id_code'));
		$view2->prefix->setDbValue($rs->fields('prefix'));
		$view2->gender->setDbValue($rs->fields('gender'));
		$view2->fname->setDbValue($rs->fields('fname'));
		$view2->lname->setDbValue($rs->fields('lname'));
		$view2->birthdate->setDbValue($rs->fields('birthdate'));
		$view2->age->setDbValue($rs->fields('age'));
		$view2->t_code->setDbValue($rs->fields('t_code'));
		$view2->t_title->setDbValue($rs->fields('t_title'));
		$view2->village_id->setDbValue($rs->fields('village_id'));
		$view2->v_title->setDbValue($rs->fields('v_title'));
		$view2->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
		$view2->dead_date->setDbValue($rs->fields('dead_date'));
		$view2->note->setDbValue($rs->fields('note'));
		$view2->dead_id->setDbValue($rs->fields('dead_id'));
		$view2->member_status->setDbValue($rs->fields('member_status'));
		$view2->regis_date->setDbValue($rs->fields('regis_date'));
	}

	// Load old record
	function LoadOldRecord() {
		global $view2;

		// Load key values from Session
		$bValidKey = TRUE;

		// Load old recordset
		if ($bValidKey) {
			$view2->CurrentFilter = $view2->KeyFilter();
			$sSql = $view2->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $view2;

		// Initialize URLs
		$this->ViewUrl = $view2->ViewUrl();
		$this->EditUrl = $view2->EditUrl();
		$this->InlineEditUrl = $view2->InlineEditUrl();
		$this->CopyUrl = $view2->CopyUrl();
		$this->InlineCopyUrl = $view2->InlineCopyUrl();
		$this->DeleteUrl = $view2->DeleteUrl();

		// Call Row_Rendering event
		$view2->Row_Rendering();

		// Common render codes for all row types
		// member_code
		// id_code
		// prefix
		// gender
		// fname

		$view2->fname->CellCssStyle = "white-space: nowrap;";

		// lname
		$view2->lname->CellCssStyle = "white-space: nowrap;";

		// birthdate
		// age
		// t_code

		$view2->t_code->CellCssStyle = "white-space: nowrap;";

		// t_title
		// village_id

		$view2->village_id->CellCssStyle = "white-space: nowrap;";

		// v_title
		// bnfc1_name

		$view2->bnfc1_name->CellCssStyle = "white-space: nowrap;";

		// dead_date
		$view2->dead_date->CellCssStyle = "white-space: nowrap;";

		// note
		// dead_id

		$view2->dead_id->CellCssStyle = "white-space: nowrap;";

		// member_status
		$view2->member_status->CellCssStyle = "white-space: nowrap;";

		// regis_date
		if ($view2->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$view2->member_code->ViewValue = $view2->member_code->CurrentValue;
			$view2->member_code->ViewCustomAttributes = "";

			// id_code
			$view2->id_code->ViewValue = $view2->id_code->CurrentValue;
			$view2->id_code->ViewCustomAttributes = "";

			// prefix
			if (strval($view2->prefix->CurrentValue) <> "") {
				$sFilterWrk = "`p_title` = '" . ew_AdjustSql($view2->prefix->CurrentValue) . "'";
			$sSqlWrk = "SELECT `p_title` FROM `prefix`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view2->prefix->ViewValue = $rswrk->fields('p_title');
					$rswrk->Close();
				} else {
					$view2->prefix->ViewValue = $view2->prefix->CurrentValue;
				}
			} else {
				$view2->prefix->ViewValue = NULL;
			}
			$view2->prefix->ViewCustomAttributes = "";

			// gender
			if (strval($view2->gender->CurrentValue) <> "") {
				$sFilterWrk = "`g_title` = '" . ew_AdjustSql($view2->gender->CurrentValue) . "'";
			$sSqlWrk = "SELECT `g_title` FROM `gender`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view2->gender->ViewValue = $rswrk->fields('g_title');
					$rswrk->Close();
				} else {
					$view2->gender->ViewValue = $view2->gender->CurrentValue;
				}
			} else {
				$view2->gender->ViewValue = NULL;
			}
			$view2->gender->ViewCustomAttributes = "";

			// fname
			$view2->fname->ViewValue = $view2->fname->CurrentValue;
			$view2->fname->ViewCustomAttributes = "";

			// lname
			$view2->lname->ViewValue = $view2->lname->CurrentValue;
			$view2->lname->ViewCustomAttributes = "";

			// birthdate
			$view2->birthdate->ViewValue = $view2->birthdate->CurrentValue;
			$view2->birthdate->ViewValue = ew_FormatDateTime($view2->birthdate->ViewValue, 6);
			$view2->birthdate->ViewCustomAttributes = "";

			// age
			$view2->age->ViewValue = $view2->age->CurrentValue;
			$view2->age->ViewCustomAttributes = "";

			// t_code
			if (strval($view2->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($view2->t_code->CurrentValue) . "'";
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
					$view2->t_code->ViewValue = $rswrk->fields('t_code');
					$view2->t_code->ViewValue .= ew_ValueSeparator(0,1,$view2->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$view2->t_code->ViewValue = $view2->t_code->CurrentValue;
				}
			} else {
				$view2->t_code->ViewValue = NULL;
			}
			$view2->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($view2->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($view2->village_id->CurrentValue) . "";
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
					$view2->village_id->ViewValue = $rswrk->fields('v_code');
					$view2->village_id->ViewValue .= ew_ValueSeparator(0,1,$view2->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$view2->village_id->ViewValue = $view2->village_id->CurrentValue;
				}
			} else {
				$view2->village_id->ViewValue = NULL;
			}
			$view2->village_id->ViewCustomAttributes = "";

			// dead_date
			$view2->dead_date->ViewValue = $view2->dead_date->CurrentValue;
			$view2->dead_date->ViewValue = ew_FormatDateTime($view2->dead_date->ViewValue, 7);
			$view2->dead_date->ViewCustomAttributes = "";

			// note
			$view2->note->ViewValue = $view2->note->CurrentValue;
			$view2->note->ViewCustomAttributes = "";

			// dead_id
			$view2->dead_id->ViewValue = $view2->dead_id->CurrentValue;
			$view2->dead_id->ViewCustomAttributes = "";

			// member_status
			if (strval($view2->member_status->CurrentValue) <> "") {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($view2->member_status->CurrentValue) . "'";
			$sSqlWrk = "SELECT `s_title` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view2->member_status->ViewValue = $rswrk->fields('s_title');
					$rswrk->Close();
				} else {
					$view2->member_status->ViewValue = $view2->member_status->CurrentValue;
				}
			} else {
				$view2->member_status->ViewValue = NULL;
			}
			$view2->member_status->ViewCustomAttributes = "";

			// regis_date
			$view2->regis_date->ViewValue = $view2->regis_date->CurrentValue;
			$view2->regis_date->ViewValue = ew_FormatDateTime($view2->regis_date->ViewValue, 7);
			$view2->regis_date->ViewCustomAttributes = "";

			// member_code
			$view2->member_code->LinkCustomAttributes = "";
			$view2->member_code->HrefValue = "";
			$view2->member_code->TooltipValue = "";

			// id_code
			$view2->id_code->LinkCustomAttributes = "";
			$view2->id_code->HrefValue = "";
			$view2->id_code->TooltipValue = "";

			// prefix
			$view2->prefix->LinkCustomAttributes = "";
			$view2->prefix->HrefValue = "";
			$view2->prefix->TooltipValue = "";

			// gender
			$view2->gender->LinkCustomAttributes = "";
			$view2->gender->HrefValue = "";
			$view2->gender->TooltipValue = "";

			// fname
			$view2->fname->LinkCustomAttributes = "";
			$view2->fname->HrefValue = "";
			$view2->fname->TooltipValue = "";

			// lname
			$view2->lname->LinkCustomAttributes = "";
			$view2->lname->HrefValue = "";
			$view2->lname->TooltipValue = "";

			// age
			$view2->age->LinkCustomAttributes = "";
			$view2->age->HrefValue = "";
			$view2->age->TooltipValue = "";

			// t_code
			$view2->t_code->LinkCustomAttributes = "";
			$view2->t_code->HrefValue = "";
			$view2->t_code->TooltipValue = "";

			// village_id
			$view2->village_id->LinkCustomAttributes = "";
			$view2->village_id->HrefValue = "";
			$view2->village_id->TooltipValue = "";

			// dead_date
			$view2->dead_date->LinkCustomAttributes = "";
			$view2->dead_date->HrefValue = "";
			$view2->dead_date->TooltipValue = "";

			// note
			$view2->note->LinkCustomAttributes = "";
			$view2->note->HrefValue = "";
			$view2->note->TooltipValue = "";

			// dead_id
			$view2->dead_id->LinkCustomAttributes = "";
			$view2->dead_id->HrefValue = "";
			$view2->dead_id->TooltipValue = "";

			// member_status
			$view2->member_status->LinkCustomAttributes = "";
			$view2->member_status->HrefValue = "";
			$view2->member_status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($view2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$view2->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $view2;

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
		$item->Body = "<a name=\"emf_view2\" id=\"emf_view2\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_view2',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fview2list,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($view2->Export <> "" ||
			$view2->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $view2;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $view2->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($view2->ExportAll) {
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
		if ($view2->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($view2, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($view2->Export == "xml") {
			$view2->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$view2->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($view2->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($view2->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($view2->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($view2->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($view2->ExportReturnUrl());
		} elseif ($view2->Export == "pdf") {
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
