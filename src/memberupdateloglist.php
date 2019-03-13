<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memberupdateloginfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "membersinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memberupdatelog_list = new cmemberupdatelog_list();
$Page =& $memberupdatelog_list;

// Page init
$memberupdatelog_list->Page_Init();

// Page main
$memberupdatelog_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($memberupdatelog->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var memberupdatelog_list = new ew_Page("memberupdatelog_list");

// page properties
memberupdatelog_list.PageID = "list"; // page ID
memberupdatelog_list.FormID = "fmemberupdateloglist"; // form ID
var EW_PAGE_ID = memberupdatelog_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
memberupdatelog_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
memberupdatelog_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
memberupdatelog_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memberupdatelog_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($memberupdatelog->Export == "") || (EW_EXPORT_MASTER_RECORD && $memberupdatelog->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "memberslist.php";
if ($memberupdatelog_list->DbMasterFilter <> "" && $memberupdatelog->getCurrentMasterTable() == "members") {
	if ($memberupdatelog_list->MasterRecordExists) {
		if ($memberupdatelog->getCurrentMasterTable() == $memberupdatelog->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<div class="phpmaker ewTitle"><img src="images/ico_edit_member.png" width="40" height="40" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("MasterRecord") ?><?php echo $members->TableCaption() ?>
&nbsp;&nbsp;<?php $memberupdatelog_list->ExportOptions->Render("body"); ?>
</div>
<div class="clear"></div>
<?php if ($memberupdatelog->Export == "") { ?>
<p><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>

<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$memberupdatelog_list->TotalRecs = $memberupdatelog->SelectRecordCount();
	} else {
		if ($memberupdatelog_list->Recordset = $memberupdatelog_list->LoadRecordset())
			$memberupdatelog_list->TotalRecs = $memberupdatelog_list->Recordset->RecordCount();
	}
	$memberupdatelog_list->StartRec = 1;
	if ($memberupdatelog_list->DisplayRecs <= 0 || ($memberupdatelog->Export <> "" && $memberupdatelog->ExportAll)) // Display all records
		$memberupdatelog_list->DisplayRecs = $memberupdatelog_list->TotalRecs;
	if (!($memberupdatelog->Export <> "" && $memberupdatelog->ExportAll))
		$memberupdatelog_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$memberupdatelog_list->Recordset = $memberupdatelog_list->LoadRecordset($memberupdatelog_list->StartRec-1, $memberupdatelog_list->DisplayRecs);
?>

<?php $memberupdatelog_list->ShowPageHeader(); ?>
<?php
$memberupdatelog_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($memberupdatelog->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($memberupdatelog->CurrentAction <> "gridadd" && $memberupdatelog->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($memberupdatelog_list->Pager)) $memberupdatelog_list->Pager = new cPrevNextPager($memberupdatelog_list->StartRec, $memberupdatelog_list->DisplayRecs, $memberupdatelog_list->TotalRecs) ?>
<?php if ($memberupdatelog_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($memberupdatelog_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_list->PageUrl() ?>start=<?php echo $memberupdatelog_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($memberupdatelog_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_list->PageUrl() ?>start=<?php echo $memberupdatelog_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $memberupdatelog_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($memberupdatelog_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_list->PageUrl() ?>start=<?php echo $memberupdatelog_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($memberupdatelog_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_list->PageUrl() ?>start=<?php echo $memberupdatelog_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $memberupdatelog_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $memberupdatelog_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $memberupdatelog_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $memberupdatelog_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($memberupdatelog_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($memberupdatelog_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="memberupdatelog">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($memberupdatelog_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($memberupdatelog_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($memberupdatelog_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($memberupdatelog_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($memberupdatelog_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($memberupdatelog_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($memberupdatelog_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($memberupdatelog_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($memberupdatelog_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($memberupdatelog->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
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
<form name="fmemberupdateloglist" id="fmemberupdateloglist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="memberupdatelog">
<div id="gmp_memberupdatelog" class="ewGridMiddlePanel">
<?php if ($memberupdatelog_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $memberupdatelog->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$memberupdatelog_list->RenderListOptions();

// Render list options (header, left)
$memberupdatelog_list->ListOptions->Render("header", "left");
?>
<?php if ($memberupdatelog->update_detail->Visible) { // update_detail ?>
	<?php if ($memberupdatelog->SortUrl($memberupdatelog->update_detail) == "") { ?>
		<td width="20" style="white-space: nowrap;"><?php echo $memberupdatelog->update_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memberupdatelog->SortUrl($memberupdatelog->update_detail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $memberupdatelog->update_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($memberupdatelog->update_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberupdatelog->update_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($memberupdatelog->update_date->Visible) { // update_date ?>
	<?php if ($memberupdatelog->SortUrl($memberupdatelog->update_date) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $memberupdatelog->update_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memberupdatelog->SortUrl($memberupdatelog->update_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $memberupdatelog->update_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($memberupdatelog->update_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberupdatelog->update_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($memberupdatelog->author->Visible) { // author ?>
	<?php if ($memberupdatelog->SortUrl($memberupdatelog->author) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $memberupdatelog->author->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memberupdatelog->SortUrl($memberupdatelog->author) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $memberupdatelog->author->FldCaption() ?></td><td style="width: 10px;"><?php if ($memberupdatelog->author->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberupdatelog->author->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$memberupdatelog_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($memberupdatelog->ExportAll && $memberupdatelog->Export <> "") {
	$memberupdatelog_list->StopRec = $memberupdatelog_list->TotalRecs;
} else {

	// Set the last record to display
	if ($memberupdatelog_list->TotalRecs > $memberupdatelog_list->StartRec + $memberupdatelog_list->DisplayRecs - 1)
		$memberupdatelog_list->StopRec = $memberupdatelog_list->StartRec + $memberupdatelog_list->DisplayRecs - 1;
	else
		$memberupdatelog_list->StopRec = $memberupdatelog_list->TotalRecs;
}
$memberupdatelog_list->RecCnt = $memberupdatelog_list->StartRec - 1;
if ($memberupdatelog_list->Recordset && !$memberupdatelog_list->Recordset->EOF) {
	$memberupdatelog_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $memberupdatelog_list->StartRec > 1)
		$memberupdatelog_list->Recordset->Move($memberupdatelog_list->StartRec - 1);
} elseif (!$memberupdatelog->AllowAddDeleteRow && $memberupdatelog_list->StopRec == 0) {
	$memberupdatelog_list->StopRec = $memberupdatelog->GridAddRowCount;
}

// Initialize aggregate
$memberupdatelog->RowType = EW_ROWTYPE_AGGREGATEINIT;
$memberupdatelog->ResetAttrs();
$memberupdatelog_list->RenderRow();
$memberupdatelog_list->RowCnt = 0;
while ($memberupdatelog_list->RecCnt < $memberupdatelog_list->StopRec) {
	$memberupdatelog_list->RecCnt++;
	if (intval($memberupdatelog_list->RecCnt) >= intval($memberupdatelog_list->StartRec)) {
		$memberupdatelog_list->RowCnt++;

		// Set up key count
		$memberupdatelog_list->KeyCount = $memberupdatelog_list->RowIndex;

		// Init row class and style
		$memberupdatelog->ResetAttrs();
		$memberupdatelog->CssClass = "";
		if ($memberupdatelog->CurrentAction == "gridadd") {
		} else {
			$memberupdatelog_list->LoadRowValues($memberupdatelog_list->Recordset); // Load row values
		}
		$memberupdatelog->RowType = EW_ROWTYPE_VIEW; // Render view
		$memberupdatelog->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$memberupdatelog_list->RenderRow();

		// Render list options
		$memberupdatelog_list->RenderListOptions();
?>
	<tr<?php echo $memberupdatelog->RowAttributes() ?>>
<?php

// Render list options (body, left)
$memberupdatelog_list->ListOptions->Render("body", "left");
?>
	<?php if ($memberupdatelog->update_detail->Visible) { // update_detail ?>
		<td<?php echo $memberupdatelog->update_detail->CellAttributes() ?>>
<div<?php echo $memberupdatelog->update_detail->ViewAttributes() ?>><?php echo $memberupdatelog->update_detail->ListViewValue() ?></div>
<a name="<?php echo $memberupdatelog_list->PageObjName . "_row_" . $memberupdatelog_list->RowCnt ?>" id="<?php echo $memberupdatelog_list->PageObjName . "_row_" . $memberupdatelog_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($memberupdatelog->update_date->Visible) { // update_date ?>
		<td<?php echo $memberupdatelog->update_date->CellAttributes() ?>>
<div<?php echo $memberupdatelog->update_date->ViewAttributes() ?>><?php echo $memberupdatelog->update_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($memberupdatelog->author->Visible) { // author ?>
		<td<?php echo $memberupdatelog->author->CellAttributes() ?>>
<div<?php echo $memberupdatelog->author->ViewAttributes() ?>><?php echo $memberupdatelog->author->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$memberupdatelog_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($memberupdatelog->CurrentAction <> "gridadd")
		$memberupdatelog_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($memberupdatelog_list->Recordset)
	$memberupdatelog_list->Recordset->Close();
?>
<?php if ($memberupdatelog_list->TotalRecs > 0) { ?>
<?php if ($memberupdatelog->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($memberupdatelog->CurrentAction <> "gridadd" && $memberupdatelog->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($memberupdatelog_list->Pager)) $memberupdatelog_list->Pager = new cPrevNextPager($memberupdatelog_list->StartRec, $memberupdatelog_list->DisplayRecs, $memberupdatelog_list->TotalRecs) ?>
<?php if ($memberupdatelog_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($memberupdatelog_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_list->PageUrl() ?>start=<?php echo $memberupdatelog_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($memberupdatelog_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_list->PageUrl() ?>start=<?php echo $memberupdatelog_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $memberupdatelog_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($memberupdatelog_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_list->PageUrl() ?>start=<?php echo $memberupdatelog_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($memberupdatelog_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_list->PageUrl() ?>start=<?php echo $memberupdatelog_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $memberupdatelog_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $memberupdatelog_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $memberupdatelog_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $memberupdatelog_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($memberupdatelog_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($memberupdatelog_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="memberupdatelog">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($memberupdatelog_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($memberupdatelog_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($memberupdatelog_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($memberupdatelog_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($memberupdatelog_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($memberupdatelog_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($memberupdatelog_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($memberupdatelog_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($memberupdatelog_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($memberupdatelog->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
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
<?php if ($memberupdatelog->Export == "" && $memberupdatelog->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(memberupdatelog_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$memberupdatelog_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($memberupdatelog->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$memberupdatelog_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemberupdatelog_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'memberupdatelog';

	// Page object name
	var $PageObjName = 'memberupdatelog_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memberupdatelog;
		if ($memberupdatelog->UseTokenInUrl) $PageUrl .= "t=" . $memberupdatelog->TableVar . "&"; // Add page token
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
		global $objForm, $memberupdatelog;
		if ($memberupdatelog->UseTokenInUrl) {
			if ($objForm)
				return ($memberupdatelog->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memberupdatelog->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemberupdatelog_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memberupdatelog)
		if (!isset($GLOBALS["memberupdatelog"])) {
			$GLOBALS["memberupdatelog"] = new cmemberupdatelog();
			$GLOBALS["Table"] =& $GLOBALS["memberupdatelog"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "memberupdatelogadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "memberupdatelogdelete.php";
		$this->MultiUpdateUrl = "memberupdatelogupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (members)
		if (!isset($GLOBALS['members'])) $GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'memberupdatelog', TRUE);

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
		global $memberupdatelog;

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
			$memberupdatelog->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $memberupdatelog;

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
			if ($memberupdatelog->Export <> "" ||
				$memberupdatelog->CurrentAction == "gridadd" ||
				$memberupdatelog->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($memberupdatelog->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $memberupdatelog->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $memberupdatelog->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $memberupdatelog->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($memberupdatelog->getMasterFilter() <> "" && $memberupdatelog->getCurrentMasterTable() == "members") {
			global $members;
			$rsmaster = $members->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($memberupdatelog->getReturnUrl()); // Return to caller
			} else {
				$members->LoadListRowValues($rsmaster);
				$members->RowType = EW_ROWTYPE_MASTER; // Master row
				$members->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$memberupdatelog->setSessionWhere($sFilter);
		$memberupdatelog->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $memberupdatelog;
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
			$memberupdatelog->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$memberupdatelog->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $memberupdatelog;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$memberupdatelog->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$memberupdatelog->CurrentOrderType = @$_GET["ordertype"];
			$memberupdatelog->UpdateSort($memberupdatelog->update_detail); // update_detail
			$memberupdatelog->UpdateSort($memberupdatelog->update_date); // update_date
			$memberupdatelog->UpdateSort($memberupdatelog->author); // author
			$memberupdatelog->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $memberupdatelog;
		$sOrderBy = $memberupdatelog->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($memberupdatelog->SqlOrderBy() <> "") {
				$sOrderBy = $memberupdatelog->SqlOrderBy();
				$memberupdatelog->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $memberupdatelog;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$memberupdatelog->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$memberupdatelog->member_code->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$memberupdatelog->setSessionOrderBy($sOrderBy);
				$memberupdatelog->update_detail->setSort("");
				$memberupdatelog->update_date->setSort("");
				$memberupdatelog->author->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$memberupdatelog->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $memberupdatelog;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $memberupdatelog, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $memberupdatelog;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $memberupdatelog;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$memberupdatelog->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$memberupdatelog->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $memberupdatelog->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$memberupdatelog->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$memberupdatelog->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$memberupdatelog->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $memberupdatelog;

		// Call Recordset Selecting event
		$memberupdatelog->Recordset_Selecting($memberupdatelog->CurrentFilter);

		// Load List page SQL
		$sSql = $memberupdatelog->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$memberupdatelog->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memberupdatelog;
		$sFilter = $memberupdatelog->KeyFilter();

		// Call Row Selecting event
		$memberupdatelog->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memberupdatelog->CurrentFilter = $sFilter;
		$sSql = $memberupdatelog->SQL();
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
		global $conn, $memberupdatelog;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memberupdatelog->Row_Selected($row);
		$memberupdatelog->mu_id->setDbValue($rs->fields('mu_id'));
		$memberupdatelog->member_code->setDbValue($rs->fields('member_code'));
		$memberupdatelog->update_detail->setDbValue($rs->fields('update_detail'));
		$memberupdatelog->update_date->setDbValue($rs->fields('update_date'));
		$memberupdatelog->author->setDbValue($rs->fields('author'));
	}

	// Load old record
	function LoadOldRecord() {
		global $memberupdatelog;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($memberupdatelog->getKey("mu_id")) <> "")
			$memberupdatelog->mu_id->CurrentValue = $memberupdatelog->getKey("mu_id"); // mu_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$memberupdatelog->CurrentFilter = $memberupdatelog->KeyFilter();
			$sSql = $memberupdatelog->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memberupdatelog;

		// Initialize URLs
		$this->ViewUrl = $memberupdatelog->ViewUrl();
		$this->EditUrl = $memberupdatelog->EditUrl();
		$this->InlineEditUrl = $memberupdatelog->InlineEditUrl();
		$this->CopyUrl = $memberupdatelog->CopyUrl();
		$this->InlineCopyUrl = $memberupdatelog->InlineCopyUrl();
		$this->DeleteUrl = $memberupdatelog->DeleteUrl();

		// Call Row_Rendering event
		$memberupdatelog->Row_Rendering();

		// Common render codes for all row types
		// mu_id

		$memberupdatelog->mu_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$memberupdatelog->member_code->CellCssStyle = "white-space: nowrap;";

		// update_detail
		$memberupdatelog->update_detail->CellCssStyle = "white-space: nowrap;";

		// update_date
		$memberupdatelog->update_date->CellCssStyle = "white-space: nowrap;";

		// author
		$memberupdatelog->author->CellCssStyle = "white-space: nowrap;";
		if ($memberupdatelog->RowType == EW_ROWTYPE_VIEW) { // View row

			// update_detail
			$memberupdatelog->update_detail->ViewValue = $memberupdatelog->update_detail->CurrentValue;
			$memberupdatelog->update_detail->ViewCustomAttributes = "";

			// update_date
			$memberupdatelog->update_date->ViewValue = $memberupdatelog->update_date->CurrentValue;
			$memberupdatelog->update_date->ViewValue = ew_FormatDateTime($memberupdatelog->update_date->ViewValue, 7);
			$memberupdatelog->update_date->ViewCustomAttributes = "";

			// author
			$memberupdatelog->author->ViewValue = $memberupdatelog->author->CurrentValue;
			$memberupdatelog->author->ViewCustomAttributes = "";

			// update_detail
			$memberupdatelog->update_detail->LinkCustomAttributes = "";
			$memberupdatelog->update_detail->HrefValue = "";
			$memberupdatelog->update_detail->TooltipValue = "";

			// update_date
			$memberupdatelog->update_date->LinkCustomAttributes = "";
			$memberupdatelog->update_date->HrefValue = "";
			$memberupdatelog->update_date->TooltipValue = "";

			// author
			$memberupdatelog->author->LinkCustomAttributes = "";
			$memberupdatelog->author->HrefValue = "";
			$memberupdatelog->author->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($memberupdatelog->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memberupdatelog->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $memberupdatelog;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "members") {
				$bValidMaster = TRUE;
				if (@$_GET["member_code"] <> "") {
					$GLOBALS["members"]->member_code->setQueryStringValue($_GET["member_code"]);
					$memberupdatelog->member_code->setQueryStringValue($GLOBALS["members"]->member_code->QueryStringValue);
					$memberupdatelog->member_code->setSessionValue($memberupdatelog->member_code->QueryStringValue);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$memberupdatelog->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$memberupdatelog->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "members") {
				if ($memberupdatelog->member_code->QueryStringValue == "") $memberupdatelog->member_code->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $memberupdatelog->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $memberupdatelog->getDetailFilter(); // Get detail filter
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
