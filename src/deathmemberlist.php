<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "deathmemberinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$deathmember_list = new cdeathmember_list();
$Page =& $deathmember_list;

// Page init
$deathmember_list->Page_Init();

// Page main
$deathmember_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($deathmember->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var deathmember_list = new ew_Page("deathmember_list");

// page properties
deathmember_list.PageID = "list"; // page ID
deathmember_list.FormID = "fdeathmemberlist"; // form ID
var EW_PAGE_ID = deathmember_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
deathmember_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
deathmember_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
deathmember_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
deathmember_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($deathmember->Export == "") || (EW_EXPORT_MASTER_RECORD && $deathmember->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$deathmember_list->TotalRecs = $deathmember->SelectRecordCount();
	} else {
		if ($deathmember_list->Recordset = $deathmember_list->LoadRecordset())
			$deathmember_list->TotalRecs = $deathmember_list->Recordset->RecordCount();
	}
	$deathmember_list->StartRec = 1;
	if ($deathmember_list->DisplayRecs <= 0 || ($deathmember->Export <> "" && $deathmember->ExportAll)) // Display all records
		$deathmember_list->DisplayRecs = $deathmember_list->TotalRecs;
	if (!($deathmember->Export <> "" && $deathmember->ExportAll))
		$deathmember_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$deathmember_list->Recordset = $deathmember_list->LoadRecordset($deathmember_list->StartRec-1, $deathmember_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $deathmember->TableCaption() ?>
&nbsp;&nbsp;<?php $deathmember_list->ExportOptions->Render("body"); ?>
</p>
<?php $deathmember_list->ShowPageHeader(); ?>
<?php
$deathmember_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($deathmember->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($deathmember->CurrentAction <> "gridadd" && $deathmember->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($deathmember_list->Pager)) $deathmember_list->Pager = new cPrevNextPager($deathmember_list->StartRec, $deathmember_list->DisplayRecs, $deathmember_list->TotalRecs) ?>
<?php if ($deathmember_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($deathmember_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $deathmember_list->PageUrl() ?>start=<?php echo $deathmember_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($deathmember_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $deathmember_list->PageUrl() ?>start=<?php echo $deathmember_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $deathmember_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($deathmember_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $deathmember_list->PageUrl() ?>start=<?php echo $deathmember_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($deathmember_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $deathmember_list->PageUrl() ?>start=<?php echo $deathmember_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $deathmember_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $deathmember_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $deathmember_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $deathmember_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($deathmember_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($deathmember_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="deathmember">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($deathmember_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($deathmember_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($deathmember_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($deathmember_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($deathmember_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($deathmember_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($deathmember_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($deathmember_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($deathmember_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $deathmember_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($deathmember_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fdeathmemberlist, '<?php echo $deathmember_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fdeathmemberlist" id="fdeathmemberlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="deathmember">
<div id="gmp_deathmember" class="ewGridMiddlePanel">
<?php if ($deathmember_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $deathmember->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$deathmember_list->RenderListOptions();

// Render list options (header, left)
$deathmember_list->ListOptions->Render("header", "left");
?>
<?php if ($deathmember->death_id->Visible) { // death_id ?>
	<?php if ($deathmember->SortUrl($deathmember->death_id) == "") { ?>
		<td><?php echo $deathmember->death_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $deathmember->SortUrl($deathmember->death_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $deathmember->death_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($deathmember->death_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($deathmember->death_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($deathmember->member_id->Visible) { // member_id ?>
	<?php if ($deathmember->SortUrl($deathmember->member_id) == "") { ?>
		<td><?php echo $deathmember->member_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $deathmember->SortUrl($deathmember->member_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $deathmember->member_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($deathmember->member_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($deathmember->member_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($deathmember->dead_date->Visible) { // dead_date ?>
	<?php if ($deathmember->SortUrl($deathmember->dead_date) == "") { ?>
		<td><?php echo $deathmember->dead_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $deathmember->SortUrl($deathmember->dead_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $deathmember->dead_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($deathmember->dead_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($deathmember->dead_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($deathmember->dead_detail->Visible) { // dead_detail ?>
	<?php if ($deathmember->SortUrl($deathmember->dead_detail) == "") { ?>
		<td><?php echo $deathmember->dead_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $deathmember->SortUrl($deathmember->dead_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $deathmember->dead_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($deathmember->dead_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($deathmember->dead_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$deathmember_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($deathmember->ExportAll && $deathmember->Export <> "") {
	$deathmember_list->StopRec = $deathmember_list->TotalRecs;
} else {

	// Set the last record to display
	if ($deathmember_list->TotalRecs > $deathmember_list->StartRec + $deathmember_list->DisplayRecs - 1)
		$deathmember_list->StopRec = $deathmember_list->StartRec + $deathmember_list->DisplayRecs - 1;
	else
		$deathmember_list->StopRec = $deathmember_list->TotalRecs;
}
$deathmember_list->RecCnt = $deathmember_list->StartRec - 1;
if ($deathmember_list->Recordset && !$deathmember_list->Recordset->EOF) {
	$deathmember_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $deathmember_list->StartRec > 1)
		$deathmember_list->Recordset->Move($deathmember_list->StartRec - 1);
} elseif (!$deathmember->AllowAddDeleteRow && $deathmember_list->StopRec == 0) {
	$deathmember_list->StopRec = $deathmember->GridAddRowCount;
}

// Initialize aggregate
$deathmember->RowType = EW_ROWTYPE_AGGREGATEINIT;
$deathmember->ResetAttrs();
$deathmember_list->RenderRow();
$deathmember_list->RowCnt = 0;
while ($deathmember_list->RecCnt < $deathmember_list->StopRec) {
	$deathmember_list->RecCnt++;
	if (intval($deathmember_list->RecCnt) >= intval($deathmember_list->StartRec)) {
		$deathmember_list->RowCnt++;

		// Set up key count
		$deathmember_list->KeyCount = $deathmember_list->RowIndex;

		// Init row class and style
		$deathmember->ResetAttrs();
		$deathmember->CssClass = "";
		if ($deathmember->CurrentAction == "gridadd") {
		} else {
			$deathmember_list->LoadRowValues($deathmember_list->Recordset); // Load row values
		}
		$deathmember->RowType = EW_ROWTYPE_VIEW; // Render view
		$deathmember->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$deathmember_list->RenderRow();

		// Render list options
		$deathmember_list->RenderListOptions();
?>
	<tr<?php echo $deathmember->RowAttributes() ?>>
<?php

// Render list options (body, left)
$deathmember_list->ListOptions->Render("body", "left");
?>
	<?php if ($deathmember->death_id->Visible) { // death_id ?>
		<td<?php echo $deathmember->death_id->CellAttributes() ?>>
<div<?php echo $deathmember->death_id->ViewAttributes() ?>><?php echo $deathmember->death_id->ListViewValue() ?></div>
<a name="<?php echo $deathmember_list->PageObjName . "_row_" . $deathmember_list->RowCnt ?>" id="<?php echo $deathmember_list->PageObjName . "_row_" . $deathmember_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($deathmember->member_id->Visible) { // member_id ?>
		<td<?php echo $deathmember->member_id->CellAttributes() ?>>
<div<?php echo $deathmember->member_id->ViewAttributes() ?>><?php echo $deathmember->member_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($deathmember->dead_date->Visible) { // dead_date ?>
		<td<?php echo $deathmember->dead_date->CellAttributes() ?>>
<div<?php echo $deathmember->dead_date->ViewAttributes() ?>><?php echo $deathmember->dead_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($deathmember->dead_detail->Visible) { // dead_detail ?>
		<td<?php echo $deathmember->dead_detail->CellAttributes() ?>>
<div<?php echo $deathmember->dead_detail->ViewAttributes() ?>><?php echo $deathmember->dead_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$deathmember_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($deathmember->CurrentAction <> "gridadd")
		$deathmember_list->Recordset->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$deathmember->RowType = EW_ROWTYPE_AGGREGATE;
$deathmember->ResetAttrs();
$deathmember_list->RenderRow();
?>
<?php if ($deathmember_list->TotalRecs > 0 && ($deathmember->CurrentAction <> "gridadd" && $deathmember->CurrentAction <> "gridedit")) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$deathmember_list->RenderListOptions();

// Render list options (footer, left)
$deathmember_list->ListOptions->Render("footer", "left");
?>
	<?php if ($deathmember->death_id->Visible) { // death_id ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $deathmember->death_id->ViewAttributes() ?>><?php echo $deathmember->death_id->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($deathmember->member_id->Visible) { // member_id ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($deathmember->dead_date->Visible) { // dead_date ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($deathmember->dead_detail->Visible) { // dead_detail ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$deathmember_list->ListOptions->Render("footer", "right");
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
if ($deathmember_list->Recordset)
	$deathmember_list->Recordset->Close();
?>
<?php if ($deathmember_list->TotalRecs > 0) { ?>
<?php if ($deathmember->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($deathmember->CurrentAction <> "gridadd" && $deathmember->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($deathmember_list->Pager)) $deathmember_list->Pager = new cPrevNextPager($deathmember_list->StartRec, $deathmember_list->DisplayRecs, $deathmember_list->TotalRecs) ?>
<?php if ($deathmember_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($deathmember_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $deathmember_list->PageUrl() ?>start=<?php echo $deathmember_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($deathmember_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $deathmember_list->PageUrl() ?>start=<?php echo $deathmember_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $deathmember_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($deathmember_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $deathmember_list->PageUrl() ?>start=<?php echo $deathmember_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($deathmember_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $deathmember_list->PageUrl() ?>start=<?php echo $deathmember_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $deathmember_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $deathmember_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $deathmember_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $deathmember_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($deathmember_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($deathmember_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="deathmember">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($deathmember_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($deathmember_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($deathmember_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($deathmember_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($deathmember_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($deathmember_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($deathmember_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($deathmember_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($deathmember_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $deathmember_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($deathmember_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fdeathmemberlist, '<?php echo $deathmember_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($deathmember->Export == "" && $deathmember->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(deathmember_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$deathmember_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($deathmember->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$deathmember_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cdeathmember_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'deathmember';

	// Page object name
	var $PageObjName = 'deathmember_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $deathmember;
		if ($deathmember->UseTokenInUrl) $PageUrl .= "t=" . $deathmember->TableVar . "&"; // Add page token
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
		global $objForm, $deathmember;
		if ($deathmember->UseTokenInUrl) {
			if ($objForm)
				return ($deathmember->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($deathmember->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdeathmember_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (deathmember)
		if (!isset($GLOBALS["deathmember"])) {
			$GLOBALS["deathmember"] = new cdeathmember();
			$GLOBALS["Table"] =& $GLOBALS["deathmember"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "deathmemberadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "deathmemberdelete.php";
		$this->MultiUpdateUrl = "deathmemberupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'deathmember', TRUE);

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
		global $deathmember;

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
			$deathmember->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$deathmember->Export = $_POST["exporttype"];
		} else {
			$deathmember->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $deathmember->Export; // Get export parameter, used in header
		$gsExportFile = $deathmember->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($deathmember->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($deathmember->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$deathmember->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $deathmember;

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
			if ($deathmember->Export <> "" ||
				$deathmember->CurrentAction == "gridadd" ||
				$deathmember->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($deathmember->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $deathmember->getRecordsPerPage(); // Restore from Session
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
		$deathmember->setSessionWhere($sFilter);
		$deathmember->CurrentFilter = "";

		// Export data only
		if (in_array($deathmember->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($deathmember->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $deathmember;
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
			$deathmember->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$deathmember->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $deathmember;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$deathmember->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$deathmember->CurrentOrderType = @$_GET["ordertype"];
			$deathmember->UpdateSort($deathmember->death_id); // death_id
			$deathmember->UpdateSort($deathmember->member_id); // member_id
			$deathmember->UpdateSort($deathmember->dead_date); // dead_date
			$deathmember->UpdateSort($deathmember->dead_detail); // dead_detail
			$deathmember->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $deathmember;
		$sOrderBy = $deathmember->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($deathmember->SqlOrderBy() <> "") {
				$sOrderBy = $deathmember->SqlOrderBy();
				$deathmember->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $deathmember;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$deathmember->setSessionOrderBy($sOrderBy);
				$deathmember->death_id->setSort("");
				$deathmember->member_id->setSort("");
				$deathmember->dead_date->setSort("");
				$deathmember->dead_detail->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$deathmember->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $deathmember;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"deathmember_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $deathmember, $objForm;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($deathmember->death_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $deathmember;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $deathmember;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$deathmember->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$deathmember->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $deathmember->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$deathmember->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$deathmember->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$deathmember->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $deathmember;

		// Call Recordset Selecting event
		$deathmember->Recordset_Selecting($deathmember->CurrentFilter);

		// Load List page SQL
		$sSql = $deathmember->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$deathmember->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $deathmember;
		$sFilter = $deathmember->KeyFilter();

		// Call Row Selecting event
		$deathmember->Row_Selecting($sFilter);

		// Load SQL based on filter
		$deathmember->CurrentFilter = $sFilter;
		$sSql = $deathmember->SQL();
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
		global $conn, $deathmember;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$deathmember->Row_Selected($row);
		$deathmember->death_id->setDbValue($rs->fields('death_id'));
		$deathmember->member_id->setDbValue($rs->fields('member_id'));
		$deathmember->dead_date->setDbValue($rs->fields('dead_date'));
		$deathmember->dead_detail->setDbValue($rs->fields('dead_detail'));
	}

	// Load old record
	function LoadOldRecord() {
		global $deathmember;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($deathmember->getKey("death_id")) <> "")
			$deathmember->death_id->CurrentValue = $deathmember->getKey("death_id"); // death_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$deathmember->CurrentFilter = $deathmember->KeyFilter();
			$sSql = $deathmember->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $deathmember;

		// Initialize URLs
		$this->ViewUrl = $deathmember->ViewUrl();
		$this->EditUrl = $deathmember->EditUrl();
		$this->InlineEditUrl = $deathmember->InlineEditUrl();
		$this->CopyUrl = $deathmember->CopyUrl();
		$this->InlineCopyUrl = $deathmember->InlineCopyUrl();
		$this->DeleteUrl = $deathmember->DeleteUrl();

		// Call Row_Rendering event
		$deathmember->Row_Rendering();

		// Common render codes for all row types
		// death_id
		// member_id
		// dead_date
		// dead_detail
		// Accumulate aggregate value

		if ($deathmember->RowType <> EW_ROWTYPE_AGGREGATEINIT && $deathmember->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($deathmember->death_id->CurrentValue))
				$deathmember->death_id->Total += $deathmember->death_id->CurrentValue; // Accumulate total
		}
		if ($deathmember->RowType == EW_ROWTYPE_VIEW) { // View row

			// death_id
			$deathmember->death_id->ViewValue = $deathmember->death_id->CurrentValue;
			$deathmember->death_id->ViewCustomAttributes = "";

			// member_id
			$deathmember->member_id->ViewValue = $deathmember->member_id->CurrentValue;
			$deathmember->member_id->ViewCustomAttributes = "";

			// dead_date
			$deathmember->dead_date->ViewValue = $deathmember->dead_date->CurrentValue;
			$deathmember->dead_date->ViewValue = ew_FormatDateTime($deathmember->dead_date->ViewValue, 7);
			$deathmember->dead_date->ViewCustomAttributes = "";

			// dead_detail
			$deathmember->dead_detail->ViewValue = $deathmember->dead_detail->CurrentValue;
			$deathmember->dead_detail->ViewCustomAttributes = "";

			// death_id
			$deathmember->death_id->LinkCustomAttributes = "";
			$deathmember->death_id->HrefValue = "";
			$deathmember->death_id->TooltipValue = "";

			// member_id
			$deathmember->member_id->LinkCustomAttributes = "";
			$deathmember->member_id->HrefValue = "";
			$deathmember->member_id->TooltipValue = "";

			// dead_date
			$deathmember->dead_date->LinkCustomAttributes = "";
			$deathmember->dead_date->HrefValue = "";
			$deathmember->dead_date->TooltipValue = "";

			// dead_detail
			$deathmember->dead_detail->LinkCustomAttributes = "";
			$deathmember->dead_detail->HrefValue = "";
			$deathmember->dead_detail->TooltipValue = "";
		} elseif ($deathmember->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$deathmember->death_id->Total = 0; // Initialize total
		} elseif ($deathmember->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$deathmember->death_id->CurrentValue = $deathmember->death_id->Total;
			$deathmember->death_id->ViewValue = $deathmember->death_id->CurrentValue;
			$deathmember->death_id->ViewCustomAttributes = "";
			$deathmember->death_id->HrefValue = ""; // Clear href value
		}

		// Call Row Rendered event
		if ($deathmember->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$deathmember->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $deathmember;

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
		$item->Body = "<a name=\"emf_deathmember\" id=\"emf_deathmember\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_deathmember',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fdeathmemberlist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($deathmember->Export <> "" ||
			$deathmember->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $deathmember;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $deathmember->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($deathmember->ExportAll) {
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
		if ($deathmember->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($deathmember, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($deathmember->Export == "xml") {
			$deathmember->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$deathmember->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($deathmember->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($deathmember->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($deathmember->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($deathmember->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($deathmember->ExportReturnUrl());
		} elseif ($deathmember->Export == "pdf") {
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
