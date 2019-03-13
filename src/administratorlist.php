<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$administrator_list = new cadministrator_list();
$Page =& $administrator_list;

// Page init
$administrator_list->Page_Init();

// Page main
$administrator_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($administrator->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var administrator_list = new ew_Page("administrator_list");

// page properties
administrator_list.PageID = "list"; // page ID
administrator_list.FormID = "fadministratorlist"; // form ID
var EW_PAGE_ID = administrator_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
administrator_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
administrator_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
administrator_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
administrator_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($administrator->Export == "") || (EW_EXPORT_MASTER_RECORD && $administrator->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$administrator_list->TotalRecs = $administrator->SelectRecordCount();
	} else {
		if ($administrator_list->Recordset = $administrator_list->LoadRecordset())
			$administrator_list->TotalRecs = $administrator_list->Recordset->RecordCount();
	}
	$administrator_list->StartRec = 1;
	if ($administrator_list->DisplayRecs <= 0 || ($administrator->Export <> "" && $administrator->ExportAll)) // Display all records
		$administrator_list->DisplayRecs = $administrator_list->TotalRecs;
	if (!($administrator->Export <> "" && $administrator->ExportAll))
		$administrator_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$administrator_list->Recordset = $administrator_list->LoadRecordset($administrator_list->StartRec-1, $administrator_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $administrator->TableCaption() ?>
&nbsp;&nbsp;<?php $administrator_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($administrator->Export == "" && $administrator->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(administrator_list);" style="text-decoration: none;"><img id="administrator_list_SearchImage" src="phpimages/collapse.png" alt=""  border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="administrator_list_SearchPanel">
<form name="fadministratorlistsrch" id="fadministratorlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="administrator">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($administrator->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $administrator_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($administrator->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($administrator->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($administrator->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $administrator_list->ShowPageHeader(); ?>
<?php
$administrator_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($administrator->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($administrator->CurrentAction <> "gridadd" && $administrator->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($administrator_list->Pager)) $administrator_list->Pager = new cPrevNextPager($administrator_list->StartRec, $administrator_list->DisplayRecs, $administrator_list->TotalRecs) ?>
<?php if ($administrator_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($administrator_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $administrator_list->PageUrl() ?>start=<?php echo $administrator_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($administrator_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $administrator_list->PageUrl() ?>start=<?php echo $administrator_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $administrator_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($administrator_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $administrator_list->PageUrl() ?>start=<?php echo $administrator_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($administrator_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $administrator_list->PageUrl() ?>start=<?php echo $administrator_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $administrator_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $administrator_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $administrator_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $administrator_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($administrator_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($administrator_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="administrator">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($administrator_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($administrator_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($administrator_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($administrator_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($administrator_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($administrator_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($administrator_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($administrator_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($administrator_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
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
<form name="fadministratorlist" id="fadministratorlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="administrator">
<div id="gmp_administrator" class="ewGridMiddlePanel">
<?php if ($administrator_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $administrator->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$administrator_list->RenderListOptions();

// Render list options (header, left)
$administrator_list->ListOptions->Render("header", "left");
?>
<?php if ($administrator->member_id->Visible) { // member_id ?>
	<?php if ($administrator->SortUrl($administrator->member_id) == "") { ?>
		<td><?php echo $administrator->member_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $administrator->SortUrl($administrator->member_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $administrator->member_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($administrator->member_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($administrator->member_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($administrator->username->Visible) { // username ?>
	<?php if ($administrator->SortUrl($administrator->username) == "") { ?>
		<td><?php echo $administrator->username->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $administrator->SortUrl($administrator->username) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $administrator->username->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($administrator->username->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($administrator->username->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($administrator->password->Visible) { // password ?>
	<?php if ($administrator->SortUrl($administrator->password) == "") { ?>
		<td><?php echo $administrator->password->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $administrator->SortUrl($administrator->password) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $administrator->password->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($administrator->password->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($administrator->password->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($administrator->name->Visible) { // name ?>
	<?php if ($administrator->SortUrl($administrator->name) == "") { ?>
		<td><?php echo $administrator->name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $administrator->SortUrl($administrator->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $administrator->name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($administrator->name->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($administrator->name->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($administrator->lastlogin->Visible) { // lastlogin ?>
	<?php if ($administrator->SortUrl($administrator->lastlogin) == "") { ?>
		<td><?php echo $administrator->lastlogin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $administrator->SortUrl($administrator->lastlogin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $administrator->lastlogin->FldCaption() ?></td><td style="width: 10px;"><?php if ($administrator->lastlogin->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($administrator->lastlogin->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$administrator_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($administrator->ExportAll && $administrator->Export <> "") {
	$administrator_list->StopRec = $administrator_list->TotalRecs;
} else {

	// Set the last record to display
	if ($administrator_list->TotalRecs > $administrator_list->StartRec + $administrator_list->DisplayRecs - 1)
		$administrator_list->StopRec = $administrator_list->StartRec + $administrator_list->DisplayRecs - 1;
	else
		$administrator_list->StopRec = $administrator_list->TotalRecs;
}
$administrator_list->RecCnt = $administrator_list->StartRec - 1;
if ($administrator_list->Recordset && !$administrator_list->Recordset->EOF) {
	$administrator_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $administrator_list->StartRec > 1)
		$administrator_list->Recordset->Move($administrator_list->StartRec - 1);
} elseif (!$administrator->AllowAddDeleteRow && $administrator_list->StopRec == 0) {
	$administrator_list->StopRec = $administrator->GridAddRowCount;
}

// Initialize aggregate
$administrator->RowType = EW_ROWTYPE_AGGREGATEINIT;
$administrator->ResetAttrs();
$administrator_list->RenderRow();
$administrator_list->RowCnt = 0;
while ($administrator_list->RecCnt < $administrator_list->StopRec) {
	$administrator_list->RecCnt++;
	if (intval($administrator_list->RecCnt) >= intval($administrator_list->StartRec)) {
		$administrator_list->RowCnt++;

		// Set up key count
		$administrator_list->KeyCount = $administrator_list->RowIndex;

		// Init row class and style
		$administrator->ResetAttrs();
		$administrator->CssClass = "";
		if ($administrator->CurrentAction == "gridadd") {
		} else {
			$administrator_list->LoadRowValues($administrator_list->Recordset); // Load row values
		}
		$administrator->RowType = EW_ROWTYPE_VIEW; // Render view
		$administrator->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$administrator_list->RenderRow();

		// Render list options
		$administrator_list->RenderListOptions();
?>
	<tr<?php echo $administrator->RowAttributes() ?>>
<?php

// Render list options (body, left)
$administrator_list->ListOptions->Render("body", "left");
?>
	<?php if ($administrator->member_id->Visible) { // member_id ?>
		<td<?php echo $administrator->member_id->CellAttributes() ?>>
<div<?php echo $administrator->member_id->ViewAttributes() ?>><?php echo $administrator->member_id->ListViewValue() ?></div>
<a name="<?php echo $administrator_list->PageObjName . "_row_" . $administrator_list->RowCnt ?>" id="<?php echo $administrator_list->PageObjName . "_row_" . $administrator_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($administrator->username->Visible) { // username ?>
		<td<?php echo $administrator->username->CellAttributes() ?>>
<div<?php echo $administrator->username->ViewAttributes() ?>><?php echo $administrator->username->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($administrator->password->Visible) { // password ?>
		<td<?php echo $administrator->password->CellAttributes() ?>>
<div<?php echo $administrator->password->ViewAttributes() ?>><?php echo $administrator->password->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($administrator->name->Visible) { // name ?>
		<td<?php echo $administrator->name->CellAttributes() ?>>
<div<?php echo $administrator->name->ViewAttributes() ?>><?php echo $administrator->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($administrator->lastlogin->Visible) { // lastlogin ?>
		<td<?php echo $administrator->lastlogin->CellAttributes() ?>>
<div<?php echo $administrator->lastlogin->ViewAttributes() ?>><?php echo $administrator->lastlogin->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$administrator_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($administrator->CurrentAction <> "gridadd")
		$administrator_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($administrator_list->Recordset)
	$administrator_list->Recordset->Close();
?>
<?php if ($administrator_list->TotalRecs > 0) { ?>
<?php if ($administrator->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($administrator->CurrentAction <> "gridadd" && $administrator->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($administrator_list->Pager)) $administrator_list->Pager = new cPrevNextPager($administrator_list->StartRec, $administrator_list->DisplayRecs, $administrator_list->TotalRecs) ?>
<?php if ($administrator_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($administrator_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $administrator_list->PageUrl() ?>start=<?php echo $administrator_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($administrator_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $administrator_list->PageUrl() ?>start=<?php echo $administrator_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $administrator_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($administrator_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $administrator_list->PageUrl() ?>start=<?php echo $administrator_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($administrator_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $administrator_list->PageUrl() ?>start=<?php echo $administrator_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $administrator_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $administrator_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $administrator_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $administrator_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($administrator_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($administrator_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="administrator">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($administrator_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($administrator_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($administrator_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($administrator_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($administrator_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($administrator_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($administrator_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($administrator_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($administrator_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
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
<?php if ($administrator->Export == "" && $administrator->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(administrator_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$administrator_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($administrator->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$administrator_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cadministrator_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'administrator';

	// Page object name
	var $PageObjName = 'administrator_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $administrator;
		if ($administrator->UseTokenInUrl) $PageUrl .= "t=" . $administrator->TableVar . "&"; // Add page token
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
		global $objForm, $administrator;
		if ($administrator->UseTokenInUrl) {
			if ($objForm)
				return ($administrator->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($administrator->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cadministrator_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (administrator)
		if (!isset($GLOBALS["administrator"])) {
			$GLOBALS["administrator"] = new cadministrator();
			$GLOBALS["Table"] =& $GLOBALS["administrator"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "administratoradd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "administratordelete.php";
		$this->MultiUpdateUrl = "administratorupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'administrator', TRUE);

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
		global $administrator;

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
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate();
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$administrator->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$administrator->Export = $_POST["exporttype"];
		} else {
			$administrator->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $administrator->Export; // Get export parameter, used in header
		$gsExportFile = $administrator->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($administrator->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($administrator->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$administrator->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $administrator;

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
			if ($administrator->Export <> "" ||
				$administrator->CurrentAction == "gridadd" ||
				$administrator->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$administrator->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($administrator->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $administrator->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$administrator->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$administrator->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$administrator->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $administrator->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$administrator->setSessionWhere($sFilter);
		$administrator->CurrentFilter = "";

		// Export data only
		if (in_array($administrator->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($administrator->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $administrator;
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
			$administrator->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$administrator->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $administrator;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $administrator->username, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $administrator->password, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $administrator->name, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", $lFldDataType));
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $administrator;
		$sSearchStr = "";
		$sSearchKeyword = $administrator->BasicSearchKeyword;
		$sSearchType = $administrator->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$administrator->setSessionBasicSearchKeyword($sSearchKeyword);
			$administrator->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $administrator;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$administrator->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $administrator;
		$administrator->setSessionBasicSearchKeyword("");
		$administrator->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $administrator;
		$bRestore = TRUE;
		if ($administrator->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$administrator->BasicSearchKeyword = $administrator->getSessionBasicSearchKeyword();
			$administrator->BasicSearchType = $administrator->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $administrator;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$administrator->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$administrator->CurrentOrderType = @$_GET["ordertype"];
			$administrator->UpdateSort($administrator->member_id); // member_id
			$administrator->UpdateSort($administrator->username); // username
			$administrator->UpdateSort($administrator->password); // password
			$administrator->UpdateSort($administrator->name); // name
			$administrator->UpdateSort($administrator->lastlogin); // lastlogin
			$administrator->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $administrator;
		$sOrderBy = $administrator->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($administrator->SqlOrderBy() <> "") {
				$sOrderBy = $administrator->SqlOrderBy();
				$administrator->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $administrator;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$administrator->setSessionOrderBy($sOrderBy);
				$administrator->member_id->setSort("");
				$administrator->username->setSort("");
				$administrator->password->setSort("");
				$administrator->name->setSort("");
				$administrator->lastlogin->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$administrator->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $administrator;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $administrator, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $administrator;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $administrator;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$administrator->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$administrator->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $administrator->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$administrator->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$administrator->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$administrator->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $administrator;
		$administrator->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$administrator->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $administrator;

		// Call Recordset Selecting event
		$administrator->Recordset_Selecting($administrator->CurrentFilter);

		// Load List page SQL
		$sSql = $administrator->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$administrator->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $administrator;
		$sFilter = $administrator->KeyFilter();

		// Call Row Selecting event
		$administrator->Row_Selecting($sFilter);

		// Load SQL based on filter
		$administrator->CurrentFilter = $sFilter;
		$sSql = $administrator->SQL();
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
		global $conn, $administrator;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$administrator->Row_Selected($row);
		$administrator->member_id->setDbValue($rs->fields('member_id'));
		$administrator->username->setDbValue($rs->fields('username'));
		$administrator->password->setDbValue($rs->fields('password'));
		$administrator->name->setDbValue($rs->fields('name'));
		$administrator->lastlogin->setDbValue($rs->fields('lastlogin'));
	}

	// Load old record
	function LoadOldRecord() {
		global $administrator;

		// Load key values from Session
		$bValidKey = TRUE;

		// Load old recordset
		if ($bValidKey) {
			$administrator->CurrentFilter = $administrator->KeyFilter();
			$sSql = $administrator->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $administrator;

		// Initialize URLs
		$this->ViewUrl = $administrator->ViewUrl();
		$this->EditUrl = $administrator->EditUrl();
		$this->InlineEditUrl = $administrator->InlineEditUrl();
		$this->CopyUrl = $administrator->CopyUrl();
		$this->InlineCopyUrl = $administrator->InlineCopyUrl();
		$this->DeleteUrl = $administrator->DeleteUrl();

		// Call Row_Rendering event
		$administrator->Row_Rendering();

		// Common render codes for all row types
		// member_id
		// username
		// password
		// name
		// lastlogin

		if ($administrator->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_id
			if (strval($administrator->member_id->CurrentValue) <> "") {
				switch ($administrator->member_id->CurrentValue) {
					case "-1":
						$administrator->member_id->ViewValue = $administrator->member_id->FldTagCaption(1) <> "" ? $administrator->member_id->FldTagCaption(1) : $administrator->member_id->CurrentValue;
						break;
					case "0":
						$administrator->member_id->ViewValue = $administrator->member_id->FldTagCaption(2) <> "" ? $administrator->member_id->FldTagCaption(2) : $administrator->member_id->CurrentValue;
						break;
					case "1":
						$administrator->member_id->ViewValue = $administrator->member_id->FldTagCaption(3) <> "" ? $administrator->member_id->FldTagCaption(3) : $administrator->member_id->CurrentValue;
						break;
					default:
						$administrator->member_id->ViewValue = $administrator->member_id->CurrentValue;
				}
			} else {
				$administrator->member_id->ViewValue = NULL;
			}
			$administrator->member_id->ViewCustomAttributes = "";

			// username
			$administrator->username->ViewValue = $administrator->username->CurrentValue;
			$administrator->username->ViewCustomAttributes = "";

			// password
			$administrator->password->ViewValue = $administrator->password->CurrentValue;
			$administrator->password->ViewCustomAttributes = "";

			// name
			$administrator->name->ViewValue = $administrator->name->CurrentValue;
			$administrator->name->ViewCustomAttributes = "";

			// lastlogin
			$administrator->lastlogin->ViewValue = $administrator->lastlogin->CurrentValue;
			$administrator->lastlogin->ViewValue = ew_FormatDateTime($administrator->lastlogin->ViewValue, 7);
			$administrator->lastlogin->ViewCustomAttributes = "";

			// member_id
			$administrator->member_id->LinkCustomAttributes = "";
			$administrator->member_id->HrefValue = "";
			$administrator->member_id->TooltipValue = "";

			// username
			$administrator->username->LinkCustomAttributes = "";
			$administrator->username->HrefValue = "";
			$administrator->username->TooltipValue = "";

			// password
			$administrator->password->LinkCustomAttributes = "";
			$administrator->password->HrefValue = "";
			$administrator->password->TooltipValue = "";

			// name
			$administrator->name->LinkCustomAttributes = "";
			$administrator->name->HrefValue = "";
			$administrator->name->TooltipValue = "";

			// lastlogin
			$administrator->lastlogin->LinkCustomAttributes = "";
			$administrator->lastlogin->HrefValue = "";
			$administrator->lastlogin->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($administrator->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$administrator->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $administrator;

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
		$item->Body = "<a name=\"emf_administrator\" id=\"emf_administrator\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_administrator',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fadministratorlist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($administrator->Export <> "" ||
			$administrator->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $administrator;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $administrator->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($administrator->ExportAll) {
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
		if ($administrator->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($administrator, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($administrator->Export == "xml") {
			$administrator->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$administrator->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($administrator->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($administrator->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($administrator->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($administrator->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($administrator->ExportReturnUrl());
		} elseif ($administrator->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $administrator;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($administrator->member_id->CurrentValue);
			}
		}
		return TRUE;
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
