<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memberstatuslistinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memberstatuslist_list = new cmemberstatuslist_list();
$Page =& $memberstatuslist_list;

// Page init
$memberstatuslist_list->Page_Init();

// Page main
$memberstatuslist_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($memberstatuslist->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var memberstatuslist_list = new ew_Page("memberstatuslist_list");

// page properties
memberstatuslist_list.PageID = "list"; // page ID
memberstatuslist_list.FormID = "fmemberstatuslistlist"; // form ID
var EW_PAGE_ID = memberstatuslist_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
memberstatuslist_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
memberstatuslist_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
memberstatuslist_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memberstatuslist_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($memberstatuslist->Export == "") || (EW_EXPORT_MASTER_RECORD && $memberstatuslist->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$memberstatuslist_list->TotalRecs = $memberstatuslist->SelectRecordCount();
	} else {
		if ($memberstatuslist_list->Recordset = $memberstatuslist_list->LoadRecordset())
			$memberstatuslist_list->TotalRecs = $memberstatuslist_list->Recordset->RecordCount();
	}
	$memberstatuslist_list->StartRec = 1;
	if ($memberstatuslist_list->DisplayRecs <= 0 || ($memberstatuslist->Export <> "" && $memberstatuslist->ExportAll)) // Display all records
		$memberstatuslist_list->DisplayRecs = $memberstatuslist_list->TotalRecs;
	if (!($memberstatuslist->Export <> "" && $memberstatuslist->ExportAll))
		$memberstatuslist_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$memberstatuslist_list->Recordset = $memberstatuslist_list->LoadRecordset($memberstatuslist_list->StartRec-1, $memberstatuslist_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memberstatuslist->TableCaption() ?>
&nbsp;&nbsp;<?php $memberstatuslist_list->ExportOptions->Render("body"); ?>
</p>
<?php $memberstatuslist_list->ShowPageHeader(); ?>
<?php
$memberstatuslist_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($memberstatuslist->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($memberstatuslist->CurrentAction <> "gridadd" && $memberstatuslist->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($memberstatuslist_list->Pager)) $memberstatuslist_list->Pager = new cPrevNextPager($memberstatuslist_list->StartRec, $memberstatuslist_list->DisplayRecs, $memberstatuslist_list->TotalRecs) ?>
<?php if ($memberstatuslist_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($memberstatuslist_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_list->PageUrl() ?>start=<?php echo $memberstatuslist_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($memberstatuslist_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_list->PageUrl() ?>start=<?php echo $memberstatuslist_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $memberstatuslist_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($memberstatuslist_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_list->PageUrl() ?>start=<?php echo $memberstatuslist_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($memberstatuslist_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_list->PageUrl() ?>start=<?php echo $memberstatuslist_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $memberstatuslist_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $memberstatuslist_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $memberstatuslist_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $memberstatuslist_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($memberstatuslist_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($memberstatuslist_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="memberstatuslist">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($memberstatuslist_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($memberstatuslist_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($memberstatuslist_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($memberstatuslist_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($memberstatuslist_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($memberstatuslist_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($memberstatuslist_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($memberstatuslist_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($memberstatuslist_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $memberstatuslist_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($memberstatuslist_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fmemberstatuslistlist, '<?php echo $memberstatuslist_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fmemberstatuslistlist" id="fmemberstatuslistlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="memberstatuslist">
<div id="gmp_memberstatuslist" class="ewGridMiddlePanel">
<?php if ($memberstatuslist_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $memberstatuslist->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$memberstatuslist_list->RenderListOptions();

// Render list options (header, left)
$memberstatuslist_list->ListOptions->Render("header", "left");
?>
<?php if ($memberstatuslist->member_id->Visible) { // member_id ?>
	<?php if ($memberstatuslist->SortUrl($memberstatuslist->member_id) == "") { ?>
		<td><?php echo $memberstatuslist->member_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memberstatuslist->SortUrl($memberstatuslist->member_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $memberstatuslist->member_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($memberstatuslist->member_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberstatuslist->member_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($memberstatuslist->status->Visible) { // status ?>
	<?php if ($memberstatuslist->SortUrl($memberstatuslist->status) == "") { ?>
		<td><?php echo $memberstatuslist->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memberstatuslist->SortUrl($memberstatuslist->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $memberstatuslist->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($memberstatuslist->status->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberstatuslist->status->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($memberstatuslist->mbs_date->Visible) { // mbs_date ?>
	<?php if ($memberstatuslist->SortUrl($memberstatuslist->mbs_date) == "") { ?>
		<td><?php echo $memberstatuslist->mbs_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memberstatuslist->SortUrl($memberstatuslist->mbs_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $memberstatuslist->mbs_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($memberstatuslist->mbs_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberstatuslist->mbs_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($memberstatuslist->mbs_detail->Visible) { // mbs_detail ?>
	<?php if ($memberstatuslist->SortUrl($memberstatuslist->mbs_detail) == "") { ?>
		<td><?php echo $memberstatuslist->mbs_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memberstatuslist->SortUrl($memberstatuslist->mbs_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $memberstatuslist->mbs_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($memberstatuslist->mbs_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberstatuslist->mbs_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$memberstatuslist_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($memberstatuslist->ExportAll && $memberstatuslist->Export <> "") {
	$memberstatuslist_list->StopRec = $memberstatuslist_list->TotalRecs;
} else {

	// Set the last record to display
	if ($memberstatuslist_list->TotalRecs > $memberstatuslist_list->StartRec + $memberstatuslist_list->DisplayRecs - 1)
		$memberstatuslist_list->StopRec = $memberstatuslist_list->StartRec + $memberstatuslist_list->DisplayRecs - 1;
	else
		$memberstatuslist_list->StopRec = $memberstatuslist_list->TotalRecs;
}
$memberstatuslist_list->RecCnt = $memberstatuslist_list->StartRec - 1;
if ($memberstatuslist_list->Recordset && !$memberstatuslist_list->Recordset->EOF) {
	$memberstatuslist_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $memberstatuslist_list->StartRec > 1)
		$memberstatuslist_list->Recordset->Move($memberstatuslist_list->StartRec - 1);
} elseif (!$memberstatuslist->AllowAddDeleteRow && $memberstatuslist_list->StopRec == 0) {
	$memberstatuslist_list->StopRec = $memberstatuslist->GridAddRowCount;
}

// Initialize aggregate
$memberstatuslist->RowType = EW_ROWTYPE_AGGREGATEINIT;
$memberstatuslist->ResetAttrs();
$memberstatuslist_list->RenderRow();
$memberstatuslist_list->RowCnt = 0;
while ($memberstatuslist_list->RecCnt < $memberstatuslist_list->StopRec) {
	$memberstatuslist_list->RecCnt++;
	if (intval($memberstatuslist_list->RecCnt) >= intval($memberstatuslist_list->StartRec)) {
		$memberstatuslist_list->RowCnt++;

		// Set up key count
		$memberstatuslist_list->KeyCount = $memberstatuslist_list->RowIndex;

		// Init row class and style
		$memberstatuslist->ResetAttrs();
		$memberstatuslist->CssClass = "";
		if ($memberstatuslist->CurrentAction == "gridadd") {
		} else {
			$memberstatuslist_list->LoadRowValues($memberstatuslist_list->Recordset); // Load row values
		}
		$memberstatuslist->RowType = EW_ROWTYPE_VIEW; // Render view
		$memberstatuslist->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$memberstatuslist_list->RenderRow();

		// Render list options
		$memberstatuslist_list->RenderListOptions();
?>
	<tr<?php echo $memberstatuslist->RowAttributes() ?>>
<?php

// Render list options (body, left)
$memberstatuslist_list->ListOptions->Render("body", "left");
?>
	<?php if ($memberstatuslist->member_id->Visible) { // member_id ?>
		<td<?php echo $memberstatuslist->member_id->CellAttributes() ?>>
<div<?php echo $memberstatuslist->member_id->ViewAttributes() ?>><?php echo $memberstatuslist->member_id->ListViewValue() ?></div>
<a name="<?php echo $memberstatuslist_list->PageObjName . "_row_" . $memberstatuslist_list->RowCnt ?>" id="<?php echo $memberstatuslist_list->PageObjName . "_row_" . $memberstatuslist_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($memberstatuslist->status->Visible) { // status ?>
		<td<?php echo $memberstatuslist->status->CellAttributes() ?>>
<div<?php echo $memberstatuslist->status->ViewAttributes() ?>><?php echo $memberstatuslist->status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($memberstatuslist->mbs_date->Visible) { // mbs_date ?>
		<td<?php echo $memberstatuslist->mbs_date->CellAttributes() ?>>
<div<?php echo $memberstatuslist->mbs_date->ViewAttributes() ?>><?php echo $memberstatuslist->mbs_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($memberstatuslist->mbs_detail->Visible) { // mbs_detail ?>
		<td<?php echo $memberstatuslist->mbs_detail->CellAttributes() ?>>
<div<?php echo $memberstatuslist->mbs_detail->ViewAttributes() ?>><?php echo $memberstatuslist->mbs_detail->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$memberstatuslist_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($memberstatuslist->CurrentAction <> "gridadd")
		$memberstatuslist_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($memberstatuslist_list->Recordset)
	$memberstatuslist_list->Recordset->Close();
?>
<?php if ($memberstatuslist_list->TotalRecs > 0) { ?>
<?php if ($memberstatuslist->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($memberstatuslist->CurrentAction <> "gridadd" && $memberstatuslist->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($memberstatuslist_list->Pager)) $memberstatuslist_list->Pager = new cPrevNextPager($memberstatuslist_list->StartRec, $memberstatuslist_list->DisplayRecs, $memberstatuslist_list->TotalRecs) ?>
<?php if ($memberstatuslist_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($memberstatuslist_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_list->PageUrl() ?>start=<?php echo $memberstatuslist_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($memberstatuslist_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_list->PageUrl() ?>start=<?php echo $memberstatuslist_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $memberstatuslist_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($memberstatuslist_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_list->PageUrl() ?>start=<?php echo $memberstatuslist_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($memberstatuslist_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_list->PageUrl() ?>start=<?php echo $memberstatuslist_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $memberstatuslist_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $memberstatuslist_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $memberstatuslist_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $memberstatuslist_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($memberstatuslist_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($memberstatuslist_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="memberstatuslist">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($memberstatuslist_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($memberstatuslist_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($memberstatuslist_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($memberstatuslist_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($memberstatuslist_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($memberstatuslist_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($memberstatuslist_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($memberstatuslist_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($memberstatuslist_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $memberstatuslist_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($memberstatuslist_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fmemberstatuslistlist, '<?php echo $memberstatuslist_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($memberstatuslist->Export == "" && $memberstatuslist->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(memberstatuslist_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$memberstatuslist_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($memberstatuslist->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$memberstatuslist_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemberstatuslist_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'memberstatuslist';

	// Page object name
	var $PageObjName = 'memberstatuslist_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memberstatuslist;
		if ($memberstatuslist->UseTokenInUrl) $PageUrl .= "t=" . $memberstatuslist->TableVar . "&"; // Add page token
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
		global $objForm, $memberstatuslist;
		if ($memberstatuslist->UseTokenInUrl) {
			if ($objForm)
				return ($memberstatuslist->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memberstatuslist->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemberstatuslist_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memberstatuslist)
		if (!isset($GLOBALS["memberstatuslist"])) {
			$GLOBALS["memberstatuslist"] = new cmemberstatuslist();
			$GLOBALS["Table"] =& $GLOBALS["memberstatuslist"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "memberstatuslistadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "memberstatuslistdelete.php";
		$this->MultiUpdateUrl = "memberstatuslistupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'memberstatuslist', TRUE);

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
		global $memberstatuslist;

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
			$memberstatuslist->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$memberstatuslist->Export = $_POST["exporttype"];
		} else {
			$memberstatuslist->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $memberstatuslist->Export; // Get export parameter, used in header
		$gsExportFile = $memberstatuslist->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($memberstatuslist->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($memberstatuslist->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$memberstatuslist->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $memberstatuslist;

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
			if ($memberstatuslist->Export <> "" ||
				$memberstatuslist->CurrentAction == "gridadd" ||
				$memberstatuslist->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($memberstatuslist->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $memberstatuslist->getRecordsPerPage(); // Restore from Session
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
		$memberstatuslist->setSessionWhere($sFilter);
		$memberstatuslist->CurrentFilter = "";

		// Export data only
		if (in_array($memberstatuslist->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($memberstatuslist->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $memberstatuslist;
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
			$memberstatuslist->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$memberstatuslist->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $memberstatuslist;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$memberstatuslist->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$memberstatuslist->CurrentOrderType = @$_GET["ordertype"];
			$memberstatuslist->UpdateSort($memberstatuslist->member_id); // member_id
			$memberstatuslist->UpdateSort($memberstatuslist->status); // status
			$memberstatuslist->UpdateSort($memberstatuslist->mbs_date); // mbs_date
			$memberstatuslist->UpdateSort($memberstatuslist->mbs_detail); // mbs_detail
			$memberstatuslist->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $memberstatuslist;
		$sOrderBy = $memberstatuslist->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($memberstatuslist->SqlOrderBy() <> "") {
				$sOrderBy = $memberstatuslist->SqlOrderBy();
				$memberstatuslist->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $memberstatuslist;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$memberstatuslist->setSessionOrderBy($sOrderBy);
				$memberstatuslist->member_id->setSort("");
				$memberstatuslist->status->setSort("");
				$memberstatuslist->mbs_date->setSort("");
				$memberstatuslist->mbs_detail->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$memberstatuslist->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $memberstatuslist;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"memberstatuslist_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $memberstatuslist, $objForm;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($memberstatuslist->mbs_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $memberstatuslist;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $memberstatuslist;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$memberstatuslist->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$memberstatuslist->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $memberstatuslist->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$memberstatuslist->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$memberstatuslist->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$memberstatuslist->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $memberstatuslist;

		// Call Recordset Selecting event
		$memberstatuslist->Recordset_Selecting($memberstatuslist->CurrentFilter);

		// Load List page SQL
		$sSql = $memberstatuslist->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$memberstatuslist->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memberstatuslist;
		$sFilter = $memberstatuslist->KeyFilter();

		// Call Row Selecting event
		$memberstatuslist->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memberstatuslist->CurrentFilter = $sFilter;
		$sSql = $memberstatuslist->SQL();
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
		global $conn, $memberstatuslist;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memberstatuslist->Row_Selected($row);
		$memberstatuslist->mbs_id->setDbValue($rs->fields('mbs_id'));
		$memberstatuslist->member_id->setDbValue($rs->fields('member_id'));
		$memberstatuslist->status->setDbValue($rs->fields('status'));
		$memberstatuslist->mbs_date->setDbValue($rs->fields('mbs_date'));
		$memberstatuslist->mbs_detail->setDbValue($rs->fields('mbs_detail'));
	}

	// Load old record
	function LoadOldRecord() {
		global $memberstatuslist;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($memberstatuslist->getKey("mbs_id")) <> "")
			$memberstatuslist->mbs_id->CurrentValue = $memberstatuslist->getKey("mbs_id"); // mbs_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$memberstatuslist->CurrentFilter = $memberstatuslist->KeyFilter();
			$sSql = $memberstatuslist->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memberstatuslist;

		// Initialize URLs
		$this->ViewUrl = $memberstatuslist->ViewUrl();
		$this->EditUrl = $memberstatuslist->EditUrl();
		$this->InlineEditUrl = $memberstatuslist->InlineEditUrl();
		$this->CopyUrl = $memberstatuslist->CopyUrl();
		$this->InlineCopyUrl = $memberstatuslist->InlineCopyUrl();
		$this->DeleteUrl = $memberstatuslist->DeleteUrl();

		// Call Row_Rendering event
		$memberstatuslist->Row_Rendering();

		// Common render codes for all row types
		// mbs_id
		// member_id
		// status
		// mbs_date
		// mbs_detail

		if ($memberstatuslist->RowType == EW_ROWTYPE_VIEW) { // View row

			// mbs_id
			$memberstatuslist->mbs_id->ViewValue = $memberstatuslist->mbs_id->CurrentValue;
			$memberstatuslist->mbs_id->ViewCustomAttributes = "";

			// member_id
			$memberstatuslist->member_id->ViewValue = $memberstatuslist->member_id->CurrentValue;
			$memberstatuslist->member_id->ViewCustomAttributes = "";

			// status
			if (strval($memberstatuslist->status->CurrentValue) <> "") {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($memberstatuslist->status->CurrentValue) . "'";
			$sSqlWrk = "SELECT `s_title` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$memberstatuslist->status->ViewValue = $rswrk->fields('s_title');
					$rswrk->Close();
				} else {
					$memberstatuslist->status->ViewValue = $memberstatuslist->status->CurrentValue;
				}
			} else {
				$memberstatuslist->status->ViewValue = NULL;
			}
			$memberstatuslist->status->ViewCustomAttributes = "";

			// mbs_date
			$memberstatuslist->mbs_date->ViewValue = $memberstatuslist->mbs_date->CurrentValue;
			$memberstatuslist->mbs_date->ViewValue = ew_FormatDateTime($memberstatuslist->mbs_date->ViewValue, 7);
			$memberstatuslist->mbs_date->ViewCustomAttributes = "";

			// mbs_detail
			$memberstatuslist->mbs_detail->ViewValue = $memberstatuslist->mbs_detail->CurrentValue;
			$memberstatuslist->mbs_detail->ViewCustomAttributes = "";

			// member_id
			$memberstatuslist->member_id->LinkCustomAttributes = "";
			$memberstatuslist->member_id->HrefValue = "";
			$memberstatuslist->member_id->TooltipValue = "";

			// status
			$memberstatuslist->status->LinkCustomAttributes = "";
			$memberstatuslist->status->HrefValue = "";
			$memberstatuslist->status->TooltipValue = "";

			// mbs_date
			$memberstatuslist->mbs_date->LinkCustomAttributes = "";
			$memberstatuslist->mbs_date->HrefValue = "";
			$memberstatuslist->mbs_date->TooltipValue = "";

			// mbs_detail
			$memberstatuslist->mbs_detail->LinkCustomAttributes = "";
			$memberstatuslist->mbs_detail->HrefValue = "";
			$memberstatuslist->mbs_detail->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($memberstatuslist->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memberstatuslist->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $memberstatuslist;

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
		$item->Body = "<a name=\"emf_memberstatuslist\" id=\"emf_memberstatuslist\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_memberstatuslist',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fmemberstatuslistlist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($memberstatuslist->Export <> "" ||
			$memberstatuslist->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $memberstatuslist;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $memberstatuslist->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($memberstatuslist->ExportAll) {
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
		if ($memberstatuslist->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($memberstatuslist, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($memberstatuslist->Export == "xml") {
			$memberstatuslist->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$memberstatuslist->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($memberstatuslist->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($memberstatuslist->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($memberstatuslist->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($memberstatuslist->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($memberstatuslist->ExportReturnUrl());
		} elseif ($memberstatuslist->Export == "pdf") {
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
   // $url = "http://www.google.com"; 
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
